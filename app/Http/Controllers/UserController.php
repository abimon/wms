<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::orderBy('name','asc')->get();
    }

    public function register()
    {
        $user = User::create([
            'name'=>request()->name,
            'email'=>request()->email,
            'contact'=>request()->contact,
            'role'=>request()->role,
            'password'=>Hash::make(request()->password),
        ]);
        $data = User::findOrFail($user->id);
        return response()->json($data, 201);
    }

    public function login()
    {
        $user = User::where('email', request()->email)->first();
        if ($user && Hash::check(request()->password, $user->password)) {
            return response()->json($user, 200);
        }
        return response()->json(["message"=>'Wrong email or password. Please try again'], 400);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function edit($id)
    {
        User::where('id',$id)->update([
            'k_name'=>request()->k_name,
            'k_contact'=>request()->k_contact
        ]);
        return response()->json(['message'=>'Success'],200);
    }

    public function update($id)
    {
        User::where('id',$id)->update([
            'name'=>request()->name,
            'email'=>request()->email,
            'contact'=>request()->contact,
            'password'=>Hash::make(request()->password),
        ]);
        $user=User::findOrFail($id);
        return $user;
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message'=>'Success delete'],200);

    }
}
