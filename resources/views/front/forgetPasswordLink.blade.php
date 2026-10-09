@extends('front.layouts.app')
@section('titlename', 'Reset Password')
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
                                    <h2>Reset Password</h2><br>
                                </div>
                                <hr>
                                <div class="custom-form" style="padding-top:20px">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                    {{-- error --}}
                                    <form method="POST" action="{{ route('reset.password.post') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>{{ __('Password') }}</label>
                                                    <input type="password" autocomplete="off" class="@error('password') is-invalid @enderror" name="password" id="password" required style="padding: 15px 20px 15px 15px;">
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>{{ __('Confirm Password') }}</label>
                                                    <input type="password" autocomplete="off" class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" required style="padding: 15px 20px 15px 15px;">
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="clearfix"></div>
                                                <button type="submit" class="log_btn color-bg"> {{ __('Reset Password') }} </button>
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
