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
        $polygons = Polygon::all();
        return view('home', compact('polygons'));
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
        $this->validate(request(), [
            'name' => 'required',
            'code' => 'required',
        ]);
        $polygon = Polygon::where('name', '=', request('name'))->first();
        if (!$polygon) {
            $polygon=Polygon::create([
                "name"=>request("name"),
                "code"=>request("code"),
                "speed_limit"=>request("speed_limit"),
            ]);
        }
        return view('polypoints.index',compact('polygon'))->with('success', 'Successfully created polygon');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $polygon = Polygon::findOrFail($id);
        return view('polypoints.index', compact('polygon'));
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
