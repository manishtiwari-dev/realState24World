@extends('agent.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Property Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Property</li>
                </ol>
            </div>

            <div class="ms-auto">
                <a href="{{ route(getRolePrefix() . 'properties.create') }}" class="btn btn-primary px-4"><i
                        class="fa fa-plus fa-lg ms-n2 "></i> CREATE PROPERTY</a>
            </div>

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
                                    <th width="20%">Address</th>
                                    <th>State</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    @can('property-status')
                                        <th class="text-nowrap" width="1%">Status</th>
                                    @endcan
                                    <th class="text-nowrap" width="18%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($properties))
                                    @foreach ($properties as $key => $prop)
                                        <tr class="odd gradeX">
                                            <?php $dash = ''; ?>
                                            <td class="fw-bold text-dark">{{ ++$key }}</td>
                                            <td class="with-img">
                                                @if (empty($prop->thumbnail))
                                                    <img src="{{ asset('uploads/no-image.png') }}"
                                                        class="rounded h-40px my-n1 mx-n1" />
                                                @else
                                                    <img src="{{ asset('uploads/properties/' . $prop->thumbnail . '') }}"
                                                        class="rounded h-40px w-50px my-n1 mx-n1" />
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-bold text-blue">{{ $prop->name }}</span><br>
                                                <span class="fw-bold text-red"><i class="fa fa-inr"></i>
                                                    {{ $prop->amount }}</span>
                                            </td>
                                            <td>{{ $prop->address }}</td>
                                            <td>{{ $prop->state->name ?? '' }}</td>
                                            <td>{{ $prop->category->name ?? '' }}</td>
                                            <td>{{ $prop->type ?? '' }}</td>
                                            @can('location-status')
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input statusproperty"
                                                            data-id="{{ $prop->id }}" type="checkbox"
                                                            {{ $prop->status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                            @endcan
                                            <td>


                                                <a href="{{ route(getRolePrefix() . 'properties.edit', ['id' => encode_string($prop->id)]) }}"
                                                    class="btn btn-primary btn-xs btn-circle me-1 mb-1"><i
                                                        class="fa fa-edit"></i> Edit</a>


                                                <form method="POST"
                                                    action="{{ route(getRolePrefix() . 'properties.destroy', $prop->id) }}"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onClick="if(confirm('Are you sure want to delete this property')){ return true;} else { return false; }"><i
                                                            class="fa-solid fa-trash"></i> Delete</button>
                                                </form>

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
        $('.statusproperty').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let propertyId = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route(getRolePrefix() . 'properties.status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'property_id': propertyId
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                }
            });
        });
    </script>
@endsection
