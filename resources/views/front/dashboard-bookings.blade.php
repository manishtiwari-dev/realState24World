@extends('front.agent.app')

@section('content')
    <!-- wrapper  -->

    <!-- content -->
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
            @include('front.dashboard-title')
            <div class="dasboard-wrapper fl-wrap">
                <div class="dasboard-widget-title fl-wrap">
                    <h5><i class="fal fa-comments-alt"></i>Last Bookings</h5>
                </div>
                <div class="dasboard-widget-box fl-wrap">
                    <div class="dasboard-opt fl-wrap">
                        <form method="GET" action="{{ route('front.dashboardbookings') }}">
                            <div class="price-opt">
                                <span class="price-opt-title">Sort by:</span>
                                <div class="listsearch-input-item">
                                    <select name="sort_by" onchange="this.form.submit()" data-placeholder="Lastes" class="chosen-select no-search-select">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest </option>
                                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest </option>
                                    </select>
                                </div>
                            </div>
                            <!-- price-opt end-->
                        </form>
                    </div>
                    <div class="row">
                        @forelse($propertyenquiry as $data)
                            <div class="col-md-6">
                                <div class="bookings-item fl-wrap">
                                    <div class="bookings-item-header fl-wrap">
                                         @if (empty($data->property->thumbnail))
                                            <img src="{{ asset('uploads/property-img.jpg') }}" alt="Thumbnail">
                                        @else
                                            <img src="{{ asset('uploads/properties/' . $data->property->thumbnail) }}" alt="Thumbnail">
                                        @endif
                                        <h4>For <a href="#" target="_blank">{{$data->property->name}}</a></h4>
                                        <span class="new-bookmark">New</span>
                                    </div>
                                    <div class="bookings-item-content fl-wrap">
                                        <ul>
                                            <li>Name: <span>{{$data->name}}</span></li>
                                            <li>Phone: <span>{{$data->phone}}</span></li>
                                            <li>Date: <span>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</span></li>
                                            <li>Time: <span>{{ \Carbon\Carbon::parse($data->created_at)->timezone('Asia/Kolkata')->format('h:i A') }}</span></li>
                                        </ul>
                                        <p>{{$data->message}}</p>
                                    </div>
                                    <div class="bookings-item-footer fl-wrap">
                                        <span class="message-date">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</span>
                                        <ul>
                                            <li><a href="mailto:{{ $data->email }}" class="tolt" data-microtip-position="top-left" data-tooltip="Write"><i class="fas fa-envelope"></i></a></li>
                                            <li><a href="tel:{{ $data->phone }}" class="tolt" data-microtip-position="top-left" data-tooltip="Call"><i class="fas fa-phone"></i></a></li>
                                            <li><a href="{{ route('front.booking_delete', $data->id) }}" class="tolt" data-microtip-position="top-left"  onClick="if(confirm('Are you sure want to delete this data')){ return true;} else { return false; }" data-tooltip="Delete"><i class="fas fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No bookings found.</p>
                        @endforelse
                    </div>
                </div>
                <div class="pagination float-pagination">
                    {{ $propertyenquiry->links('vendor.pagination.custom') }}
                </div>

            </div>
        </div>

    </div>
@endsection


