@extends('front.layouts.app')
@section('titlename', $propertiesrow->name)
@section('content')
    <style>
        .leave-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
        }
    </style>
    <div id="wrapper">
        <div class="content">
            <div class="breadcrumbs fw-breadcrumbs top-smpar smpar fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="#">Home</a><a href="{{ route('auction') }}">Auction</a><span> {{ $propertiesrow->name }}</span>
                    </div>
                </div>
            </div>

            <div class="gray-bg small-padding fl-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="list-single-main-wrapper fl-wrap">
                                <div class="scroll-nav-wrap">
                                    <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                        <ul class="no-list-style">
                                            <li><a class="act-scrlink" href="#sec1"><i class="fal fa-info"></i>
                                                </a><span>Details</span></li>
                                            <li><a href="#sec2"><i class="fal fa-stars"></i></a><span>Features</span></li>
                                            <li><a href="#sec6"><i class="fal fa-comment-alt-lines"></i></a><span>Reviews</span></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="list-single-opt_header fl-wrap">
                                    <ul class="list-single-opt_header_cat">
                                        <li><a href="#" class="cat-opt color-bg">{{ $propertiesrow->type }}</a></li>
                                    </ul>
                                </div>

                                <div class="list-single-header-item  fl-wrap" id="sec1">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h1>{{ $propertiesrow->name }} </h1>
                                            <div class="geodir-category-location fl-wrap">
                                                <a href="#" style="text-align: left;"> {{ $propertiesrow->address }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-single-header-footer fl-wrap">
                                        <div class="list-single-header-price"
                                            data-propertyprise="{{ $propertiesrow->amount }}">
                                            <strong>Price:</strong><span>₹</span>{{ number_format($propertiesrow->amount) }}
                                        </div>
                                        <div class="list-single-header-date">
                                            <span>Date:</span>{{ \Carbon\Carbon::parse($propertiesrow->created_at)->format('d M, Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrapper carousel-wrap fl-wrap">
                                        @php
                                            use Illuminate\Support\Facades\File;
                                            $images = json_decode($propertiesrow->multiple_images);
                                        @endphp
                                        <div class="slider-for fl-wrap carousel lightgallery">
                                            <div class="slick-slide-item">
                                                <div class="box-item">
                                                    <a href="{{ asset('uploads/auction/' . $propertiesrow->thumbnail) }}"
                                                        class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                    <img src="{{ asset('uploads/auction/' . $propertiesrow->thumbnail) }}"
                                                        alt="Image">
                                                </div>
                                            </div>
                                            @if(!empty($images))
                                                @php $hasValidImage = false; @endphp
                                                @foreach ($images as $image)
                                                    @php
                                                        $imagePath = public_path('uploads/auction/' . $image);
                                                    @endphp
                                                    @if (File::exists($imagePath))
                                                        @php $hasValidImage = true; @endphp
                                                        <div class="slick-slide-item">
                                                            <div class="box-item">
                                                                <a href="{{ asset('uploads/auction/' . $image) }}"
                                                                    class="gal-link popup-image"><i
                                                                        class="fal fa-search"></i></a>
                                                                <img src="{{ asset('uploads/auction/' . $image) }}"
                                                                    alt="Image">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if (!$hasValidImage)
                                                    <div class="slick-slide-item">
                                                        <div class="box-item">
                                                            <a href="{{ asset('uploads/property-img.jpg') }}"
                                                                class="gal-link popup-image"><i
                                                                    class="fal fa-search"></i></a>
                                                            <img src="{{ asset('uploads/property-img.jpg') }}"
                                                                alt="Default Image">
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="slick-slide-item">
                                                    <div class="box-item">
                                                        <a href="{{ asset('uploads/property-img.jpg') }}"
                                                            class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                        <img src="{{ asset('uploads/property-img.jpg') }}"
                                                            alt="Default Image">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="swiper-button-prev ssw-btn"><i class="fas fa-caret-left"></i></div>
                                        <div class="swiper-button-next ssw-btn"><i class="fas fa-caret-right"></i></div>
                                    </div>
                                </div>
                                <div class="list-single-header-item  fl-wrap">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h1>{{ $propertiesrow->name }} </h1>
                                            <div class="geodir-category-location fl-wrap">
                                                <a href="#" style="text-align: left;"> {{ $propertiesrow->address }}</a>
                                                <p style="margin-top: 50px; color:black;"><b>Last Date : </b> {{ \Carbon\Carbon::parse($propertiesrow->last_date)->format('d M, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-main-container fl-wrap">
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Description</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <p>{!! $propertiesrow->description !!}</p>
                                        </div>
                                    </div>

                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Notice :</h3>
                                            <p><a href="{{ asset('uploads/auction/' . $propertiesrow->notice) }}" download>Download</a></p>
                                        </div>
                                    </div>


                                    @if ($propertiesrow->reviews && $propertiesrow->reviews->count() > 0)
                                        <div class="list-single-main-item fl-wrap" id="sec6">
                                            <div class="list-single-main-item-title">
                                                <h3>Reviews <span>{{ $propertiesrow->reviews->count() }}</span></h3>
                                            </div>
                                            @php
                                                $average = $propertiesrow->reviews->avg('rating');
                                                $avgRounded = round($average, 1);
                                            @endphp
                                            <div class="list-single-main-item_content fl-wrap">
                                                <div class="reviews-comments-wrap fl-wrap">
                                                    <div class="review-total">
                                                        <span class="review-number blue-bg">{{ $avgRounded }}</span>
                                                        <div class="listing-rating card-popup-rainingvis"
                                                            data-starrating2="{{ round($average) }}"><span
                                                                class="re_stars-title">
                                                                @if ($avgRounded >= 4.5)
                                                                    Excellent
                                                                @elseif ($avgRounded >= 3.5)
                                                                    Good
                                                                @elseif ($avgRounded >= 2.5)
                                                                    Average
                                                                @elseif ($avgRounded >= 1.5)
                                                                    Fair
                                                                @elseif ($avgRounded == 1)
                                                                    Very Bad
                                                                @else
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>

                                                    @if (!empty($propertiesrow->reviews))
                                                        @foreach ($propertiesrow->reviews as $review)
                                                            <div class="reviews-comments-item">
                                                                <div class="review-comments-avatar">
                                                                    <img src="{{ asset('images/blank-img.jpg') }}"
                                                                        alt="">

                                                                </div>
                                                                <div class="reviews-comments-item-text smpar">

                                                                    <h4><a href="#">{{ $review->name }}</a></h4>
                                                                    <div class="listing-rating card-popup-rainingvis"
                                                                        data-starrating2="{{ $review->rating }}"><span
                                                                            class="re_stars-title">
                                                                            @if ($review->rating == 5)
                                                                                Excellent
                                                                            @elseif($review->rating == 4)
                                                                                Good
                                                                            @elseif($review->rating == 3)
                                                                                Fair
                                                                            @elseif($review->rating == 2)
                                                                                Average
                                                                            @else
                                                                                Very Bad
                                                                            @endif
                                                                        </span></div>
                                                                    <div class="clearfix"></div>
                                                                    <p>{{ $review->comment }}</p>
                                                                    <div class="reviews-comments-item-date"><span
                                                                            class="reviews-comments-item-date-item"><i
                                                                                class="far fa-calendar-check"></i>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <p class="text-center">No Reviews Found ..</p>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="list-single-main-item fl-wrap" id="sec15">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Add Your Review</h3>
                                        </div>
                                        <!-- Add Review Box -->
                                        <div id="add-review" class="add-review-box">
                                            <form action="{{ route('front.review') }}" method="POST"
                                                class="add-comment custom-form">
                                                @csrf
                                                <div class="leave-rating-wrap">
                                                    <span class="leave-rating-title">Your rating for this listing : </span>
                                                    <div class="leave-rating">

                                                        <input type="radio" name="rating" id="rating-5"
                                                            value="5" />
                                                        <label for="rating-5" class="fal fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-4"
                                                            value="4" />
                                                        <label for="rating-4" class="fal fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-3"
                                                            value="3" />
                                                        <label for="rating-3" class="fal fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-2"
                                                            value="2" />
                                                        <label for="rating-2" class="fal fa-star"></label>
                                                        <input type="radio" name="rating" id="rating-1"
                                                            value="1" />
                                                        <label for="rating-1" class="fal fa-star"></label>

                                                        {{-- @for ($i = 1; $i <= 5; $i++)
                                                            <input type="radio" name="rating"
                                                                id="rating-{{ $i }}"
                                                                value="{{ $i }}" required />
                                                            <label for="rating-{{ $i }}"
                                                                class="fal fa-star"></label>
                                                        @endfor --}}

                                                        @error('rating')
                                                            <div class="error-message">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="count-radio-wrapper">
                                                        <span id="count-checked-radio">Your Rating</span>
                                                    </div>
                                                </div>
                                                <!-- Review Comment -->

                                                {{-- <form action="{{ route('front.review') }}" method="POST"
                                                class="add-comment custom-form">
                                                @csrf --}}

                                                <input type="hidden" value="{{ $propertiesrow->id }}"
                                                    name="property_id" />

                                                <input type="hidden" value="{{ $propertiesrow->slug }}"
                                                    name="slug" />
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Your name* <span class="dec-icon"><i
                                                                        class="fas fa-user"></i></span></label>
                                                            <input name="reviewname" type="text"
                                                                onClick="this.select()" value="">
                                                            @error('reviewname')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Yourmail* <span class="dec-icon"><i
                                                                        class="fas fa-envelope"></i></span></label>
                                                            <input name="reviewemail" type="text"
                                                                onClick="this.select()" value="">
                                                            @error('reviewemail')
                                                                <div class="error-message">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <textarea cols="40" rows="3" name="comment" placeholder="Your Review:"></textarea>
                                                </fieldset>
                                                <button class="btn big-btn color-bg float-btn">Submit Review <i
                                                        class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sidebar -->

                        <div class="col-md-4">
                            <div class="box-widget fl-wrap">
                                <div class="profile-widget">
                                    <div class="profile-widget-header color-bg smpar fl-wrap">
                                        <div class="profile-widget-card">
                                            <div class="profile-widget-image">
                                                @if (!empty($propertiesrow->dealer->profile_photo))
                                                    <img src="{{ asset('uploads/dealer/' . $propertiesrow->dealer->profile_photo . '') }}"
                                                        alt="{{ $propertiesrow->dealer->name }}">
                                                @else
                                                    <img src="{{ asset('images/blank-img.jpg') }}" alt="realState24world">
                                                @endif
                                            </div>

                                            <div class="profile-widget-header-title">
                                                @if (!empty($propertiesrow->dealer->name))
                                                    <h4><a href="#"> By {{ $propertiesrow->dealer->name }}</a></h4>
                                                @else
                                                    <h4><a href="#"> By realState24world</a></h4>
                                                @endif
                                                <div class="clearfix"></div>
                                                <div class="pwh_counter"><span>22</span>Property Listings</div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-widget-content fl-wrap">
                                        <div class="contats-list fl-wrap">
                                            <ul class="no-list-style">
                                                @if (!empty($propertiesrow->dealer->phone))
                                                    <li><span><i class="fal fa-phone"></i>
                                                            Phone:</span>&nbsp;+91{{ substr($propertiesrow->dealer->phone, 0, 3) . '*******' . substr($propertiesrow->dealer->phone, -2) }}
                                                    </li>
                                                @else
                                                    <li><span><i class="fal fa-phone"></i> Phone :</span> +9199*******10
                                                    </li>
                                                @endif
                                                @if (!empty($propertiesrow->dealer->address))
                                                    <li><span><i class="fal fa-envelope"></i> Email:</span>&nbsp;
                                                        {{ substr($propertiesrow->dealer->email, 0, 4) . '*********' . substr($propertiesrow->dealer->email, -4) }}
                                                    </li>
                                                @else
                                                    <li><span><i class="fal fa-envelope"></i> Email :</span>
                                                        Supp**************.com</li>
                                                @endif

                                            </ul>
                                        </div>
                                        <div class="profile-widget-footer fl-wrap">
                                            @if (!empty($propertiesrow->dealer->id))
                                                <a href="#" class="btn float-btn color-bg small-btn openPopupBtn"
                                                    data-id="{{ $propertiesrow->dealer->id }}"
                                                    data-property="{{ $propertiesrow->id }}"><i class="fa fa-phone"></i>
                                                    View Contact</a>
                                            @else
                                                <a href="#" class="btn float-btn color-bg small-btn openPopupBtn"
                                                    data-id="realState24world" data-property="{{ $propertiesrow->id }}"><i
                                                        class="fa fa-phone"></i> View Contact</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-widget fl-wrap">
                                <div class="box-widget-fixed-init fl-wrap" id="sec-contact">
                                    <div class="box-widget-title fl-wrap box-widget-title-color color-bg">Contact Property
                                    </div>

                                    <div class="box-widget-content fl-wrap">
                                        <div class="custom-form">
                                            <form action="{{ route('front.enquiry') }}" method="POST"
                                                name="contact-property-form">
                                                @csrf
                                                @if (!empty($propertiesrow->dealer->id))
                                                    <input type="hidden" value="{{ $propertiesrow->dealer->id }}"
                                                        name="agent_id" />
                                                @endif
                                                <input type="hidden" value="{{ $propertiesrow->id }}"
                                                    name="property_id" />

                                                @if (!empty($propertiesrow->dealer))
                                                    <input type="hidden" value="{{ $propertiesrow->dealer->id }}"
                                                        name="dealer_id" />
                                                @else
                                                    <input type="hidden" value="0" name="dealer_id" />
                                                @endif


                                                <input type="hidden" value="{{ $propertiesrow->slug }}"
                                                    name="slug" />

                                                <label>Your name* <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input name="name" type="text" onClick="this.select()"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your phone * <span class="dec-icon"><i
                                                            class="fas fa-phone"></i></span></label>
                                                <input name="phone" type="text" onClick="this.select()"
                                                    value="{{ old('phone') }}">

                                                @error('phone')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your Email * <span class="dec-icon"><i
                                                            class="fas fa-envelope"></i></span></label>
                                                <input name="email" type="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror

                                                <label>Message </label>
                                                <textarea name="message" id=""></textarea>

                                                <button type="submit" class="btn float-btn color-bg fw-btn">
                                                    Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  sidebar end-->
                    </div>
                    <div class="fl-wrap limit-box"></div>
                    <div class="listing-carousel-wrapper carousel-wrap fl-wrap">
                        <div class="list-single-main-item-title">
                            <h3>Similar Properties</h3>
                        </div>
                        <div class="listing-carousel carousel ">


                            @foreach ($similar_property as $property)
                                <div class="slick-slide-item">

                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img fl-wrap">
                                                <a href="{{ route('auction.detail', $property->slug) }}"
                                                    class="geodir-category-img_item">

                                                    @if (empty($property->thumbnail))
                                                        <img src="{{ asset('uploads/property-img.jpg') }}"
                                                            alt="{{ $property->name }}" />
                                                    @else
                                                        <img src="{{ asset('uploads/auction/' . $property->thumbnail . '') }}"
                                                            alt="{{ $property->name }}" />
                                                    @endif
                                                    <div class="overlay"></div>
                                                </a>
                                                <div class="geodir-category-location">
                                                    <a href="#4" class="map-item"><i
                                                            class="fas fa-map-marker-alt"></i>
                                                        {{ $property->address }}</a>
                                                </div>
                                                <ul class="list-single-opt_header_cat">
                                                    {{-- <li>
                                                        <a href="#" class="cat-opt blue-bg">
                                                            @if ($property->property_type == 1)
                                                                Sale
                                                            @elseif($property->property_type == 2)
                                                                Rent
                                                            @endif
                                                        </a>
                                                    </li> --}}
                                                    <li><a href="#"
                                                            class="cat-opt color-bg">{{ $property->type }}</a></li>
                                                </ul>

                                                <div class="geodir-category-listing_media-list">
                                                    <span><i class="fas fa-camera"></i>{{ $property->views }} </span>
                                                </div>
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3><a
                                                        href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a>
                                                </h3>
                                                <div class="geodir-category-content_price">₹
                                                    {{ number_format($property->amount, 2) }}</div>
                                                <div class="bhk-apprtment">{{ strip_tags($property->description) }}</div>
                                                <div class="geodir-category-content-details">
                                                    <ul>
                                                        <li><i
                                                                class="fal fa-bed"></i><span>{{ $property->bedrooms }}</span>
                                                        </li>
                                                        <li><i
                                                                class="fal fa-bath"></i><span>{{ $property->bathrooms }}</span>
                                                        </li>
                                                        <li><i class="fal fa-cube"></i><span>{{ $property->area }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="geodir-category-footer fl-wrap">
                                                    <a href="#" class="gcf-company">
                                                        @if (!empty($property->dealer))
                                                            <img src="{{ asset('uploads/dealer/' . $property->dealer->profile_photo . '') }}"
                                                                alt="{{ $property->dealer->name }}">
                                                        @else
                                                            <img src="{{ asset('images/blank-img.jpg') }}"
                                                                alt="realState24world">
                                                        @endif
                                                    </a>
                                                    @if (!empty($property->dealer))
                                                        <span> By {{ $property->dealer->name }}</span>
                                                    @else
                                                        <span> By realState24world</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                </div>
                            @endforeach


                        </div>
                        <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="fas fa-angle-left"></i></div>
                        <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="fas fa-angle-right"></i></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
