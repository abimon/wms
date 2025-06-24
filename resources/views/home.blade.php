@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-dollar-sign fa-3x text-dark"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Revenue</p>
                        <h6 class="mb-0">{{App\Models\Mpesa::sum('TransAmount')}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-tasks fa-3x text-dark"></i>
                    <div class="ms-3">
                        <p class="mb-2">Trips Done Today</p>
                        <h6 class="mb-0">{{App\Models\Trip::where('created_at', '>=', Carbon\Carbon::today())->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-taxi fa-3x text-dark"></i>
                    <div class="ms-3">
                        <p class="mb-2">Shifts Today</p>
                        <h6 class="mb-0">{{App\Models\Shift::where('created_at', '>=', Carbon\Carbon::today())->count()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-car-crash fa-3x text-dark"></i>
                    <div class="ms-3">
                        <p class="mb-2">Misconducts Today</p>
                        <h6 class="mb-0">{{(App\Models\TripReport::where('created_at', '>=', Carbon\Carbon::today())->count()) + (App\Models\Report::where('created_at', '>=', Carbon\Carbon::today())->count())}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection