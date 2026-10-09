@extends('admin.layouts.app')
@section('content')
<div id="content" class="app-content">
<div class="d-flex align-items-center mb-3">
    <div>
        <h1 class="page-header mb-0">Category Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
            <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Category</li>
        </ol>
    </div>
    @can('category-create')
        <div class="ms-auto">
            <a href="{{ route(getRolePrefix().'category.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i> CREATE CATEGORY</a>
        </div>
    @endcan
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 mb-4">
            <div class="card-header h6 mb-0 bg-none p-3">
                <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> CATEGORY LIST
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
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Parent Category</th>
                        @can('category-status')
                        <th class="text-nowrap" width="1%">Status</th>
                        @endcan
                        <th class="text-nowrap" width="20%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($categories))
                        @foreach($categories as $key => $category)
                          <tr class="odd gradeX">
                            <?php $dash=''; ?>
                            <td class="fw-bold text-dark">{{ ++$i }}</td>
                            <td class="with-img">
                                @if(empty($category->thumbnail))
                                    <img src="{{ asset('uploads/no-image.png') }}" class="rounded h-40px my-n1 mx-n1"/>
                                @else
                                    <img src="{{ asset('uploads/category/'.$category->thumbnail.'') }}" class="rounded h-40px w-100px my-n1 mx-n1"/>
                                @endif
                            </td>
                            <td><b>{{$category->name}}</b></td>
                            <td>{{$category->slug}}</td>
                            <td>
                                @if(isset($category->parent_id))
                                    {{$category->subcategory->name}}
                                @else
                                    None
                                @endif
                            </td>
                            @can('category-status')
                            <td>
                              <div class="form-check form-switch">
                                <input class="form-check-input statuscategory" data-id="{{ $category->id }}"
                                    type="checkbox" {{ $category->status == 1 ? 'checked' : '' }}>
                              </div>
                            </td>
                            @endcan
                            <td>
                                <a class="btn btn-info btn-xs me-1 mb-1" href="#"><i
                                    class="fa-solid fa-list"></i> Show</a>
                                @can('category-edit')
                                    <a class="btn btn-primary btn-xs btn-circle me-1 mb-1" href="{{ route(getRolePrefix().'category.edit', ['id' => encode_string($category->id)]) }}"><i class="fa fa-edit"></i> Edit</a>
                                @endcan
                                @can('category-delete')
                                    <a href="{{ route(getRolePrefix().'category.delete', ['id' => encode_string($category->id)]) }}" class="btn btn-danger btn-xs btn-circle me-1 mb-1" style="background-color: #9a1515;" onClick="if(confirm('Are you sure want to delete this category')){ return true;} else { return false; }"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                @endcan
                            </td>
                          </tr>
                          @if(count($category->subcategory))
                              @include('admin.category.sub-category-list',['subcategories' => $category->subcategory, 'parentKey' => $key+1])
                          @endif
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
        let categoryId = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route(getRolePrefix().'category.status') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'status': status,
                'category_id': categoryId
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
