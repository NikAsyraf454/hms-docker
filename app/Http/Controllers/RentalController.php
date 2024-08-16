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

use App\Services\CustomerService;
use App\Services\RentalService;
use App\Services\DepositService;
use App\Services\PaymentService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService, RentalService $rentalService, DepositService $depositService, PaymentService $paymentService){
        $this->customerService = $customerService;
        $this->rentalService = $rentalService;
        $this->depositService = $depositService;
        $this->paymentService = $paymentService;
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

    public function displayForm($id){
        
        return view('rental.inspection-form', compact('id'));
    }

    public function submitForm(Request $request){
        $request->validate([
            'parts' => 'required',
            'parts' => 'required',
            'mileage'=>'required',
            'fuel'=>'required',
            'remarks'=>'required',
        ]);

        $front = $request->file('img_front');
        $back = $request->file('img_back');
        $left = $request->file('img_left');
        $right = $request->file('img_right');
        $add1 = $request->file('img_add1');
        $add2 = $request->file('img_add2');

        $gambar = [$front, $back, $left, $right];

        // Check if $add1 is not null
        if ($add1 !== null) {
            $gambar[] = $add1;
        }

        // Check if $add2 is not null
        if ($add2 !== null) {
            $gambar[] = $add2;
        }


        $input = $request->all();
        // dd($input);

        $result = $this->rentalService->storeInspection($input,$gambar);

        // dd($result);
        return redirect()->route('rental.index')
        ->with('success', 'Inpespection form created');

        // if($request->hasFile('image')){
        //     // $allowedfileExtension=['pdf','jpg','png','docx'];
        //     // $files = $request->file('image');

            
        //     // $barang;
        //     //Loop for image
        //     // foreach($files as $file){
        //     //     $filename = $file->getClientOriginalName();
        //     //     $extension = $file->getClientOriginalExtension();
        //     //     $check=in_array($extension,$allowedfileExtension);

        //     //     if($check){
        //     //         $filenama = $filename . $extension;
        //     //         $barang['file'] = $filenama;
        //     //         $file->move('inspections', $filenama);

        //     //         foreach ($files as $photo) {
        //     //             $photo->move('inspections', $filename);
        //     //         }
        //     //         // echo "Upload Successfully";
        //     //     }
        //     // }
        //     Inspection::create([
        //         'staff' => $data['staff_id'],
        //         'rental_id' => '1',
        //         'image' => $barang['file']
        //     ]);
        // }
        // echo "Upload Successfully";
        
    }
}

