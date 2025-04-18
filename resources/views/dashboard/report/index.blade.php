@extends('layouts.app')
@section('content')
<div class="container">
    <div class="table table-responsive">
        <table>
            <thead>
                <th>#</th>
                <th>Contact</th>
                <th>Vehicle</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Description</th>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $loop()->iteration }}</td>
                    <td>{{ $report->contact }}</td>
                    <td>{{ $report->vehicle }}</td>
                    <td>{{ $report->latitude }}</td>
                    <td>{{ $report->longitude }}</td>
                    <td>{{ $report->description }}</td>
                    <td>{{ date_format($report->created_at, 'F jS, Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection