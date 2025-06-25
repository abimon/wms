@extends('layouts.app', ['title' => 'shifts'])
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
                    <th>Shift Reports</th>
                </thead>
                <tbody>
                    @foreach($shifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shift->vehicle_plate }}</td>
                            <td>
                                <a href="https://maps.google.com/maps?q={{$shift->start_location}}">{{ $shift->start_location }}</a>
                                <br>{{ $shift->direction }}
                            </td>
                            <td>{{ $shift->created_at->format('F jS H:i:s') }}</td>
                            <td>{{ $shift->passenger_contact }}</td>
                            <td>
                                <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('shifts.show', $shift->id)}}">
                                    <button type="button" class="btn btn-primary">
                                        Reports({{ $shift->shiftReports->count() }})
                                    </button>
                                </a>
                                <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" class="d-inline">
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