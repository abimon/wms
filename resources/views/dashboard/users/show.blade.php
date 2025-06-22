@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __(($user->first_name).' Details') }}</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $user->avatar}}" alt="Profile Picture" class="img-fluid rounded mb-3"
                            style="width: 150px; height: 150px;">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $user->first_name.' '.$user->last_name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Contact:</strong> {{ $user->contact }}</p>
                        <p><strong>Role:</strong> {{ $user->role }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3">
                <img src="{{ $user-> license_front}}" alt="" style="width: 100%; height: auto;object-fit:scale-down">
            </div>
            <div class="col-md-6 p-3">
                <img src="{{ $user-> license_back}}" alt="" style="width: 100%; height: auto;object-fit:scale-down">
            </div>
        </div>
        
    </div>
@endsection