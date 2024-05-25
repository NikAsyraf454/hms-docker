<?php

namespace App\Http\Controllers;


use App\Models\Claim;
use App\Models\Fleet;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(){
        $claims = Claim::paginate(5);

        return view('claim.index')->with('claims', $claims);
    }

    public function create()
    {
        $fleet = Fleet::all();
        // dd($fleet);
       return view('claim.create', compact('fleet'));
    }

    public function store(Request $request){

        // $request->validate([
        // 'details' => 'required|max:255',
        // 'amount' => 'required',
        // 'plate_number' => 'required',
        // 'date' => 'required',
        // 'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        // ]);

        $data = $request->all();

        // dd($data);

        $file = $request->file('receipt');
        // dd($file);
        $filename = time(). '.' . $file->getClientOriginalExtension();
        $file->move('receipts', $filename);

        $claim = new Claim();
        $claim->staff_id = $request->staff_id;
        $claim->details = $request->details;
        $claim->broker = $request->broker;
        $claim->plate_number = $request->plate_number;
        $claim->date = $request->date;
        $claim->amount = $request->amount;
        $claim->receipt = 'receipts/'. $filename;
        $claim->save();

        // Claim::create($request->all());
        return redirect()->route('claim.index')
        ->with('success', 'Claim created successfully.');
    }

    public function show($id){
        $claim = Claim::find($id);
        return view('claim.show', compact('claim'));
    }

    public function edit($id){
        $claim = Claim::find($id);
        return view('claim.edit', compact('claim'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'detail' => 'required|max:255',
            'plate_number' => 'required',
        ]);

        $claim = Claim::find($id);
        $claim->update($request->all());
        return redirect()->route('claim.index')
        ->with('success', 'Claim updated successfully.');
    }

    public function destroy($id){
        $claim = Claim::find($id);
        $claim->delete();
        return redirect()->route('claim.index')
        ->with('success', 'Claim deleted successfully');
    }
}
