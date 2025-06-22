<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::orderBy('created_at', 'desc')->get();
        return view('dashboard.shifts.index', compact('shifts'));
    }

    public function create()
    {
        //
    }

 
    public function store()
    {
        $Shift = Shift::create([
            'driver_id' => request('driver_id'),
            'shift_code' => strtoupper(uniqid()),
            'vehicle_plate' => request('vehicle_plate'),
            'paid' => false,
        ]);
        return response()->json([
            'message' => 'Shift created successfully',
        ]);
    }


    public function show(Shift $Shift)
    {
        //
    }

    public function edit(Shift $Shift)
    {
        //
    }

    public function update(Request $request, Shift $Shift)
    {
        //
    }

    public function destroy(Shift $Shift)
    {
        //
    }
}
