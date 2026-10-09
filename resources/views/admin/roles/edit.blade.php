@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content app-bg">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Edit Role</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Edit Role</li>
                </ol>
            </div>
            @can('role-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'roles.index') }}" class="btn btn-primary px-4"><i class="fa fa-list fa-lg ms-n2 "></i>
                        &nbsp; ROLE LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3" style="border-bottom: 1px solid #2196f3;">
                        <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Update Role
                        Permission
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

                    <form method="POST" action="{{ route(getRolePrefix().'roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-md-2 fw-bold"><strong>Role Name:</strong></label>
                                <div class="col-md-10">
                                    <input type="text" name="name" placeholder="Enter Role Name" class="form-control" value="{{ $role->name }}">
                                </div>
                            </div>
                            
                            <div class="row">
                                <label class="col-md-2 mb-3"><strong>Role Has Permission:</strong></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 25%;">Module</th>
                                                <th>Permissions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $permissions = $permission->groupBy('module_id'); @endphp
                                        @foreach ($permissions as $key => $allvalue)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="form-check">
                                                        <label class="form-check-label fw-bold">
                                                            <input type="checkbox" name="module" class="form-check-input selectall" onclick="toggleModulePermissions(this)"> {{ $allvalue->first()->modulename }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @foreach ($allvalue as $index => $value)
                                                            <div class="col-md-3 mb-2">
                                                                <div class="form-check">
                                                                    <label>
                                                                        <input type="checkbox" name="permission[{{ $value->id }}]" value="{{ $value->id }}" class="form-check-input permission-checkbox" data-module="{{ $key }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}> {{ ucwords(str_replace('-', ' ', $value->name)) }} 
                                                                    </label>
                                                                </div>
                                                            </div>    
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        <div class="card-footer bg-grey d-flex p-3">
                            <button type="submit" class="btn btn-primary rounded-0"><i class="fas fa-check"></i> CLICK TO CREATE ROLE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
<script>
    function toggleModulePermissions(checkbox) {
        let row = checkbox.closest('tr');
        let checkboxes = row.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(chk => chk.checked = checkbox.checked);
    }
</script>
@endsection
