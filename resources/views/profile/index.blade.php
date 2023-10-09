@extends('layouts.app')

@section('css-plugins')
    <!-- Sweet Alert-->
    <link href="{{ asset('template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">My Profile</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="error-container"></div>

            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ Session::get('success') }} You will automatically logged out
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <input type="hidden" id="fieldId" value="{{ auth()->user()->id }}">

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Account Information</h4>
                            <form id="updateAccountForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fieldName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="fieldName" name="name" value="{{ auth()->user()->name }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fieldUsername" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="fieldUsername" name="username" value="{{ auth()->user()->username }}" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fieldEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="fieldEmail" name="email" value={{ auth()->user()->email }} autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fieldPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="fieldPassword" name="password" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success w-md">Save Changes</button>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                {{-- <div class="col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Profile Picture</h4>
                            <form>
                                <div class="mb-4">
                                    <img class="rounded-circle avatar-xl" alt="200x200" src="{{ auth()->user()->profile_photo_path }}" data-holder-rendered="true">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Upload</button>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col --> --}}
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('js-plugins')
    <!-- Sweet Alerts js -->
    <script src="{{ asset('template/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

@section('custom-js')
    <script>
        $(function() {
            const id = $('#fieldId').val();

            $('#fieldName').focus();

            $('#updateAccountForm').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();

                Swal.fire({
                    title: "Update Account Information?",
                    text: "Are you sure you want to update your account information?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Confirm",
                }).then(function (t) {
                    if (t.value) {
                        updateRecord(id, data)
                    }
                });
            });
        });

        function updateRecord(id, user) {
            $('.error-container').empty();

            axios.post('/profile/' + id, user).then(function(response) {
                let status = response.status;
                if (status === 204) {
                    Swal.fire({
                        title: "Account Updated",
                        text: "You will automatically logged out for security purposes.",
                        icon: "success"
                    }).then(function(t) {
                        if (t.value) {
                            window.location.href = "/login"
                        }
                    });
                }
            }).catch(function(error) {
                // window.location.href = "/profile"
                let data = error.response.data;
                for (var key in data) {
                    const errorElement = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper me-2"></i>
                        ` + data[key][0] + `
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `;

                    console.log('append');

                    $('.error-container').append(errorElement);
                }
            });
        }
    </script>
@endsection
