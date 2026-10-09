@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="block-header">
            <h1 class="page-header">{{ __('Dashboard') }}</h1>
        </div>
        {{-- Dashboard Tab Section --}}
        <div class="row">
            <div class="col-lg-3">
                <a href="{{ route(getRolePrefix() . 'properties.index') }}">
                    <div class="card">
                        <div class="card-body no-padding" style="height:208px">
                            <div class="alert alert-callout alert-info no-margin">
                                <strong class="text-xl" style="font-size: 50px;">{{ $total_property ?? '0'}}</strong><br>
                                <span class="opacity-90">Total Property</span>
                                <h1 class="pull-right text-warning"><img src="{{ asset('assets/img/order.png') }}"></h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'dealer.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-warning no-margin">
                                        <h1 class="pull-right text-warning"><img src="{{ asset('assets/img/totaldealer.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{ $total_dealer ?? '0' }}</strong><br />
                                        <span class="opacity-50">Total Registered Dealer</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'agent.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-danger no-margin">
                                        <h1 class="pull-right text-warning"><img src="{{ asset('assets/img/totalagent.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{ $total_agent ?? '0' }}</strong><br />
                                        <span class="opacity-50">Total Registered Agent</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'customer.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-success no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/totaluser.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{$total_user ?? ''}} </strong><br />
                                        <span class="opacity-50">Total Registered User</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'review.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-warning no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/totalrevenue.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{ $total_enquiry ?? ''}}</strong><br />
                                        <span class="opacity-50">Total Booking Enquiry</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'review.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-danger no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/discount.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{ $total_review ?? ''}}</strong><br />
                                        <span class="opacity-50">Total Review</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{ route(getRolePrefix() . 'blog.index') }}">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-success no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/product.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">{{$total_blog ?? ''}}</strong><br />
                                        <span class="opacity-50">Total  Blog</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Dashboard Tab Section --}}
        {{-- Table --}}

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-inverse" data-sortable-id="table-basic-6">
                    <div class="panel-heading">
                        <h4 class="panel-title">Booking Enquiry</h4>
                        <div class="panel-heading-btn">
                            <a href="{{ route(getRolePrefix() . 'booking.enquiry') }}" class="btn btn-xs text-white">View All</a>
                        </div>
                    </div>


                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($total_enquiry_result as $key => $enquiry)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $enquiry->name }}</td>
                                            <td>{{ $enquiry->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>



            <div class="col-lg-6">
                <div class="panel panel-inverse" data-sortable-id="table-basic-6">

                    <div class="panel-heading">
                        <h4 class="panel-title">New Properties Registration</h4>
                        <div class="panel-heading-btn">
                            <a href="{{ route(getRolePrefix() . 'properties.verification') }}" class="btn btn-xs text-white">View All</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="40%">Properties</th>
                                        <th>State</th>
                                        <th>Is Verified</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($total_property_result as $pi => $newproperties)
                                    <tr>
                                        <td>{{ $pi+1 }}</td>
                                        <td>{{ $newproperties->name }}</td>
                                        <td>{{ $newproperties->state->name ?? '' }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input is_verified" data-id="{{ $newproperties->id }}"
                                                    type="checkbox" {{ $newproperties->is_verified == 1 ? 'checked' : '' }}>
                                            </div>
                                            </td>
                                        <td><a class="btn btn-info btn-xs me-1 mb-1" href="{{ route(getRolePrefix().'properties.verification.edit', ['id' => encode_string($newproperties->id)]) }}" target="_blank"><i
                                    class="fa-solid fa-check"></i> Verification</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $('.is_verified').change(function () {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let propertyId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{{ route(getRolePrefix().'properties.is_verified') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'is_verified': status,
                        'property_id': propertyId
                    },
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (xhr) {
                        toastr.error('Something went wrong!');
                    }
                });
            });
    </script>
@endsection