@extends('front.layouts.app')
@section('titlename', 'FAQ')
@section('content')
    <div id="wrapper">
        <!-- content -->
        <div class="content">
            <!--  section  -->
            <section class="hidden-section single-par2  " data-scrollax-parent="true">
                <div class="bg-wrap bg-parallax-wrap-gradien">
                    <div class="bg par-elem " data-bg="images/bg/5.jpg" data-scrollax="properties: { translateY: '30%' }">
                    </div>
                </div>
                <div class="container">
                    <div class="section-title center-align big-title">
                        <h2><span>Frequently Asked Questions</span></h2>

                    </div>

                </div>
            </section>
            <!--  section  end-->
            <!-- breadcrumbs-->
            <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
                <div class="container">
                    <div class="breadcrumbs-list">
                        <a href="{{ url('/') }}">Home</a> <span>Help FAQ</span>
                    </div>

                </div>
            </div>
            <!-- breadcrumbs end -->
            <!-- col-list-wrap -->
            <section class="gray-bg small-padding ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box-widget fl-wrap fixed-column_menu-init">
                                <div class="box-widget-content fl-wrap">
                                    <div class="box-widget-title fl-wrap">FAQ Navigation</div>
                                    <div class="faq-nav scroll-init fl-wrap">
                                        <ul>
                                            <li><a class="act-scrlink" href="#faq1">Payments</a></li>
                                            <li><a href="#faq2">Suggestions</a></li>
                                            <li><a href="#faq3">Reccomendations</a></li>
                                            <li><a href="#faq4">Booking</a></li>
                                            <li><a href="#faq5">Listing</a></li>
                                        </ul>
                                    </div>
                                    <!-- <div class="search-widget fns fl-wrap">
                                                        <form action="#" class="fl-wrap custom-form">
                                                            <input name="se" id="se" type="text" class="search" placeholder="Keywords" value="" />
                                                            <button class="search-submit" id="submit_btn"><i class="far fa-search"></i></button>
                                                        </form>
                                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="list-single-main-container">
                                <!--   list-single-main-item -->
                                <div class="list-single-main-item fl-wrap" id="faq1">
                                    <div class="list-single-main-item-title big-lsmt fl-wrap">
                                        <h3>Payments</h3>
                                    </div>

                                    {{-- @dd($faq) --}}
                                    @if (!empty($faq))
                                        @foreach ($faq as $item)
                                            @if ($item->navigation_type == 1)
                                                <div class="accordion-lite-container fl-wrap">
                                                    <div class="accordion-lite-header fl-wrap">{{ $item->question }}
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="accordion-lite_content fl-wrap">
                                                        <p>{{ $item->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif




                                </div>
                              
                                <div class="list-single-main-item fl-wrap" id="faq2">
                                    <div class="list-single-main-item-title big-lsmt fl-wrap">
                                        <h3>Suggestions</h3>
                                    </div>
                                    <!--   accordion-lite -->
                                         @if (!empty($faq))
                                        @foreach ($faq as $item)
                                            @if ($item->navigation_type == 2)
                                                <div class="accordion-lite-container fl-wrap">
                                                    <div class="accordion-lite-header fl-wrap">{{ $item->question }}
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="accordion-lite_content fl-wrap">
                                                        <p>{{ $item->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif



                                 
                                </div>
                               
                                <div class="list-single-main-item fl-wrap" id="faq3">
                                    <div class="list-single-main-item-title big-lsmt fl-wrap">
                                        <h3>Reccomendations</h3>
                                    </div>
                                    <!--   accordion-lite -->
                                        @if (!empty($faq))
                                        @foreach ($faq as $item)
                                            @if ($item->navigation_type == 3)
                                                <div class="accordion-lite-container fl-wrap">
                                                    <div class="accordion-lite-header fl-wrap">{{ $item->question }}
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="accordion-lite_content fl-wrap">
                                                        <p>{{ $item->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif



                                    <!--   accordion-lite end -->
                                   
                                </div>
                               
                                <div class="list-single-main-item fl-wrap" id="faq4">
                                    <div class="list-single-main-item-title big-lsmt fl-wrap">
                                        <h3>Booking</h3>
                                    </div>
                                    <!--   accordion-lite -->
                                         @if (!empty($faq))
                                        @foreach ($faq as $item)
                                            @if ($item->navigation_type == 4)
                                                <div class="accordion-lite-container fl-wrap">
                                                    <div class="accordion-lite-header fl-wrap">{{ $item->question }}
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="accordion-lite_content fl-wrap">
                                                        <p>{{ $item->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif



                                 
                                </div>
                               
                                <div class="list-single-main-item fl-wrap" id="faq5">
                                    <div class="list-single-main-item-title big-lsmt fl-wrap">
                                        <h3>Listing</h3>
                                    </div>
                                    <!--   accordion-lite -->

                                         @if (!empty($faq))
                                        @foreach ($faq as $item)
                                            @if ($item->navigation_type == 5)
                                                <div class="accordion-lite-container fl-wrap">
                                                    <div class="accordion-lite-header fl-wrap">{{ $item->question }}
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="accordion-lite_content fl-wrap">
                                                        <p>{{ $item->answer }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif



                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="limit-box fl-wrap"></div>
            </section>
        </div>
        <!-- content end -->
    </div>
@endsection
