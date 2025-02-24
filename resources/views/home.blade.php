@extends('layouts.app')

@section('content')
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
                            <span aria-hidden="true">&times;</span>
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
                <th>Coordinates</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polygons as $polygon)
                <tr>
                    <td>{{ $polygon->name }}</td>
                    <td>{{ $polygon->code }}</td>
                    <td>{{ $polygon->speed_limit }}</td>
                    <td>
                        @foreach ($polygon->points as $k => $coordinate)
                            <p>Point {{ $k + 1 }}: {{ $coordinate->longitude }}, {{ $coordinate->latitude }}</p>
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editPolygonModal{{ $polygon->id }}">
                            Edit
                        </button>
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
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editPolygonForm{{ $polygon->id }}"
                                            action="{{ route('polygon.update', $polygon->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $polygon->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code" name="code">
                                                <small id="codeHelp" class="form-text text-muted">Enter the code
                                                    for the polygon.</small>
                                                <div id="codeError" class="form-text text-danger"></div>
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
                    </td>
                    <td>
                        <!-- Delete polygon -->
                        <form id="deletePolygonForm{{ $polygon->id }}" action="{{ route('polygon.destroy', $polygon->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <!-- View Polygon -->
                        <a href="{{ route('polygon.show', $polygon->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection