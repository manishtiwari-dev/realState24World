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
                            <div class="dasboard-listing-box fl-wrap">
                                <div class="dasboard-opt sl-opt fl-wrap">
                                    <div class="dashboard-search-listing">
                                        <input type="text" onclick="this.select()" placeholder="Search" value="">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                    <a href="#" class="gradient-bg dashboard-addnew_btn show-popup-form">Add New <i class="fal fa-plus"></i></a>	
                                    <!-- price-opt-->
                                    <div class="price-opt">
                                        <span class="price-opt-title">Sort   by:</span>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Lastes" class="chosen-select no-search-select" >
                                                <option>Lastes</option>
                                                <option>Oldes</option>
                                                <option>Average rating</option>
                                                <option>Name: A-Z</option>
                                                <option>Name: Z-A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- price-opt end-->
                                    <div class="popup-form">
                                        <div class="custom-form">
                                            <label>Name <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                            <input type="text" placeholder="Alica Noory" value=""/>
                                            <label>Email Address <span class="dec-icon"><i class="fas fa-envelope"></i></span></label>
                                            <input type="text" placeholder="AlicaNoory@domain.com" value=""/>
                                            <label>Agent Link<span class="dec-icon"><i class="fal fa-link"></i></span></label>
                                            <input type="text" placeholder="homeradar.net/agent-alicanoory/" value=""/>	
                                            <button type="submit" class="btn float-btn color-bg fw-btn"> Send</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- dashboard-listings-wrap-->
                                <div class="dashboard-listings-wrap fl-wrap">
                                    <div class="row">
                                        <!-- dashboard-listings-item-->
                                        <div class="col-md-4">
                                            <!--  agent card item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img fl-wrap  agent_card">
                                                        <a href="#" class="geodir-category-img_item">
                                                        <img src="images/agency/2.png" alt="">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                                        <div class="agent_card-title fl-wrap">
                                                            <h4><a href="#" >Liza Rose</a></h4>
                                                            <h5><a href="#">Mavers RealEstate agency</a></h5>
                                                        </div>
                                                        <div class="agent-card-facts fl-wrap">
                                                            <ul>
                                                                <li>Listings<span>24</span></li>
                                                                <li>Reviews<span>18</span></li>
                                                                <li>Bookings<span>124</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="geodir-category-footer fl-wrap">
                                                            <a href="#" class="btn float-btn color-bg small-btn">View Profile</a>
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!--  agent card item end -->										
                                        </div>
                                        <!-- dashboard-listings-item end--> 									
                                        <!-- dashboard-listings-item-->
                                        <div class="col-md-4">
                                            <!--  agent card item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img fl-wrap  agent_card">
                                                        <a href="#" class="geodir-category-img_item">
                                                        <img src="images/agency/2.png" alt="">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <div class="card-verified cv_not tolt" data-microtip-position="left" data-tooltip="Not Verified"><i class="fal fa-minus-octagon"></i></div>
                                                        <div class="agent_card-title fl-wrap">
                                                            <h4><a href="#" >Jane Kobart</a></h4>
                                                            <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                                        </div>
                                                        <div class="agent-card-facts fl-wrap">
                                                            <ul>
                                                                <li>Listings<span>14</span></li>
                                                                <li>Reviews<span>28</span></li>
                                                                <li>Bookings<span>321</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="geodir-category-footer fl-wrap">
                                                            <a href="#" class="btn float-btn color-bg small-btn">View Profile</a>
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!--  agent card item end -->										
                                        </div>
                                        <!-- dashboard-listings-item end-->  
                                        <!-- dashboard-listings-item-->
                                        <div class="col-md-4">
                                            <!--  agent card item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img fl-wrap  agent_card">
                                                        <a href="#" class="geodir-category-img_item">
                                                        <img src="images/agency/2.png" alt="">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                                        <div class="agent_card-title fl-wrap">
                                                            <h4><a href="#" >Bill Trust</a></h4>
                                                            <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                                        </div>
                                                        <div class="agent-card-facts fl-wrap">
                                                            <ul>
                                                                <li>Listings<span>12</span></li>
                                                                <li>Reviews<span>38</span></li>
                                                                <li>Bookings<span>68</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="geodir-category-footer fl-wrap">
                                                            <a href="#" class="btn float-btn color-bg small-btn">View Profile</a>
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!--  agent card item end -->										
                                        </div>
                                        <!-- dashboard-listings-item end--> 
                                        <!-- dashboard-listings-item-->
                                        <div class="col-md-4">
                                            <!--  agent card item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img fl-wrap  agent_card">
                                                        <a href="#" class="geodir-category-img_item">
                                                        <img src="images/agency/2.png" alt="">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <div class="card-verified cv_not tolt" data-microtip-position="left" data-tooltip="Not Verified"><i class="fal fa-minus-octagon"></i></div>
                                                        <div class="agent_card-title fl-wrap">
                                                            <h4><a href="#" >Andy Sposty</a></h4>
                                                            <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                                        </div>
                                                        <div class="agent-card-facts fl-wrap">
                                                            <ul>
                                                                <li>Listings<span>10</span></li>
                                                                <li>Reviews<span>44</span></li>
                                                                <li>Bookings<span>98</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="geodir-category-footer fl-wrap">
                                                            <a href="#" class="btn float-btn color-bg small-btn">View Profile</a>
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!--  agent card item end -->										
                                        </div>
                                        <!-- dashboard-listings-item end-->  
                                        <!-- dashboard-listings-item-->
                                        <div class="col-md-4">
                                            <!--  agent card item -->
                                            <div class="listing-item">
                                                <article class="geodir-category-listing fl-wrap">
                                                    <div class="geodir-category-img fl-wrap  agent_card">
                                                        <a href="#" class="geodir-category-img_item">
                                                        <img src="images/agency/2.png" alt="">
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="geodir-category-content fl-wrap">
                                                        <div class="card-verified tolt" data-microtip-position="left" data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                                        <div class="agent_card-title fl-wrap">
                                                            <h4><a href="#" >Martin Smith</a></h4>
                                                            <h5><a href="agency-single.html">Mavers RealEstate agency</a></h5>
                                                        </div>
                                                        <div class="agent-card-facts fl-wrap">
                                                            <ul>
                                                                <li>Listings<span>06</span></li>
                                                                <li>Reviews<span>18</span></li>
                                                                <li>Bookings<span>33</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="geodir-category-footer fl-wrap">
                                                            <a href="#" class="btn float-btn color-bg small-btn">View Profile</a>
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <!--  agent card item end -->										
                                        </div>
                                        <!-- dashboard-listings-item end-->												
                                    </div>
                                </div>
                                <!-- dashboard-listings-wrap end-->
                            </div>
                            <!-- pagination-->
                            <div class="pagination float-pagination">
                                <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                                <a href="#" >1</a>
                                <a href="#" class="current-page">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                            </div>
                            <!-- pagination end-->	
                        </div>
                    </div>
                    			
                </div>
                
               	
                
@endsection