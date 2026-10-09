<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'realState24world') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/owlcarousel/owl.theme.default.min.css') }}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
</head>
<body id="body" class="auth-page login-bg">
    <div class="container-md d-flex justify-content-center align-items-center min-vh-100">
        <div class="row shadow box-area">
            <div class="col-md-6 left-box">
                <div class="header-text mb-4">
                    <div class="pb-40px">
                    <img src="{{ asset('uploads/logo.png') }}" style="height: 50px;" alt="logo" class="auth-logo">
                    </div>
                    <h2 style="margin-top: 20px;">Verify Account</h2>
                    <p><b>Select OTP Verification Method</b></p>
                </div>

                {{-- error --}}
                @if(Session::has('error'))
                    <div style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                        {{ Session::get('error') }}
                    </div>
                @endif
                {{-- error --}}
                
                <form method="POST" class="my-4" action="{{ route(getRolePrefix() . 'verify.2fa') }}">
                    @csrf
                    <div class="form-group mb-0 row">
                        <div class="col-12">
                            <div class="d-grid mb-15px mt-3">
                                <button class="btn btn-default" type="submit" name="method" value="phone">Login With Mobile OTP - {{ substr($user->phone, 0, 3) . '******' . substr($user->phone, -2) }}</button>
                            </div>

                            <div class="d-grid mb-15px mt-3">
                                <button class="btn btn-blue" type="submit" name="method" value="email">Login With Mail OTP - {{ substr($user->email, 0, 5) . '*********' . substr($user->email, -8) }}</button>
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
</body>
<script>
    $(document).ready(function() {
        $("#owl-example").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            dots: true,
            animateIn: "fadeIn",
            animateOut: "fadeOut"
        });
    });
</script>

</html>
