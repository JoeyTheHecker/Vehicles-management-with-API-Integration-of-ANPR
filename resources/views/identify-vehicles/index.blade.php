@extends('layouts.app')

@section('css-plugins')
    <!-- Lightbox css -->
    <link href="{{ asset('template/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <input type="hidden" id="userId" value="{{ auth()->user()->id }}">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Identify Vehicles</h4>

                        <div class="page-title-right">
                            <button id="btnUploadImage" type="button" class="btn btn-primary lnb-new-schedule-btn">
                                <i class="bx bx-plus"></i> Upload Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="alert-message-container">

            </div>

            <div class="vehicle-container" style="visibility:hidden">
                <div class="row">
                    <div class="col-xl-4">
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
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="pt-4">

                                            <div class="row">
                                                <div class="col-6" style="width:200px">
                                                    <h5 class="font-size-15" id="fieldOwnerName"></h5>
                                                    <p class="text-muted mb-0">Owner</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Vehicle Information</h4>

                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fieldBrand" class="form-label">Brand</label>
                                                <input type="text" class="form-control" id="fieldBrand" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fieldModel" class="form-label">Model</label>
                                                <input type="text" class="form-control" id="fieldModel" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fieldSerial" class="form-label">Serial</label>
                                                <input type="text" class="form-control" id="fieldSerial" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fieldPlateNumber" class="form-label">Plate Number</label>
                                                <input type="text" class="form-control" id="fieldPlateNumber" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row">-->
                <!--    <div class="col-xl-12">-->
                <!--        <div class="card">-->
                <!--            <div class="card-body">-->
                <!--                <h4 class="card-title mb-4">Vehicle Images</h4>-->

                <!--                <div class="row">-->
                <!--                    <div class="zoom-gallery d-flex flex-wrap">-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('js-plugins')

    <!-- Sweet Alerts js -->
    <script src="{{ asset('template/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Magnific Popup-->
    <script src="{{ asset('template/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- lightbox init js-->
    <script src="{{ asset('template/js/pages/lightbox.init.js') }}"></script>
@endsection

@section('custom-js')
    <script>
        $(function() {
            $('.vehicle-container').hide();
            $('.vehicle-container').css('visibility', 'visible');

            $("#btnUploadImage").click(function() {
                $('.alert-message-container').empty();
                $('.vehicle-container').hide();
                $('#fieldOwnerName').text('');
                $('#fieldBrand').val('');
                $('#fieldModel').val('');
                $('#fieldSerial').val('');
                $('#fieldPlateNumber').val('');
                // $('.zoom-gallery').empty();

                swal.queue([{
                    title: "Upload Plate Number",
                    input: 'file',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload Plate Number'
                    },
                    showLoaderOnConfirm: !0,
                    preConfirm: function(file) {
                        if (!file) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Occured',
                                text: 'File is required. Please choose a file.'
                            });
                        }
                        return new Promise(function(e) {
                            var formData = new FormData();
                            var file = $('.swal2-file')[0].files[0];
                            if (!file) {
                                return;
                            }

                            formData.append("file", file);
                            formData.append("user_id", $('#userId').val());
                            $.ajax({
                                method: 'POST',
                                url: '/api/vehicles/upload',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    console.log(response);

                                    let data = jQuery.parseJSON(
                                        response);
                                    if (data.error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error Occured',
                                            text: jsonResponse
                                                .message
                                        });
                                        return;
                                    } else {
                                        let jsonResponse = data.response
                                        if (IsJsonString(data.response)) {
                                            jsonResponse = jQuery
                                            .parseJSON(data.response);
                                        }

                                        if (jsonResponse.hasOwnProperty('message')) {
                                            if (jsonResponse.message.search('subscribed') > -1) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error Occured',
                                                    text: jsonResponse.message
                                                });
                                                return;
                                            }
                                        }

                                        $('.alert-message-container').append(`
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="mdi mdi-check-all me-2"></i>
                                                <strong>Vehicle record found.</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        `);

                                        $('#fieldOwnerName').text(jsonResponse.owner_name);
                                        $('#fieldBrand').val(jsonResponse.brand_name);
                                        $('#fieldModel').val(jsonResponse.model);
                                        $('#fieldSerial').val(jsonResponse.serial_number);
                                        $('#fieldPlateNumber').val(jsonResponse.plate_number);

                                        if (jsonResponse.images.length > 0) {
                                            for (let i = 0; i < jsonResponse.images.length; i++) {
                                                const image = jsonResponse.images[i];
                                                const imageElement = `
                                                <a href="` + image.image_path + `" title=""><img src="` + image.image_path + `" alt="" width="245"></a>
                                                `;
                                                // $('.zoom-gallery').append(imageElement);
                                            }
                                        }
                                        $('.vehicle-container').show();

                                        swal.close();
                                    }
                                },
                                error: function(error) {
                                    console.log(error);

                                    let errorResponse = jQuery
                                        .parseJSON(error.responseText);
                                    if (error.status === 404) {
                                        $('.alert-message-container').append(`
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="mdi mdi-block-helper me-2"></i>
                                            <strong>Not Found!</strong> ` + errorResponse.response + `
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        `);

                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Not Found',
                                            text: errorResponse
                                                .response
                                        });
                                    }
                                }
                            });
                        });
                    },
                }, ]).catch(swal.noop);
            });
        });

        function IsJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    </script>
@endsection
