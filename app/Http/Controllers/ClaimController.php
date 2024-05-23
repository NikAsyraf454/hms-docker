<?php

namespace App\Http\Controllers;


use App\Models\Claim;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(){
        $claims = Claim::all();

        return view('claim.index')->with('claims', $claims);
    }

    public function create()
    {
       return view('claim.create');
    }

    public function store(Request $request){
        $request->validate([
        'details' => 'required|max:255',
        'amount' => 'required',
        ]);

        $data = $request->all();
        // dd($data);

        Claim::create($request->all());
        return redirect()->route('claim.index')
        ->with('success', 'Claim created successfully.');
        }

    public function show($id){
    //
    }

    public function edit(){
    //  
    }

    public function update(){
        //
    }

    public function destroy(){
        //
    }
}
