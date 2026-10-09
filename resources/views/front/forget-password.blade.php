@extends('front.layouts.app')
@section('titlename', 'Login')
@section('content')
    <div id="wrapper">
        <div class="content">
            <section class="gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="dasboard-widget-box fl-wrap">
                                <div class="register-title fl-wrap">
                                    <h2>Reset Password</h2>
                                </div>
                                <hr>
                                <div class="custom-form" style="padding-top:20px">
                                    
                                    <form method="POST" action="{{ route('forget.password.post') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>{{ __('Register Email Address') }}</label>
                                                <input name="email" id="email" type="text" class="@error('email') is-invalid @enderror" placeholder="Enter Your Registered Email Address" required style="padding: 15px 20px 15px 15px;">
                                                @error('email')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                {{-- error --}}
                                                @if (Session::has('message'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('message') }}
                                                    </div>
                                                @endif

                                                @error('email')
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                                {{-- error --}}
                                                <div class="clearfix"></div>
                                                <button type="submit" class="log_btn color-bg"> {{ __('Send Password Reset Link') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
