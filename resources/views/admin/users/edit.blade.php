@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Update Admin User</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Admin Users</li>
                </ol>
            </div>
            @can('user-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'users.index') }}" class="btn btn-primary px-4"><i class="fa fa-list fa-lg ms-n2 "></i>
                        &nbsp; ADMIN USER'S LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Update Admin user
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

                    <form method="POST" action="{{ route(getRolePrefix().'users.update', $user->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" placeholder="Enter Phone No" class="form-control" value="{{ $user->phone }}">
                                    </div>
                                </div>
    
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="roles">Role Type<span class="text-danger">*</span></label>
                                        <select name="roles[]" id="roles" class="multiple-select form-control" multiple="multiple">
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ isset($userRole[$value]) ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="theme">Theme<span class="text-danger">*</span></label>
                                        <select name="is_theme" class="default-select form-control">
                                            <option value="theme-default" {{ $user->is_theme == 'theme-default' ? 'selected' : '' }}> Default </option>
                                            <option value="theme-black" {{ $user->is_theme == 'theme-black' ? 'selected' : '' }}> Black </option>
                                            <option value="theme-blue" {{ $user->is_theme == 'theme-blue' ? 'selected' : '' }}> Blue </option>
                                            <option value="theme-cyan" {{ $user->is_theme == 'theme-cyan' ? 'selected' : '' }}> Cyan </option>
                                            <option value="theme-dark" {{ $user->is_theme == 'theme-dark' ? 'selected' : '' }}> Dark </option>
                                            <option value="theme-danger" {{ $user->is_theme == 'theme-danger' ? 'selected' : '' }}> Danger </option>
                                            <option value="theme-green" {{ $user->is_theme == 'theme-green' ? 'selected' : '' }}> Green </option>
                                            <option value="theme-gray" {{ $user->is_theme == 'theme-gray' ? 'selected' : '' }}> Gray </option>
                                            <option value="theme-gray-dark" {{ $user->is_theme == 'theme-gray-dark' ? 'selected' : '' }}> Gray Dark </option>
                                            <option value="theme-info" {{ $user->is_theme == 'theme-info' ? 'selected' : '' }}> Info </option>
                                            <option value="theme-inverse" {{ $user->is_theme == 'theme-inverse' ? 'selected' : '' }}> Inverse </option>
                                            <option value="theme-indigo" {{ $user->is_theme == 'theme-indigo' ? 'selected' : '' }}> Indigo </option>
                                            <option value="theme-lime" {{ $user->is_theme == 'theme-lime' ? 'selected' : '' }}> Lime </option>
                                            <option value="theme-light" {{ $user->is_theme == 'theme-light' ? 'selected' : '' }}> Light </option>
                                            <option value="theme-muted" {{ $user->is_theme == 'theme-muted' ? 'selected' : '' }}> Muted </option>
                                            <option value="theme-orange" {{ $user->is_theme == 'theme-orange' ? 'selected' : '' }}> Orange </option>
                                            <option value="theme-pink" {{ $user->is_theme == 'theme-pink' ? 'selected' : '' }}> Pink </option>
                                            <option value="theme-purple" {{ $user->is_theme == 'theme-purple' ? 'selected' : '' }}> Purple </option>
                                            <option value="theme-primary" {{ $user->is_theme == 'theme-primary' ? 'selected' : '' }}> Primary </option>
                                            <option value="theme-red" {{ $user->is_theme == 'theme-red' ? 'selected' : '' }}> Red </option>
                                            <option value="theme-success" {{ $user->is_theme == 'theme-success' ? 'selected' : '' }}> Success </option>
                                            <option value="theme-teal" {{ $user->is_theme == 'theme-teal' ? 'selected' : '' }}> Teal </option>
                                            <option value="theme-white" {{ $user->is_theme == 'theme-white' ? 'selected' : '' }}> White </option>
                                            <option value="theme-warning" {{ $user->is_theme == 'theme-warning' ? 'selected' : '' }}> Warning </option>
                                            <option value="theme-yellow" {{ $user->is_theme == 'theme-yellow' ? 'selected' : '' }}> Yellow </option>
                                        </select>
                                    </div>
                                </div>
    
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="status">User Status<span class="text-danger">*</span></label>
                                        <select class="default-select form-control" name="is_status" id="status">
                                                <option value="">Select User Status</option>
                                                <option value="1" {{ $user->is_status == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $user->is_status == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" autocomplete="new-password">
                                            <div class="input-group-text"><i class="fa fa-eye toggle-password" data-target="#password"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="confirm">Confirm Password </label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="confirm-password" id="confirmpassword" placeholder="Confirm Password" class="form-control" autocomplete="new-confirm-password">
                                            <div class="input-group-text"><i class="fa fa-eye toggle-password" data-target="#confirmpassword"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="card-footer bg-none d-flex p-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> CLICK TO UPDATE USER </button>
                            <a href="{{ route(getRolePrefix().'users.index') }}" class="btn btn-danger ms-2">CANCEL</a>
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
        $(".multiple-select").select2({
            placeholder: "Select Role"
        });
        //SHOW PASSWORD HIDE SHOW
        $(document).ready(function () {
            $(".toggle-password").click(function () {
                let input = $($(this).data("target"));
                let type = input.attr("type") === "password" ? "text" : "password";
                input.attr("type", type);
                
                // Toggle eye icon class
                $(this).toggleClass("fa-eye fa-eye-slash");
            });
        });
    </script>
@endsection
