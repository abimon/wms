<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShiftController extends Controller
{
    public function generateToken()
    {
        $consumer_key = 'yILGU9cIuiSiuO3eOOWAR9VQfGLGLqk8dNQHGZr4zjaa9tCD';
        $consumer_secret = 'mpyTh9iEaCu23dHwsM36fbS1QSDnA03AyMfXCFCGi9sDBEsAFuP1ACyQnFRprddT';
        $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $response = Http::withHeaders(["Authorization: Basic " . $credentials])
        
            ->get($url);
        return $response;
    }

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
        $shift = Shift::create([
            'driver_id' => request('driver_id'),
            'shift_code' => strtoupper(uniqid()),
            'vehicle_plate' => request('vehicle_plate'),
            'paid' => false,
        ]);
        $driver = User::findOrFail(request('driver_id'));
        $phone = $driver->contact;
        // initiate mpesa payment

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
