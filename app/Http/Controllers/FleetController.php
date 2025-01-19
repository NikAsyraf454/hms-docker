<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Fleet;
use App\Models\MaintenanceRecord;
use Illuminate\Http\Request;

class FleetController extends Controller
{

    public function index(){
        $fleet = Fleet::get();

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

    // public function getAvailableVehicles(Request $request)
    // {
    //     $date = $request->query('date');
    //     $time = $request->query('time');

    //     // Logic to get available vehicles based on the date and time
    //     $availableVehicles = Fleet::whereDoesntHave('rentals', function ($query) use ($date, $time) {
    //         $query->where('pickup_date', $date)
    //               ->where('pickup_time', $time);
    //     })->get();

    //     return response()->json($availableVehicles);
    // }

    // public function getAvailableVehicles(Request $request)
    // {
    //     $pickupDate = $request->query('date');
    //     $pickupTime = $request->query('time');
    //     $pickupDateTime = $pickupDate . ' ' . $pickupTime;

    //     try {
    //         // Logic to get available vehicles based on the date and time
    //         $availableVehicles = Fleet::whereDoesntHave('rentals', function ($query) use ($pickupDateTime) {
    //             $query->where(function ($query) use ($pickupDateTime) {
    //                 $query->where('pickup_date', '<=', $pickupDateTime)
    //                       ->where('return_date', '>=', $pickupDateTime);
    //             });
    //         })->get();

    //         return response()->json($availableVehicles);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function getAvailableVehicles(Request $request)
    // {
    //     $pickupDate = $request->query('date');
    //     $pickupTime = $request->query('time');

    //     try {
    //         $availableVehicles = Fleet::whereDoesntHave('rentals', function ($query) use ($pickupDate, $pickupTime) {
    //             $query->where(function ($q) use ($pickupDate, $pickupTime) {
    //                 $q->where(function ($subQuery) use ($pickupDate, $pickupTime) {
    //                     $subQuery->where('pickup_date', '=', $pickupDate)
    //                             ->where('pickup_time', '<=', $pickupTime)
    //                             ->where('return_date', '>=', $pickupDate);
    //                 })
    //                 ->orWhere(function ($subQuery) use ($pickupDate, $pickupTime) {
    //                     $subQuery->where('pickup_date', '<', $pickupDate)
    //                             ->where('return_date', '>=', $pickupDate);
    //                 });
    //             });
    //         })->get();

    //         return response()->json($availableVehicles);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function getAvailableVehicles(Request $request){
    //     $pickupDate = $request->query('date');
    //     $pickupTime = $request->query('time');
    //     $returnDate = $request->query('return_date');
    //     $returnTime = $request->query('return_time');
        
    //     try {
    //         $availableVehicles = Fleet::whereDoesntHave('rentals', function ($query) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //             $query->where(function ($q) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //                 $q->where(function ($dateOverlap) use ($pickupDate, $returnDate) {
    //                     // Check if the requested dates overlap with existing rental dates
    //                     $dateOverlap->where('pickup_date', '<=', $returnDate)
    //                                 ->where('return_date', '>=', $pickupDate);
    //                 })->where(function ($timeOverlap) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //                     $timeOverlap->where(function ($sameDayCheck) use ($pickupDate, $pickupTime, $returnTime) {
    //                         // Handle rentals on the same day
    //                         $sameDayCheck->where('pickup_date', '=', $pickupDate)
    //                                      ->where('return_date', '=', $pickupDate)
    //                                      ->where(function ($timeCheck) use ($pickupTime, $returnTime) {
    //                                          $timeCheck->where('pickup_time', '<=', $returnTime)
    //                                                    ->where('return_time', '>=', $pickupTime);
    //                                      });
    //                     })->orWhere(function ($multiDayCheck) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //                         // Handle rentals spanning multiple days
    //                         $multiDayCheck->where(function ($startWithin) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //                             // Requested rental starts during an existing rental
    //                             $startWithin->where('pickup_date', '<=', $pickupDate)
    //                                         ->where('return_date', '>=', $pickupDate)
    //                                         ->whereRaw('? >= pickup_time', [$pickupTime]);
    //                         })->orWhere(function ($endWithin) use ($pickupDate, $pickupTime, $returnDate, $returnTime) {
    //                             // Requested rental ends during an existing rental
    //                             $endWithin->where('pickup_date', '<=', $returnDate)
    //                                       ->where('return_date', '>=', $returnDate)
    //                                       ->whereRaw('? <= return_time', [$returnTime]);
    //                         })->orWhere(function ($fullyContained) use ($pickupDate, $returnDate) {
    //                             // Requested rental fully contains an existing rental
    //                             $fullyContained->where('pickup_date', '>=', $pickupDate)
    //                                            ->where('return_date', '<=', $returnDate);
    //                         });
    //                     });
    //                 });
    //             });
    //         })->get();
            
    //         return response()->json($availableVehicles);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }        

    // }
}
