<?php

namespace App\Http\Controllers;

use App\Models\Polygon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $polygons = Polygon::all();
        return view('home', compact('polygons'));
    }
    public function polygons()
    {
        $polygons = Polygon::all();
        return view('dashboard.polygons.index', compact('polygons'));
    }
    public function drivers(){
        return view('dashboard.drivers.drivers');
    }

}
