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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection