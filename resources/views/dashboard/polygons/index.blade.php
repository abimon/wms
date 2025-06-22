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

    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPolygonModal">
            Add New Polygon
        </button>
        <!-- Modal add polygon -->
        <!-- Modal -->
        <div class="modal fade" id="addPolygonModal" tabindex="-1" aria-labelledby="addPolygonModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPolygonModalLabel">Add New Polygon</h5>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addPolygonForm" action="{{ route('polygon.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code" name="code">
                                <small id="codeHelp" class="form-text text-muted">Enter the code for the polygon.</small>
                                <div id="codeError" class="form-text text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="speed_limit">Speed Limit(Km/Hr)</label>
                                <input type="number" class="form-control" id="speed_limit" name="speed_limit">
                            </div>
                            <div class="row">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="form-floating col-md-6 mb-2">
                                        <input type="text" class="form-control" name="coordinates{{ $i }}"
                                            placeholder="Paste Coordinates Here">
                                        <label for="latitude{{ $i }}" class="text-center">Point
                                            {{ $i + 1 }} Coordinates</label>
                                    </div>
                                @endfor
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Speed Limit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polygons as $polygon)
                <tr>
                    <td>{{ $polygon->name }}</td>
                    <td>{{ $polygon->code }}</td>
                    <td>{{ $polygon->speed_limit }}</td>
                    <td>
                        <!-- dropdown -->
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#editPolygonModal{{ $polygon->id }}">Edit</a>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#viewPolygonModal{{ $polygon->id }}">View</a>

                            <button type="submit" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#deletePolygonModal{{ $polygon->id }}">Delete</button>
                            <div class="dropdown-divider"></div>
                        </div>
                        <!-- Modal delete -->
                        <!-- Modal -->
                        <div class="modal fade" id="deletePolygonModal{{ $polygon->id }}" tabindex="-1"
                            aria-labelledby="deletePolygonModalLabel{{ $polygon->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePolygonModalLabel{{ $polygon->id }}">Delete Polygon
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="deletePolygonForm{{ $polygon->id }}"
                                        action="{{ route('polygon.destroy', $polygon->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Are you sure you want to delete this polygon?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal view -->
                        <!-- Modal -->
                        <div class="modal fade" id="viewPolygonModal{{ $polygon->id }}" tabindex="-1"
                            aria-labelledby="viewPolygonModalLabel{{ $polygon->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewPolygonModalLabel{{ $polygon->id }}">
                                            View Polygon
                                        </h5>
                                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Name: {{ $polygon->name }}</p>
                                        <p>Code: {{ $polygon->code }}</p>
                                        <p>Speed Limit: {{ $polygon->speed_limit }}</p>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Point</th>
                                                    <th>Longitude</th>
                                                    <th>Latitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for($k = 0; $k < 8; $k++)
                                                    @if($polygon['point' . $k] != null)
                                                        <tr>
                                                            <td>Point {{ $k + 1 }}</td>
                                                            <td>{{explode(',', $polygon['point' . $k])[0]}}</td>
                                                            <td>{{ explode(',', $polygon['point' . $k])[1]}}</td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="close" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal edit polygon -->
                        <!-- Modal -->
                        <div class="modal fade" id="editPolygonModal{{ $polygon->id }}" tabindex="-1"
                            aria-labelledby="editPolygonModalLabel{{ $polygon->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPolygonModalLabel{{ $polygon->id }}">
                                            Edit Polygon
                                        </h5>
                                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <form id="editPolygonForm{{ $polygon->id }}"
                                        action="{{ route('polygon.update', $polygon->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $polygon->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                    value="{{ $polygon->code }}">
                                                <small id="codeHelp" class="form-text text-muted">Enter the code
                                                    for the polygon.</small>
                                                <div id="codeError" class="form-text text-danger"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="speed_limit">Speed Limit(Km/Hr)</label>
                                                <input type="number" class="form-control" id="speed_limit" name="speed_limit"
                                                    value="{{ $polygon->speed_limit }}">
                                            </div>
                                            <div class="row">
                                                @for($j = 0; $j < 8; $j++)
                                                    <div class="form-floating col-md-6 mb-2">
                                                        <input type="text" class="form-control" id="latitude{{ $j }}"
                                                            name="coordinates{{ $j }}" value="{{ $polygon['point' . $j]}}"
                                                            placeholder="{{ $polygon['point' . $j] == null ? 'Paste Coordinates Here' : ''}}">
                                                        <label for="latitude{{ $j }}" class="text-center">Point
                                                            {{ $j + 1 }} Coordinates</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" id="close" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Delete polygon -->

                    </td>
                </tr>
            @endforeach
    </table>
@endsection