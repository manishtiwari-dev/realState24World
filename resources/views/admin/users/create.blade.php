@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Create Admin User</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Admin User</li>
                </ol>
            </div>
            @can('user-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'users.index') }}" class="btn btn-primary px-4"><i class="fa fa-list fa-lg ms-n2 "></i>
                        &nbsp;ADMIN USER'S LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Create Admin user
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

                    <form method="POST" action="{{ route(getRolePrefix().'users.store') }}" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Enter Name"
                                            class="form-control" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" placeholder="Enter Email"
                                            class="form-control" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" placeholder="Enter Phone No"
                                            class="form-control" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="status">Role Type<span
                                                class="text-danger">*</span></label>
                                        <select name="roles[]" class="multiple-select form-control" multiple="multiple">
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}"> {{ $label }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="theme">Theme<span class="text-danger">*</span></label>
                                        <select name="is_theme" class="default-select form-control">
                                            <option value="theme-default" selected> Default </option>
                                            <option value="theme-black"> Black </option>
                                            <option value="theme-blue"> Blue </option>
                                            <option value="theme-cyan"> Cyan </option>
                                            <option value="theme-dark"> Dark </option>
                                            <option value="theme-danger"> Danger </option>
                                            <option value="theme-green"> Green </option>
                                            <option value="theme-gray"> Gray </option>
                                            <option value="theme-gray-dark"> Gray Dark </option>
                                            <option value="theme-info"> Info </option>
                                            <option value="theme-inverse"> Inverse </option>
                                            <option value="theme-indigo"> Indigo </option>
                                            <option value="theme-lime"> Lime </option>
                                            <option value="theme-light"> Light </option>
                                            <option value="theme-muted"> Muted </option>
                                            <option value="theme-orange"> Orange </option>
                                            <option value="theme-pink"> Pink </option>
                                            <option value="theme-purple"> Purple </option>
                                            <option value="theme-primary"> Primary </option>
                                            <option value="theme-red"> Red </option>
                                            <option value="theme-success"> Success </option>
                                            <option value="theme-teal"> Teal </option>
                                            <option value="theme-white"> White </option>
                                            <option value="theme-warning"> Warning </option>
                                            <option value="theme-yellow"> Yellow </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="status">User Status<span
                                                class="text-danger">*</span></label>
                                        <select name="is_status" class="default-select form-control">
                                            <option value="1" selected> Active </option>
                                            <option value="0"> Inactive </option>
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
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> CLICK TO CREATE
                                USER </button>
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
