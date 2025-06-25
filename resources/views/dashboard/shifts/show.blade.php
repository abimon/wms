@extends('layouts.app', ['title' => 'Shift Details'])
@section('content')
    <div class="container">
        <table class="table-bordered table-striped ">
            <thead>
                <th>#</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <!-- <th>Duration</th> -->
                <th>Start Location</th>
                <th>End Location</th>
                <th>Direction</th>
                <th>Accuracy</th>
                <th>Speed Limit</th>
                <th>Highest Speed</th>

            </thead>
            <tbody>
                @foreach($shift->shiftReports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->type }}</td>
                        <td>{{date_format(date_create($report->start_time), 'M jS Y H:i:s')}}</td>
                        <td>{{date_format(date_create($report->end_time), 'M jS Y H:i:s')}}</td>
                        <!-- <td></td> -->
                        <td>{{$report->start_location}}</td>
                        <td>{{$report->end_location}}</td>
                        <td>{{$report->direction}}</td>
                        <td>{{$report->accuracy}}</td>
                        <td>{{$report->speedLimit}}</td>
                        <td>{{$report->highestSpeed}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection