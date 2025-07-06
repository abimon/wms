<?php

namespace App\Http\Controllers;

use App\Models\ShiftReport;
use Illuminate\Http\Request;

class ShiftReportController extends Controller
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
    public function store()
    {
        try {
            if (ShiftReport::where([['shift_id', request('shift_id')], ['start_time', request('start_time')]])->count() == 0) {
                ShiftReport::create([
                    'shift_id' => request('shift_id'),
                    'start_time' => request('start_time'),
                    'start_location' => request('start_location'),
                    'end_time' => request('end_time'),
                    'end_location' => request('end_location'),
                    'direction' => request('direction'),
                    'accuracy' => request('accuracy'),
                    'type' => request('type')
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Shift Report Created'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function show($id)
    {
        try {
            $shiftReport = ShiftReport::where('shift_id', $id)->get();
            return  $shiftReport;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftReport $shiftReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShiftReport $shiftReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftReport $shiftReport)
    {
        //
    }
}
