@extends('front.agent.app')

@section('content')
    <!-- wrapper  -->

    <!-- content -->
    <div class="dashboard-content" style="padding: 40px 10px 60px 280px;">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
            @include('front.dashboard-title')

            <!-- dashboard-title end -->
            <div class="dasboard-wrapper fl-wrap">
                <div class="dasboard-listing-box fl-wrap">
                    <div class="dasboard-opt sl-opt fl-wrap">
                        <form method="GET" action="{{ route('front.dashboardlistingtable') }}">
                            <div class="dashboard-search-listing">
                                <input type="text" onclick="this.select()" placeholder="Search" name="search" value="{{ request('search') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <a href="{{ route('front.dashboardaddlisting') }}" class="gradient-bg dashboard-addnew_btn">Add New <i class="fal fa-plus"></i></a>
                            <div class="price-opt">
                                <span class="price-opt-title">Sort by:</span>
                                <div class="listsearch-input-item">
                                    <select name="sort_by" onchange="this.form.submit()" data-placeholder="Lastes"
                                        class="chosen-select no-search-select">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest
                                        </option>
                                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest
                                        </option>
                                        <option value="a-z" {{ request('sort_by') == 'a-z' ? 'selected' : '' }}>Name: A-Z
                                        </option>
                                        <option value="z-a" {{ request('sort_by') == 'z-a' ? 'selected' : '' }}>Name: Z-A
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- dashboard-listings-wrap-->
                    <div class="dashboard-listings-wrap fl-wrap">
                        <div class="row">
                            @forelse($properties as $property)
                                <div class="col-md-6">
                                    <div class="dashboard-listings-item fl-wrap">
                                        <div class="smc-ribbon-wrapper">
                                            <div class="smc-ribbon {{ $property->is_verified == 1 ? 'successverify' : '' }}">
                                                {{ $property->is_verified == 1 ? 'Verified' : 'UN-Verified' }}
                                            </div>
                                        </div>
                                        <div class="dashboard-listings-item_img">
                                            <div class="bg-wrap">
                                                @if (empty($property->thumbnail))
                                                    <div class="bg" data-bg="{{ asset('uploads/property-img.jpg') }}"></div>
                                                @else
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/properties/' . $property->thumbnail) }}">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="overlay"></div>
                                            <a href="{{ route('property.detail', $property->slug) }}" target="_blank" class="color-bg">View</a>
                                        </div>
                                        <div class="dashboard-listings-item_content">
                                            <h4><a href="{{ route('property.detail', $property->slug) }}" target="_blank">{{ $property->name }}</a></h4>
                                            <div class="geodir-category-location">
                                                <a href="{{ route('property.detail', $property->slug) }}" target="_blank"><i class="fas fa-map-marker-alt"></i> <span>{{ $property->address }}</span></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="right" data-tooltip="Good" data-starrating2="{{ $property->average_rating }}"> </div>
                                            <div class="clearfix"></div>
                                            <div class="dashboard-listings-item_opt">
                                                <span class="viewed-counter"><i class="fas fa-eye"></i> Viewed - {{ $property->views ?? 0 }} </span>
                                                <ul>
                                                    {{-- <li><a href="{{ route('front.dashboardeditlisting', ['id' => encode_string($property->id)]) }}" class="tolt" data-microtip-position="top-left" data-tooltip="Edit"><i class="fas fa-edit"></i></a></li> --}}
                                                    <li><a href="{{ route('front.listing_delete', $property->id) }}" class="tolt" onClick="if(confirm('Are you sure want to delete this data')){ return true;} else { return false; }" data-microtip-position="top-left" data-tooltip="Delete"><i class="fas fa-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No properties found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- pagination-->
                <div class="pagination float-pagination">
                    {{ $properties->links('vendor.pagination.custom') }}
                </div>
                <!-- pagination end-->
            </div>
        </div>
    </div>
@endsection
