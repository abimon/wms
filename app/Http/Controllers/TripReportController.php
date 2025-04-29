<?php

namespace App\Http\Controllers;

use App\Models\TripReport;
use Illuminate\Http\Request;

class TripReportController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tripReport = TripReport::create([
            "trip_id" => request("trip_id"),
            "speed_limit" => request("speed_limit"),
            "start_time" => request("start_time"),
            "start_location" => request("start_location"),
            "direction" => request("direction"),
            "accuracy" => request("accuracy"),
            "speed" => request("speed"),
            "end_time" => request("end_time"),
            "end_location" => request("end_location")
        ]);
        return response()->json([
            'message' => 'Trip report created successfully',
            'id' => $tripReport->id
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(TripReport $tripReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripReport $tripReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TripReport $tripReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripReport $tripReport)
    {
        //
    }
}
