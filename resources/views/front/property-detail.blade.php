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
        <!-- content -->
        <div class="content">
            <div class="breadcrumbs fw-breadcrumbs top-smpar smpar fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="#">Home</a><a href="#">{{ $propertiesrow->city }}</a><span>
                            {{ $propertiesrow->name }}</span>
                    </div>

                </div>
            </div>

            <div class="gray-bg small-padding fl-wrap">
                <div class="container">
                    <div class="row">
                        <!--  listing-single content -->
                        <div class="col-md-8">
                            <div class="list-single-main-wrapper fl-wrap">
                                <!--  scroll-nav-wrap -->
                                <div class="scroll-nav-wrap">
                                    <nav class="scroll-nav scroll-init fixed-column_menu-init">
                                        <ul class="no-list-style">
                                            <li><a class="act-scrlink" href="#sec1"><i class="fal fa-info"></i>
                                                </a><span>Details</span></li>
                                            <li><a href="#sec2"><i class="fal fa-stars"></i></a><span>Features</span></li>
                                            <!-- <li><a href="#sec3"><i class="fal fa-bed"></i></a><span>Rooms</span></li> -->
                                            <!-- <li><a href="#sec4"><i class="fal fa-video"></i></a><span>Video</span></li> -->
                                            <!-- <li><a href="#sec5"><i class="fal fa-map-pin"></i></a><span>Location</span></li> -->
                                            <li><a href="#sec6"><i
                                                        class="fal fa-comment-alt-lines"></i></a><span>Reviews</span></li>
                                        </ul>
                                        <div class="progress-indicator">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                                                <circle cx="16" cy="16" r="15.9155"
                                                    class="progress-bar__background" />
                                                <circle cx="16" cy="16" r="15.9155"
                                                    class="progress-bar__progress 
                                                            js-progress-bar" />
                                            </svg>
                                        </div>
                                    </nav>
                                </div>

                                <!--  scroll-nav-wrap end-->
                                <!--  list-single-opt_header-->
                                <div class="list-single-opt_header fl-wrap">
                                    <ul class="list-single-opt_header_cat">
                                        <li>
                                            <a href="#" class="cat-opt blue-bg">
                                                @if ($propertiesrow->property_type == 1)
                                                    Sale
                                                @elseif($propertiesrow->property_type == 2)
                                                    Rent
                                                @endif
                                            </a>
                                        </li>
                                        <li><a href="#" class="cat-opt color-bg">{{ $propertiesrow->type }}</a></li>
                                    </ul>
                                </div>

                                <div class="list-single-header-item  fl-wrap" id="sec1">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h1>{{ $propertiesrow->name }} <span class="verified-badge tolt"
                                                    data-microtip-position="bottom" data-tooltip="Verified"><i class="fas fa-check"></i></span></h1>
                                            <div class="geodir-category-location fl-wrap">
                                                <a href="#"><i class="fas fa-map-marker-alt"></i>
                                                    {{ $propertiesrow->address }}</a>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="view-map-loc">
                                                <a href=""><i class="fas fa-map-marker-alt"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="list-single-header-footer fl-wrap">
                                        <div class="list-single-header-price"
                                            data-propertyprise="{{ $propertiesrow->amount }}">
                                            <strong>Price:</strong><span>₹</span>{{ number_format($propertiesrow->amount, 2) }} / {{ $propertiesrow->amount_type ?? '' }}
                                        </div>
                                        <div class="list-single-header-date">
                                            <span>Date:</span>{{ \Carbon\Carbon::parse($propertiesrow->created_at)->format('d-m-Y') }}
                                        </div>
                                        <div class="list-single-stats">
                                            <ul class="no-list-style">
                                                <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -
                                                        {{ $propertiesrow->views }}
                                                    </span></li>

                                            </ul>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="agent-contact-box flx-wrap">
                                                @if (!empty($propertiesrow->dealer->id))
                                                    <a href="#" class="btn color-bg small-btn openPopupBtn"
                                                        data-id="{{ $propertiesrow->dealer->id }}"
                                                        data-property="{{ $propertiesrow->id }}">View Number</a>
                                                    <a href="#" class="btn color-bg small-btn openPopupBtn"
                                                        data-id="{{ $propertiesrow->dealer->id }}"
                                                        data-property="{{ $propertiesrow->id }}"><i
                                                            class="fal fa-phone-alt"></i> Contact</a>
                                                @else
                                                    <a href="#" class="btn color-bg small-btn openPopupBtn"
                                                        data-id="realState24world" data-property="{{ $propertiesrow->id }}"><i
                                                            class="fa fa-phone"></i> View Contact</a>
                                                @endif
                                            </div>
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
                                                    <a href="{{ asset('uploads/properties/' . $propertiesrow->thumbnail) }}"
                                                        class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                    <img src="{{ asset('uploads/properties/' . $propertiesrow->thumbnail) }}"
                                                        alt="Image">
                                                </div>
                                            </div>
                                            @if (!empty($images))
                                                @php $hasValidImage = false; @endphp
                                                @foreach ($images as $image)
                                                    @php
                                                        $imagePath = public_path('uploads/properties/' . $image);
                                                    @endphp
                                                    @if (File::exists($imagePath))
                                                        @php $hasValidImage = true; @endphp
                                                        <div class="slick-slide-item">
                                                            <div class="box-item">
                                                                <a href="{{ asset('uploads/properties/' . $image) }}"
                                                                    class="gal-link popup-image"><i
                                                                        class="fal fa-search"></i></a>
                                                                <img src="{{ asset('uploads/properties/' . $image) }}"
                                                                    alt="Image">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if (!$hasValidImage)
                                                    {{-- No valid images found, show default --}}
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
                                                {{-- multiple_images is empty, show default --}}
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
                                    <div class="single-slider-wrapper fl-wrap">
                                        <div class="slider-nav fl-wrap">
                                            <div class="slick-slide-item">
                                                <img src="{{ asset('uploads/properties/' . $propertiesrow->thumbnail) }}">
                                            </div>
                                            @if (!empty($images))
                                                @php $hasValidImage = false; @endphp
                                                @foreach ($images as $image)
                                                    @php
                                                        $imagePath = public_path('uploads/properties/' . $image);
                                                    @endphp
                                                    @if (File::exists($imagePath))
                                                        @php $hasValidImage = true; @endphp
                                                        <div class="slick-slide-item"><img
                                                                src="{{ asset('uploads/properties/' . $image) }}">
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if (!$hasValidImage)
                                                    <div class="slick-slide-item"><img
                                                            src="{{ asset('uploads/property-img.jpg') }}">
                                                    </div>
                                                @endif
                                            @else
                                                <div class="slick-slide-item"><img
                                                        src="{{ asset('uploads/property-img.jpg') }}">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="list-single-facts fl-wrap">
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-home-lg"></i>
                                            <h6>Type</h6>
                                            <span>{{ $propertiesrow->type ?? '' }}</span>
                                        </div>
                                    </div>
                                    @if (!empty($propertiesrow->area))
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fal fa-expand"></i>
                                                <h6>Area</h6>
                                                <span>{{ $propertiesrow->area ?? 'N/A' }} Sq ft</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-users"></i>
                                            <h6>Accomodation</h6>
                                            <span>{{ $propertiesrow->accomodation ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="inline-facts-wrap">
                                        <div class="inline-facts">
                                            <i class="fal fa-bed"></i>
                                            <h6>Bedrooms</h6>
                                            <span>{{ $propertiesrow->bedrooms ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <!-- inline-facts end -->
                                    <!-- inline-facts -->
                                    
                                </div>
                                <div class="list-single-main-container fl-wrap">
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>About This Listing</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <p>{!! $propertiesrow->description !!}</p>
                                        </div>
                                    </div>

                                    <div class="list-single-main-item fl-wrap" id="sec2">
                                        <div class="list-single-main-item-title">
                                            <h3>Details</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <div class="details-list">
                                                <ul>

                                                    <li><span>Property Id:</span>{{ $propertiesrow->id }}</li>
                                                    @if (!empty($propertiesrow->area))
                                                        <li><span>Property Size:</span>{{ $propertiesrow->area }} sq ft</li>
                                                    @endif
                                                    @if (!empty($propertiesrow->amount))
                                                        <li><span>Price:</span> {{ number_format($propertiesrow->amount, 2) }}
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->bedrooms))
                                                        <li><span>Bedrooms:</span>{{ $propertiesrow->bedrooms }}</li>
                                                    @endif
                                                    @if (!empty($propertiesrow->bathrooms))
                                                        <li><span>Bathrooms:</span>{{ $propertiesrow->bathrooms }}</li>
                                                    @endif
                                                    @if (!empty($propertiesrow->balcony))
                                                        <li><span>Balcony:</span>{{ $propertiesrow->balcony }}</li>
                                                    @endif
                                                    @if (!empty($propertiesrow->furnishing))
                                                        <li><span>Furnishing:</span>{{ $propertiesrow->furnishing }}</li>
                                                    @endif
                                                   @if (!empty($propertiesrow->floor_number))
                                                        <li>
                                                            <span>Floor Number:</span> 
                                                            {{ $propertiesrow->floor_number . (($propertiesrow->floor_number % 100 >= 11 && $propertiesrow->floor_number % 100 <= 13) ? 'th' : (['th','st','nd','rd','th','th','th','th','th','th'][$propertiesrow->floor_number % 10])) }} Floor
                                                        </li>
                                                    @endif
                                                    {{-- <li><span>Rooms:</span>8</li> --}}
                                                    
                                                    @if (!empty($propertiesrow->garage))
                                                        <li><span>Garage Size:</span>{{ $propertiesrow->garage }}</li>
                                                    @endif
                                                    @if (!empty($propertiesrow->created_at))
                                                        <li><span>Available
                                                                from:</span>{{ \Carbon\Carbon::parse($propertiesrow->created_at)->format('d-m-Y') }}
                                                        </li>
                                                    @endif
                                                    
                                                    @if (!empty($propertiesrow->type))
                                                        <li><span>Type:</span>{{ $propertiesrow->type }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Features</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <div class="listing-features ">
                                                <ul>
                                                    @if (!empty($propertiesrow->gym) && $propertiesrow->gym == '1')
                                                        <li><a href="#"><i class="fal fa-dumbbell"></i> Gym</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->wifi) && $propertiesrow->wifi == '1')
                                                        <li><a href="#"><i class="fal fa-wifi"></i> Wi Fi</a></li>
                                                    @endif
                                                    @if (!empty($propertiesrow->parking) && $propertiesrow->parking == '1')
                                                        <li><a href="#"><i class="fal fa-parking"></i> Parking</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->garden) && $propertiesrow->garden == '1')
                                                        <li><a href="#"><i class="fal fa-cloud"></i> Garden</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->air_conditioning) && $propertiesrow->air_conditioning == '1')
                                                        <li><a href="#"><i class="fal fa-cloud"></i> Air
                                                                Conditioned</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->pool) && $propertiesrow->pool == '1')
                                                        <li><a href="#"><i class="fal fa-swimmer"></i> Pool</a></li>
                                                    @endif
                                                    @if (!empty($propertiesrow->security) && $propertiesrow->security == '1')
                                                        <li><a href="#"><i class="fal fa-cctv"></i> Security</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->laundry) && $propertiesrow->laundry == '1')
                                                        <li><a href="#"><i class="fal fa-washer"></i> Laundry
                                                                Room</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($propertiesrow->equipped_kitchen) && $propertiesrow->equipped_kitchen == '1')
                                                        <li><a href="#"><i class="fal fa-utensils"></i> Equipped
                                                                Kitchen</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Nearby facilities</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <div class="listing-features ">
                                                <ul>
                                                    @if (!empty($propertiesrow->busstand) && $propertiesrow->busstand == '1')
                                                        <li><a href="#"> Bus Stand</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->market) && $propertiesrow->market == '1')
                                                        <li><a href="#"> Market</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->airport) && $propertiesrow->airport == '1')
                                                        <li><a href="#"> Airport</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->park) && $propertiesrow->park == '1')
                                                        <li><a href="#"> Park</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->school) && $propertiesrow->school == '1')
                                                        <li><a href="#"> School</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->railwaystation) && $propertiesrow->railwaystation == '1')
                                                        <li><a href="#"> Railway Station</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->mandir) && $propertiesrow->mandir == '1')
                                                        <li><a href="#"> Mandir</a></li>
                                                    @endif

                                                    @if (!empty($propertiesrow->hospital) && $propertiesrow->hospital == '1')
                                                        <li><a href="#">Hospital</a></li>
                                                    @endif
                                                </ul>
                                            </div>
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
                                                    <li class="defaultno"><span><i class="fal fa-phone"></i>
                                                            Phone:</span>&nbsp;+91{{ substr($propertiesrow->dealer->phone, 0, 3) . '*******' . substr($propertiesrow->dealer->phone, -2) }}
                                                    </li>
                                                    <li class="originalno" style="display: none;"><span><i class="fal fa-phone"></i>
                                                            Phone:</span>&nbsp;+91{{ $propertiesrow->dealer->phone }}
                                                    </li>
                                                @else
                                                    <li><span><i class="fal fa-phone"></i> Phone :</span> +9199*******10
                                                    </li>
                                                @endif
                                                @if (!empty($propertiesrow->dealer->address))
                                                    <li class="defaultemail"><span><i class="fal fa-envelope"></i> Email:</span>&nbsp;
                                                        {{ substr($propertiesrow->dealer->email, 0, 4) . '*********' . substr($propertiesrow->dealer->email, -4) }}
                                                    </li>
                                                     <li class="originalemail" style="display: none;"><span><i class="fal fa-envelope"></i> Email:</span>&nbsp;
                                                        {{ $propertiesrow->dealer->email }}
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
                                                <input type="hidden" value="{{ $propertiesrow->dealer->id }}"
                                                    name="agent_id" />
                                                <input type="hidden" value="{{ $propertiesrow->id }}"
                                                    name="property_id" />

                                                @if(!empty($propertiesrow->dealer))
                                                <input type="hidden" value="{{ $propertiesrow->dealer->id  }}"
                                                    name="dealer_id" />
                                                 @else
                                                    <input type="hidden" value="0"
                                                    name="dealer_id" />
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
                                                <a href="{{ route('property.detail', $property->slug) }}"
                                                    class="geodir-category-img_item">

                                                    @if (empty($property->thumbnail))
                                                        <img src="{{ asset('uploads/property-img.jpg') }}"
                                                            alt="{{ $property->name }}" />
                                                    @else
                                                        <img src="{{ asset('uploads/properties/' . $property->thumbnail . '') }}"
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
                                                    <li><a href="#" class="cat-opt blue-bg">
                                                            @if ($property->property_type == 1)
                                                                Sale
                                                            @elseif($property->property_type == 2)
                                                                Rent
                                                            @endif
                                                        </a></li>
                                                    <li><a href="#"
                                                            class="cat-opt color-bg">{{ $property->type }}</a></li>
                                                </ul>

                                                {{-- <div class="geodir-category-listing_media-list">
                                                    <span><i class="fas fa-camera"></i>{{ $property->views }} </span>
                                                </div> --}}
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3><a
                                                        href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a>
                                                </h3>
                                                <div class="geodir-category-content_price">₹
                                                    {{ number_format($property->amount, 2) }}</div>
                                                <div class="bhk-apprtment">{{ \Illuminate\Support\Str::words(strip_tags($property->description), 10, '...') }}</div>
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
