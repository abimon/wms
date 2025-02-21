<?php

namespace App\Http\Controllers;

use App\Models\Polygon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        
        return view('home');
    }
}
