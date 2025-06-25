<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Shift;
use App\Models\Trip;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
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
        try {
            Vehicle::create([
                'plate' => request('plate'),
                'make' => request('make'),
                'type' => request('type'),
                'color' => request('color'),
                'insurance' => request('insurance'),
                'inspection' => request('inspection'),
                'userId' => request('userId'),
            ]);
            return response()->json(['message' => 'Vehicle created successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle=Vehicle::where('userId',$id)->get();
        return $vehicle;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
