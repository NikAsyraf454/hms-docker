<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Services\InspectionService;

class InspectionController extends Controller
{
    protected $inspectionService;

    public function __construct(InspectionService $inspectionService){
        $this->inspectionService = $inspectionService;
    }
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
    public function create($id, $type)
    {
        return view('rental.inspection.form', compact('id', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $createdData = $this->inspectionService->addInspection($data);
        // dd($createdData);
        return redirect()->route('rental.index')->with('success','Inspection Created');   
    }

    /**
     * Display the specified resource.
     */
    public function show($rentalId, $type)
    {
        $inspection = $this->inspectionService->getInspectionById($rentalId, $type);
        $id = $rentalId;

        // dd($inspection);
        return view('rental.inspection.show', compact('id','inspection','type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspection $inspection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        //
    }
}
