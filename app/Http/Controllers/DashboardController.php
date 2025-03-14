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
    public function dashboard(){
        $customer = Customer::count();
        $claim = Claim::count();
        $rental = Rental::count();
        $sales = Payment::sum('rental_amount');

        // $currentDate = Carbon::today()->toDateString();
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();
        $rentalToday = Rental::where('pickup_date','=',$currentDate)->get();
        $returnToday = Rental::where('return_date','=',$currentDate)->get();
        $car = Fleet::whereDoesntHave('rentals', function ($query) use ($currentDate) {
            $query->where('pickup_date', '<=', $currentDate)
                ->where('return_date', '>=', $currentDate);
        })->get();

        // return response()->json($availableCars);

        // return response()->json($rental_sum);

        $data = [
            'customer'=>$customer,
            'claim'=>$claim,
            'rental'=>$rental,
            'sales'=>$sales,
            'returnToday'=>$returnToday,
            'car'=>$car
        ];

        return view('dashboard', compact('data','rentalToday'));
    }

    public function test(){
        $customer = Customer::count();
        dd($customer);
    }
}
