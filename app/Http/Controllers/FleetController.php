<?php

namespace App\Http\Controllers;
use App\Models\Fleet;
use App\Models\MaintenanceRecord;

use Illuminate\Http\Request;

class FleetController extends Controller
{

    public function index(){
        $fleet = Fleet::paginate(5);

        return view('fleet.index')->with('fleets', $fleet);
    }

    public function create()
    {
        $fleet = Fleet::all();
       return view('fleet.create', compact('fleet'));
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

        $claim = new Fleet();
        $claim->brand = $request->brand;
        $claim->model = $request->model;
        $claim->year = $request->year;
        $claim->license_plate = $request->license_plate;
        $claim->color = $request->color;
        $claim->transmission = $request->transmission;
        $claim->status = $request->status;
        $claim->save();

        return redirect()->route('fleet.index')
        ->with('success', 'Fleet created successfully.');
    }

    public function show($id){
        $fleet = Fleet::find($id);
        return view('fleet.show', compact('fleet'));
    }

    public function edit($id){
        $fleet = Fleet::find($id);
        $maintenance = MaintenanceRecord::where('fleet_id', $id)->get();

        return view('fleet.edit', compact('fleet','maintenance'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|max:255',
            'plate_number' => 'required',
        ]);

        $fleet = Fleet::find($id);
        $fleet->update($request->all());
        return redirect()->route('fleet.index')
        ->with('success', 'Fleet updated successfully.');
    }

    public function destroy($id){
        $fleet = Fleet::find($id);
        $fleet->delete();
        return redirect()->route('fleet.index')
        ->with('success', 'Fleet deleted successfully');
    }
}
