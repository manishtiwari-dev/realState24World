@extends('admin.layouts.app')
@section('content')
<div id="content" class="app-content">
<div class="d-flex align-items-center mb-3">
    <div>
        <h1 class="page-header mb-0">Blog Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Blog</li>
        </ol>
    </div>
    @can('blog-create')
        <div class="ms-auto">
            <a href="{{ route(getRolePrefix().'blog.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i> CREATE BLOG</a>
        </div>
    @endcan
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 mb-4">
            <div class="card-header h6 mb-0 bg-none p-3">
                <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Blog List
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
                        <th>Title</th>
                        <th> Slug</th>
                        @can('blog-status')
                        <th class="text-nowrap" width="1%">Status</th>
                        @endcan
                        <th class="text-nowrap" width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($blogs))
                        @foreach($blogs as $key => $blog)
                          <tr class="odd gradeX">
                            <?php $dash=''; ?>
                            <td class="fw-bold text-dark">{{ $key + 1 }}</td>
                            <td class="with-img">
                                @if(empty($blog->thumbnail))
                                    <img src="{{ asset('uploads/no-image.png') }}" class="rounded h-40px my-n1 mx-n1"/>
                                @else
                                    <img src="{{ asset('uploads/blog/'.$blog->thumbnail.'') }}" class="rounded h-40px w-100px my-n1 mx-n1"/>
                                @endif
                            </td>
                            <td><b>{{$blog->title}}</b></td>
                            <td>{{$blog->slug}}</td>
                           
                            @can('category-status')
                            <td>
                              <div class="form-check form-switch">
                                <input class="form-check-input statuscategory" data-id="{{ $blog->id }}"
                                    type="checkbox" {{ $blog->status == 1 ? 'checked' : '' }}>
                              </div>
                            </td>
                            @endcan
                            <td>
                                
                                @can('blog-edit')
                                    <a class="btn btn-primary btn-xs btn-circle me-1 mb-1" href="{{ route(getRolePrefix().'blog.update', ['id' => encode_string($blog->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('blog-delete')
                                    <a href="{{ route(getRolePrefix().'blog.delete', ['id' => encode_string($blog->id)]) }}" class="btn btn-danger btn-xs btn-circle me-1 mb-1" style="background-color: #9a1515;" onClick="if(confirm('Are you sure want to delete this category')){ return true;} else { return false; }"><i class="fa fa-trash"></i>&nbsp;Delete</a>
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
    $('.statuscategory').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let blog_id = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route(getRolePrefix().'blog.status') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'status': status,
                'blog_id': blog_id
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
