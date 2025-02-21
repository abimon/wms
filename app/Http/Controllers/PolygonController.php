<?php

namespace App\Http\Controllers;

use App\Models\Polygon;
use Illuminate\Http\Request;

class PolygonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polygon = Polygon::all();
        return response()->json($polygon);
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
        Polygon::create([
            "name"=>request("name"),
            "code"=>request("code"),
            "point0"=>request("point0Latitude").",".request("point0Longitude"),
        ]);
        $polygons=Polygon::all();
        return response()->json($polygons);
    }

    /**
     * Display the specified resource.
     */
    public function show(Polygon $polygon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Polygon $polygon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $polygon = Polygon::find($id);
        if(request('name')!=null){
            $polygon->name=request('name');
        }
        if(request('code')!=null){
            $polygon->code=request('code');
        }
        if(request('point0')!=null){
            $polygon->point0=request('point0Latitude').','.request('point0Longitude');
        }
        if(request('point1')!=null){
            $polygon->point1=request('point1Latitude').','.request('point1Longitude');
        }
        if(request('point2')!=null){
            $polygon->point2=request('point2Latitude').','.request('point2Longitude');
        }
        if(request('point3')!=null){
            $polygon->point3=request('point3Latitude').','.request('point3Longitude');
        }
        if(request('point4')!=null){
            $polygon->point4=request('point4Latitude').','.request('point4Longitude');
        }
        if(request('point5')!=null){
            $polygon->point5=request('point5Latitude').','.request('point5Longitude');
        }
        if(request('point6')!=null){
            $polygon->point6=request('point6Latitude').','.request('point6Longitude');
        }
        if(request('point7')!=null){
            $polygon->point7=request('point7Latitude').','.request('point7Longitude');
        }
        $polygon->update();
        return back()->with("success","Polygon updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Polygon::destroy($id);
        return response()->json(["message"=>"Polygon deleted successfully"]);
    }
}
