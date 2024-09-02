<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Fleet;
use App\Models\Inspection;
use App\Models\Payment;
use App\Models\Deposit;

use App\Services\CustomerService;
use App\Services\RentalService;
use App\Services\DepositService;
use App\Services\PaymentService;
use App\Services\InspectionService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService, RentalService $rentalService, DepositService $depositService, PaymentService $paymentService, InspectionService $inspectionService){
        $this->customerService = $customerService;
        $this->rentalService = $rentalService;
        $this->depositService = $depositService;
        $this->paymentService = $paymentService;
        $this->inspectionService = $inspectionService;
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

    public function store(Request $request,StoreRentalRequest $rrequest, storeCustomerRequest $crequest, DepositRequest $drequest, PaymentRequest $prequest){
        
        $user_id = session('user_id');
        
        $customerRequest = $crequest->validated();
        $depositRequest = $drequest->validated();
        $rentalRequest = $rrequest->validated();
        $paymentRequest = $prequest->validated();

        $filePay = $request->file('payment_proof');
        $fileDepo = $request->file('deposit_proof');

        $depositRequest['updated_by'] = $user_id;

        $customer = DB::table('customers')
                    ->where('matric', $customerRequest['matric'])
                    ->first();

        if($customer){
            //store rental only
            $rentalRequest['customer_id'] = $customer->id;
            $deposit = $this->depositService->addDeposit($depositRequest,$fileDepo);
            $payment = $this->paymentService->storePayment($paymentRequest, $filePay);

            $rentalRequest['depo_id'] = $deposit->id;
            $rentalRequest['payment_id'] = $payment->id;
            // dd($rentalRequest['payment_id']);

            $this->rentalService->storeRental($rentalRequest);
           
        }else{
            //store rental and customer
            $deposit = $this->depositService->addDeposit($depositRequest,$fileDepo);
            $payment = $this->paymentService->storePayment($paymentRequest, $filePay);

            $rentalRequest['depo_id'] = $deposit->id;
            $rentalRequest['payment_id'] = $payment->id;
            // dd($rentalRequest['payment_id']);

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
        $pre = $this->inspectionService->getPreInspectionById($id);
        $post = $this->inspectionService->getPostInspectionById($id);
        // return response()->json($post);
        return view('rental.show', compact('rental','pre','post'));
    }

    public function edit($id){
        $rental = Rental::find($id);
        return view('rental.edit', compact('rental'));
    }

    public function update(Request $request, $id){
        $rental = Rental::find($id);
        $payment = Payment::find($rental->payment_id);
        $deposit = Deposit::find($rental->depo_id);

        $data = $request->validate([
            'staff_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'fleet_id' => 'required|string|max:255',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'pickup_time' => 'required|string',
            'return_time' => 'required|string',
            'pickup_location' => 'required|string|max:255',
            'return_location' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
            'destination' => 'required|string|max:255',
            'payment_status' => 'required|in:paid,unpaid',
            'rental_amount' => 'required|numeric|min:0',
            'depo_amount' => 'required|numeric|min:0',
            'depo_date' => 'required|date',
            'depo_status' => 'required|in:paid,unpaid',
        ]);
        
        // dd($data);

        $rental->staff_id = $request->input('staff_id');
        $rental->customer_id = $request->input('customer_id');
        // $rental->fleet_id = $request->input('fleet_id');
        $rental->pickup_date = $request->input('pickup_date');
        $rental->return_date = $request->input('return_date');
        $rental->pickup_time = $request->input('pickup_time');
        $rental->return_time = $request->input('return_time');
        $rental->pickup_location = $request->input('pickup_location');
        $rental->return_location = $request->input('return_location');
        $rental->note = $request->input('note');
        $rental->destination = $request->input('destination');

        $payment->payment_status = $request->input('payment_status');
        $payment->rental_amount = $request->input('rental_amount');

        $deposit->depo_amount = $request->input('depo_amount');
        $deposit->depo_date = $request->input('depo_date');
        $deposit->depo_status = $request->input('depo_status');

        $rental->save();
        $payment->save();

        // dd($request->all());
        // $rental->update($request->all());
        return redirect()->route('rental.index')
        ->with('success', 'Rental updated successfully.');
    }

    public function destroy($id){
        $rental = Rental::find($id);
        $rental->delete();
        return redirect()->route('rental.index')
        ->with('success', 'Rental deleted successfully');
    }

    // public function displayForm($id){
        
    //     return view('rental.inspection-form', compact('id'));
    // }

    // public function submitForm(Request $request){
    //     $request->validate([
    //         // 'parts' => 'required',
    //         'mileage'=>'required',
    //         'fuel'=>'required',
    //     ]);

    //     $front = $request->file('img_front');
    //     $back = $request->file('img_back');
    //     $left = $request->file('img_left');
    //     $right = $request->file('img_right');
    //     $add1 = $request->file('img_add1');
    //     $add2 = $request->file('img_add2');

    //     $gambar = [$front, $back, $left, $right];

    //     // Check if $add1 is not null
    //     if ($add1 !== null) {
    //         $gambar[] = $add1;
    //     }

    //     // Check if $add2 is not null
    //     if ($add2 !== null) {
    //         $gambar[] = $add2;
    //     }


    //     $input = $request->all();

    //     $parts = json_encode($request->input('parts'));
    //     $input['parts'] = $parts;
     
    //     dd($input);

    //     $result = $this->rentalService->storeInspection($input,$gambar);

    //     // dd($result);
    //     return redirect()->route('rental.index')
    //     ->with('success', 'Inspection form created');

    //     // if($request->hasFile('image')){
    //     //     // $allowedfileExtension=['pdf','jpg','png','docx'];
    //     //     // $files = $request->file('image');

            
    //     //     // $barang;
    //     //     //Loop for image
    //     //     // foreach($files as $file){
    //     //     //     $filename = $file->getClientOriginalName();
    //     //     //     $extension = $file->getClientOriginalExtension();
    //     //     //     $check=in_array($extension,$allowedfileExtension);

    //     //     //     if($check){
    //     //     //         $filenama = $filename . $extension;
    //     //     //         $barang['file'] = $filenama;
    //     //     //         $file->move('inspections', $filenama);

    //     //     //         foreach ($files as $photo) {
    //     //     //             $photo->move('inspections', $filename);
    //     //     //         }
    //     //     //         // echo "Upload Successfully";
    //     //     //     }
    //     //     // }
    //     //     Inspection::create([
    //     //         'staff' => $data['staff_id'],
    //     //         'rental_id' => '1',
    //     //         'image' => $barang['file']
    //     //     ]);
    //     // }
    //     // echo "Upload Successfully";
        
    // }
}

