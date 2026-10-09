@extends('front.layouts.app')
@section('titlename', 'Project')
@section('content')
    <div id="wrapper">
        <!-- content -->
        <div class="content">

            <!--  section  -->
            <section class="hidden-section single-par2" data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem " data-bg="images/bg/3.jpg" data-scrollax="properties: { translateY: '30%' }">
                    </div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>List of Our Project's</span></h2>

                    </div>

                </div>
            </section>
            <!--  section  end-->
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a> <span>Project</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs end -->
            <section class="gray-bg small-padding ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-main-wrap-header box-list-header fl-wrap">

                                <div class="list-main-wrap-title">
                                    <h2>Results For : <span>Project's </span><strong>{{ $agents->total() }}</strong></h2>
                                </div>

                                <div class="list-main-wrap-opt">
                                    <form method="GET" action="{{ route('project') }}">
                                        <div class="price-opt">
                                            <span class="price-opt-title">Sort by:</span>
                                            <div class="listsearch-input-item">
                                                <select name="sort_by" onchange="this.form.submit()"
                                                    data-placeholder="Popularity" class="chosen-select no-search-select">
                                                    
                                                    <option value="popularity"
                                                        {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Popularity
                                                    </option>
                                                    <option value="rating"
                                                        {{ request('sort_by') == 'rating' ? 'selected' : '' }}>Average rating
                                                    </option>
                                                    <option value="a-z"
                                                        {{ request('sort_by') == 'a-z' ? 'selected' : '' }}>
                                                        Name: A-Z
                                                    </option>
                                                    <option value="z-a"
                                                        {{ request('sort_by') == 'z-a' ? 'selected' : '' }}>
                                                        Name: Z-A
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>

                            <!-- listing-item-wrap-->
                            <div class="listing-item-container  box-list_ic fl-wrap agent-sec-page">

                                @if (!empty($agents))
                                    @foreach ($agents as $user)
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap  agent_card">
                                                    <a href="{{ route('project.detail', ['id' => encode_string($user->id)]) }}"
                                                        class="geodir-category-img_item">
                                                        @if (empty($user->company_logo))
                                                            <img src="images/agency/2.png" alt="">
                                                        @else
                                                            <img src="{{ asset('uploads/project/' . $user->company_logo . '') }}"
                                                                alt="">
                                                        @endif

                                                        <ul class="list-single-opt_header_cat">
                                                            <li><span
                                                                    class="cat-opt color-bg">{{ $user->property->count() ?? 0 }}
                                                                    listings</span></li>
                                                        </ul>
                                                    </a>

                                                    <div class="listing-rating card-popup-rainingvis"
                                                        data-starrating2="{{ $user->average_rating }}"><span
                                                            class="re_stars-title">
                                                            @if ($user->average_rating == 5)
                                                                Excellent
                                                            @elseif($user->average_rating == 4)
                                                                Good
                                                            @elseif($user->average_rating == 3)
                                                                Fair
                                                            @elseif($user->average_rating == 2)
                                                                Average
                                                            @elseif($user->average_rating == 1)
                                                                Very Bad
                                                            @else
                                                            @endif
                                                        </span></div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap">
                                                    <div class="card-verified tolt" data-microtip-position="left"
                                                        data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                                    <div class="agent_card-title fl-wrap">
                                                        <h4><a
                                                                href="{{ route('project.detail', ['id' => encode_string($user->id)]) }}">{{ $user->name }}</a>
                                                        </h4>
                                                        <h5><a href="#">{{ $user->company_name }}</a></h5>
                                                    </div>
                                                    <p>{{ $user->about }}</p>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <a href="{{ route('project.detail', ['id' => encode_string($user->id)]) }}"
                                                            class="btn float-btn color-bg small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endforeach
                                @endif




                            </div>
                            <!-- listing-item-wrap end-->
                            <!-- pagination-->
                            <div class="pagination">
                                {{ $agents->links('vendor.pagination.custom') }}
                            </div>
                            <!-- pagination end-->
                        </div>
                        <!-- col-md 8 end -->

                    </div>
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
        </div>
    </div>
@endsection
