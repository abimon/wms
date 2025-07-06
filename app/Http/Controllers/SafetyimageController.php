<?php

namespace App\Http\Controllers;

use App\Models\Safetyimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SafetyimageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // dd(request()->file('files'));
        $i = 0;
        foreach (request()->file('files') as $file) {
            $filename = (uniqid() . time()) . '.' . ($file->getClientOriginalExtension());
            $file->move('storage/avatars', $filename);
            Safetyimage::create([
                "path" => 'storage/safety/'.$filename
            ]);
            $i++;
        };
        return back()->with("success", ($i) . " Files uploaded successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Safetyimage $safetyimage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Safetyimage $safetyimage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Safetyimage $safetyimage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Safetyimage $safetyimage)
    {
        //
    }
}
