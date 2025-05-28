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
            "trip_id" => request('trip_id'),
            "start_time" => request('start_time'),
            "start_location" => request('start_location'),
            "direction" => request('direction'),
            "accuracy" => request('accuracy'),
            "speedLimit" => request('speedLimit'),
            "end_time" => request('end_time'),
            "highestSpeed" => request('highestSpeed'),
            "end_location" => request('end_location')
        ]);
        return response()->json([
            'message' => 'Trip report created successfully',
            'id' => $tripReport->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
    public function update($id)
    {
        $tripReport = TripReport::findOrFail($id);
        if (request('speed') != null) {
            $tripReport->speed = request('speed');
        }
        if (request('end_time') != null) {
            $tripReport->end_time = request('end_time');
        }
        if (request('end_location') != null) {
            $tripReport->end_location = request('end_location');
        }
        $tripReport->update();
        return response()->json([
            'message' => 'Trip report updated successfully',
            'id' => $id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripReport $tripReport)
    {
        //
    }
}
