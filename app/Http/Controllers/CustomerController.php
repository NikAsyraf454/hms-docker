<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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

    public function edit($id){
        $customer = $this->customerService->getCustomerById($id);
        // return response()->json($customer);
        return view('customer.edit', compact('customer'));
    }

    public function autocomplete(Request $request){
        $query = $request->get('query');

        $customers = Customer::where('name', 'LIKE', "%{$query}%")
            ->orWhere('matric', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($customers);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'matric' => 'required|max:255',
            'ic' => 'required',
            'college' => 'required',
            'phone' => 'required',
            'faculty' => 'required',
            'address' => 'required',
            'bank' => 'required',
            'acc_num' => 'required',
            'acc_num_name' => 'required',
        ]);

        // $fleet = Fleet::find($id);
        $customer = $this->customerService->updateCustomer($id, $data);

        // $customer->update($request->all());
        return redirect()->route('customer.index')
        ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id){
       try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully');
        } catch (QueryException $e) {
            Log::error('QueryException while deleting customer: ' . $e->getMessage());
            if ($e->getCode() == "23000") {
                return redirect()->back()->with('error', 'This customer cannot be deleted because they have existing rentals.');
            }
            return redirect()->back()->with('error', 'A database error occurred while deleting the customer.');
        } catch (\Exception $e) {
            Log::error('Exception while deleting customer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred while deleting the customer.');
        }
    }
}
