@extends('front.layouts.app')
@section('titlename', $keyword)
@section('content')
    <div id="wrapper">
        <div class="content">
            <!--  section  -->
            <section class="hidden-section single-par2" data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem" data-bg="{{ asset('images/bg/3.jpg') }}"
                        data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Search:</span> <span style="text-transform: capitalize;"> {{ $keyword }}</span></h2>
                    </div>
                </div>
            </section>
            <!--  section  end-->
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ route('index') }}">Home</a> <span>{{ $keyword }}</span>
                    </div>

                </div>
            </div>
            <!-- breadcrumbs end -->
            <!-- col-list-wrap -->
            <section class="gray-bg small-padding ">
                <div class="container">
                    @if($properties->count() > 0)
                    <div class="row">
                        <!-- search sidebar-->
                        <div class="col-md-4">
                            <div class="mob-nav-content-btn  color-bg show-list-wrap-search ntm fl-wrap">Show Filters</div>
                            <div class="fl-wrap lws_mobile">
                                <div class="list-searh-input-wrap-title   fl-wrap"><i
                                        class="fas fa-sliders-h"></i><span>Search Filters</span></div>
                                <div class="block-box fl-wrap search-sb" id="filters-column">
                                    <!-- listsearch-input-item-->
                                    
                                    <!-- listsearch-input-item end-->
                                    <!-- listsearch-input-item -->
                                    <div class="listsearch-input-item">
                                        <label>Keywords</label>
                                        <input type="text" placeholder="Address , Street , State..." class="filteronInput keyword" />
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <div class="listsearch-input-item">
                                        <label>Status</label>
                                        <select data-placeholder="Status" class="chosen-select on-radius no-search-select filteronSelect status">
                                            <option value="">Any Status</option>
                                            <option value="1">For Rent</option>
                                            <option value="2">For Sale</option>
                                        </select>
                                    </div>
                                    <!-- listsearch-input-item -->
                                    <div class="listsearch-input-item">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Cities</label>
                                                <select data-placeholder="All Cities"
                                                    class="chosen-select on-radius no-search-select filteronSelect cities">
                                                    <option value="">All Cities</option>
                                                    @foreach($stateData as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Categories</label>
                                                <select data-placeholder="Categories"
                                                    class="chosen-select on-radius no-search-select filteronSelect category">
                                                    <option value="">All Categories</option>
                                                    <option value="all-residential" data-select2-id="7">All Residential</option>
                                                    <option value="flats-apartments" data-select2-id="16">Flats/Apartments</option>
                                                    <option value="house-villas" data-select2-id="17">House/Villas</option>
                                                    <option value="builder-floors" data-select2-id="18">Builder Floors</option>
                                                    <option value="farm-house" data-select2-id="19">Farm House</option>
                                                    <option value="residential-plots" data-select2-id="20">Residential Plots</option>
                                                    <option value="penthouse" data-select2-id="21">Penthouse</option>
                                                    <option value="studio-apartments" data-select2-id="22">Studio Apartments</option>
                                                    <option value="commercial" data-select2-id="23">Commercial</option>
                                                    <option value="plot" data-select2-id="24">Land/Plot</option>
                                                    <option value="industrial" data-select2-id="25">Industrial</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <!-- listsearch-input-item -->
                                    <div class="listsearch-input-item" style="display: none;">
                                        <div class="price-rage-items fl-wrap">
                                            <label>Price:</label>
                                            <!-- <input type="text" class="price-range-double" data-min="100" data-max="100000"  name="price-range2"  data-step="100" value="1" data-prefix="₹"> -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="chosen-select on-radius no-search-select">
                                                        <option>Min Budget</option>
                                                        <option>1000</option>
                                                        <option>2000</option>
                                                        <option>3000</option>
                                                        <option>4000</option>
                                                        <option>5000</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="chosen-select on-radius no-search-select">
                                                        <option>Max Budget</option>
                                                        <option>1000</option>
                                                        <option>2000</option>
                                                        <option>3000</option>
                                                        <option>4000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->

                                    <!-- listsearch-input-item -->
                                    <div class="listsearch-input-item">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Bedrooms</label>
                                                <select class="chosen-select no-search-select filteronSelect bedrooms">
                                                    <option value="">Select Bedroom</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Bathrooms</label>
                                                <select class="chosen-select no-search-select filteronSelect bathrooms">
                                                    <option value="">Select Bathroom</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <!-- listsearch-input-item -->
                                    <div class="listsearch-input-item">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Floors</label>
                                                <select class="chosen-select no-search-select filteronSelect floors">
                                                    <option value="">Select Floor</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <!-- listsearch-input-item-->
                                    <div class="listsearch-input-item">
                                        <label>Amenities</label>
                                        <div class=" fl-wrap filter-tags">
                                            <ul class="no-list-style">
                                                <li>
                                                    <input id="check-aa" type="checkbox" name="check" class="filteronClick elevator" value="elevator">
                                                    <label for="check-aa">Elevator in building</label>
                                                </li>
                                                <li>
                                                    <input id="check-b" type="checkbox" name="check" class="filteronClick laundry" value="laundry">
                                                    <label for="check-b"> Laundry Room</label>
                                                </li>
                                                <li>
                                                    <input id="check-c" type="checkbox" name="check" class="filteronClick kitchen" value="kitchen">
                                                    <label for="check-c">Equipped Kitchen</label>
                                                </li>
                                                <li>
                                                    <input id="check-d" type="checkbox" name="check" class="filteronClick ac" value="ac">
                                                    <label for="check-d">Air Conditioned</label>
                                                </li>
                                                <li>
                                                    <input id="check-d2" type="checkbox" name="check" class="filteronClick parking" value="parking">
                                                    <label for="check-d2">Parking</label>
                                                </li>
                                                <li>
                                                    <input id="check-d3" type="checkbox" name="check" class="filteronClick swimmingpool" value="swimmingpool">
                                                    <label for="check-d3">Swimming Pool</label>
                                                </li>
                                                <li>
                                                    <input id="check-d4" type="checkbox" name="check" class="filteronClick gym" value="gym">
                                                    <label for="check-d4">Fitness Gym</label>
                                                </li>
                                                <li>
                                                    <input id="check-d5" type="checkbox" name="check" class="filteronClick security" value="security">
                                                    <label for="check-d5">Security</label>
                                                </li>
                                                {{-- <li>
                                                    <input id="check-d6" type="checkbox" name="check" class="filteronClick garage" value="garage">
                                                    <label for="check-d6">Garage Attached</label>
                                                </li>
                                                <li>
                                                    <input id="check-d8" type="checkbox" name="check" class="filteronClick fireplace" value="fireplace">
                                                    <label for="check-d8">Fireplace</label>
                                                </li>
                                                <li>
                                                    <input id="check-d9" type="checkbox" name="check" class="filteronClick windowcovering" value="windowcovering">
                                                    <label for="check-d9">Window Covering</label>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- listsearch-input-item end-->
                                    <div class="msotw_footer">
                                        <div class="reset-form reset-btn"> <i class="fas fa-sync-alt"></i> Reset Filters
                                        </div>
                                    </div>
                                </div>
                                <a class="back-tofilters color-bg custom-scroll-link fl-wrap scroll-to-fixed-fixed"
                                    href="#filters-column">Back to filters <i class="fas fa-caret-up"></i></a>
                            </div>
                        </div>
                        <!-- search sidebar end-->
                        <div class="col-md-8">
                            <!-- list-main-wrap-header-->
                            <div class="list-main-wrap-header box-list-header fl-wrap">
                                <!-- list-main-wrap-title-->
                                <div class="list-main-wrap-title">
                                    <h2>Results For : <span> {{ $keyword }}</span><strong>{{ $countproperty }}</strong></h2>
                                </div>
                                <!-- list-main-wrap-title end-->
                                <!-- list-main-wrap-opt-->
                                <div class="list-main-wrap-opt">
                                    <!-- price-opt-->
                                    <div class="price-opt">
                                        <span class="price-opt-title">Sort by:</span>
                                        <div class="listsearch-input-item">
                                            <select id="sortSelect" class="nice-select">
                                                <option>Default</option>
                                                <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
                                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- price-opt end-->
                                    <!-- price-opt-->
                                    <div class="grid-opt">
                                        <ul class="no-list-style">
                                            <li class="grid-opt_act"><span class="one-col-grid act-grid-opt tolt"
                                                    data-microtip-position="bottom" data-tooltip="List View"><i
                                                        class="fas fa-list"></i></span></li>
                                            <li class="grid-opt_act"><span class="two-col-grid tolt"
                                                    data-microtip-position="bottom" data-tooltip="Grid View"><i
                                                        class="fas fa-th"></i></span></li>
                                        </ul>
                                    </div>
                                    <!-- price-opt end-->
                                </div>
                                <!-- list-main-wrap-opt end-->
                            </div>
                            <!-- list-main-wrap-header end-->
                            <!-- listing-item-wrap-->
                            <div class="listing-item-container box-list_ic fl-wrap filterResult">
                                @foreach ($properties as $property)
                                    <div class="listing-item has_one_column">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img fl-wrap">
                                                <a href="#" class="geodir-category-img_item">
                                                    @if (empty($property->thumbnail))
                                                        <img src="{{ asset('uploads/property-img.jpg') }}" alt="{{ $property->name }}" />
                                                    @else
                                                        <img src="{{ asset('uploads/properties/' . $property->thumbnail . '') }}" alt="{{ $property->name }}" />
                                                    @endif
                                                    <div class="overlay"></div>
                                                </a>
                                                <ul class="list-single-opt_header_cat">
                                                    <li><a href="#" class="cat-opt blue-bg">Sale</a></li>
                                                    <li><a href="#" class="cat-opt color-bg">{{ $property->type }}</a></li>
                                                </ul>
                                                <div class="geodir-category-listing_media-list">
                                                    <span><i class="fas fa-camera"></i> 8</span>
                                                </div>
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <h3 class="title-sin_item"><a href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a></h3>
                                                <div class="property-category-location">
                                                    <a href="#" class="single-map-item"><i class="fas fa-map-marker-alt"></i> <span> {{ $property->address }}</span></a>
                                                </div>
                                                <div class="geodir-category-content_price">₹ {{ number_format($property->amount, 2) }} / {{ $property->amount_type ?? '' }}</div>
                                                <p>{{ \Illuminate\Support\Str::words(strip_tags($property->description), 10, '...') }}</p>
                                                <div class="geodir-category-content-details">
                                                    <ul>
                                                        <li><i class="fal fa-bed"></i><span>{{ $property->bedrooms }}</span> </li>
                                                        <li><i class="fal fa-bath"></i><span>{{ $property->bathrooms }}</span> </li>
                                                        <li><i class="fal fa-cube"></i><span>{{ $property->area }} ft</span></li>
                                                    </ul>
                                                </div>
                                                <div class="geodir-category-footer fl-wrap">
                                                    <a href="#" class="gcf-company">
                                                        @if (!empty($property->dealer))
                                                            <img src="{{ asset('uploads/dealer/' . $property->dealer->profile_photo . '') }}" alt="{{ $property->dealer->name }}">
                                                        @else
                                                            <img src="{{ asset('uploads/blank-img.png') }}" alt="realState24world">
                                                        @endif
                                                        @if (!empty($property->dealer))
                                                            <span> By {{ $property->dealer->name }}</span>
                                                        @else
                                                            <span> By realState24world</span>
                                                        @endif
                                                    </a>
                                                    <div class="agent-contact-boc">
                                                        @if (!empty($property->dealer->id)) 
                                                        <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="{{ $property->dealer->id }}" data-property="{{ $property->id }}">View Number</a>
                                                        <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="{{ $property->dealer->id }}" data-property="{{ $property->id }}"><i class="fal fa-phone-alt"></i> Contact</a>
                                                        @else
                                                        <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}">View Number</a>
                                                        <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}"><i class="fal fa-phone-alt"></i> Contact</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                                {{ $properties->appends(request()->query())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <h4>No properties found in this category.</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        document.getElementById('sortSelect').addEventListener('change', function () {
            let sortValue = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        });
        //filter
        $(document).ready(function(){
            //filterSearch();	
            $('.filteronClick').click(function(){
                filterSearch();
            });	
            $('.filteronSelect').change(function(){
                filterSearch();
            });	
            $('.filteronInput').on('input', function(){
                filterSearch();
            });		
        });
        function filterSearch() {
            $('.filterResult').html('<div id="loading">Loading .....</div>');
            var action = 'fetch_data';
            var keyword = $('.keyword').val();
            var status = $('.status').val();
            var cities = $('.cities').val();
            var category = $('.category').val();
            var bedrooms = $('.bedrooms').val(); 
            var bathrooms = $('.bathrooms').val();
            var floors = $('.floors').val();
            var elevator = getFilterData('elevator');
            var laundry = getFilterData('laundry');
            var kitchen = getFilterData('kitchen');
            var ac = getFilterData('ac');
            $.ajax({
                url:"{{ route('property.filter') }}",
                method:"POST",
                dataType: "json",		
                data:{ keyword:keyword, status:status, cities:cities, category:category, elevator:elevator, laundry:laundry, kitchen:kitchen, ac:ac, bedrooms:bedrooms, bathrooms:bathrooms, floors:floors},
                success:function(data){
                    $('.filterResult').html(data.html);
                }
            });
        }
        function getFilterData(className) {
            var filter = [];
            $('.'+className+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }
    </script>
@endsection
