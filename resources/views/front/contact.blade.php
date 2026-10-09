@extends('front.layouts.app')
@section('titlename', 'Contact Us')
@section('content')
    <div id="wrapper">
        <div class="content">
            <!--  section  -->
            <section class="hidden-section single-par2  " data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem " data-bg="images/bg/3.jpg" data-scrollax="properties: { translateY: '30%' }">
                    </div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Contact Us</span></h2>
                    </div>
                </div>
            </section>
            <!--  section  end-->
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ route('index') }}">Home</a> <span>Contact</span>
                    </div>

                </div>
            </div>
            <!-- breadcrumbs end -->

            <!-- section -->
            <section class="gray-bg small-padding">
                <div class="container">
                    <div class="row">
                        <!-- services-item -->
                        <div class="col-md-4">
                            <div class="services-item fl-wrap">
                                <i class="fal fa-envelope"></i>
                                <h4>Our Mails <span>01</span></h4>

                                <a href="mailto:manishtiwari8601@gmail.com" class="serv-link sl-b">
                                    support@realState24world.com</a>
                            </div>
                        </div>
                        <!-- services-item  end-->
                        <!-- services-item -->
                        <div class="col-md-4">
                            <div class="services-item fl-wrap">
                                <i class="fal fa-phone-rotary"></i>
                                <h4>Our Phones<span>02</span></h4>

                                <a href="tel:+91-8601607526" class="serv-link sl-b">+91 -8601607526</a>
                            </div>
                        </div>
                        <!-- services-item  end-->
                        <!-- services-item -->
                        <div class="col-md-4">
                            <div class="services-item fl-wrap">
                                <i class="fal fa-map-marked"></i>
                                <h4>Our Adress <span>03</span></h4>
                                <a href="#" class="serv-link sl-b">1st Floor, Shee Ram Complex, Hayatpur Chowk Sector
                                    93, Gurugram, Haryana 122505</a>
                            </div>
                        </div>
                        <!-- services-item  end-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="contacts-opt fl-wrap">
                        <a href="#" class="btn small-btn color-bg">Help Center</a>
                    </div>
                    <!--box-widget  -->
                    <div class="box-widget">
                        <div class="box-widget-title single_bwt fl-wrap">Get In Touch</div>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla
                            finibus lobortis pulvinar. Donec a consectetur nulla.</p> --}}
                        <!--box-widget end-->
                        <div class="contact-form-main fl-wrap">

                            {{-- <div id="contact-form" class="contact-form fl-wrap"> --}}
                                <div id="message"></div>
                                <form class="custom-form" action="{{ route('contact_store') }}" method="POST" id="contactUSForm">
                                     @csrf
                                    <fieldset>
                                        <label>Your name* <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                        <input type="text" name="name" id="name" placeholder="Your Name *"
                                            value="" />
                                              @error('name')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                        <label>Your mail* <span class="dec-icon"><i
                                                    class="fas fa-envelope"></i></span></label>
                                        <input type="text" name="email" id="email" placeholder="Email Address*"
                                            value="" />
                                              @error('email')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                        <label>Message </label>
                                        <textarea name="message" id="comments" cols="40" rows="3" placeholder="Your Message:"></textarea>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </fieldset>
                                    <div class="form-group text-center">
                                        <button class="btn float-btn color-bg" style="margin-top:15px;">Send
                                        Message</button>
                                    </div>
                                </form>
                            {{-- </div> --}}
                            <!-- contact form  end-->
                        </div>
                    </div>

                </div>
            </section>
            <!-- section end-->
        </div>
    </div>
@endsection
@section('custom-javascript')
<script type="text/javascript">
    $('#contactUSForm').submit(function(event) {
        event.preventDefault();
    
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}", {action: 'subscribe_newsletter'}).then(function(token) {
                $('#contactUSForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $('#contactUSForm').unbind('submit').submit();
            });;
        });
    });
</script>
@endsection
