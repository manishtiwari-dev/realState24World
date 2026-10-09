@extends('admin.layouts.app')
@section('content')
<div id="content" class="app-content app-bg">
    <div class="d-flex align-items-center mb-3">
        <div>
            <h1 class="page-header mb-0">Permissions</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Permissions</li>
            </ol>
        </div>
        @can('permission-list')
        <div class="ms-auto">
            <a href="{{ route(getRolePrefix().'permissions.index') }}" class="btn btn-primary px-4"><i class="fa fa-list fa-lg ms-n2 "></i> &nbsp; Permissions List</a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0">
                <div class="card-header h6 mb-0 bg-none p-3">
                    <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Create permission
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show rounded-0">
                        <strong> Opps! </strong> Something went wrong, please check below errors.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                    </div>
                @endif
                    <form action="{{ route(getRolePrefix().'permissions.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="col-md-2 mb-2"><strong>Module:</strong></label>
                                <select class="form-select default-select" name="module">
                                    <option value="" selected disabled>Select Module</option>
                                    @foreach ($modulelist as $module)
                                        <option value="{{ $module->id}}">{{ $module->module }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 mb-2"><strong>Permission File Name:</strong></label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer bg-grey d-flex p-3">
                            <button type="submit" class="btn btn-primary rounded-0"><i class="fas fa-check"></i>  CLICK TO CREATE PERMISSION</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('custom-javascript')
    <script>
        $(".default-select").select2({
            minimumResultsForSearch: Infinity
        });
    </script>
@endsection