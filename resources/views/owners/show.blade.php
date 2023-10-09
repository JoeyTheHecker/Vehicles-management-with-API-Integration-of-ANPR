@extends('layouts.app')

@section('css-plugins')
    <!-- Select2 -->
    <link href="{{ asset('template/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('template/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('template/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('template/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <input type="hidden" id="ownerId" value={{ $owner->id }}>


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Vehicle Owner</h4>

                        <div class="page-title-right">
                            <button style="margin-right: 4px" type="button" class="btn btn-light waves-effect"
                                id="btnRefresh" data-toggle="tooltip" data-placement="left" title="Refresh List"><i
                                    class="bx bx-loader-circle"></i></button>
                            <button id="btn-new-schedule" type="button" class="btn btn-primary lnb-new-schedule-btn"
                                data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="bx bx-plus"></i> New Vehicle</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3" style="width: 300px">
                                        <h5 class="text-primary">Personal Information</h5>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ asset('template/images/owners/default-car-owner.png') }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15" style="width: 100px">
                                        {{ $owner->first_name . ' ' . $owner->last_name }}</h5>
                                    <p class="text-muted mb-0">Owner</p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pt-4">

                                        <div class="row">
                                            <div class="col-6" style="width:200px">
                                                <h5 class="font-size-15">{{ count($owner->vehicles) }}</h5>
                                                <p class="text-muted mb-0">Total Vehicles</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List of Vehicles</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Serial No.</th>
                                        <th>Plate No.</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- create modal content -->
    <div id="modalCreate" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Owner Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldBrand" class="form-label">Brand</label>
                                    <select class="form-control" id="fieldBrand" name="brand_id" style="width: 100%">
                                        <option value="">---</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldModel" class="form-label">Model</label>
                                    <input type="text" class="form-control" id="fieldModel" name="model"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldSerialNumber" class="form-label">Serial Number</label>
                                    <input type="text" class="form-control" id="fieldSerialNumber" name="serial_number"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldPlateNumber" class="form-label">Plate Number</label>
                                    <input type="text" class="form-control" id="fieldPlateNumber" name="plate_number"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light"
                            id="btnConfirmSave">Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update modal content -->
    <div id="modalUpdate" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Owner Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdateBrand" class="form-label">Brand</label>
                                    <select class="form-control" id="fieldUpdateBrand" name="brand_id" style="width: 100%">
                                        <option value="">---</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdateModel" class="form-label">Model</label>
                                    <input type="text" class="form-control" id="fieldUpdateModel" name="model"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdateSerialNumber" class="form-label">Serial Number</label>
                                    <input type="text" class="form-control" id="fieldUpdateSerialNumber" name="serial_number"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdatePlateNumber" class="form-label">Plate Number</label>
                                    <input type="text" class="form-control" id="fieldUpdatePlateNumber" name="plate_number"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning waves-effect waves-light"
                            id="btnConfirmUpdate">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- delete modal content -->
    <div id="modalDelete" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Delete Owner Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this vehicle?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light"
                        id="btnConfirmDelete">Confirm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js-plugins')
    <!-- Required select2 js -->
    <script src="{{ asset('template/libs/select2/js/select2.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('template/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('template/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('template/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('template/js/pages/datatables.init.js') }}"></script>
@endsection

@section('custom-js')
    <script>
        var owner_id = $('#ownerId').val();

        $(function() {
            $('#fieldBrand').select2({
                dropdownParent: $('#modalCreate')
            });

            $('#fieldUpdateBrand').select2({
                dropdownParent: $('#modalUpdate')
            });

            fetchRecords();
            $('#btnRefresh').on('click', function() {
                fetchRecords();
            });

            let selected_id = null;
            $(document).on('click', '.btn-update', function() {
                selected_id = $(this).data('id');

                $('#fieldUpdateBrand').val($(this).data('brand_id'));
                $('#fieldUpdateBrand').trigger('change');

                $('#fieldUpdateModel').val($(this).data('model'));
                $('#fieldUpdateSerialNumber').val($(this).data('serial_number'));
                $('#fieldUpdatePlateNumber').val($(this).data('plate_number'));
            });

            $(document).on('click', '.btn-delete', function() {
                selected_id = $(this).data('id');
            });

            $('#btnConfirmDelete').on('click', function() {
                deleteRecord(selected_id);
            });

            $('#modalCreate').on('shown.bs.modal', function (e) {
                $('#fieldBrand').focus();
            });

            $('#modalCreate').on('hidden.bs.modal', function() {
                $('#formCreate')[0].reset();

                $('#fieldBrand').val('');
                $('#fieldBrand').trigger('change');
            });

            $('#modalUpdate').on('shown.bs.modal', function (e) {
                $('#fieldUpdateBrand').focus();
            });

            $('#modalUpdate').on('hidden.bs.modal', function() {
                $('#fieldUpdateBrand').val('');
                $('#fieldUpdateBrand').trigger('change');
                $('#formUpdate')[0].reset();
            });

            $('#formCreate').on('submit', function(e) {
                e.preventDefault();

                let data = $(this).serialize();
                data = data + "&owner_id=" + owner_id;
                saveRecord(data);
            });

            $('#formUpdate').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                data = data + "&owner_id=" + owner_id;
                updateRecord(selected_id, data);
            });
        });

        function fetchRecords() {
            $("#datatable").DataTable().rows().clear().draw();

            axios.get('/api/vehicles/owners/' + owner_id).then(function(response) {
                let vehicles = response.data.vehicles;
                if (vehicles.length === 0) {
                    return;
                }

                for (let i = 0; i < vehicles.length; i++) {
                    const vehicle = vehicles[i];

                    const actions = `
                    <button type="button" class="btn btn-warning waves-effect waves-light btn-update"
                        data-id="` + vehicle.id + `"
                        data-brand_id="` + vehicle.brand_id + `"
                        data-model="` + vehicle.model + `"
                        data-model="` + vehicle.model + `"
                        data-serial_number="` + vehicle.serial_number + `"
                        data-plate_number="` + vehicle.plate_number + `" data-bs-toggle="modal" data-bs-target="#modalUpdate"><i class="bx bxs-edit-alt"></i></button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn-delete" data-id=` +
                        vehicle
                        .id + ` data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bx bxs-trash-alt"></i></button>
                    `;

                    $('#datatable').dataTable().fnAddData([
                        vehicle.brand_name.toUpperCase(),
                        vehicle.model.toUpperCase(),
                        vehicle.serial_number.toUpperCase(),
                        vehicle.plate_number.toUpperCase(),
                        vehicle.created_at,
                        actions
                    ]);
                }
            }).catch(function(error) {
                console.log(error.response);
            });
        }

        function saveRecord(data) {
            axios.post('/api/vehicles', data).then(function(response) {
                let status = response.status;
                if (status === 201) {
                    fetchRecords();
                    $('#modalCreate').modal('hide');
                    $('#formCreate')[0].reset();
                }
            }).catch(function(error) {
                console.log(error.response);
            });
        }

        function updateRecord(id, data) {
            axios.post('/api/vehicles/' + id + '/update', data).then(function(response) {
                let status = response.status;
                if (status === 204) {
                    fetchRecords();
                    $('#modalUpdate').modal('hide');
                    $('#formUpdate')[0].reset();
                }
            }).catch(function(error) {
                console.log(error.response);
            });
        }

        function deleteRecord(id) {
            axios.post('/api/vehicles/' + id + '/delete').then(function(response) {
                fetchRecords();
                $('#modalDelete').modal('hide');
            }).catch(function(error) {
                console.log(error.response);
            });
        }
    </script>
@endsection
