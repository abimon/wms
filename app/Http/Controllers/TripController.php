<?php

namespace App\Http\Controllers;

use App\Models\Polygon;
use App\Models\Safetyimage;
use App\Models\Shift;
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
        TripReport::where('start_time', 'null')->delete();
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
        $trip = Trip::create([
            "vehicle_plate" => request("vehicle_plate"),
            "passenger_contact" => request("passenger_contact"),
            "location" => request("location"),
            "direction" => request("direction")
        ]);
        $polys  = Polygon::all();
        $zones = [];
        foreach ($polys as $poly) {
            $polygons = [];
            for ($i = 0; $i < 8; $i++) {
                if ($poly->{"point" . $i} != null) {
                    $point = explode(",", $poly->{"point" . $i});
                    array_push($polygons, $point);
                }
            }
            array_push($zones, [
                'name' => $poly->name,
                'coordinates' => $polygons,
                'speed_limit' => $poly->speed_limit,
                'code' => $poly->code
            ]);
        }
        $shift = Shift::where('vehicle_plate', request('vehicle_plate'))->orderBy('created_at', 'desc')->first();
        $image = Safetyimage::all()->shuffle()->first();
        return response()->json([
            'message' => 'Success',
            'trip_id' => $trip->id,
            'driver' => $shift ? ($shift->driver->avatar) : null,
            'image' => $image->path,
            'polygons' => json_encode($zones)
        ]);
    }

    public function show(Trip $trip)
    {
        return view('dashboard.trips.show', compact('trip'));
    }
    /**
     * Display the specified resource.
     */
    public function showTrip($plate)
    {
        $trips = Trip::where('vehicle_plate', $plate)->get();
        $data = [];
        foreach ($trips as $trip) {
            $time = $trip->tripReport->map(function ($t) {
                return (date_create($t->end_time)->getTimestamp() - date_create($t->start_time)->getTimestamp()) / 60;
            })->sum();
            array_push($data, ['trip' => $trip, 'overspeeds' => $trip->tripReport->count(), 'total_time' => $time]);
        }
        return $data;
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
    public function update(Request $request, Trip $trip) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Trip::destroy($id);
        return redirect()->back()->with('success', 'Trip deleted successfully');
    }
}
