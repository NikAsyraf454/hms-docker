<?php

namespace App\Http\Controllers;
use App\Models\Deposit;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    
    public function index(){
        $depo = Deposit::paginate(5);
        // return response()->json($depo);
        return view('deposit.index')->with('deposit', $depo);
    }

    public function create()
    {
        $deposit = Deposit::all();
    }

    public function store(Request $request){

        // $request->validate([
        // 'details' => 'required|max:255',
        // 'amount' => 'required',
        // 'plate_number' => 'required',
        // 'date' => 'required',
        // 'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        // ]);

        // $data = $request->all();

        // $claim = new Fleet();
        // $claim->brand = $request->brand;
        // $claim->model = $request->model;
        // $claim->year = $request->year;
        // $claim->license_plate = $request->license_plate;
        // $claim->color = $request->color;
        // $claim->transmission = $request->transmission;
        // $claim->status = $request->status;
        // $claim->save();

        return redirect()->route('fleet.index')
        ->with('success', 'Fleet created successfully.');
    }

    public function show($id){
        $depo = Deposit::find($id);
        // return response()->json($depo);
        return view('deposit.show', compact('depo'));
    }

    public function edit($id){
        $depo = Deposit::find($id);
        return view('deposit.edit', compact('depo'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'fuel' => 'required|max:255',
            'late' => 'required|max:255',
            'extend' => 'required|max:255',
            'return_date' => 'nullable',
        ]);
        // dd('hm');
        $depo = Deposit::find($id);
        $depo->update($request->all());

        return redirect()->route('deposit.show',$id)
        ->with('success', 'Deposit updated successfully.');
    }

    public function destroy($id){
        $depo = Deposit::find($id);
        if ($depo->receipt) {
            // Get the full path to the image
            $imagePath = public_path($claim->receipt);

            // Check if file exists before attempting to delete
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $depo->delete();
        return redirect()->route('deposit.index')
        ->with('success', 'Fleet deleted successfully');
    }
}
