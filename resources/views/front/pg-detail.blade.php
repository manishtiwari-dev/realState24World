@extends('front.layouts.app')
@section('titlename', $agent->name)
@section('content')
    <div id="wrapper">
        <!-- content -->
        <div class="content">
            <section class="hidden-section   single-hero-section" data-scrollax-parent="true" id="sec1">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    @if (empty($agent->thumbnail))
                        <div class="bg par-elem " data-bg="{{ asset('images/pg.jpg') }}" data-scrollax="properties: { translateY: '30%' }"> </div>
                    @else
                        <div class="bg par-elem " data-bg="{{ asset('uploads/payinguest/' . $agent->thumbnail . '') }}" data-scrollax="properties: { translateY: '30%' }"> </div>
                    @endif
                </div>
                <div class="container">
                    <div class="list-single-header-item no-bg-list_sh fl-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>{!! breakWords($agent->name,6) !!} <span class="verified-badge tolt"
                                        data-microtip-position="bottom" data-tooltip="Verified"><i
                                            class="fas fa-check"></i></span></h1>
                                <div class="geodir-category-location fl-wrap">
                                    <a href="#"><i class="fas fa-map-marker-alt"></i>{{ $agent->address }}</a>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"><span class="re_stars-title">Good</span></div>
                                </div>
                                <div class="share-holder hid-share">
                                    <a href="#" class="share-btn showshare sfcs"> <span class="viewed-counter"><i class="fas fa-eye"></i> Viewed - {{ $agent->views }} </span> </a>
                                    <div class="share-container  isShare"></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-single-header-footer fl-wrap">
                            <div class="list-single-header-price" data-propertyprise="50500">
                                {{-- <strong>Price:</strong><span>$</span>50.500 --}}
                            </div>
                            <div class="list-single-header-date"><span>Date:</span>{{ $agent->created_at->format('d M, Y') }}</div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="breadcrumbs fw-breadcrumbs smpar fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a><a href="">PG/Co-Living</a><span>{{ $agent->name }}</span>
                    </div>
                    <div class="show-more-snopt smact"><i class="fal fa-ellipsis-v"></i></div>
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
                                            <li><a class="act-scrlink" href="#sec1"><i
                                                        class="fal fa-home-lg-alt"></i></a><span>Main</span></li>
                                            <li><a href="#sec2"><i class="fal fa-image"></i></a><span>Gallery</span></li>
                                            <li><a href="#sec3"><i class="fal fa-info"></i> </a><span>Details</span></li>
                                            <li><a href="#sec4"><i class="fal fa-bed"></i></a><span>Rooms</span></li>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!--  scroll-nav-wrap end-->
                                <div class="list-single-main-media fl-wrap" id="sec2">
                                    <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery">
                                        <!-- 1 -->
                                        <div class="gallery-item ">
                                            <div class="grid-item-holder">
                                                <div class="box-item">
                                                    <img src="{{ asset('uploads/payinguest/' . $agent->thumbnail . '') }}">
                                                    <a href="{{ asset('uploads/payinguest/' . $agent->thumbnail . '') }}" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- 1 end -->
                                        @if ($properties->count())
                                            @foreach ($properties as $key => $data)
                                                @php
                                                    $multiImages = json_decode($data->multiple_images, true);
                                                @endphp
                                                <div class="gallery-item">
                                                    <div class="grid-item-holder">
                                                        <div class="box-item">
                                                            <img src="{{ asset('uploads/properties/' . $data->thumbnail) }}" alt="">
                                                            <a href="{{ asset('uploads/properties/' . $data->thumbnail) }}" class="gal-link popup-image">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (!empty($multiImages))
                                                    @foreach ($multiImages as $img)
                                                        <div class="gallery-item">
                                                            <div class="grid-item-holder">
                                                                <div class="box-item">
                                                                    <img src="{{ asset('uploads/properties/' . $img) }}" alt="">
                                                                    <a href="{{ asset('uploads/properties/' . $img) }}" class="gal-link popup-image">
                                                                        <i class="fa fa-search"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- end gallery items -->
                                </div>
                                <div class="list-single-main-item fl-wrap" style="border: 1px solid #eaeaea;">
                                    <div class="list-single-main-item-title">
                                        <h3>Details</h3>
                                    </div>
                                    <div class="list-single-main-item_content fl-wrap">
                                        <div class="details-list">
                                            <ul>
                                                <li><span>Bed Rooms:</span>{{ $agent->total_beds }} Beds</li>
                                                <li><span>Meal :</span>{{ $agent->meals }}</li>
                                                <li><span>Available from:</span>{{ $agent->created_at->format('d M, Y') }}</li>
                                                <li><span>Starting Price:</span>{{ number_format($minPrice) }}</li>
                                                <li><span>Type:</span>{{ $agent->type }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-main-container fl-wrap" id="sec3">
                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec4">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Available Rooms</h3>
                                        </div>
                                        <!--   rooms-container -->
                                        <div class="rooms-container fl-wrap">
                                        @if ($properties->count())
                                            @foreach ($properties as $key => $data)
                                            <!--  rooms-item -->
                                            <div class="rooms-item fl-wrap">
                                                <div class="rooms-media">
                                                    <img src="{{ asset('uploads/properties/' . $data->thumbnail) }}" alt="">
                                                </div>
                                                <div class="rooms-details">
                                                    <div class="rooms-details-header fl-wrap">
                                                        <h3><a href="{{ route('property.detail', $data->slug) }}">{{ $data->room_type }} {{ $data->name }}</a></h3>
                                                        <h5>Rooms: <span>{{ $data->room_type }}</span></h5>
                                                    </div>
                                                    <p>{{ \Illuminate\Support\Str::words(strip_tags($data->description), 10, '...') }}</p>
                                                    <p><strong>Amount : {{ number_format($data->amount) }} / {{ $data->amount_type }}</strong></p>
                                                    <div class="facilities-list fl-wrap">
                                                        <ul>
                                                            <li class="tolt" data-microtip-position="top" data-tooltip="Air conditioner"><i class="fal fa-snowflake"></i></li>
                                                            <li class="tolt" data-microtip-position="top" data-tooltip="Bed Inside"><i class="fal fa-bed"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>

                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Features</h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <div class="listing-features ">
                                                <ul>
                                                    @if (!empty($singleproperties->gym) && $singleproperties->gym == '1')
                                                        <li><a href="#"><i class="fal fa-dumbbell"></i> Gym</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->wifi) && $singleproperties->wifi == '1')
                                                        <li><a href="#"><i class="fal fa-wifi"></i> Wi Fi</a></li>
                                                    @endif
                                                    @if (!empty($singleproperties->parking) && $singleproperties->parking == '1')
                                                        <li><a href="#"><i class="fal fa-parking"></i> Parking</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($singleproperties->garden) && $singleproperties->garden == '1')
                                                        <li><a href="#"><i class="fal fa-cloud"></i> Garden</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($singleproperties->air_conditioning) && $singleproperties->air_conditioning == '1')
                                                        <li><a href="#"><i class="fal fa-cloud"></i> Air
                                                                Conditioned</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($singleproperties->pool) && $singleproperties->pool == '1')
                                                        <li><a href="#"><i class="fal fa-swimmer"></i> Pool</a></li>
                                                    @endif
                                                    @if (!empty($singleproperties->security) && $singleproperties->security == '1')
                                                        <li><a href="#"><i class="fal fa-cctv"></i> Security</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($singleproperties->laundry) && $singleproperties->laundry == '1')
                                                        <li><a href="#"><i class="fal fa-washer"></i> Laundry
                                                                Room</a>
                                                        </li>
                                                    @endif
                                                    @if (!empty($singleproperties->equipped_kitchen) && $singleproperties->equipped_kitchen == '1')
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
                                                    @if (!empty($singleproperties->busstand) && $singleproperties->busstand == '1')
                                                        <li><a href="#"> Bus Stand</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->market) && $singleproperties->market == '1')
                                                        <li><a href="#"> Market</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->airport) && $singleproperties->airport == '1')
                                                        <li><a href="#"> Airport</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->park) && $singleproperties->park == '1')
                                                        <li><a href="#"> Park</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->school) && $singleproperties->school == '1')
                                                        <li><a href="#"> School</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->railwaystation) && $singleproperties->railwaystation == '1')
                                                        <li><a href="#"> Railway Station</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->mandir) && $singleproperties->mandir == '1')
                                                        <li><a href="#"> Mandir</a></li>
                                                    @endif

                                                    @if (!empty($singleproperties->hospital) && $singleproperties->hospital == '1')
                                                        <li><a href="#">Hospital</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title">
                                            <h3>Description </h3>
                                        </div>
                                        <div class="list-single-main-item_content fl-wrap">
                                            <p>{!! $agent->about !!}</p>
                                        </div>
                                    </div>
                                    
                                    
                                    <!-- list-single-main-item end -->
                                </div>
                            </div>
                        </div>
                        <!-- listing-single content end-->
                        <!-- sidebar -->
                        <div class="col-md-4">
                            <!--box-widget-->
                            <div class="box-widget bwt-first fl-wrap">
                                <div class="box-widget-title fl-wrap box-widget-title-color color-bg no-top-margin">Agent
                                    Contacts</div>
                                <div class="box-widget-content fl-wrap">
                                    <div class="contats-list clm fl-wrap">
                                        <ul class="no-list-style">
                                            {{-- <li><span><i class="fal fa-phone"></i> Phone :</span> <a
                                                    href="#">{{ substr($agent->phone, 0, 3) . '******' . substr($agent->phone, -2) }}</a>
                                            </li>
                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a
                                                    href="#">{{ substr($agent->email, 0, 5) . '*********' . substr($agent->email, -8) }}</a>
                                            </li> --}}

                                            {{-- <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#">
                                                    {{ $agent->address }}</a></li> --}}

                                          @if(!empty($agent->website))
                                            <li><span><i class="fal fa-browser"></i> Website :</span> <a
                                                    href="{{ $agent->website }}">{{ $agent->website }}</a></li>@endif
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
                                            <form action="{{ route('front.enquiry') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $agent->id }}"
                                                    name="agent_id" />
                                                <label>Your name* <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input name="name" type="text"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your E-mail * <span class="dec-icon"><i
                                                            class="fas fa-envelope"></i></span></label>
                                                <input name="email" type="email"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Your Phone * <span class="dec-icon"><i
                                                            class="fas fa-phone"></i></span></label>
                                                <input name="phone" type="text"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <div class="error-message">{{ $message }}</div>
                                                @enderror
                                                <label>Message </label>
                                                <textarea cols="40" rows="3" name="message" placeholder="Your Message:" style="height: 120px"></textarea>
                                                <button type="submit" class="btn float-btn color-bg fw-btn"> Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--box-widget end -->
                            <!--box-widget-->
                            <div class="box-widget fl-wrap">
                                <div class="box-widget-title fl-wrap">Featured Properties</div>
                                <div class="box-widget-content fl-wrap">
                                    <!--widget-posts-->
                                    <div class="widget-posts  fl-wrap">
                                        <ul class="no-list-style">
                                            @foreach ($featuredata as $property)
                                            <li>
                                                <div class="widget-posts-img"><a href="{{ route('pg.detail', ['id' => encode_string($property->id)]) }}"><img
                                                            src="{{ asset('uploads/payinguest/' . $property->thumbnail . '') }}" alt=""></a>
                                                </div>
                                                <div class="widget-posts-descr">
                                                    <h4><a href="{{ route('pg.detail', ['id' => encode_string($property->id)]) }}">{{ $property->name }}</a></h4>
                                                    <div class="geodir-category-location fl-wrap"><a href="#"><i
                                                                class="fas fa-map-marker-alt"></i> {{ $property->address }}</a></div>
                                                    {{-- <div class="widget-posts-descr-price"><span>Price: </span> $ 1500 / per
                                                        month</div> --}}
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- widget-posts end-->
                                    <a href="listing.html" class="btn float-btn color-bg small-btn">View All
                                        Properties</a>
                                </div>
                            </div>
                            <!--box-widget end -->
                        </div>
                        <!--  sidebar end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
