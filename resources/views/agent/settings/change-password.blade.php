@extends('agent.layouts.app')
@section('content')
    <div id="content" class="app-content p-0">
        {{-- Heading --}}
        @include('agent.settings.topbar')
        {{-- Heading --}}
        {{-- Body Here --}}
        <div class="container">
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="card border-0 mb-4">
                        <form method="POST" action="{{ route(getRolePrefix().'settings.password') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header h6 mb-0 bg-none p-3">
                                <i class="fa fa-unlock-alt fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                {{ __('Change Password') }}
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert" class="text-danger">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row  mb-3">
                                    <label class="form-label col-form-label col-md-2" for="oldpassword">Old Password </label>
                                    <div class="col-md-10">
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control mb-5px @error('old_password') is-invalid @enderror" name="old_password" id="oldpassword"
                                            placeholder="Old Password" value="{{ old('old_password') }}"/>
                                            <div class="input-group-text mb-5px "><i class="fa fa-eye toggle-password" data-target="#oldpassword"></i></div>
                                        </div>
                                        @error('old_password')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-2" for="newpassword">New Password</label>
                                    <div class="col-md-10">
                                        <div class="input-group mb-3">
                                        <input type="password" class="form-control mb-5px @error('new_password') is-invalid @enderror" name="new_password" id="newpassword"
                                        placeholder="New Password"/>
                                        <div class="input-group-text mb-5px "><i class="fa fa-eye toggle-password" data-target="#newpassword"></i></div>
                                        </div>
                                        @error('new_password')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-2" for="confirmNewPassword">Confirm New Password</label>
                                    <div class="col-md-10">
                                        <div class="input-group mb-3">
                                        <input type="password" class="form-control mb-5px @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="confirmNewPassword"
                                        placeholder="Confirm New Password"/>
                                        <div class="input-group-text mb-5px "><i class="fa fa-eye toggle-password" data-target="#confirmNewPassword"></i></div>
                                        </div>
                                        @error('new_password_confirmation')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-danger px-4"><i
                                    class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Reset</button>
                                <button type="submit" name="btnsubmit" value="update" class="btn btn-primary px-4"> &nbsp; {{ __('Change Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        {{-- Body Here --}}
    </div>
@endsection
@section('custom-javascript')
    <script>
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