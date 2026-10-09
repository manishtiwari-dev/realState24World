@extends('admin.layouts.app')
@section('title', 'Agent Detail')

@section('content')
    <div id="content" class="app-content">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="page-header mb-0">Agent Profile</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'agent.index') }}">Agent</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agent Detail</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route(getRolePrefix() . 'agent.index') }}" class="btn btn-outline-primary">
                <i class="fa fa-arrow-left me-2"></i>Back to List
            </a>
        </div>

        <!-- Dealer Info Glass Card -->
        <!-- Dealer Info Glass Card -->
        <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px;">
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Left: Full Image -->
                    <div class="col-md-4 bg-light d-flex align-items-center justify-content-center"
                        style="border-top-left-radius: 16px; border-bottom-left-radius: 16px;">
                        @if (empty($agent->profile_photo))
                            <img src="https://ui-avatars.com/api/?background=random&name={{ $agent->name }}"
                                class="img-fluid" style="border-top-left-radius: 16px; border-bottom-left-radius: 16px;" />
                        @else
                            <img src="{{ asset('uploads/agents/' . $agent->profile_photo . '') }}" class="img-fluid"
                                style="border-top-left-radius: 16px; border-bottom-left-radius: 16px;" />
                        @endif
                    </div>

                    <!-- Right: Dealer Info -->
                    <div class="col-md-8 p-4">
                        <h4 class="fw-bold mb-2">{{ $agent->company_name }}</h4>
                        <p class="mb-2 fw-bold">{{ $agent->name }}</p>
                        <p class="text-muted mb-4">{{ $agent->about }}</p>
                        <div class="row gy-3">
                            <div class="col-sm-6">
                                <strong>Email:</strong>
                                <div class="text-secondary">{{ $agent->email }}</div>
                            </div>
                            <div class="col-sm-6">
                                <strong>Phone:</strong>
                                <div class="text-secondary">{{ $agent->phone }}</div>
                            </div>
                            <div class="col-sm-6">
                                <strong>Address:</strong>
                                <div class="text-secondary">{{ $agent->address }}</div>
                            </div>
                            @if (!empty($agent->website))
                                <div class="col-sm-6">
                                    <strong>Website:</strong>
                                    <div class="text-secondary">{{ $agent->website }}</div>
                                </div>
                            @endif

                            @if (!empty($agent->license_number))
                                <div class="col-sm-6">
                                    <strong>License Number:</strong>
                                    <div class="text-secondary">{{ $agent->license_number }}</div>
                                </div>
                            @endif

                            <div class="col-sm-6">
                                <strong>License Document:</strong>
                                @if ($agent->documents)
                                    <div>
                                        <a href="{{ asset('uploads/document/' . $agent->documents) }}"
                                            class="badge bg-success px-3 py-1" download>
                                            Download
                                        </a>
                                    </div>
                                @else
                                    <div><span class="text-muted">No document uploaded</span></div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <strong>Verification:</strong>
                                <div>
                                    @if ($agent->is_verified == '1')
                                        <span class="badge bg-green px-3 py-1"><i class="fa fa-star"></i>Verified </span>
                                    @else
                                        <span class="badge bg-red px-3 py-1"><i class="fa fa-star"></i> Not Verified </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <strong>Dealer Status:</strong>
                                <div>
                                    @if ($agent->is_status == '1')
                                        <span class="badge bg-success px-3 py-1">Active</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-1">Not Active </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Property Listings -->
        @if(!empty($agent->user->property))
        @if ($agent->user->property && $agent->user->property->count() > 0)
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h5 class="mb-0 text-dark fw-semibold">Agent Property Listings</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Property Name</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    {{-- <th>Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dummy rows -->
                                @foreach ($agent->user->property as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $data->type }}</span></td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->amount }}</td>
                                        {{-- <td><span class="badge bg-success-subtle text-success">Available</span></td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @endif
    </div>
@endsection
