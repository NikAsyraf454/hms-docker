<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Fleet;

use App\Services\CustomerService;
use App\Services\RentalService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService, RentalService $rentalService){
        $this->customerService = $customerService;
        $this->rentalService = $rentalService;
    }

    public function index(){
        $rentals = Rental::with(['customer', 'staff', 'fleet'])->paginate(5);

        return view('rental.index')->with('rentals', $rentals);
    }

    public function create(){
        $fleet = Fleet::all();
        // $customer = Customer::all();
        // dd($fleet);
       return view('rental.create', compact('fleet'));
    }

    public function store(StoreRentalRequest $request, storeCustomerRequest $crequest){
        $customerRequest = $crequest->validated();
        $depositRequest = $drequest->validated();
        $rentalRequest = $request->validated();

        // dd($rentalRequest);

        $customer = DB::table('customers')
                    ->where('matric', $customerRequest['matric'])
                    ->first();

        if($customer){
            //store rental only
            $rentalRequest['customer_id'] = $customer->id;
            // dd($rentalRequest); 

            $this->rentalService->storeRental($rentalRequest);
            // dd('woa kosong');
        }else{
            //store rental and customer
            $customer = $this->customerService->storeCustomer($customerRequest);

            $rentalRequest['customer_id'] = $customer;
            
            $this->rentalService->storeRental($rentalRequest);

        }
    
        return redirect()->route('rental.index')
        ->with('success', 'Rental created successfully.');
    }

    public function show($id){
        $rental = Rental::find($id);
        return view('rental.show', compact('rental'));
    }

    public function edit($id){
        $rental = Rental::find($id);
        return view('rental.edit', compact('rental'));
    }

    public function update(Request $request, $id){
        
        $rental = Rental::find($id);
        $rental->update($request->all());
        return redirect()->route('rental.index')
        ->with('success', 'Rental updated successfully.');
    }

    public function destroy($id){
        $rental = Rental::find($id);
        $rental->delete();
        return redirect()->route('rental.index')
        ->with('success', 'Rental deleted successfully');
    }
}
