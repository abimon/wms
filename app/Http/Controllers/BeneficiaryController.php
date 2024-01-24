<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index($id)
    {
        return Beneficiary::where('u_id',$id)->orderBy('b_name','asc')->get();
    }

    public function create()
    {
        Beneficiary::create([
            'u_id'=>request()->u_id,
            'b_name'=>request()->b_name,
        ]);
        $ben = Beneficiary::where('u_id',request()->u_id)->get();
        return response()->json(['message'=>'Beneficiary added successifully'],201);
    }
    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        return Beneficiary::findOrFail($id);
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
