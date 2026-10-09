@extends('front.layouts.app')
@section('titlename', $blog_detail->title ?? 'Blog Detail')
@section('content')
    <div id="wrapper">
        <div class="content">
            <section class="hidden-section single-par2" data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem" data-bg="{{ asset('images/bg/3.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title"> <h2><span>Blog Detail</span></h2> </div>
                </div>
            </section>
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a> <span>Blog Detail</span>
                    </div>
                </div>
            </div>
            <div class="gray-bg small-padding fl-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="post-container fl-wrap">
                                <article class="post-article fl-wrap">
                                    <div class="list-single-main-media fl-wrap">
                                        <div class="single-slider-wrapper carousel-wrap fl-wrap">
                                            <div class="single-slider fl-wrap carousel lightgallery">
                                                @php
                                                    use Illuminate\Support\Facades\File;
                                                    $images = json_decode($blog_detail->multiple_images);
                                                @endphp
                                                @if (!empty($images))
                                                    @php $hasValidImage = false; @endphp
                                                    @foreach ($images as $image)
                                                        @php
                                                            $imagePath = public_path('uploads/blog/' . $image);
                                                        @endphp
                                                        @if (File::exists($imagePath))
                                                            @php $hasValidImage = true; @endphp
                                                            <div class="slick-slide-item">
                                                                <div class="box-item">
                                                                    <a href="{{ asset('uploads/blog/' . $image) }}"
                                                                        class="gal-link popup-image"><i
                                                                            class="fal fa-search"></i></a>
                                                                    <img src="{{ asset('uploads/blog/' . $image) }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if (!$hasValidImage)
                                                        <div class="slick-slide-item">
                                                            <div class="box-item">
                                                                <a href="{{ asset('uploads/property-img.jpg') }}" class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                                <img src="{{ asset('uploads/property-img.jpg') }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="slick-slide-item">
                                                        <div class="box-item">
                                                            <a href="{{ asset('uploads/property-img.jpg') }}" class="gal-link popup-image"><i class="fal fa-search"></i></a>
                                                            <img src="{{ asset('uploads/property-img.jpg') }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="swiper-button-prev ssw-btn"><i class="fas fa-caret-left"></i></div>
                                            <div class="swiper-button-next ssw-btn"><i class="fas fa-caret-right"></i></div>
                                        </div>
                                    </div>
                                    <div class="list-single-main-item fl-wrap block_box">
                                        <div class="single-article-header fl-wrap">
                                            <h2 class="post-opt-title">{{ $blog_detail->title ?? '' }}</h2>
                                            <span class="fw-separator"></span>
                                            <div class="clearfix"></div>
                                            <div class="post-author"><a href="#"><img src="{{ asset('images/blank-img.jpg') }}"><span>{{ $blog_detail->author }}</span></a></div>
                                            <div class="post-opt">
                                                <ul class="no-list-style">
                                                    <li><i class="fal fa-calendar"></i> <span>{{ \Carbon\Carbon::parse($blog_detail->date)->format('d M Y') }}</span> </li>
                                                    <li><i class="fal fa-tags"></i>
                                                        @if (!empty($tagData))
                                                            @foreach ($tagData as $tag)
                                                                <a>{{ $tag->name }}</a>,
                                                            @endforeach
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <span class="fw-separator fl-wrap"></span>
                                        <p>{!! $blog_detail->description !!} </p>
                                        <div class="clearfix"></div>
                                        <span class="fw-separator fl-wrap"></span>
                                        <div class="list-single-tags tags-stylwrap">
                                            <span class="tags-title"> Tags : </span>
                                            @if (!empty($blogs_tag))
                                                @foreach ($blogs_tag as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </article>
                                <!-- article end -->
                                <!--content-nav_holder-->
                                <div class="content-nav_holder fl-wrap color-bg">
                                    <div class="content-nav">
                                        <ul>
                                            <li>
                                                @if (!empty($prevBlog))
                                                    <a href="{{ route('blog.detail', $prevBlog->slug) }}" class="ln">
                                                        <i class="fal fa-long-arrow-left"></i> <span>Prev <strong>- {{ $prevBlog->title }}</strong></span>
                                                    </a>
                                                    <div class="content-nav-media">
                                                        <div class="bg" data-bg="{{ asset('uploads/blog/' . $prevBlog->thumbnail) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                            <li>
                                                @if (!empty($nextBlog))
                                                    <a href="{{ route('blog.detail', $nextBlog->slug) }}" class="rn">
                                                        <span>Next <strong>- {{ $nextBlog->title }}</strong></span>
                                                        <i class="fal fa-long-arrow-right"></i>
                                                    </a>
                                                    <div class="content-nav-media">
                                                        <div class="bg" data-bg="{{ asset('uploads/blog/' . $nextBlog->thumbnail) }}"> </div>
                                                    </div>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- col-md 8 end -->
                        <!--  sidebar-->
                        <div class="col-md-4">
                            <div class="box-widget-wrap fl-wrap fixed-bar">
                                <!--box-widget-->
                                <div class="box-widget fl-wrap">
                                    <div class="search-widget fl-wrap">
                                        <form action="{{ route('blog') }}" class="fl-wrap custom-form" method="GET">
                                            <input name="search" id="se" type="text" class="search" placeholder="Search.." value="{{ request('search') }}" />
                                            <button class="search-submit" id="submit_btn"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!--box-widget end -->
                                <!--box-widget-->
                                <div class="box-widget fl-wrap">
                                    <div class="box-widget-title fl-wrap">Popular Posts</div>
                                    <div class="box-widget-content fl-wrap">
                                        <div class="widget-posts  fl-wrap">
                                            <ul class="no-list-style">
                                                @if (!empty($popularBlog))
                                                    @foreach ($popularBlog as $blog)
                                                        <li>
                                                            <div class="widget-posts-img">
                                                                <a href="{{ route('blog.detail', $blog->slug) }}">
                                                                    <img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}">
                                                                </a>
                                                            </div>
                                                            <div class="widget-posts-descr">
                                                                <h4>
                                                                    <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }} </a>
                                                                </h4>
                                                                <div class="geodir-category-location fl-wrap">
                                                                    <a href="#"><i class="fal fa-calendar"></i> {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--box-widget end -->
                                <!--box-widget-->
                                <div class="box-widget fl-wrap">
                                    <div class="banner-widget fl-wrap">
                                        <div class="bg-wrap bg-parallax-wrap-gradien">
                                            <div class="bg" data-bg="{{ asset('images/all/blog/1.jpg') }}"></div>
                                        </div>
                                        <div class="banner-widget_content">
                                            <h5>Do you want to join our real estate network?</h5>
                                            <a href="{{ route('register') }}" class="btn float-btn color-bg small-btn">Become an Agent</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-widget fl-wrap">
                                    <div class="box-widget-title fl-wrap">Tags</div>
                                    <div class="box-widget-content fl-wrap">
                                        <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 20px;">
                                            @if (!empty($blogs_tag))
                                                @foreach ($blogs_tag as $tag)
                                                    <a>{{ $tag->name }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="limit-box fl-wrap"></div>
        </div>
    </div>
@endsection
