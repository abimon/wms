@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPolyPointModal">
            Add New PolyPoint
        </button>
        <!-- Modal add poly point -->
        <div class="modal fade" id="addPolyPointModal" tabindex="-1" aria-labelledby="addPolyPointModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPolyPointModalLabel">Add New PolyPoint</h5>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addPolyPointForm" action="{{ route('polypoint.store', ['polygon_id' => $polygon->id]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control longitude" id="longitude" name="longitude">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control latitude" id="latitude" name="latitude">
                            </div>
                            <div class="form-group">
                                <label for="accuracy">Accuracy</label>
                                <input type="text" class="form-control accuracy" id="accuracy" name="accuracy">
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
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Longitude</th>
                <th scope="col">Latitude</th>
                <th scope="col">Accuracy</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>
                @foreach ($polygon->points as $index => $polypoint)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{ $polygon->name }}</td>
                        <td>{{ $polypoint->longitude }}</td>
                        <td>{{ $polypoint->latitude }}</td>
                        <td>{{ $polypoint->accuracy }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editPolyPointModal{{ $polypoint->id }}">
                                Edit
                            </button>
                            <!-- Modal edit poly point -->
                            <!-- Modal -->
                            <div class="modal fade accordion-modal" id="editPolyPointModal{{ $polypoint->id }}" tabindex="-1"
                                aria-labelledby="editPolyPointModal{{ $polypoint->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPolyPointModal{{ $polypoint->id }}Label">Edit
                                                PolyPoint</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editPolyPointForm{{ $polypoint->id }}"
                                                action="{{ route('polypoint.update', ['polypoint' => $polypoint->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $polypoint->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="longitude">Longitude</label>
                                                    <input type="text" class="form-control longitude" id="longitude"
                                                        name="longitude" value="{{ $polypoint->longitude }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input type="text" class="form-control latitude" id="latitude"
                                                        name="latitude" value="{{ $polypoint->latitude }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="accuracy">Accuracy</label>
                                                    <input type="text" class="form-control accuracy" id="accuracy"
                                                        name="accuracy" value="{{ $polypoint->accuracy }}">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };
            var lats = document.getElementsByClassName("latitude")
            var longs = document.getElementsByClassName("longitude")
            var accs = document.getElementsByClassName("accuracy")
            // // console.log(lats)
            // for (var i = 0; i < lats.length; i++) {
            //     navigator.geolocation.getCurrentPosition(success, error, options);
            //     function success(pos) {
            //         var crd = pos.coords;
            //         lats[i].value = crd.latitude;
            //         longs[i].value = crd.longitude;
            //         accs[i].value = crd.accuracy;
            //     }

            //     function error(err) {
            //         console.warn(`ERROR(${err.code}): ${err.message}`);
            //     }
            // }
            function success(pos) {
                var crd = pos.coords;
                for (var i = 0; i < lats.length; i++) {
                    lats[i].value = crd.latitude;
                    longs[i].value = crd.longitude;
                    accs[i].value = crd.accuracy;
                }
            }

            function error(err) {
                console.warn(`ERROR(${err.code}): ${err.message}`);
            }
            navigator.geolocation.getCurrentPosition(success, error, options);
        });
    </script>
@endsection