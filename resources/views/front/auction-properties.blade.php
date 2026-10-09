@extends('front.layouts.app')
@section('titlename', 'Auction Property')
@section('content')
    <div id="wrapper">
        <div class="content">
            <section class="hidden-section single-par2" data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem" data-bg="{{ asset('images/auction.webp') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Auction Property</span></h2>
                    </div>
                </div>
            </section>
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ route('index') }}">Home</a> <span>Auction Property</span>
                    </div>
                </div>
            </div>
            <section class="gray-bg small-padding ">
                <div class="container">
                    @if ($auctionproperties->count() > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="list-main-wrap-header box-list-header fl-wrap">
                                    <div class="list-main-wrap-title">
                                        <h2><span> {{ count($auctionproperties) }} Results | <span>Auction Property</span> </h2>
                                    </div>
                                    <div class="list-main-wrap-opt">
                                        <div class="price-opt">
                                            <span class="price-opt-title">Sort by:</span>
                                            <div class="listsearch-input-item">
                                                <select id="sortSelect" class="nice-select">
                                                    <option>Default</option>
                                                    <option value="popularity"
                                                        {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity
                                                    </option>
                                                    <option value="price_low"
                                                        {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to
                                                        High</option>
                                                    <option value="price_high"
                                                        {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High
                                                        to Low</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid-opt">
                                            <ul class="no-list-style">
                                                <li class="grid-opt_act"><span class="one-col-grid tolt" data-microtip-position="bottom" data-tooltip="List View"><i class="fas fa-list"></i></span></li>
                                                <li class="grid-opt_act"><span class="two-col-grid act-grid-opt tolt" data-microtip-position="bottom" data-tooltip="Grid View"><i class="fas fa-th"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="listing-item-container box-list_ic fl-wrap filterResult">
                                    @foreach ($auctionproperties as $property)
                                        <div class="listing-item has_two_column">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap">
                                                    <a href="{{ route('auction.detail', $property->slug) }}" class="geodir-category-img_item">
                                                        @if (empty($property->thumbnail))
                                                            <img src="{{ asset('uploads/property-img.jpg') }}" alt="{{ $property->name }}" />
                                                        @else
                                                            <img src="{{ asset('uploads/auction/' . $property->thumbnail . '') }}" alt="{{ $property->name }}" />
                                                        @endif
                                                        <div class="overlay"></div>
                                                    </a>
                                                    <ul class="list-single-opt_header_cat">
                                                        <li><a href="#" class="cat-opt color-bg">{{ $property->type }}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <h3 class="title-sin_item"><a href="{{ route('auction.detail', $property->slug) }}">{{ $property->name }}</a>
                                                    </h3>
                                                    <div class="property-category-location">
                                                        <a href="#" class="single-map-item"> <span> {{ $property->address }}</span></a>
                                                    </div>
                                                    <div class="geodir-category-content_price">₹ {{ number_format($property->amount) }}</div>
                                                    <p>{{ \Illuminate\Support\Str::words(strip_tags($property->description), 40, '...') }}
                                                    </p>
                                                    
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="#" class="gcf-company">
                                                            @if (!empty($property->dealer))
                                                                <img src="{{ asset('uploads/dealer/' . $property->dealer->profile_photo . '') }}" alt="{{ $property->dealer->name }}">
                                                            @else
                                                                <img src="{{ asset('uploads/blank-img.png') }}"  alt="realState24world">
                                                            @endif
                                                            @if (!empty($property->dealer))
                                                                <span> By {{ $property->dealer->name }}</span>
                                                            @else
                                                                <span> By realState24world</span>
                                                            @endif
                                                        </a>
                                                        <div class="agent-contact-boc">
                                                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}">View Number</a>
                                                            <a href="#" class="btn color-bg small-btn openPopupBtn" data-id="realState24world" data-property="{{ $property->id }}"><i class="fal fa-phone-alt"></i> Contact</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                    {{ $auctionproperties->appends(request()->query())->links('pagination::bootstrap-4') }}
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
        document.getElementById('sortSelect').addEventListener('change', function() {
            let sortValue = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        });
        //filter
        $(document).ready(function() {
            //filterSearch();	
            $('.filteronClick').click(function() {
                filterSearch();
            });
            $('.filteronSelect').change(function() {
                filterSearch();
            });
            $('.filteronInput').on('input', function() {
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
                url: "{{ route('property.filter') }}",
                method: "POST",
                dataType: "json",
                data: {
                    keyword: keyword,
                    status: status,
                    cities: cities,
                    category: category,
                    elevator: elevator,
                    laundry: laundry,
                    kitchen: kitchen,
                    ac: ac,
                    bedrooms: bedrooms,
                    bathrooms: bathrooms,
                    floors: floors
                },
                success: function(data) {
                    $('.filterResult').html(data.html);
                }
            });
        }

        function getFilterData(className) {
            var filter = [];
            $('.' + className + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }
    </script>
@endsection
