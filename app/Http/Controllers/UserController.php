<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::orderBy('name', 'asc')->get();
    }

    public function register()
    {$name = explode(' ', request('name'));
        $user = User::create([
            'first_name' => $name[0],
            'last_name' => end($name),
            'email' => request('email'),
            'contact' => request('contact'),
            'role' => request('role'),
            'password' => Hash::make(request('password')),
            'id_number'=>request('id_number'),
            'driving_license_number'=>request('driving_license_number'),
            'vehicle_category'=>request('vehicle_category')
        ]);
        $data = User::findOrFail($user->id);
        return response()->json($data, 201);
    }

    public function login()
    {
        $user = User::where('email', request('email'))->first();
        if ($user && Hash::check(request()->password, $user->password)) {
            return response()->json($user, 200);
        }
        return response()->json(["message" => 'Wrong email or password. Please try again'], 400);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function edit($id)
    {
        
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        if (request('first_name') != null) {
            $user->first_name = request('first_name');
        }
        if (request('last_name') != null) {
            $user->last_name = request('last_name');
        }
        if (request('email') != null) {
            $user->email = request('email');
        }
        if (request('contact') != null) {
            $user->contact = request('contact');
        }
        if (request('id_number') != null) {
            $user->id_number = request('id_number');
        }
        if (request('driving_license_number') != null) {
            $user->driving_license_number = request('driving_license_number');
        }
        if (request('vehicle_category') != null) {
            $user->vehicle_category = request('vehicle_category');
        }
        if (request('image') != null) {
            $file = request()->file('image');
            $fileName = ($user->last_name).time() . '.' . $file->getClientOriginalExtension();
            if(request('title')=='avatar'){
                $file->move('storage/avatars', $fileName);
                $user->avatar = '/storage/avatars/' . $fileName;
            }
            if(request('title')=='license_front'){
                $file->move('storage/licenses', $fileName);
                $user->license_front = '/storage/licenses/' . $fileName;
            }
            if(request('title')=='license_back'){
                $file->move('storage/licenses', $fileName);
                $user->license_back = '/storage/licenses/' . $fileName;
            }
        }
        if (request('password') != null) {
            $user->password = request('password');
        }
        if (request('role') != null) {
            $user->role = request('role');
        }
        $user->update();
        return $user;
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Success delete'], 200);

    }
}
