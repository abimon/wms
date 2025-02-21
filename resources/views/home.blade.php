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
                                <label for="description">Longitude</label>
                                <input type="text" readonly class="form-control" id="longitude" name="point0Longitude">
                            </div>
                            <div class="form-group">
                                <label for="description">Latitude</label>
                                <input type="text" readonly class="form-control" id="latitude" name="point0Latitude">
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive pt-3">
                    <canva class="" id="polygons"></canva>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            updatePolygons();
            $(document).ready(function () {
                var fullUrl = "/polygon"
                $('#addPolygonForm').on('submit', function (event) {
                    event.preventDefault();
                    let form = $(this);
                    let url = form.attr('action');
                    let data = form.serialize();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            $('#close').click();
                            $('#addPolygonForm').trigger('reset');
                            updatePolygons();
                        }
                    });
                });
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                var crd = pos.coords;
                document.getElementById("latitude").value = crd.latitude;
                document.getElementById("longitude").value = crd.longitude;
            }

            function error(err) {
                console.warn(`ERROR(${err.code}): ${err.message}`);
            }
            navigator.geolocation.getCurrentPosition(success, error, options);
        });
        function updatePolygons() {
            var fullUrl = "/polygon"
            $.ajax({
                url: fullUrl,
                type: "GET",
                headers: {
                    "accept": "application/json; odata=verbose"
                },
                success: onSuccess,
                error: onError
            });
            function onError(error) {
                alert('Error');
            }

            function onSuccess(data) {
                var objItems = data;
                // console.log(data);
                var tableContent = '<table class="table table-striped project-orders-table">' +
                    '<thead><tr><th class="ms-5">#</th><th>Name</th><th>Code</th><th>Created At</th>' +
                    '<th>Last Update</th><th colspan="3" class="text-center">Actions</th></tr></thead>' + '<tbody>';
                for (var i = 0; i < objItems.length; i++) {
                    var options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
                    var ud = new Date(objItems[i].updated_at);
                    var cd = new Date(objItems[i].created_at);
                    // console.log(cd.toLocaleDateString("en-US"));
                    tableContent += '<tr>';
                    tableContent += '<td>' + (i + 1) + '</td>';
                    tableContent += '<td>' + objItems[i].name + '</td>';
                    tableContent += '<td>' + objItems[i].code + '</td>';
                    tableContent += '<td>' + cd.toLocaleDateString("en-US", options) + '</td>';
                    tableContent += '<td>' + ud.toLocaleDateString("en-US", options) + '</td>';
                    tableContent += '<td><button class="btn btn-sm btn-danger delete" data-bs-toggle="modal" data-bs-target="#deletePolygonModal' + objItems[i].id + '">Delete <i class="typcn typcn-delete-outline btn-icon-append"></i></button></td>'
                    tableContent += '<td><button class="btn btn-sm btn-primary edit">Edit <i class="typcn typcn-edit btn-icon-append"></i></button></td>'
                    tableContent += '<td><button class="btn btn-sm btn-success view">View</button></td>'
                    tableContent += '</tr>';
                    tableContent += '<div class="modal fade" id="deletePolygonModal' + objItems[i].id + '" tabindex="-1" aria-labelledby="addPolygonModalLabel"aria-hidden="true">' +
                        '<div class="modal-dialog modal-dialog-centered" role="document">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header">' +
                        '<h5 class="modal-title" id="addPolygonModalLabel">Delete Polygon</h5>' +
                        '<button type="button" id="closeB' + objItems[i].id + '" class="btn-close" data-bs-dismiss="modal" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        '<p>Are you sure to delete this polygon(' + objItems[i].code + ')?</p>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-primary" id = "closeB'+objItems[i].id+'" data-bs-dismiss="modal">No</button>' +
                        '<button type="button" class="btn btn-danger deletePolygon" onclick="deletePolygon(' + objItems[i].id + ')">Yes</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    var id = objItems[i].id
                }
                tableContent += '</tbody></table> ';
                $('#polygons').empty();
                $('#polygons').append(tableContent);
            }
        }
        // setInterval(updatePolygons, 10000); // Update every 10seconds
        function deletePolygon(id) {
            $.ajax({
                url: '/polygons/destroy/'+id,
                type: 'GET',
                success: function (response) {
                    $('#closeB'+id).click();
                    updatePolygons();
                    // alert(response.message);
                }
            });
        }

    </script>
@endsection