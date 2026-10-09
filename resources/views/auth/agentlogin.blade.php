@extends('admin.layouts.guest')
@section('content')
    <div class="container-md d-flex justify-content-center align-items-center min-vh-100">
        <div class="row shadow box-area">
            <div class="col-md-6 left-box">
                <div class="header-text mb-4">
                    <div class="pb-40px">
                    <img src="{{ asset('uploads/logo.png') }}" style="height: 50px;" alt="logo" class="auth-logo">
                    </div>
                    <h2 style="margin-top: 20px;">Sign in</h2>
                    <p><b>We are happy to have you back.</b></p>
                </div>

                {{-- error --}}
                @if(Session::has('error'))
                    <div style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                        {{ Session::get('error') }}
                    </div>
                @endif
                {{-- error --}}
                {{-- @dd(session()->all()); --}}

                <form method="POST" class="my-4" action="{{ route('agent.login') }}">
                    @csrf
                    <div class="mb-20px">
                        <input id="email" type="text" name="email" class="form-control fs-13px h-40px @error('email') is-invalid  @enderror" placeholder="Email address or Username" value="{{ old('email') }}" />
                        @error('email')
                            <p class="invalid-feedback" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-20px">
                        <div class="input-group mb-3">
                            <input id="password" name="password" type="password" class="form-control fs-13px h-40px @error('password') is-invalid @enderror" placeholder="Password" />
                            <div class="input-group-text"><i class="fa fa-eye toggle-password" data-target="#password"></i></div>
                        </div>

                        @error('password')
                            <p class="invalid-feedback" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-check mb-10px">
                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }} />
                        <label class="form-check-label" for="rememberMe"> {{ __('Remember Me') }} </label>
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-12">
                            <div class="d-grid mb-15px mt-3">
                                <button class="btn btn-login" type="submit">{{ __('Login') }} <i class="fas fa-sign-in-alt ms-1"></i></button>
                            </div>
                            <hr class="bg-gray-600 opacity-2" />
                            <div class="text-gray-600 text-center mb-0">
                                © {{ date('Y') }}, <span style="color: #3170fc; font-weight: 700;">Home24world</span>. All Rights Reserved.
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6 right-box">
                <div id="owl-example" class="owl-carousel owl-theme">
                    <div class="owl-slide">
                        <img src="{{ asset('assets/img/login-1.png') }}" style="width: 100%">
                        <h3>Heading - 1</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                    <div class="owl-slide">
                        <img src="{{ asset('assets/img/login-2.png') }}" style="width: 100%">
                        <h3>Heading - 2</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                    <div class="owl-slide">
                        <img src="{{ asset('assets/img/login-3.png') }}" style="width: 100%">
                        <h3>Heading - 3</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
<script>
    $(document).ready(function () {
        $(".toggle-password").click(function () {
            let input = $($(this).data("target"));
            let type = input.attr("type") === "password" ? "text" : "password";
            input.attr("type", type);
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
</script>
@endsection