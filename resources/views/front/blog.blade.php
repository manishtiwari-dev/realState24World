@extends('front.layouts.app')
@section('titlename', 'Blog')
@section('content')
    <div id="wrapper">
        <div class="content">
            <!--  section  -->
            <section class="hidden-section single-par2  " data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem" data-bg="{{ asset('images/bg/3.jpg') }}" data-scrollax="properties: { translateY: '30%' }"></div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Blog</span></h2>
                    </div>
                </div>
            </section>
            <!--  section  end-->
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a> <span>Blog</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs end -->
            <!-- col-list-wrap -->
            <div class="gray-bg small-padding fl-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="post-container fl-wrap">
                                <article class="post-article fl-wrap">
                                    @if (!empty($blogs))
                                        <div class="list-single-main-media fl-wrap">
                                            <div class="single-slider-wrapper carousel-wrap fl-wrap">
                                                    <div class="single-slider fl-wrap carousel lightgallery">
                                                        @foreach ($blogs as $blog)
                                                            <div class="slick-slide-item">
                                                                <div class="box-item">
                                                                    <a href="{{ asset('uploads/blog/' . $blog->thumbnail) }}"
                                                                        class="gal-link popup-image"><i
                                                                            class="fal fa-search"></i></a>
                                                                    <img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}"
                                                                        alt="{{ $blog->thumbnail_alt }}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                <div class="swiper-button-prev ssw-btn"><i class="fas fa-caret-left"></i></div>
                                                <div class="swiper-button-next ssw-btn"><i class="fas fa-caret-right"></i></div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($blogData))
                                        @foreach ($blogData as $blog)
                                            @if ($loop->first)
                                                <div class="list-single-main-item fl-wrap block_box">
                                                    <h2 class="post-opt-title"><a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a> </h2>
                                                    <p>{{ \Illuminate\Support\Str::words($blog->subtitle, 100, '...') }}</p>
                                                    <span class="fw-separator fl-wrap"></span>
                                                    <div class="post-author"><a href="#"><img src="images/blank-img.jpg" alt=""><span>By {{ $blog->author }}</span></a></div>
                                                    <div class="post-opt">
                                                        <ul class="no-list-style">
                                                            <li><i class="fal fa-calendar"></i> <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span> </li>
                                                            <li><i class="fal fa-tags"></i>
                                                                @if (!empty($blog->tags))
                                                                    @foreach ($blog->tags as $tag)
                                                                        <a>{{ $tag->name }}</a>,
                                                                    @endforeach
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <a href="{{ route('blog.detail', $blog->slug) }}" class="btn color-bg float-btn small-btn">Read more</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </article>
                                @if (!empty($blogData))
                                    @foreach ($blogData as $blog)
                                        @if ($loop->first)
                                            @continue
                                        @endif
                                        <article class="post-article fl-wrap">
                                            <div class="list-single-main-media fl-wrap">
                                                <img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}" class="respimg" alt="{{ $blog->thumbnail_alt }}">
                                            </div>
                                            <div class="list-single-main-item fl-wrap block_box">
                                                <h2 class="post-opt-title"><a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a> </h2>
                                                <p>{{ \Illuminate\Support\Str::words($blog->subtitle, 100, '...') }}</p>
                                                <span class="fw-separator fl-wrap"></span>
                                                <div class="post-author"><a href="#"><img src="{{ asset('images/blank-img.jpg') }}"><span>By {{ $blog->author }}</span></a></div>
                                                <div class="post-opt">
                                                    <ul class="no-list-style">
                                                        <li><i class="fal fa-calendar"></i> <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span> </li>
                                                        <li><i class="fal fa-tags"></i>
                                                            @if (!empty($blog->tags))
                                                                @foreach ($blog->tags as $tag)
                                                                    <a>{{ $tag->name }}</a>,
                                                                @endforeach
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('blog.detail', $blog->slug) }}" class="btn color-bg float-btn small-btn">Read more</a>
                                            </div>
                                        </article>
                                    @endforeach
                                    <div class="pagination">
                                        {{ $blogData->links('vendor.pagination.custom') }}
                                    </div>
                                @else
                                    <div class="col-12">
                                        <p>No blog posts found.</p>
                                    </div>
                                @endif
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
                                            <input name="search" id="search" type="text" class="search" placeholder="Search.." value={{ request('search') }}>
                                            <button class="search-submit" id="submit_btn"><i class="fa fa-search"></i></button>
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
                                                            <div class="widget-posts-img"><a href="{{ route('blog.detail', $blog->slug) }}"><img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}" alt="{{ $blog->thumbnail_alt }}"></a>
                                                            </div>
                                                            <div class="widget-posts-descr">
                                                                <h4><a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                                                                </h4>
                                                                <div class="geodir-category-location fl-wrap">
                                                                    <a href="#"><i class="fal fa-calendar"></i>
                                                                        {{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}
                                                                    </a>
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
                                    <div class="box-widget-title fl-wrap">Tags</div>
                                    <div class="box-widget-content fl-wrap">
                                        <div class="list-single-tags fl-wrap tags-stylwrap" style="margin-top: 20px;">
                                            @if (!empty($blogs_tag))
                                                @foreach ($blogs_tag as $tag)
                                                    <a href="#">{{ $tag->name }}</a>
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
