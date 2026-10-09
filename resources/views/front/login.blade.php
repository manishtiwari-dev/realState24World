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
                                    <h2>Login Form</h2><br>
                                </div>
                                <p>Create an Account to Avail the Best Real Estate Solutions</p>
                                <hr>
                              
                                <div class="custom-form" style="padding-top:20px">
                                    {{-- error --}}
                                    @if (Session::has('error'))
                                        <div
                                            style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                    @session('message')
                                        <div class="alert alert-success" role="alert"> 
                                            {{ $value }}
                                        </div>
                                    @endsession
                                    {{-- error --}}
                                    <form method="POST" action="{{ route('loginuser') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 py-3">
                                                <div class="radio-sec">
                                                    <label for="">Login</label>
                                                    <div class="rad1 fl-wrap">
                                                        <div class="add-list-media-header">
                                                            <label class="radio inline">
                                                                <input type="radio" name="is_role" value="3" checked>
                                                                <span>As Dealer</span>
                                                            </label>
                                                        </div>
                                                        <div class="add-list-media-header">
                                                            <label class="radio inline">
                                                                <input type="radio" name="is_role" value="0">
                                                                <span>As User</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Username or Email Address * <span class="dec-icon"><i
                                                            class="fal fa-user"></i></span></label>
                                                <input name="email" type="text" onclick="this.select()" value="">
                                                @error('email')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>Password * <span class="dec-icon"><i
                                                                class="fal fa-key"></i></span></label>
                                                    <input name="password" type="password" autocomplete="off"
                                                        onclick="this.select()" value="">
                                                    <span class="eye"><i class="fal fa-eye"></i> </span>
                                                </div>
                                                @error('password')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="lost_password">
                                                    <a href="{{ route('forget.password.get') }}">Lost Your Password?</a>
                                                </div>
                                                <div class="filter-tags">
                                                    <input id="check-a3" type="checkbox" name="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="check-a3">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="clearfix"></div>
                                                <button type="submit" class="log_btn color-bg"> LogIn </button>
                                                <div class="clearfix"></div>
                                                <p class="already-login">Not Register <a
                                                        href="{{ route('register') }}">Register</a></p>
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
