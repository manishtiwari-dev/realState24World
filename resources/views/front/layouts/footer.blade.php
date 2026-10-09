    <!-- subscribe-wrap -->
    {{-- <div class="subscribe-wrap fl-wrap">
        <div class="container">
            <div class="subscribe-container fl-wrap color-bg">
                <div class="pwh_bg"></div>
                <div class="mrb_dec mrb_dec3"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="subscribe-header">
                            <h4>newsletter</h4>
                            <h3>Sign up for newsletter and get latest news and update</h3>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="footer-widget fl-wrap">
                            <div class="subscribe-widget fl-wrap">
                                <div class="subcribe-form">
                                    <form id="subscribe">
                                        <input class="enteremail fl-wrap" name="email" id="subscribe-email"
                                            placeholder="Enter Your Email" spellcheck="false" type="text">
                                        <button type="submit" id="subscribe-button"
                                            class="subscribe-button color-bg"> Subscribe</button>
                                        <label for="subscribe-email" class="subscribe-message"></label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- subscribe-wrap end -->
    <!-- footer -->
    <footer class="main-footer fl-wrap">
        <div class="footer-inner fl-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-widget fl-wrap">
                            <div class="footer-widget-logo fl-wrap">
                                <a href="#"><img src="images/logo.png" alt=""></a>
                            </div>
                            {{-- <p>We specialize in empowering property sellers with a user-friendly platform designed to maximize exposure and streamline the selling process.</p> --}}
                            <ul class="footer-contacts fl-wrap">
                                <li>
                                    <span><i class="fal fa-envelope"></i> Mail :</span>
                                    <a href="mailto:manishtiwari8601@gmail.com"
                                        target="_blank">support@realState24world.com</a>
                                </li>

                                <li>
                                    <span><i class="fal fa-phone-alt"></i> Phone :</span>
                                    <a href="tel:+91 8601607526">+91 8601607526</a>
                                </li>
                            </ul>
                            <div class="footer-social fl-wrap">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget fl-wrap">
                            <div class="footer-widget-title fl-wrap">
                                <h4>Helpful links</h4>
                            </div>
                            <ul class="footer-list fl-wrap">
                                <li><a href="{{ route('about') }}">Our Company</a></li>
                                <li><a href="{{ route('blog') }}">Our News</a></li>
                                <li><a href="{{ route('agent') }}">Seller</a></li>
                                <li><a href="{{ route('front.faq') }}">Help Center</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact us</a></li>
                                <li><a href="{{ route('front.privacyPolicy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget fl-wrap">
                            <div class="footer-widget-title fl-wrap">
                                <h4>Services links</h4>
                            </div>
                            <ul class="footer-list fl-wrap">
                                @foreach (getfooterCategories() as $category)
                                    <li><a href="{{ route('property', $category->slug) }}">{{ $category->name }}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer-widget fl-wrap">
                            <div class="footer-widget-title fl-wrap">
                                <h4>Services links</h4>
                            </div>
                            <ul class="footer-list fl-wrap">
                                @foreach (getfooterCategories2() as $category2)
                                    <li><a href="{{ route('property', $category2->slug) }}">{{ $category2->name }}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> 

                    {{-- <div class="col-md-3">
                        <div class="footer-widget fl-wrap">
                            <div class="footer-widget-title fl-wrap">
                                <h4>Contacts Info</h4>
                            </div>
                            <ul class="footer-contacts fl-wrap">
                                <li>
                                    <span><i class="fal fa-envelope"></i> Mail :</span>
                                    <a href="mailto:support@realState24world.com"
                                        target="_blank">support@realState24world.com</a>
                                </li>
                                <li>
                                    <span><i class="fal fa-map-marker"></i> Adress :</span>
                                    <a href="#" target="_blank">1st Floor, Shee Ram Complex, Hayatpur Chowk Sector
                                        93, Gurugram, Haryana 122505</a>
                                </li>
                                <li>
                                    <span><i class="fal fa-phone-alt"></i> Phone :</span>
                                    <a href="tel:+91-8601607526">+91 -8601607526</a>
                                </li>
                            </ul>
                            <div class="footer-social fl-wrap">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="sub-footer gray-bg fl-wrap">
            <div class="container">
                <div class="copyright"> &copy; realState24world 2026 . All rights reserved.| Designed By: <a
                        href="https://manish-portfolio-chi.vercel.app">Manish Tiwari</a></div>
                <div class="subfooter-nav">
                    <ul class="no-list-style">
                        <li><a href="{{ route('front.term_condition') }}">Terms of use</a></li>
                        <li><a href="{{ route('front.privacyPolicy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="#">Sitemap</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    </div>
    <!-- wrapper end -->
    <!-- agent contact foprm -->
    <div id="popupForm" class="popup-overlay">
        <div class="popup-content">
            <div class="popform-header">
                <div class="head-diff">
                    <span class="close-btn" id="closePopupBtn">&times;</span>
                    <div class="pop-head-header">
                        <h2>To Contact the Advertiser</h2>
                        <p>(Just fill the below details one-time ONLY)</p>
                    </div>
                </div>
                <div class="agent-pop-card">
                    <div class="profile-widget-card">
                        <div class="profile-widget-image">
                            <img src="" id="dealer_image">
                        </div>
                        <div class="profile-widget-header-title">
                            <h4><a href="" id="dealer_name"></a></h4>
                            <div class="clearfix"></div>
                            <div class="pwh_counter"><span>22</span>Property Listings</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pop-form-contact-box">
                <div class="custom-form">
                    <div class="alert alert" id="formMsg"></div>
                    <form method="post" id="dealerForm">
                        <input type="hidden" name="dealer_id" id="dealer_id">
                        <input type="hidden" name="property_id" id="property_id">
                        <label>Your name* <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                        <input name="name" type="text" value="">
                        <label>Your phone * <span class="dec-icon"><i class="fas fa-phone"></i></span></label>
                        <input name="phone" type="text" value="">
                        <label>Your Email * <span class="dec-icon"><i class="fas fa-envelope"></i></span></label>
                        <input name="email" type="text" value="">
                        <label>Message *</label>
                        <textarea name="message"></textarea>
                        <div class="row" style="display:flex; align-items:center">
                            <div class="col-md-6"><span>Are you a real estate agent? </span></div>
                            <div class="col-md-3">
                                <div class="frm-radio">
                                    <input type="radio" class="radio11" name="is_agent" id="yes"
                                        value="1" checked>
                                    <label for="yes">Yes</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="frm-radio">
                                    <input type="radio" class="radio11" name="is_agent" id="no"
                                        value="0">
                                    <label for="no">No</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align:left">
                        <div class="form-group">
                            <input type="checkbox" id="agree" value="8" class="comm_pt" name="agree"
                                checked="checked">
                            <label for="agree">I agree to be contacted thru call, WhatsApp, sms & e-mail by
                                <b>realState24world</b> and other advertisers for similar properties.</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn color-bg fw-btn"> Send</button>
                </form>
            </div>

        </div>
    </div>
    </div>


    <!--user register form -->
    <div class="main-register-wrap modals">
        <div class="reg-overlay"></div>
        <div class="main-register-holder tabs-act">
            <div class="main-register-wrapper modal_main fl-wrap">
                <div class="main-register-header color-bg">
                    <div class="main-register-logo fl-wrap">
                        <img src="images/logo1.png" alt="">
                    </div>
                    <div class="main-register-bg">
                        <div class="mrb_pin"></div>
                        <div class="mrb_pin mrb_pin2"></div>
                    </div>
                    <div class="mrb_dec"></div>
                    <div class="mrb_dec mrb_dec2"></div>
                </div>
                <div class="main-register">
                    <div class="close-reg"><i class="fal fa-times"></i></div>
                    <h3>Register</h3>
                    <!--tabs -->
                    <div class="tabs-container">
                        <div class="custom-form">
                            <form method="post" name="registerform">
                                <label>Name <span class="dec-icon"><i class="fal fa-user"></i></span></label>
                                <input name="Name" type="text" placeholder="Your Name" value="">

                                <label>Phone No <span class="dec-icon"><i class="far fa-phone"></i></span></label>
                                <input name="numb" type="text" placeholder="Phone No." value="">

                                <label>Email <span class="dec-icon"><i class="far fa-envelope"></i></label>
                                <input name="email" type="text" placeholder="Your Mail" value="">

                                <div class="clearfix"></div>
                                <label>Property Type <span class="dec-icon"><i
                                            class="far fa-briefcase"></i></span></label>
                                <select data-placeholder="Categories"
                                    class="chosen-select on-radius no-search-select">
                                    <option>Rent</option>
                                    <option>Res </option>
                                    <option>Commercial property </option>
                                    <option>Commercial Land</option>
                                    <option>Argictural Land</option>
                                </select>

                                <div class="rad1 fl-wrap">
                                    <div class="add-list-media-header">
                                        <label class="radio inline">
                                            <input type="radio" name="gender" checked>
                                            <span>Rara</span>
                                        </label>
                                    </div>
                                    <div class="add-list-media-header">
                                        <label class="radio inline">
                                            <input type="radio" name="gender">
                                            <span>Non</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <button type="submit" class="log_btn color-bg"> Pay </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--secondary-nav -->



    <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>
