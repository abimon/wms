<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index()
    {
        return Beneficiary::all();
    }

    public function create()
    {
        Beneficiary::create([
            'u_id'=>request()->u_id,
            'b_age'=>request()->b_age,
            'rel'=>request()->rel,
            'b_name'=>request()->b_name,
        ]);
        return response()->json(['message'=>'Beneficiary added successifully'],201);
    }
    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        return Beneficiary::where('u_id',$id)->get();
    }

    public function edit()
    {
        //
    }

    public function update($id)
    {
        Beneficiary::where('id',$id)->update([
            'u_id'=>request()->u_id,
            'b_name'=>request()->b_name,
        ]);
        return response()->json(['message'=>'Success update'],200);
    }

    public function destroy($id)
    {
        Beneficiary::destroy($id);
        return response()->json(['message'=>'Delete Success'],200);
    }
}
