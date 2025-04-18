@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="table table-responsive">
            <table>
                <thead>
                    <th>#</th>
                    <th>Contact</th>
                    <th>Vehicle</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Report Time</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->contact }}</td>
                            <td>{{ $report->vehicle }}</td>
                            <td>
                                <a href="https://maps.google.com/maps?q={{ ($report->latitude) . ',' . ($report->longitude) }}"
                                    target="_blank" title="Click to view on map">
                                    {{ ($report->latitude) . ' ' . ($report->longitude) }}
                                </a>
                            </td>
                            <td>{{ $report->description }}</td>
                            <td>{{ date_format($report->created_at, 'F jS, Y H:i:s') }}</td>
                            <td>
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection