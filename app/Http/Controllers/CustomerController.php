<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Services\CustomerService;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    protected $customerService;

    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }

    public function index(){
        $customers = Customer::get();

        return view('customer.index', compact('customers'));
    }

    public function show($id){
        $customer = $this->customerService->getCustomerById($id);
        // return response()->json($customer);
        return view('customer.show', compact('customer'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        $customers = Customer::where('name', 'LIKE', "%{$query}%")
            ->orWhere('matric', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($customers);
    }

}
