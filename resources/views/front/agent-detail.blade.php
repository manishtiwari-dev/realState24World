@extends('front.layouts.app')
@section('titlename', $agent->name ?? 'Agent Detail')
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
        <!-- content -->
        <div class="content">
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap top-smpar">
                <div class="container" style="padding-top: 20px;">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a><a href="{{ route('agent') }}">Agent</a>
                        <span>{{ $agent->name }}</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs end -->
            <!-- col-list-wrap -->
            <section class="gray-bg small-padding ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-info smpar fl-wrap">

                                <div class="bg-wrap bg-parallax-wrap-gradien">
                                    @if (empty($agent->company_logo))
                                        <div class="bg" data-bg="images/bg/8.jpg"></div>
                                    @else
                                        <div class="bg"
                                            data-bg="{{ asset('uploads/dealer/' . $agent->company_logo . '') }}"></div>
                                    @endif
                                </div>
                                <div class="card-info-media">

                                    @if (empty($agent->profile_photo))
                                        <div class="bg" data-bg="images/blank-img.jpg"></div>
                                    @else
                                        <div class="bg"
                                            data-bg="{{ asset('uploads/dealer/' . $agent->profile_photo . '') }}"></div>
                                    @endif
                                </div>
                                <div class="card-info-content">
                                    <div class="agent_card-title fl-wrap">
                                        <h4> {{ $agent->name }} </h4>
                                        <div class="geodir-category-location fl-wrap">
                                            <h5><a href="agency-single.html">{{ $agent->company_name }}</a></h5>

                                        </div>
                                    </div>
                                    <div class="list-single-stats">
                                        <ul class="no-list-style">
                                            <li><span class="viewed-counter"><i class="fas fa-eye"></i> Viewed -
                                                    {{ $agent->views }} </span>
                                            </li>
                                            <li><span class="bookmark-counter"><i class="fas fa-sitemap"></i> Listings -
                                                    {{ $agent->property->count() ?? 0 }} </span></li>
                                        </ul>
                                    </div>
                                    <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i
                                            class="fal fa-user-check"></i></div>
                                </div>
                            </div>
                            <div class="list-single-main-container fl-wrap">
                                <!-- list-single-main-item -->
                                <div class="list-single-main-item fl-wrap">
                                    <div class="list-single-main-item-title">
                                        <h3>About This Agent</h3>
                                    </div>
                                    <div class="list-single-main-item_content fl-wrap">
                                        <p>{{ $agent->about }} </p>
                                        {{-- <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 20px;">
                                            <span>Service Areas:</span>
                                            <a href="#">Delhi</a>
                                            <a href="#">New Delhi</a>
                                            <a href="#">Noida</a>
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- list-single-main-item end -->
                            </div>
                            <!-- content-tabs-wrap -->
                            <div class="content-tabs-wrap tabs-act fl-wrap">
                                <div class="content-tabs fl-wrap">
                                    <ul class="tabs-menu fl-wrap no-list-style">
                                        <li class="current"><a href="#tab-listing"> Listing </a></li>
                                        <li><a href="#tab-reviews">Reviews</a></li>
                                    </ul>
                                </div>
                                <!--tabs -->
                                <div class="tabs-container">
                                    <!--tab -->
                                    <div class="tab">
                                        <div id="tab-listing" class="tab-content first-tab">

                                            <div class="listing-item-container one-column-grid-wrap  box-list_ic fl-wrap">

                                                @if ($properties->count())
                                                    @foreach ($properties as $key => $data)
                                                        <div class="listing-item">
                                                            <article class="geodir-category-listing fl-wrap">
                                                                <div class="geodir-category-img fl-wrap">
                                                                    <a href="{{ route('property.detail', $data->slug) }}"
                                                                        class="geodir-category-img_item">
                                                                        @if (empty($data->thumbnail))
                                                                            <img src="{{ asset('uploads/property-img.jpg') }}"
                                                                                alt="{{ $data->name }}" />
                                                                        @else
                                                                            <img src="{{ asset('uploads/properties/' . $data->thumbnail) }}"
                                                                                alt="{{ $data->name }}" />
                                                                        @endif
                                                                        <div class="overlay"></div>
                                                                    </a>
                                                                    <div class="geodir-category-location">
                                                                        <a href="#" class="single-map-item"><i
                                                                                class="fas fa-map-marker-alt"></i>
                                                                            {{ $data->address }}</a>
                                                                    </div>
                                                                    <ul class="list-single-opt_header_cat">
                                                                        <li><a href="#" class="cat-opt blue-bg">
                                                                                @if ($data->property_type == 1)
                                                                                    Sale
                                                                                @elseif($data->property_type == 2)
                                                                                    Rent
                                                                                @endif
                                                                            </a></li>
                                                                        <li><a href="#"
                                                                                class="cat-opt color-bg">{{ $data->type }}</a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="geodir-category-listing_media-list">
                                                                        <span><i class="fas fa-camera"></i>
                                                                            {{ $data->views }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="geodir-category-content fl-wrap">
                                                                    <h3 class="title-sin_item">
                                                                        <a
                                                                            href="{{ route('property.detail', $data->slug) }}">{{ $data->name }}</a>
                                                                    </h3>
                                                                    <div class="geodir-category-content_price">
                                                                        ₹{{ number_format($data->amount, 2) }}</div>
                                                                    <p>{{ \Illuminate\Support\Str::words(strip_tags($data->description), 20, '...') }}</p>
                                                                    <div class="geodir-category-content-details">
                                                                        <ul>
                                                                            @if (!empty($data->bedrooms))
                                                                                <li><i
                                                                                        class="fal fa-bed"></i><span>{{ $data->bedrooms }}</span>
                                                                                </li>
                                                                            @endif

                                                                            @if (!empty($data->bathrooms))
                                                                                <li><i
                                                                                        class="fal fa-bath"></i><span>{{ $data->bathrooms }}</span>
                                                                                </li>
                                                                            @endif
                                                                            @if (!empty($data->area))
                                                                                <li><i
                                                                                        class="fal fa-cube"></i><span>{{ $data->area }}</span>
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>

                                                                    <div class="geodir-category-footer fl-wrap">
                                                                        <a href="#" class="gcf-company">
                                                                            @if (!empty($data->dealer))
                                                                                <img src="{{ asset('uploads/dealer/' . $data->dealer->profile_photo) }}"
                                                                                    alt="{{ $data->dealer->name }}">
                                                                                <span>By {{ $data->dealer->name }}</span>
                                                                            @else
                                                                                <img src="{{ asset('images/blank-img.jpg') }}"
                                                                                    alt="realState24world">
                                                                                <span>By realState24world</span>
                                                                            @endif
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                        </div>
                                                    @endforeach

                                                    {{-- Pagination Links --}}
                                                    {{-- <div class="pagination">
                                                        {{ $properties->links() }}
                                                    </div> --}}
                                                @else
                                                    <p>No properties found for this agent.</p>
                                                @endif


                                            </div>

                                            <!-- listing-item-wrap end-->
                                            <!-- pagination-->
                                            <div class="pagination">
                                                {{ $properties->links('vendor.pagination.custom') }}
                                            </div>
                                            <!-- pagination end-->
                                        </div>
                                    </div>
                                    <!--tab  end-->
                                    <!--tab -->
                                    <div class="tab">

                                        <div id="tab-reviews" class="tab-content">
                                            <div class="list-single-main-container fl-wrap" style="margin-top: 30px;">
                                                <!-- list-single-main-item -->
                                                @if ($agent->reviews && $agent->reviews->count() > 0)
                                                    <div class="list-single-main-item fl-wrap" id="sec6">
                                                        <div class="list-single-main-item-title">
                                                            <h3>Reviews <span>{{ $agent->reviews->count() }}</span></h3>
                                                        </div>
                                                        @php
                                                            $average = $agent->reviews->avg('rating');
                                                            $avgRounded = round($average, 1);
                                                        @endphp
                                                        <div class="list-single-main-item_content fl-wrap">
                                                            <div class="reviews-comments-wrap fl-wrap">
                                                                <div class="review-total">
                                                                    <span
                                                                        class="review-number blue-bg">{{ $avgRounded }}</span>
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
                                                                        </span></div>
                                                                </div>
                                                                @if (!empty($agent->reviews))
                                                                    @foreach ($agent->reviews as $review)
                                                                        <div class="reviews-comments-item">
                                                                            <div class="review-comments-avatar">
                                                                                <img src="{{ asset('images/blank-img.jpg') }}"
                                                                                    alt="">

                                                                            </div>
                                                                            <div class="reviews-comments-item-text smpar">
                                                                                <div class="box-widget-menu-btn smact"><i
                                                                                        class="far fa-ellipsis-h"></i>
                                                                                </div>
                                                                                <div class="show-more-snopt-tooltip bxwt">
                                                                                    <a href="#"> <i
                                                                                            class="fas fa-reply"></i>
                                                                                        Reply</a>
                                                                                    <a href="#"> <i
                                                                                            class="fas fa-exclamation-triangle"></i>
                                                                                        Report </a>
                                                                                </div>
                                                                                <h4><a
                                                                                        href="#">{{ $review->name }}</a>
                                                                                </h4>
                                                                                <div class="listing-rating card-popup-rainingvis"
                                                                                    data-starrating2="{{ $review->rating }}">
                                                                                    <span class="re_stars-title">
                                                                                        @if ($review->rating == 5)
                                                                                            Excellent
                                                                                        @elseif($review->rating == 4)
                                                                                            Good
                                                                                        @elseif($review->rating == 3)
                                                                                            Fair
                                                                                        @elseif($review->rating == 2)
                                                                                            Average
                                                                                        @elseif($review->rating == 1)
                                                                                            Very Bad
                                                                                        @else
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                                <p>{{ $review->comment }}</p>
                                                                                <div class="reviews-comments-item-date">
                                                                                    <span
                                                                                        class="reviews-comments-item-date-item"><i
                                                                                            class="far fa-calendar-check"></i>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}
                                                                                    </span><a href="#"
                                                                                        class="rate-review"><i
                                                                                            class="fal fa-thumbs-up"></i>
                                                                                        Helpful
                                                                                        Review
                                                                                        <span>{{ $review->rating }}</span>
                                                                                    </a>
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
                                                <!-- list-single-main-item end -->
                                                <!-- list-single-main-item -->
                                                <div class="list-single-main-item fl-wrap" id="sec5">
                                                    <div class="list-single-main-item-title fl-wrap">
                                                        <h3>Add Your Review</h3>
                                                    </div>
                                                    <!-- Add Review Box -->
                                                    <div id="add-review" class="add-review-box">
                                                        <form action="{{ route('front.review') }}" method="POST"
                                                            class="add-comment custom-form">
                                                            @csrf
                                                            <div class="leave-rating-wrap">
                                                                <span class="leave-rating-title">Your rating for this
                                                                    listing :
                                                                </span>
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
                                                                    @error('rating')
                                                                        <div class="error-message">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="count-radio-wrapper">
                                                                    <span id="count-checked-radio">Your Rating</span>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" value="{{ $agent->id }}"
                                                                name="agent_id" />
                                                            <!-- Review Comment -->
                                                            {{-- <form class="add-comment custom-form"> --}}
                                                            <fieldset>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Your name* <span class="dec-icon"><i
                                                                                    class="fas fa-user"></i></span></label>
                                                                        <input name="reviewname" type="text"
                                                                            onClick="this.select()" value="">
                                                                        @error('reviewname')
                                                                            <div class="error-message">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Your Mail* <span class="dec-icon"><i
                                                                                    class="fas fa-envelope"></i></span></label>
                                                                        <input name="reviewemail" type="text"
                                                                            onClick="this.select()" value="">
                                                                        @error('reviewemail')
                                                                            <div class="error-message">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <textarea cols="40" rows="3" name="comment" placeholder="Your Review:"></textarea>
                                                            </fieldset>
                                                            <button class="btn big-btn color-bg float-btn">Submit Review <i
                                                                    class="fa fa-paper-plane-o"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                    </div>
                                                    <!-- Add Review Box / End -->
                                                </div>
                                                <!-- list-single-main-item end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--tab end-->
                                </div>
                                <!--tabs end-->
                            </div>
                            <!-- content-tabs-wrap end -->
                        </div>
                        <!-- col-md 8 end -->
                        <!--  sidebar-->
                        <div class="col-md-4">
                            <!--box-widget-->
                            <div class="box-widget bwt-first fl-wrap">
                                <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">Agent
                                    Contacts</div>
                                <div class="box-widget-content fl-wrap">
                                    <div class="contats-list clm fl-wrap">
                                        <ul class="no-list-style">
                                            <li><span><i class="fal fa-phone"></i> Phone :</span> <a
                                                    href="#">{{ substr($agent->phone, 0, 3) . '******' . substr($agent->phone, -2) }}</a>
                                            </li>
                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a
                                                    href="#">{{ substr($agent->email, 0, 5) . '*********' . substr($agent->email, -8) }}</a>
                                            </li>

                                            {{-- <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#">
                                                    {{ $agent->address }}</a></li> --}}


                                            <li><span><i class="fal fa-browser"></i> Website :</span> <a
                                                    href="{{ $agent->website }}">{{ $agent->website }}</a></li>
                                        </ul>

                                    </div>
                                    <div class="profile-widget-footer fl-wrap">
                                        <div class="card-info-content_social">
                                            <ul>
                                                <li><a href="{{ $agent->facebook_link }}" target="_blank"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="{{ $agent->twitter_link }}" target="_blank"><i
                                                            class="fab fa-twitter"></i></a>
                                                </li>
                                                <li><a href="{{ $agent->instagram_link }}" target="_blank"><i
                                                            class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                        <a href="#sec-contact" class="custom-scroll-link tolt csls"
                                            data-microtip-position="left" data-tooltip="Write Message"><i
                                                class="fal fa-paper-plane"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget end -->
                            <!--box-widget-->
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-fixed-init fl-wrap" id="sec-contact">
                                    <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">Get
                                        In Touch</div>

                                    <div class="box-widget-content fl-wrap">
                                        <div class="custom-form">
                                            <form action="{{ route('front.enquiry') }}" method="POST"
                                                name="contact-property-form">
                                                @csrf

                                                <input type="hidden" value="{{ encode_string($agent->id) }}"
                                                    name="agent_id" />

                                                <label>Your name* <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input name="name" type="text" onClick="this.select()"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your E-mail * <span class="dec-icon"><i
                                                            class="fas fa-envelope"></i></span></label>
                                                <input name="email" type="email" onClick="this.select()"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your Phone * <span class="dec-icon"><i
                                                            class="fas fa-phone"></i></span></label>
                                                <input name="phone" type="text" onClick="this.select()"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Message </label>
                                                <textarea cols="40" rows="3" name="message" placeholder="Your Message:" style="height: 120px"></textarea>
                                                <button type="submit" class="btn float-btn color-bg fw-btn">
                                                    Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget end -->
                        </div>
                        <!--   sidebar end-->
                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </section>
        </div>
    </div>
@endsection
