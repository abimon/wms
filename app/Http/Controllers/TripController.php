<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Trip;
use App\Models\TripReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        TripReport::where('start_time','null')->delete();
        $trips = Trip::orderBy('id', 'desc')->get();
        return view('dashboard.trips.index', compact('trips'));
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
    public function store()
    {
        // dd(request());
        $trip=Trip::create([
            "vehicle_plate" => request("vehicle_plate"),
            "passenger_contact" => request("passenger_contact"),
            "location" => request("location"),
            "direction" => request("direction")
        ]);
        $driver =Driver::where('vehicle_plate',request('vehicle_plate'))->orderBy('created_at', 'desc')->first();
        return response()->json([
            'message' => 'Success',
            'trip_id' => $trip->id,
            'driver'=>$driver?($driver->driver):null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Trip::destroy($id);
        return redirect()->back()->with('success', 'Trip deleted successfully');
    }
}
