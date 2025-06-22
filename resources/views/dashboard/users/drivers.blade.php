@extends('layouts.app')

@section('content')
    @error('coordinates[0]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('coordinates[1]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('coordinates[2]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('coordinates[3]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('coordinates[4]')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @error('code')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('speed_limit')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Driver Name</th>
                <th>Contact</th>
                <th>Licence</th>
                <th>ID Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\User::where('role', 'Driver')->get() as $driver)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->contact }}</td>
                    <td>{{ $driver->driving_license_number }}</td>
                    <td>{{ $driver->id_number }}</td>
                    <td>
                        <a href="{{ route('users.edit', $driver->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('users.destroy', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('users.show', $driver->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection