@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Testimonial Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Testimonial</li>
                </ol>
            </div>
            @can('testimonial-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'testimonial.create') }}" class="btn btn-primary px-4"><i
                            class="fa fa-plus fa-lg ms-n2 "></i> Create Testimonial</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Testimonial List
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
                                    <th class="text-nowrap"></th>
                                    <th class="text-nowrap">Name</th>
                                    <!-- <th class="text-nowrap">Designation</th> -->
                                    <th class="text-nowrap" width= "1%">Status</th>
                                    <th class="text-nowrap" width="12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if (!empty($testimonial))
                                    @foreach ($testimonial as $key => $val)
                                        <tr class="odd gradeX">
                                            <td class="fw-bold text-dark">{{ $key + 1 }}</td>
                                            <td class="with-img">
                                                @if (empty($val->image))
                                                    <img src="{{ asset('uploads/no-image.png') }}"
                                                        class="rounded h-40px my-n1 mx-n1" />
                                                @else
                                                    <img src="{{ asset('uploads/testimonial/' . $val->image . '') }}"
                                                        class="rounded h-50px w-50px my-n1 mx-n1" />
                                                @endif
                                            </td>
                                            <td>{{ $val->name }}</td>
                                            <!-- <td>{{ $val->designation }}</td> -->
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input testimonialstatus"
                                                        data-id="{{ $val->id }}" type="checkbox"
                                                        {{ $val->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route(getRolePrefix().'testimonial.update', $val->id) }}"
                                                    class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                                <a class="btn btn-danger btn-xs"
                                                    href="{{ route(getRolePrefix().'testimonial.delete', $val->id)}}"
                                                    onClick="if(confirm('Are you sure want to delete this data')){ return true;} else { return false; }"><i
                                                        class="fa fa-trash"></i>&nbsp;Delete</a>
                                                {{-- <a class="btn btn-success btn-xs" href="{{ route('blogs.preview',encrypt($val->id)) }}" target="_blank"><i class="fa fa-eye"></i></a> --}}
                                            </td>
                                        </tr>
                                        @php $key ++ @endphp
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
        $('.testimonialstatus').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let Id = $(this).data('id');
            console.log(Id);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route(getRolePrefix().'testimonial.status') }}',
                data: {
                    'status': status,
                    'testimonial_id': Id
                },
                success: function(data) {
                    toastr.success(data.message);
                }
            });
        });
    </script>
@endsection
