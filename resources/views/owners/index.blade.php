@extends('layouts.app')

@section('css-plugins')
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

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manage Owners</h4>

                        <div class="page-title-right">
                            <button style="margin-right: 4px" type="button" class="btn btn-light waves-effect"
                                id="btnRefresh" data-toggle="tooltip" data-placement="left" title="Refresh List"><i
                                    class="bx bx-loader-circle"></i></button>
                            <button id="btn-new-schedule" type="button" class="btn btn-primary lnb-new-schedule-btn"
                                data-bs-toggle="modal" data-bs-target="#modalCreate">
                                <i class="bx bx-plus"></i> New Owner</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List of Owners</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
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
                    <h5 class="modal-title" id="myModalLabel">Add Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fieldFirstName" name="first_name"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="fieldLastName" name="last_name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fieldAddress" class="form-label">Address</label>
                                    <textarea type="text" class="form-control" id="fieldAddress" name="address" rows="3"
                                        autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fieldContactNumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="fieldContactNumber" name="contact_number"
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
                    <h5 class="modal-title" id="myModalLabel">Edit Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdateFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fieldUpdateFirstName" name="first_name"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fieldUpdateLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="fieldUpdateLastName" name="last_name"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fieldUpdateAddress" class="form-label">Address</label>
                                    <textarea type="text" class="form-control" id="fieldUpdateAddress" name="address"
                                        rows="3" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fieldUpdateContactNumber" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="fieldUpdateContactNumber"
                                        name="contact_number" autocomplete="off">
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
                    <h5 class="modal-title" id="myModalLabel">Delete Owner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this owner?</p>
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
        $(function() {
            let selected_id = null;

            fetchRecords();
            $('#btnRefresh').on('click', function() {
                fetchRecords();
            });

            $(document).on('click', '.btn-update', function() {
                selected_id = $(this).data('id');
                $('#fieldUpdateFirstName').val($(this).data('first_name'));
                $('#fieldUpdateLastName').val($(this).data('last_name'));
                $('#fieldUpdateAddress').val($(this).data('address'));
                $('#fieldUpdateContactNumber').val($(this).data('contact_number'));
            });

            $(document).on('click', '.btn-delete', function() {
                selected_id = $(this).data('id');
            });

            $('#btnConfirmDelete').on('click', function() {
                deleteRecord(selected_id);
            });

            $('#modalCreate').on('shown.bs.modal', function (e) {
                $('#fieldFirstName').focus();
            });

            $('#modalCreate').on('hidden.bs.modal', function() {
                $('#formCreate')[0].reset();
            });

            $('#modalUpdate').on('shown.bs.modal', function (e) {
                $('#fieldUpdateFirstName').focus();
            });

            $('#modalUpdate').on('hidden.bs.modal', function() {
                $('#formUpdate')[0].reset();
            });

            $('#formCreate').on('submit', function(e) {
                e.preventDefault();

                let data = $(this).serialize();
                saveRecord(data);
            });

            $('#formUpdate').on('submit', function(e) {
                e.preventDefault();

                let data = $(this).serialize();
                updateRecord(selected_id, data);
            });
        });

        function fetchRecords() {
            $("#datatable").DataTable().rows().clear().draw();

            axios.get('/api/owners').then(function(response) {
                let owners = response.data.owners;
                if (owners.length === 0) {
                    return;
                }

                for (let i = 0; i < owners.length; i++) {
                    const owner = owners[i];

                    const actions = `
                    <a href="owners/` + owner.id + `" class="btn btn-info waves-effect waves-light"><i class="bx bxs-show"></i></a>
                    <button type="button" class="btn btn-warning waves-effect waves-light btn-update"
                        data-id="` + owner.id + `"
                        data-first_name="` + owner.first_name + `"
                        data-last_name="` + owner.last_name + `"
                        data-address="` + owner.address + `"
                        data-contact_number="` + owner.contact_number + `" data-bs-toggle="modal" data-bs-target="#modalUpdate"><i class="bx bxs-edit-alt"></i></button>
                    <button type="button" class="btn btn-danger waves-effect waves-light btn-delete" data-id=` + owner
                        .id + ` data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bx bxs-trash-alt"></i></button>
                    `;

                    $('#datatable').dataTable().fnAddData([
                        owner.first_name + ' ' + owner.last_name,
                        owner.address,
                        owner.contact_number,
                        owner.created_at,
                        owner.updated_at,
                        actions
                    ]);
                }
            }).catch(function(error) {
                console.log(error.response);
            });
        }

        function saveRecord(data) {
            axios.post('/api/owners', data).then(function(response) {
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
            axios.post('/api/owners/' + id + '/update', data).then(function(response) {
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
            axios.post('/api/owners/' + id + '/delete').then(function(response) {
                fetchRecords();
                $('#modalDelete').modal('hide');
            }).catch(function(error) {
                console.log(error.response);
            });
        }
    </script>
@endsection
