@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content p-0">
        {{-- Heading --}}
        @include('admin.settings.topbar')
        {{-- Heading --}}
        <div class="container">
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="card border-0 mb-4">
                        <form method="POST" action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header h6 mb-0 bg-none p-3">
                                <i class="fa fa-user fa-lg fa-fw text-dark text-opacity-50 me-1"></i> {{ __('Profile') }}
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row  mb-3">
                                    <label class="form-label col-form-label col-md-2">Profile Name </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-5px @error('name') is-invalid @enderror" placeholder="Enter email" placeholder="Enter Name" id="name" name="name" value="{{ auth()->user()->name }}" autofocus="" />
                                        @error('name')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row  mb-3">
                                    <label class="form-label col-form-label col-md-2">Email Address</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-5px @error('email') is-invalid @enderror" placeholder="Enter Email" id="email" name="email" value="{{ auth()->user()->email }}" autofocus="" />
                                        <small class="form-text text-muted"><b> Note: </b> Email Address Should be Valid and
                                            Required for login purpose</small>
                                        @error('email')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row  mb-3">
                                    <label class="form-label col-form-label col-md-2">Phone Number </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-5px @error('phone') is-invalid @enderror" placeholder="Enter Phone" id="phone" name="phone" value="{{ auth()->user()->phone }}" autofocus="" />
                                        @error('phone')
                                            <span role="alert" class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row  mb-3">
                                    <label class="form-label col-form-label col-md-2">Select Theme Color</label>
                                    <div class="col-md-10">
                                        <select name="is_theme" class="default-select form-control">
                                            <option value="theme-default"
                                                {{ auth()->user()->is_theme == 'theme-default' ? 'selected' : '' }}> Default
                                            </option>
                                            <option value="theme-black"
                                                {{ auth()->user()->is_theme == 'theme-black' ? 'selected' : '' }}> Black
                                            </option>
                                            <option value="theme-blue"
                                                {{ auth()->user()->is_theme == 'theme-blue' ? 'selected' : '' }}> Blue
                                            </option>
                                            <option value="theme-cyan"
                                                {{ auth()->user()->is_theme == 'theme-cyan' ? 'selected' : '' }}> Cyan
                                            </option>
                                            <option value="theme-dark"
                                                {{ auth()->user()->is_theme == 'theme-dark' ? 'selected' : '' }}> Dark
                                            </option>
                                            <option value="theme-danger"
                                                {{ auth()->user()->is_theme == 'theme-danger' ? 'selected' : '' }}> Danger
                                            </option>
                                            <option value="theme-green"
                                                {{ auth()->user()->is_theme == 'theme-green' ? 'selected' : '' }}> Green
                                            </option>
                                            <option value="theme-gray"
                                                {{ auth()->user()->is_theme == 'theme-gray' ? 'selected' : '' }}> Gray
                                            </option>
                                            <option value="theme-gray-dark"
                                                {{ auth()->user()->is_theme == 'theme-gray-dark' ? 'selected' : '' }}> Gray
                                                Dark </option>
                                            <option value="theme-info"
                                                {{ auth()->user()->is_theme == 'theme-info' ? 'selected' : '' }}> Info
                                            </option>
                                            <option value="theme-inverse"
                                                {{ auth()->user()->is_theme == 'theme-inverse' ? 'selected' : '' }}>
                                                Inverse </option>
                                            <option value="theme-indigo"
                                                {{ auth()->user()->is_theme == 'theme-indigo' ? 'selected' : '' }}> Indigo
                                            </option>
                                            <option value="theme-lime"
                                                {{ auth()->user()->is_theme == 'theme-lime' ? 'selected' : '' }}> Lime
                                            </option>
                                            <option value="theme-light"
                                                {{ auth()->user()->is_theme == 'theme-light' ? 'selected' : '' }}> Light
                                            </option>
                                            <option value="theme-muted"
                                                {{ auth()->user()->is_theme == 'theme-muted' ? 'selected' : '' }}> Muted
                                            </option>
                                            <option value="theme-orange"
                                                {{ auth()->user()->is_theme == 'theme-orange' ? 'selected' : '' }}> Orange
                                            </option>
                                            <option value="theme-pink"
                                                {{ auth()->user()->is_theme == 'theme-pink' ? 'selected' : '' }}> Pink
                                            </option>
                                            <option value="theme-purple"
                                                {{ auth()->user()->is_theme == 'theme-purple' ? 'selected' : '' }}> Purple
                                            </option>
                                            <option value="theme-primary"
                                                {{ auth()->user()->is_theme == 'theme-primary' ? 'selected' : '' }}>
                                                Primary </option>
                                            <option value="theme-red"
                                                {{ auth()->user()->is_theme == 'theme-red' ? 'selected' : '' }}> Red
                                            </option>
                                            <option value="theme-success"
                                                {{ auth()->user()->is_theme == 'theme-success' ? 'selected' : '' }}>
                                                Success </option>
                                            <option value="theme-teal"
                                                {{ auth()->user()->is_theme == 'theme-teal' ? 'selected' : '' }}> Teal
                                            </option>
                                            <option value="theme-white"
                                                {{ auth()->user()->is_theme == 'theme-white' ? 'selected' : '' }}> White
                                            </option>
                                            <option value="theme-warning"
                                                {{ auth()->user()->is_theme == 'theme-warning' ? 'selected' : '' }}>
                                                Warning </option>
                                            <option value="theme-yellow"
                                                {{ auth()->user()->is_theme == 'theme-yellow' ? 'selected' : '' }}> Yellow
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-danger px-4"><i class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Reset</button>
                                <button type="submit" name="btnsubmit" value="update" class="btn btn-primary px-4"> &nbsp; {{ __('Upload Profile') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(".default-select").select2();
    </script>
@endsection
