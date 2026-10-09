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
            <div class="dasboard-wrapper fl-wrap">
                <div class="dasboard-widget-title fl-wrap">
                    <h5><i class="fal fa-comments-alt"></i>Last Reviews</h5>
                    <!-- <a href="#" class="mark-btn  tolt" data-microtip-position="bottom" data-tooltip="Mark all as read"><i class="far fa-comment-alt-check"></i> </a> -->
                </div>
                <div class="dasboard-widget-box fl-wrap">
                    <div class="dasboard-opt fl-wrap">
                       
                        <form method="GET" action="{{ route('front.dashboardreview') }}">
                            <div class="price-opt">
                                <span class="price-opt-title">Sort by:</span>
                                <div class="listsearch-input-item">
                                    <select name="sort_by" onchange="this.form.submit()" data-placeholder="Lastes"
                                        class="chosen-select no-search-select">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest
                                        </option>
                                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>


                    @forelse($propertyreview as $data)
                        <div class="reviews-comments-item">
                            <div class="review-comments-avatar">
                                <img src="images/blank-img.jpg" alt="">
                                <div class="review-notifer">New</div>
                            </div>
                            <div class="reviews-comments-item-text smpar">

                                <h4><a href="#">{{ $data->name }} <span>{{$data->property->name}} </span></a></h4>
                                <div class="listing-rating card-popup-rainingvis" data-starrating2="{{ $data->rating }}">
                                    <span class="re_stars-title">
                                        @if ($data->rating == 5)
                                            Excellent
                                        @elseif($data->rating == 4)
                                            Good
                                        @elseif($data->rating == 3)
                                            Fair
                                        @elseif($data->rating == 2)
                                            Average
                                        @elseif($data->rating == 1)
                                            Very Bad
                                        @else
                                        @endif
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                                <p>{{ $data->comment }}</p>
                                <div class="reviews-comments-item-date"><span class="reviews-comments-item-date-item"><i
                                            class="far fa-calendar-check"></i>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span></div>
                            </div>
                        </div>
                    @empty
                        <p>No Review found.</p>
                    @endforelse



                    <!--reviews-comments-item end-->
                </div>
                <!-- pagination-->
                <div class="pagination float-pagination">
                    {{ $propertyreview->links('vendor.pagination.custom') }}
                    {{-- <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                    <a href="#">1</a>
                    <a href="#" class="current-page">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a> --}}
                </div>
                <!-- pagination end-->
            </div>
        </div>

    </div>
    <!-- content end -->
@endsection
