@extends('layouts.app', ['title' => 'Trips'])
@section('content')
    <div class="container">
        <div class="table table-responsive">
            <table>
                <thead>
                    <th>#</th>
                    <th>Number Plate</th>
                    <th>Location</th>
                    <th>Start Time</th>
                    <th>Passenger</th>
                    <th>Action</th>
                    <th>Trip Overspeed Reports</th>
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trip->vehicle_plate }}</td>
                            <td>
                                <a href="https://maps.google.com/maps?q={{$trip->location}}">{{ $trip->location }}</a>
                                <br>{{ $trip->direction }}
                            </td>
                            <td>{{ $trip->created_at->format('F jS H:i:s') }}</td>
                            <td>{{ $trip->passenger_contact }}</td>
                            <td>
                                <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('trips.show', $trip->id)}}">
                                    <button type="button" class="btn btn-primary">
                                    Overspeed instances({{$trip->tripReport->count()}})</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection