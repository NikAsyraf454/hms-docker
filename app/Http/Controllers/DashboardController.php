<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Claim;
use App\Models\Rental;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function dashboard(){
        $customer = Customer::count();
        $claim = Claim::count();
        $rental = Rental::count();
        $sales = Payment::sum('rental_amount');

        // return response()->json($rental_sum);

        $data = ['customer'=>$customer,'claim'=>$claim,'rental'=>$rental,'sales'=>$sales];


        return view('dashboard', compact('data'));
    }

    public function test(){
        $customer = Customer::count();
        dd($customer);
    }
}
