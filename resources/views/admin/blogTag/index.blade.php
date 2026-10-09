@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Blog Tag Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Blog Tag </li>
                </ol>
            </div>
            @can('category-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'blog_tag.create') }}" class="btn btn-primary px-4"><i
                            class="fa fa-plus fa-lg ms-n2 "></i> CREATE NEW</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Blog Tag List
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
                                    <th>Name</th>
                                    <th class="text-nowrap" width="1%">Status</th>
                                    <th class="text-nowrap" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($blogs))
                                    @foreach ($blogs as $key => $val)
                                        <tr class="odd gradeX">
                                            <?php $dash = ''; ?>
                                            <td class="fw-bold text-dark">{{ $key + 1 }}</td>
                                           
                                            <td>{{ $val->name }}</td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input faqstatus" data-id="{{ $val->id }}"
                                                        type="checkbox" {{ $val->status == 1 ? 'checked' : '' }}>
                                                </div>
                                            </td>

                                            <td>

                                                @can('blog-tag-edit')
                                                    <a class="btn btn-primary btn-xs btn-circle me-1 mb-1"
                                                        href="{{ route(getRolePrefix().'blog_tag.update', ['id' => encode_string($val->id)]) }}"><i
                                                            class="fa fa-edit"></i> Edit</a>
                                                @endcan
                                                @can('blog-tag-delete')
                                                    <a href="{{ route(getRolePrefix().'blog_tag.delete', $val->id) }}"
                                                        class="btn btn-danger btn-xs btn-circle me-1 mb-1"
                                                        style="background-color: #9a1515;"
                                                        onClick="if(confirm('Are you sure want to delete this blog tag')){ return true;} else { return false; }"><i
                                                            class="fa fa-trash"></i>&nbsp;Delete</a>
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
        $('.faqstatus').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let Id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route(getRolePrefix().'blog_tag.status') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'blog_id': Id
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
