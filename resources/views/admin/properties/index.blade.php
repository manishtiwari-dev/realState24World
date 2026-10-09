@extends('admin.layouts.app')
@section('content')
<div id="content" class="app-content">
<div class="d-flex align-items-center mb-3">
    <div>
        <h1 class="page-header mb-0">Property Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Property</li>
        </ol>
    </div>
    @can('properties-create')
        <div class="ms-auto">
            <a href="{{ route(getRolePrefix().'properties.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i> CREATE PROPERTY</a>
        </div>
    @endcan
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 mb-4">
            <div class="card-header h6 mb-0 bg-none p-3">
                <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> PROPERTY LIST
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0">
                    <strong> Success! </strong> {{ \Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
              </div>
            @endif
            <div class="card-body">
                <table id="data-table-default" class="table table-striped table-bordered align-middle">
                    <thead>
                      <tr>
                        <th width="1%"></th>
                        <th width="1%"></th>
                        <th>Property Name</th>
                        <th width="10%">State</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th class="text-nowrap" width="1%">Home</th>
                        <th class="text-nowrap" width="1%">Premium</th>
                        @can('property-status')
                            <th class="text-nowrap" width="1%">Status</th>
                        @endcan
                        <th class="text-nowrap" width="8%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($properties))
                        @foreach($properties as $key => $prop)
                          <tr class="odd gradeX">
                            <?php $dash=''; ?>
                            <td class="fw-bold text-dark">{{ ++$key }}</td>
                            <td class="with-img">
                                @if(empty($prop->thumbnail))
                                    <img src="{{ asset('uploads/no-image.png') }}" class="rounded h-40px my-n1 mx-n1"/>
                                @else
                                    <img src="{{ asset('uploads/properties/'.$prop->thumbnail.'') }}" class="rounded h-70px w-50px my-n1 mx-n1"/>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-blue">{{$prop->name}}</span><br>
                                <span class="fw-bold text-red"><i class="fa fa-inr"></i> {{$prop->amount}}</span><br>
                                <span class="fw-bold text-grey">{{$prop->address}}</span>
                            </td>
                            <td>{{ $prop->state->name ?? '' }}</td>
                            <td>{{ $prop->category->name ?? '' }}</td>
                            <td>{{$prop->type ?? ''}}</td>
                            <td>
                              <div class="form-check form-switch">
                                <input class="form-check-input showonhome" data-id="{{ $prop->id }}"
                                    type="checkbox" {{ $prop->show_home == 1 ? 'checked' : '' }}>
                              </div>
                            </td>
                             <td>
                              <div class="form-check form-switch">
                                <input class="form-check-input premium" data-id="{{ $prop->id }}"
                                    type="checkbox" {{ $prop->premium == 1 ? 'checked' : '' }}>
                              </div>
                            </td>
                            @can('location-status')
                            <td>
                              <div class="form-check form-switch">
                                <input class="form-check-input statusproperty" data-id="{{ $prop->id }}"
                                    type="checkbox" {{ $prop->status == 1 ? 'checked' : '' }}>
                              </div>
                            </td>
                            @endcan
                            <td>
                                <a class="btn btn-info btn-xs me-1 mb-1" href="{{ route('property.detail', $prop->slug) }}" target="_blank"><i
                                    class="fa-solid fa-list"></i>&nbsp; Show&nbsp;</a>
                                @can('properties-edit')
                                    <a href="{{ route(getRolePrefix().'properties.edit', ['id' => encode_string($prop->id)]) }}" class="btn btn-primary btn-xs btn-circle me-1 mb-1"><i class="fa fa-edit"></i> &nbsp;Edit &nbsp;&nbsp;</a>
                                @endcan
                                @can('properties-delete')
                                    <form method="POST" action="{{ route(getRolePrefix().'properties.destroy', $prop->id) }}"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure want to delete this property')){ return true;} else { return false; }"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                @endcan
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('custom-javascript')
<script>
    $('.statusproperty').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let propertyId = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route(getRolePrefix().'properties.status') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'status': status,
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
    //show home
    $('.showonhome').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let propertyId = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route(getRolePrefix().'properties.showhome') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'home_status': status,
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

    //verified

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


    //premium

       $('.premium').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let propertyId = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route(getRolePrefix().'properties.premium') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'premium': status,
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
