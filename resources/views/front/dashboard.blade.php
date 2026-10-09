@extends('front.agent.app')

@section('content')
    <!-- wrapper  -->

    <!-- content -->
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
             @include('front.dashboard-title')
            <!-- dashboard-title end -->
            <div class="dasboard-wrapper fl-wrap no-pag">
                <div class="dashboard-stats-container fl-wrap">
                    <div class="row">
                        <!--dashboard-stats-->
                        <div class="col-md-3">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-map-marked"></i>
                                <h4>Active Listings</h4>
                                <div class="dashboard-stats-count">{{$total_active_property ?? ''}}</div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                        <!--dashboard-stats-->
                        <div class="col-md-3">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-chart-bar"></i>
                                <h4>Listing Views</h4>
                                <div class="dashboard-stats-count">{{$total_property ?? ''}}<span></span></div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                        <!--dashboard-stats-->
                        <div class="col-md-3">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-comments-alt"></i>
                                <h4>Your Reviews</h4>
                                <div class="dashboard-stats-count">{{$total_review ?? ''}}<span></span></div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                        <!--dashboard-stats-->
                        <div class="col-md-3">
                            <div class="dashboard-stats fl-wrap">
                                <i class="fal fa-heart"></i>
                                <h4>Bookings</h4>
                                <div class="dashboard-stats-count">{{$total_booking ?? ''}}<span></span></div>
                            </div>
                        </div>
                        <!-- dashboard-stats end -->
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard-widget-title fl-wrap">Last Activites</div>
                        <div class="dashboard-list-box fl-wrap">
                            @if(!empty($latest_property))
                                @foreach ($latest_property as $property)
                                    <div class="dashboard-list fl-wrap">
                                        <div class="dashboard-message">
                                            {{-- <span class="close-dashboard-item color-bg"><i class="fal fa-times"></i></span> --}}
                                            <div class="main-dashboard-message-icon color-bg"><i class="fas fa-check"></i></div>
                                            <div class="main-dashboard-message-text">
                                                <p>Your listing <a href="#">{{$property->name}}</a> has been @if($property->is_verified == 1)approved! @else is pending for approval...! @endif </p>
                                            </div>
                                            <div class="main-dashboard-message-time"><i class="fal fa-calendar-week"></i> {{ \Carbon\Carbon::parse($property->created_at)->format('d M Y') }} </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
