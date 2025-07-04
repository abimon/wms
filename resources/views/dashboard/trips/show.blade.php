@extends('layouts.app',['title'=>'Trip Reports'])
@section('content')
<div class="container">
    <div class="">
        <div class="table table-responsive">
            <table class="table-bordered table-striped ">
                <thead>
                    <th>#</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Duration</th>
                    <th>Start Location</th>
                    <th>End Location</th>
                    <th>Direction</th>
                    <th>Accuracy</th>
                    <th>Speed Limit</th>
                    <th>Highest Speed</th>
                    <td>Created At</td>
                </thead>
                <tbody>
                    @foreach($trip->tripReport as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{date_format(date_create($report->start_time), 'M jS Y H:i:s')}}</td>
                        <td>{{date_format(date_create($report->end_time), 'M jS Y H:i:s')}}</td>
                        <td>{{ date_diff(date_create($report->start_time), date_create($report->end_time))->format('%h:%i:%s') }}</td>
                        <td>{{$report->start_location}}</td>
                        <td>{{$report->end_location}}</td>
                        <td>{{$report->direction}}</td>
                        <td>{{$report->accuracy}}</td>
                        <td>{{$report->speedLimit}}</td>
                        <td>{{$report->highestSpeed}}</td>
                        <td>{{$report->created_at->format('M jS Y H:i:s')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection