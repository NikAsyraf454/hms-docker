<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRecord;
use App\Models\MaintenanceType;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $type = MaintenanceType::get();
        // return response()->json($type);
        return view('maintenance.create', compact('type','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Get the fleet ID from the request
    //     $fleetId = $request->input('fleet_id');

    //     // Get the arrays of data from the request
    //     $odometers = $request->input('odometer');
    //     $costs = $request->input('cost');
    //     $dates = $request->input('date');
    //     $notes = $request->input('notes');
    //     $maintenanceTypes = $request->input('maintenance_type');

    //     // Loop through the arrays and save each maintenance item
    //     foreach ($odometers as $index => $odometer) {
    //         // Create a new maintenance record for each item
    //         $maintenance = new MaintenanceRecord();
    //         $maintenance->user_id = session('user_id');
    //         $maintenance->fleet_id = $fleetId;
    //         $maintenance->odometer_reading = $odometer;
    //         $maintenance->cost = $costs[$index];
    //         $maintenance->date = $dates[$index];
    //         $maintenance->notes = $notes[$index];
    //         $maintenance->maintenance_type_id = $maintenanceTypes[$index];
    //         $maintenance->service_provider_id = 1;
            
    //         // Save the maintenance record
    //         $maintenance->save();
    //     }

    //     return redirect()->route('maintenance.index')->with('success', 'Maintenance records saved successfully!');
    // }

    public function store(Request $request)
    {
        $user = auth()->user();

        $maintenance = new MaintenanceRecord;
        $maintenance->user_id = $user->id;
        $maintenance->fleet_id = $request->fleet_id;
        $maintenance->maintenance_type_id = $request->maintenance_type; // corrected from $request->id
        $maintenance->service_provider_id = 1; // corrected from $request->id
        $maintenance->odometer_reading = $request->odometer;
        $maintenance->date = $request->date;
        $maintenance->cost = $request->cost;
        $maintenance->notes = $request->notes;

        // Save the maintenance record
        $result = $maintenance->save(); // changed from $user->save() to $maintenance->save()
        return redirect()->back()->with('success', 'Maintenance record saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceRecord $maintenanceRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceRecord $maintenanceRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceRecord $maintenanceRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $maintenance = MaintenanceRecord::find($id);
        $maintenance->delete();
        return redirect()->route('fleet.index')
        ->with('success', 'Maintenance deleted successfully');
    }
}
