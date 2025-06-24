<?php

namespace App\Http\Controllers;

use App\Models\Mpesa;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ShiftController extends Controller
{
    public function generateToken()
    {
        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $res = Http::withBasicAuth($consumer_key, $consumer_secret)
            ->get($url);
        $response = json_decode($res, true);
        return $response['access_token'];
    }
    public function lipaNaMpesaPassword()
    {
        $passkey = env('MPESA_PASSKEY');
        $BusinessShortCode = env('MPESA_SHORT_CODE');
        $timestamp = date('YmdHis');
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }
    public function Callback($id)
    {
        $res = request();
        // if ($res['Body']['stkCallback']['ResultCode'] == 0) {
        $message = $res['Body']['stkCallback']['ResultDesc'];
        $amount = $res['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
        $TransactionId = $res['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
        $phne = $res['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
        Log::channel('mpesaSuccess')->info(json_encode(['whole' => $res['Body']]));
        Mpesa::create([
            'TransactionType' => 'Paybill',
            'shift_id' => $id,
            'TransAmount' => $amount,
            'MpesaReceiptNumber' => $TransactionId,
            'TransactionDate' => date('d-m-Y'),
            'PhoneNumber' => '+' . $phne,
            'response' => $message
        ]);
        $student = Shift::findOrFail($id);
        $student->paid += $amount;
        $student->update();
        // } else {
        //     Log::channel('mpesaErrors')->info((json_encode($res['Body']['stkCallback']['ResultDesc'])));
        // }
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));
        return $response;
    }
    // function Pay($amount, $contact, $id)
    function Pay()
    {

        $url = (env('MPESA_ENV') == 'live') ? 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest' : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $data = [
            'BusinessShortCode' => env('MPESA_SHORT_CODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => '2',
            'PartyA' => '254701583807',
            'PartyB' => env('MPESA_SHORT_CODE'),
            'PhoneNumber' => '254701583807',
            'CallBackURL' => 'https://school.healthandlifecentre.com/api/fee/callback/2' ,
            'AccountReference' => 'Shift Declaration Fee',
            'TransactionDesc' => 'Shift Declaration Fee',
        ];
        $response = Http::withToken($this->generateToken())
            ->post($url, $data);
            $res =$response->json();
        return $res->ResponseCode;
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
