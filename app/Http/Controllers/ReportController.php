<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('dashboard.report.index', compact('reports'));
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
        Report::create([
            'contact'=>request('contact'),
            'vehicle'=>request('vehicle'),
            'latitude'=>request('latitude'),
            'longitude'=>request('longitude'),
            'description'=>request('description'),
        ]);
        return response()->json(['success'=>'Report has been submitted successfully.'],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($plate)
    {
        $reports = Report::where('vehicle', $plate)->get();
        return $reports;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Report::destroy($id);
        return back()->with('success','Report has been deleted successfully.');
    }
}
