@extends('admin.layouts.app')
@section('title', 'Manage User')
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Permissions</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Permissions</li>
                </ol>
            </div>
            @can('permission-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'permissions.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i> CREATE NEW PERMISSION FILE</a>
                </div>
            @endcan
        </div>
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading bg-theme-based">
            <h4 class="panel-title" style="text-transform: capitalize;">PERMISSION FILE LIST</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <!-- END panel-heading -->
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-0">
                <strong> Success! </strong> {{ \Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
            </div>
        @endif
        <!-- BEGIN panel-body -->
        <div class="panel-body">
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th width="120px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $permission)
                        <tr>
                            <td width="1%">{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @can('permissions-edit')
                                    <a class="btn btn-primary btn-xs"  href="{{ route(getRolePrefix().'permissions.edit', $permission->id) }}"><i class="fa-solid fa-pen-to-square"></i>  Edit</a>
                                @endcan
                                @can('permissions-delete')
                                <form action="{{ route(getRolePrefix().'permissions.destroy', $permission->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa-solid fa-trash"></i> Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END panel-body -->
    </div>
    <!-- END panel -->
</div>
<!-- END #content -->
@endsection