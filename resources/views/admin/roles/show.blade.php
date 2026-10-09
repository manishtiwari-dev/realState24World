@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content app-bg">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Roles</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Roles</li>
                </ol>
            </div>
            @can('role-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'roles.index') }}" class="btn btn-primary px-4"><i class="fa fa-list fa-lg ms-n2 "></i>
                        &nbsp; Role List</a>
                </div>
            @endcan
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Role Detail
                    </div>
                    @if (\Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0">
                            <strong> Opps! </strong> {{ \Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-2"><strong>Name:</strong></label>
                            <div class="col-md-10">
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-2"><strong>Permissions:</strong></label>
                            <div class="col-md-10">
                                @if (!empty($rolePermissions))
                                    <div class="d-flex flex-wrap">
                                        @foreach ($rolePermissions as $v)
                                            <div class="mb-3px">
                                                <span class="badge bg-success me-1 mb-1"> {{ $v->name }},</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
