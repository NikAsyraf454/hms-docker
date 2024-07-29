<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\DepositRequest;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Fleet;

use App\Services\CustomerService;
use App\Services\RentalService;
use App\Services\DepositService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService, RentalService $rentalService, DepositService $depositService){
        $this->customerService = $customerService;
        $this->rentalService = $rentalService;
        $this->depositService = $depositService;
    }

    public function index(){
        $rentals = Rental::with(['customer', 'staff', 'fleet'])->get();

        return view('rental.index')->with('rentals', $rentals);
    }

    public function create(){
        // $fleet = $this->rentalService->listRental();
        $fleet = Fleet::get();
        // dd($fleet);
        return view('rental.create', compact('fleet'));
    }

    public function store(StoreRentalRequest $request, storeCustomerRequest $crequest, DepositRequest $drequest){
        
        $user_id = session('user_id');
        
        $customerRequest = $crequest->validated();
        $depositRequest = $drequest->validated();
        $rentalRequest = $request->validated();

        // dd($rentalRequest);

        $depositRequest['updated_by'] = $user_id;

        $customer = DB::table('customers')
                    ->where('matric', $customerRequest['matric'])
                    ->first();


        if($customer){
            //store rental only
            $rentalRequest['customer_id'] = $customer->id;
            $deposit = $this->depositService->addDeposit($depositRequest);
            $rentalRequest['depo_id'] = $deposit->id;

            $this->rentalService->storeRental($rentalRequest);
           
        }else{
            //store rental and customer
            $deposit = $this->depositService->addDeposit($depositRequest);
            $rentalRequest['depo_id'] = $deposit->id;

            $customer = $this->customerService->storeCustomer($customerRequest);

            $rentalRequest['customer_id'] = $customer;
            
            // dd($rentalRequest);
           $this->rentalService->storeRental($rentalRequest);

        }
    
        return redirect()->route('rental.index')
        ->with('success', 'Rental created successfully.');
    }

    public function show($id){
        $rental = $this->rentalService->getRentalById($id);
        // return response()->json($rental);
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
