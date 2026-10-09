@extends('front.layouts.app')

@section('content')
<!-- wrapper  -->
<div id="wrapper">
            <!-- content -->
            <div class="content">                
                <section class="gray-bg">
                    <div class="container">
                        
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="dasboard-widget-box fl-wrap">
                                    <div class="register-title fl-wrap">
                                        <h2 style="float:none">Mobile Verification</h2><br>                                    
                                    </div>
                                    <hr>
                                    <p style="text-align:center;margin-top:20px">4 digit code has been sent to your registered number 6377446542</p>
                                    
                                    <div class="custom-form" style="margin-top:20px">
                                        <form action="">
                                            <div class="row">                                               
                                                <div class="col-md-12">
                                                    <div class="otp-container">
                                                        <input type="text" name="code" maxlength="1" class="otp-input" />
                                                        <input type="text" maxlength="1" class="otp-input" />
                                                        <input type="text" maxlength="1" class="otp-input" />
                                                        <input type="text" maxlength="1" class="otp-input" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div style="display: flex;justify-content: center;">
                                                        <button type="submit" class="btn color-bg">Confirm</button>
                                                    </div>
                                                </div>  
                                                
                                                <div class="col-md-12">
                                                    <p style="text-align:center;margin-top:20px">Did not recevie OTP? Request Again</p>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="resend-otp-box">                                                            
                                                            <a href="#" class="btn color-bg small-btn">Resend OTP</a>
                                                            <a href="#" class="btn color-bg small-btn"><i class="fal fa-phone-alt"></i> Call To OTP</a>
                                                    </div>
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
            <!-- content end -->

@endsection