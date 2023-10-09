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
                        <h4 class="mb-sm-0 font-size-18">Activity Logs</h4>

                        <div class="page-title-right">
                            <button style="margin-right: 4px" type="button" class="btn btn-light waves-effect"
                                id="btnRefresh" data-toggle="tooltip" data-placement="left" title="Refresh List"><i
                                    class="bx bx-loader-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List of Activities</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Uploaded Image</th>
                                        <th>Result Plate Number</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
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
            fetchRecords();
            $('#btnRefresh').on('click', function() {
                fetchRecords();
            });
        });

        function fetchRecords() {
            $("#datatable").DataTable().rows().clear().draw();

            axios.get('/api/activities').then(function(response) {

                let activities = response.data.activities;
                if (activities.length === 0) {
                    return;
                }

                for (let i = 0; i < activities.length; i++) {
                    const activity = activities[i];

                    let is_success = `<span class="badge badge-pill badge-soft-danger font-size-11">No Result</span>`;

                    if (activity.is_success) {
                        is_success = `<span class="badge badge-pill badge-soft-success font-size-11">Success</span>`;
                    }

                    $('#datatable').dataTable().fnAddData([
                        titleCase(activity.user),
                        `<a href="` + activity.image_path + `" target="_blank">Image</a>`,
                        activity.result_plate_number,
                        is_success,
                        activity.created_at
                    ]);
                }
            }).catch(function(error) {
                console.log(error.response);
            });
        }

        function titleCase(str) {
            str = str.toLowerCase();
            str = str.split(' ');
            for (var i = 0; i < str.length; i++) {
                str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
            }

            return str.join(' ');
        }
    </script>
@endsection
