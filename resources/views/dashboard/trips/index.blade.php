@extends('layouts.app', ['title' => 'Trips'])
@section('content')
    <div class="container">
        <div class="table table-responsive">
            <table>
                <thead>
                    <th>#</th>
                    <th>Number Plate</th>
                    <th>Location</th>
                    <th>Direction</th>
                    <th>Passenger</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $trip->id }}</td>
                            <td>{{ $trip->vehicle_plate }}</td>
                            <td><a href="https://maps.google.com/maps?q={{$trip->location}}">{{ $trip->location }}</a></td>
                            <td>{{ $trip->direction }}</td>
                            <td>{{ $trip->passenger_contact }}</td>
                            <td>
                                <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tripModal{{ $trip->id}}">
                                    Overspeed instances({{ $trip->tripReport->count() }})
                                </button>
                                <!-- Modal add polygon -->
                                <!-- Modal -->
                                <div class="modal fade" id="tripModal{{ $trip->id}}" tabindex="-1"
                                    aria-labelledby="tripModal{{ $trip->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tripModal{{ $trip->id}}Label">Overspeed instances
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered table-striped table-responsive">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Start Time</th>
                                                        <th>Start Location</th>
                                                        <th>Direction</th>
                                                        <th>Accuracy</th>
                                                        <th>End Time</th>
                                                        <th>End Location</th>
                                                        <th>Speed Limit</th>
                                                        <th>Speed</th>

                                                    </thead>
                                                    <tbody>
                                                        @foreach($trip->tripReport as $report)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{$report->start_time}}</td>
                                                                <td>{{$report->start_location}}</td>
                                                                <td>{{$report->direction}}</td>
                                                                <td>{{$report->accuracy}}</td>
                                                                <td>{{$report->end_time}}</td>
                                                                <td>{{$report->end_location}}</td>
                                                                <td>{{$report->speed_limit}}</td>
                                                                <td>{{$report->speed}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection