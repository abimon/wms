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
                </thead>
                <tbody>
                    @foreach($trips as $trip)
                        <tr>
                            <td>{{ $trip->id }}</td>
                            <td>{{ $trip->vehicle_plate }}</td>
                            <td>{{ $trip->location }}</td>
                            <td>{{ $trip->direction }}</td>
                            <td>{{ $trip->passenger_contact }}</td>
                        </tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection