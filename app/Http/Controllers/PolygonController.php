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
        // dd(request('coordinates0'));
        $this->validate(request(), [
            'name' => 'required',
            'code' => 'required',
            'speed_limit'=> 'required',
            'coordinates0'=> 'required',
            'coordinates1'=> 'required',
            'coordinates2'=> 'required',
            'coordinates3'=> 'required',
        ],[
            'coordinates0.required' => 'The first point is required',
            'coordinates1.required' => 'The second point is required',
            'coordinates2.required' => 'The third point is required',
            'coordinates3.required' => 'The fourth point is required',
        ]);
        $polygon = Polygon::where([['name', '=', request('name')],['code','=', request('code')]])->first();
        if (!$polygon) {
            $polygon=Polygon::create([
                "name"=>request("name"),
                "code"=>request("code"),
                "speed_limit"=>request("speed_limit"),
                'point0'=>request('coordinates0'),
                'point1'=>request('coordinates1'),
                'point2'=>request('coordinates2'),
                'point3'=>request('coordinates3'),
                'point4'=>request('coordinates4'),
                'point5'=>request('coordinates5'),
                'point6'=>request('coordinates6'),
                'point7'=>request('coordinates7'),
            ]);
            return back()->with('success', 'Successfully created polygon');
        }
        return back()->with('error', 'Polygon already exists');
        
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
        Polygon::destroy($id);
        return back()->with("error","Polygon deleted successfully");
    }
}
