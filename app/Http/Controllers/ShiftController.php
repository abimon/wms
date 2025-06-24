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
        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $response = Http::withHeaders(['Content-Type : application/json', "Authorization: Basic " . $credentials])
            ->post($url);
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
