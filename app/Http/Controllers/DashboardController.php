<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Claim;
use App\Models\Rental;
use App\Models\Payment;
use App\Models\Fleet;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function getDashboardData()
    {
        // Get current date and time in KL timezone
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();
        $currentTime = Carbon::now('Asia/Kuala_Lumpur')->toTimeString();

        // Get counts and sums
        $customer = Customer::count();
        $claim = Claim::count();
        $rental = Rental::whereMonth('pickup_date', Carbon::now('Asia/Kuala_Lumpur')->month)
                ->whereYear('pickup_date', Carbon::now('Asia/Kuala_Lumpur')->year)
                ->count();
        $sales = Payment::whereMonth('payment_date', Carbon::now('Asia/Kuala_Lumpur')->month)
                ->whereYear('payment_date', Carbon::now('Asia/Kuala_Lumpur')->year)
                ->sum('rental_amount');

        // Get today's rentals and returns
        $rentalToday = Rental::where('pickup_date', '=', $currentDate)->get();
        $returnToday = Rental::where('return_date', '=', $currentDate)->get();

        // Get available cars
        $car = Fleet::whereDoesntHave('rentals', function ($query) use ($currentDate) {
            $query->where(function ($query) use ($currentDate) {
            $query->where('pickup_date', '<=', $currentDate)
                ->where('return_date', '>=', $currentDate)
                ->where('pickup_time', '<=', '23:59:59')
                ->where('return_time', '>=', '00:00:00');
            });
        })->get();

        return [
            'customer' => $customer,
            'claim' => $claim,
            'rental' => $rental,
            'sales' => $sales,
            'returnToday' => $returnToday,
            'car' => $car,
            'rentalToday' => $rentalToday
        ];
    }

    public function dashboard()
    {
        $data = $this->getDashboardData();
        // dd($data['rentalToday']);
        return view('dashboard', compact('data'));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'return_time' => 'required',
        ]);

        $pickup = $request->pickup_date . ' ' . $request->pickup_time;
        $return = $request->return_date . ' ' . $request->return_time;

        // Get all fleet IDs that are already booked for this period
        $bookedFleetIds = Rental::where(function($query) use ($pickup, $return) {
            $query->where(function($q) use ($pickup, $return) {
                $q->where('pickup_date', '<=', $pickup)
                ->where('return_date', '>=', $pickup);
            })->orWhere(function($q) use ($pickup, $return) {
                $q->where('pickup_date', '<=', $return)
                ->where('return_date', '>=', $return);
            });
        })->pluck('fleet_id');

        // Get available fleets
        $availableFleets = Fleet::whereNotIn('id', $bookedFleetIds)->get();

        // Get all data needed for dashboard
        $data = $this->getDashboardData();
        
        return view('dashboard', compact('availableFleets', 'data'));
    }

    public function test(){
        $customer = Customer::count();
        dd($customer);
    }
}
