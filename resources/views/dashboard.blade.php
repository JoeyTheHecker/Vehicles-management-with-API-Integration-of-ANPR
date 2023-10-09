@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Owners</p>
                                            <h4 class="mb-0">{{ $total_owners }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-user-pin font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Vehicles</p>
                                            <h4 class="mb-0">{{ $total_vehicles }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bxs-car font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Brands</p>
                                            <h4 class="mb-0">{{ $total_brands }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end row -->

            @if (strtolower((auth()->user()->role->name)) === "administrator")
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Owners</h4>
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Contact Number</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($latest_owners))
                                            @foreach ($latest_owners as $owner)
                                            <tr>
                                                <td>{{ $owner->first_name . ' ' . $owner->last_name  }}</td>
                                                <td>{{ $owner->address }}</td>
                                                <td>{{ $owner->contact_number }}</td>
                                                <td>{{ $owner->created_at }}</td>
                                                <td>{{ $owner->updated_at  }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Vehicles</h4>
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Owner</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Serial No.</th>
                                                <th>Plate No.</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($latest_vehicles))
                                            @foreach ($latest_vehicles as $vehicle)
                                            <tr>
                                                <td>{{ $vehicle->owner->first_name . ' ' . $vehicle->owner->last_name }}</td>
                                                <td>{{ $vehicle->brand->name  }}</td>
                                                <td>{{ $vehicle->model  }}</td>
                                                <td>{{ $vehicle->serial_number  }}</td>
                                                <td>{{ $vehicle->plate_number }}</td>
                                                <td>{{ $vehicle->created_at }}</td>
                                                <td>{{ $vehicle->updated_at }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Latest Brands</h4>
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Date Created</th>
                                                <th>Date Updated</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($latest_brands))
                                            @foreach ($latest_brands as $brand)
                                            <tr>
                                                <td>{{ $brand->name }}</td>
                                                <td>{{ $brand->created_at }}</td>
                                                <td>{{ $brand->updated_at }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
