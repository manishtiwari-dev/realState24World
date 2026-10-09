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
                        <a href="{{ route('front.dashboardpg') }}" class="gradient-bg dashboard-addnew_btn"><i class="fal fa-plus"></i> ADD NEW PG PROPERTY</a>
                    </div>
                    <!-- dashboard-listings-wrap-->
                    <div class="dashboard-listings-wrap fl-wrap">
                        <div class="row">
                            @foreach($properties as $property)
                                <div class="col-md-6">
                                    <div class="dashboard-listings-item fl-wrap">
                                        <div class="smc-ribbon-wrapper">
                                            <div class="smc-ribbon {{ $property->status == 1 ? 'successverify' : '' }}">
                                                {{ $property->status == 1 ? 'Verified' : 'UN-Verified' }}
                                            </div>
                                        </div>
                                        <div class="dashboard-listings-item_img">
                                            <div class="bg-wrap">
                                                @if (empty($property->thumbnail))
                                                    <div class="bg" data-bg="{{ asset('uploads/property-img.jpg') }}"></div>
                                                @else
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/payinguest/' . $property->thumbnail) }}">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="overlay"></div>
                                            <a href="{{ route('pg.detail', ['id' => encode_string($property->id)]) }}" target="_blank" class="color-bg">View</a>
                                        </div>
                                        <div class="dashboard-listings-item_content" >
                                            <h4><a href="{{ route('pg.detail', ['id' => encode_string($property->id)]) }}" target="_blank">{{ $property->name }}</a></h4>
                                            <div class="geodir-category-location">
                                                <a href="{{ route('pg.detail', ['id' => encode_string($property->id)]) }}" target="_blank"><i class="fas fa-map-marker-alt"></i> <span>{{ $property->address }}</span></a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="listing-rating card-popup-rainingvis tolt" data-microtip-position="right" data-tooltip="Good" data-starrating2="{{ $property->average_rating }}"> </div>
                                            <div class="clearfix"></div>
                                            <div class="dashboard-listings-item_opt">
                                                <span class="viewed-counter"><i class="fas fa-eye"></i> Viewed - {{ $property->views ?? 0 }} </span>
                                                <ul>
                                                    {{-- <li><a href="{{ route('front.dashboardeditlisting', ['id' => encode_string($property->id)]) }}" class="tolt" data-microtip-position="top-left" data-tooltip="Edit"><i class="fas fa-edit"></i></a></li> --}}
                                                    <li><a href="{{ route('front.listing_pg_delete', $property->id) }}" class="tolt" onClick="if(confirm('Are you sure want to delete this data')){ return true;} else { return false; }" data-microtip-position="top-left" data-tooltip="Delete"><i class="fas fa-trash-alt"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
