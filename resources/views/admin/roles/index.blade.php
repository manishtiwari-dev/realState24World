@extends('admin.layouts.app')
@section('title', 'Manage Roles')
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <div class="d-flex align-items-center mb-3">
        <div>
            <h1 class="page-header mb-0">Roles</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Roles</li>
            </ol>
        </div>
        @can('role-create')
            <div class="ms-auto">
                <a href="{{ route(getRolePrefix().'roles.create') }}" class="btn btn-primary px-4"><i class="fa fa-plus fa-lg ms-n2 "></i>
                    CREATE NEW ROLES</a>
            </div>
        @endcan
    </div>
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading bg-theme-based">
            <h4 class="panel-title" style="text-transform: capitalize;">ROLE LIST</h4>
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
                        <th width="1%"></th>
                        <th class="text-nowrap">Role Name</th>
                        <th class="text-nowrap" width="20%">Created At</th>
                        <th class="text-nowrap" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr class="odd gradeX">
                            <td width="1%" class="fw-bold">{{ ++$i }}</td>
                            <td><span class="fw-600">{{ $role->name }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y h:i A') }}</td>
                            <td>
                                <a class="btn btn-green btn-xs" href="{{ route(getRolePrefix().'roles.show', $role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                @if ($role->name != 'Superadmin')
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-xs" href="{{ route(getRolePrefix().'roles.edit', $role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endcan

                                    @can('role-delete')
                                        <form method="POST" action="{{ route(getRolePrefix().'roles.destroy', $role->id) }}"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection