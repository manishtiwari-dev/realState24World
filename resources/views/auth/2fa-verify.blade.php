@extends('admin.layouts.guest')
@section('content')
<style>
    .back_btn{
        position: absolute;
        top:0;
        left:0;
    }
    .back_btn a{
        font-size: 20px;
        color: #b41e45;
    }
</style>
    <div class="container-md d-flex justify-content-center align-items-center min-vh-100">
        <div class="row shadow box-area">
            <div class="col-md-6 left-box position-relative">
                <div class="back_btn"><a href="{{ route(getRolePrefix().'2fa') }}"><i class="fa fa-chevron-circle-left"></i></a></div> 
                <div class="header-text mb-4">
                    <div class="pb-40px">
                        <img src="{{ asset('uploads/logo.png') }}" style="height: 50px;" alt="logo" class="auth-logo">
                    </div>
                    <div class="div">
                        <h2 style="margin-top: 20px;">Sign in</h2>
                        <p><b>We are happy to have you back.</b></p>
                    </div>
                </div>

                {{-- error --}}
                <div class="d-none" id="otp-error" style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 5px; text-align:center;"></div>
                {{-- error --}}
                <form method="POST" class="my-4" id="otpForm" action="{{ route(getRolePrefix().'2fa.verification') }}">
                    @csrf
                    <div class="mb-20px">
                        @if ($verification_type == '1')
                            <p class="fw-600">Enter the SMS OTP you received to -  
                                <span class="fw-700" style="color: #b41e45;"> {{ substr($sendtodevice, 0, 3) . '******' . substr($sendtodevice, -2) }} </span></p>
                        @else
                            <p class="fw-600">Enter the EMAIL OTP you received to -
                               <span class="fw-700" style="color: #b41e45;"> {{ substr($sendtodevice, 0, 5) . '*********' . substr($sendtodevice, -8) }} </span></p>
                        @endif
                    </div>

                    <div class="mb-20px">
                        <label class="mb-3">Your Current OTP is - <span class="text-primary fw-700">{{ $code }}</span></label>
                        <input type="text" class="form-control fs-13px h-40px code" id="code" name="code" maxlength="6" placeholder="******" required autocomplete="code" autofocus />
                    </div> 


                    <div class="fw-600">
                        <span class="resendotp" style="text-decoration: none; color: #b41e45;"> {{ __('RESEND OTP') }} </span>
                    </div>

                    <div class="form-group mb-0 row">
                        <div class="col-12">
                            <div class="d-grid mb-15px mt-3">
                                <button class="btn btn-login" id="verifyOtpBtn" type="button">{{ __('Verify OTP') }} </button>
                                <button class="btn btn-login d-none" id="loaderOtpBtn" type="button">{{ __('Verifying OTP...') }} </button>
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
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut
                            exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                    <div class="owl-slide">
                        <img src="{{ asset('assets/img/login-2.png') }}" style="width: 100%">
                        <h3>Heading - 2</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut
                            exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                    <div class="owl-slide">
                        <img src="{{ asset('assets/img/login-3.png') }}" style="width: 100%">
                        <h3>Heading - 3</h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta ab obcaecati labore minima aut
                            exercitationem et aperiam debitis earum. Molestiae.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
<script>
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $(document).ready(function() {
        $('#verifyOtpBtn').on('click', function(e) {
            e.preventDefault();
            var otpCode = $('#code').val();
            $('#loaderOtpBtn').removeClass('d-none'); 
            $('#verifyOtpBtn').addClass('d-none');
            $.ajax({
                url: "{{ route(getRolePrefix().'2fa.verification') }}",
                method: "POST",
                data: { code: otpCode },
                success: function(response) {
                    if (response.status === "success") {
                        window.location.href = "{{ route(getRolePrefix().'home') }}";
                    } else {
                        $('#otp-error').removeClass('d-none').text(response.message);
                    }
                },
                error: function(xhr) {
                    $('#otp-error').removeClass('d-none').text(xhr.responseJSON.message);
                },
                complete: function() {
                    $('#loaderOtpBtn').addClass('d-none'); 
                    $('#verifyOtpBtn').removeClass('d-none');
                }
            });
        });
        //Resend OTP
        $('.resendotp').on('click', function(e) {
            e.preventDefault();
            var verificationtype = '{{ $verification_type ?? '1' }}';
            var verifimethod = verificationtype === '1' ? 'phone' : 'email';
            $.ajax({
                url: "{{ route(getRolePrefix().'2fa.resend') }}",
                method: "POST",
                data: { verifimethod: verifimethod },
                success: function(response) {
                    if (response.status === "success") {
                        $('#otp-error').removeClass('d-none').text(response.message);
                    } else {
                        $('#otp-error').removeClass('d-none').text(response.message);
                    }
                },
                error: function(xhr) {
                    $('#otp-error').removeClass('d-none').text(xhr.responseJSON.message);
                },
                complete: function() {
                    $('#loaderOtpBtn').addClass('d-none'); 
                    $('#verifyOtpBtn').removeClass('d-none');
                }
            });
        });
    });
</script>
@endsection