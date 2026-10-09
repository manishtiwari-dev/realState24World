@extends('front.layouts.app')
@section('titlename', 'Home')
@section('content')
    <div id="wrapper">
        <div class="content">
            <!--  section  -->
            <section class="hero-section hero-section_dec" data-scrollax-parent="true">
                <div class="bg-wrap">
                    <div class="half-hero-bg-media full-height">
                        <div class="slider-progress-bar">
                            <span>
                                <svg class="circ" width="30" height="30">
                                    <circle class="circ2" cx="15" cy="15" r="13"
                                        stroke="rgba(255,255,255,0.4)" stroke-width="1" fill="none" />
                                    <circle class="circ1" cx="15" cy="15" r="13" stroke="#fff"
                                        stroke-width="2" fill="none" />
                                </svg>
                            </span>
                        </div>
                        <div class="slideshow-container">
                            @foreach ($bannerow as $banner)
                                <div class="slideshow-item">
                                    <div class="bg" data-bg="{{ asset('uploads/banner/' . $banner->image) }}"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="hero-title hero-title_small">
                        <h2>Search and Buy Real Estate in Delhi</h2>
                    </div>
                    <div class="main-search-input-wrap main-search-tab-home">
                        <div class="content-tabs-wrap tabs-act fl-wrap tabs-wrapper search-content-tabs">
                            <div class="content-tabs fl-wrap">
                                <ul class="tabs-menu fl-wrap no-list-style dis-flex-wrap">
                                    <li class="current"><a href="#buy">Buy</a></li>
                                    <li class=""><a href="#rent">Rent</a></li>
                                    <li class=""><a href="{{ route('pg') }}">PG</a></li>
                                    <li class=""><a href="#commercials">Commercial</a></li>
                                    <li class=""><a href="{{ route('agent') }}">Dealers</a></li>
                                </ul>
                            </div>

                            <div class="tabs-container">
                                <div class="tab">
                                    <div id="buy" class="tab-content first-tab search-listings-tab tab-current">
                                        <form action="{{ route('search.properties') }}">
                                            <div class="main-search-input fl-wrap mt-0">
                                                <div class="main-search-input-item">
                                                    <div class="dropdown">
                                                        <button class="dropbtn toggleDropdownBtn">All Residential <i
                                                                class="fa fa-angle-down"></i></button>
                                                        <div class="dropdown-content myDropdown">
                                                            <ul class="check_box_list">
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="flats-apartments"
                                                                            value="flats-apartments" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label
                                                                            for="flats-apartments">Flats/Apartments</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="house-villas"
                                                                            value="house-villas" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="house-villas">House/Villas</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="builder-floors"
                                                                            value="builder-floors" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="builder-floors">Builder Floors</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="farm-house"
                                                                            value="farm-house" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="farm-house">Farm House</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="residential-plots"
                                                                            value="residential-plots" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="residential-plots">Residential
                                                                            Plots&nbsp;</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="penthouse"
                                                                            value="penthouse" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="penthouse">Penthouse
                                                                            &nbsp;&nbsp;</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="studio-apartments"
                                                                            value="studio-apartments" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="studio-apartments">Studio
                                                                            Apartments</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="plot"
                                                                            value="plot" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="plot">Plot</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="commercial"
                                                                            value="commercial" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label
                                                                            for="commercial">Commercial&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="pt-checkbox">
                                                                        <input type="checkbox" id="industrial"
                                                                            value="industrial" class="comm_pt"
                                                                            name="preference[]" checked="checked">
                                                                        <label for="industrial">Industrial</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <p class="looking-commercial"></p>
                                                            <div class="main-button-div">
                                                                <ul class="tagWrap">
                                                                    <li data-tab="Budget" id="_getBudget" class="">
                                                                        Budget</li>
                                                                    <li data-tab="Bedroom" id="bhktype-ser"
                                                                        class="">Bedroom <span id="_get_bedroom">(
                                                                            <b>1</b> )</span></li>
                                                                    <li data-tab="postedBy" class="">Posted By <span
                                                                            id="_get_PostedBy">( <b>1</b> )</span></li>
                                                                </ul>

                                                                <ul class="tagDataShow">
                                                                    <li class="budget" id="Budget">
                                                                        <div class="listsearch-input-item"
                                                                            style="margin-top:10px">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <select
                                                                                        class="chosen-select on-radius no-search-select"
                                                                                        name="budget">
                                                                                        <option value="">Select Your
                                                                                            Budget</option>
                                                                                        <option value="0-1Lakh">0 - 1 Lakh
                                                                                        </option>
                                                                                        <option value="1Lakh-10Lakh">1 Lakh
                                                                                            - 10 Lakh</option>
                                                                                        <option value="10Lakh-20Lakh">10
                                                                                            Lakh - 20 Lakh</option>
                                                                                        <option value="20Lakh-30Lakh">20
                                                                                            Lakh - 30 Lakh</option>
                                                                                        <option value="30Lakh-40Lakh">30
                                                                                            Lakh - 40 Lakh</option>
                                                                                        <option value="40Lakh-50Lakh">40
                                                                                            Lakh - 50 Lakh</option>
                                                                                        <option value="50Lakh-1Crore">50
                                                                                            Lakh - 1 Crore</option>
                                                                                        <option value="Above1Crore">Above 1
                                                                                            Crore</option>
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li id="Bedroom" class="">
                                                                        <div class="tag_title">Number of Bedrooms</div>
                                                                        <div class="tag_filter">
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="1rk"
                                                                                    value="1"><span>1 RK/1
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="1bhk"
                                                                                    value="2" class="comm_bk"><span>2
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="2bhk"
                                                                                    value="3" class="comm_bk"><span>3
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="3bhk"
                                                                                    value="4" class="comm_bk"><span>4
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="4bhk"
                                                                                    value="5" class="comm_bk"><span>5
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="5bhk"
                                                                                    value="6" class="comm_bk"><span>6
                                                                                    BHK</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="comm_bhk_type" id="6bhk"
                                                                                    value="7"
                                                                                    class="comm_bk"><span>+7
                                                                                    BHK</span></label>
                                                                        </div>
                                                                    </li>
                                                                    {{-- <li id="postedBy" class="">
                                                                        <div class="tag_title">Posted By</div>
                                                                        <div class="tag_filter">
                                                                            <label><input type="checkbox"
                                                                                    name="memtype_arr[]"
                                                                                    id="memtype_arr_3"
                                                                                    value="3"><span>Agent</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="memtype_arr[]"
                                                                                    id="memtype_arr_4"
                                                                                    value="4"><span>Builder</span></label>
                                                                            <label><input type="checkbox"
                                                                                    name="memtype_arr[]"
                                                                                    id="memtype_arr_1"
                                                                                    value="1"><span>Owner</span></label>
                                                                        </div>
                                                                    </li> --}}
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="main-search-input-item item-input-search-sec">
                                                    <input type="text" name="keyword"
                                                        placeholder="What are you looking for?" required
                                                        autocomplete="off" />
                                                </div>
                                                <input type="hidden" name="type" value="buy">
                                                <button class="main-search-button color-bg" type="submit"> Search <i
                                                        class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>

                                <div class="tab">
                                    <div id="rent" class="tab-content search-listings-tab">
                                        <form action="{{ route('search.properties') }}">
                                            <div class="main-search-input fl-wrap mt-0">
                                                <div class="main-search-input-item">
                                                    <div class="dropdown">
                                                        <select name="preference" class="dropbtn toggleDropdownBtn">
                                                            <option value="all-residential">All Residential</option>
                                                            <option value="flats-apartments">Flats/Apartments</option>
                                                            <option value="house-villas">House/Villas</option>
                                                            <option value="builder-floors">Builder Floors</option>
                                                            <option value="farm-house">Farm House</option>
                                                            <option value="residential-plots">Residential Plots</option>
                                                            <option value="penthouse">Penthouse</option>
                                                            <option value="studio-apartments">Studio Apartments</option>
                                                            <option value="commercial">Commercial</option>
                                                            <option value="plot">Land/Plot</option>
                                                            <option value="industrial">Industrial</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="main-search-input-item item-input-search-sec">
                                                    <input type="text" placeholder="What are you looking for?" />
                                                </div>
                                                <button class="main-search-button color-bg"> Search <i
                                                        class="fas fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div id="project" class="tab-content search-listings-tab">
                                        <div class="main-search-input fl-wrap mt-0">
                                            <div class="main-search-input-item">
                                                <div class="dropdown">
                                                    <button class="dropbtn toggleDropdownBtn">All Projects <i
                                                            class="fa fa-angle-down"></i></button>
                                                    <div class="dropdown-content myDropdown">
                                                        <ul class="radio_list">
                                                            <li>
                                                                <input type="radio" class="radio2" name="residential"
                                                                    id="residential" value="2" checked="">
                                                                <label for="residential"
                                                                    class="label3">Residential</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" class="radio2" name="commercial"
                                                                    id="commercial" value="3">
                                                                <label for="commercial" class="label3">Commercial</label>
                                                            </li>
                                                        </ul>
                                                        <ul class="check_box_list">
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pflats" value="8"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pflats">Ready To Move</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pindividual"
                                                                        value="9" class="comm_pt"
                                                                        name="comm_prop_type" checked="checked">
                                                                    <label for="pindividual">Ongoing Projects</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pbuilder" value="11"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pbuilder">Upcomming Peojrcts</label>
                                                                </div>
                                                            </li>

                                                        </ul>
                                                        <p class="looking-commercial">Looking for commercial properties
                                                            ? <span class="look_comm_tab">Click here</span></p>

                                                        <div class="main-button-div">
                                                            <ul class="tagWrap">
                                                                <li data-tab="Budget" id="_getBudget" class="">
                                                                    Budget</li>
                                                            </ul>

                                                            <ul class="tagDataShow">
                                                                <li class="budget" id="Budget">
                                                                    <div class="tag_title">Select Price Range</div>
                                                                    <!-- <div class="listsearch-input-item">
                                                                                                        <div class="price-rage-item fl-wrap">
                                                                                                            <input type="text" class="price-range-double" data-min="100" data-max="10000"  name="price-range2"  data-step="100" value="1" data-prefix="₹">
                                                                                                        </div>
                                                                                                    </div> -->

                                                                    <div class="listsearch-input-item"
                                                                        style="margin-top:10px">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <select
                                                                                    class="chosen-select on-radius no-search-select">
                                                                                    <option>Min Budget</option>
                                                                                    <option>1000</option>
                                                                                    <option>2000</option>
                                                                                    <option>3000</option>
                                                                                    <option>4000</option>
                                                                                    <option>5000</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select
                                                                                    class="chosen-select on-radius no-search-select">
                                                                                    <option>Max Budget</option>
                                                                                    <option>1000</option>
                                                                                    <option>2000</option>
                                                                                    <option>3000</option>
                                                                                    <option>4000</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="main-search-input-item item-input-search-sec">
                                                <input type="text" placeholder="What are you looking for?"
                                                    value="" />
                                            </div>

                                            <button class="main-search-button color-bg"> Search <i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div id="commercials" class="tab-content search-listings-tab">
                                        <div class="main-search-input fl-wrap mt-0">
                                            <div class="main-search-input-item">
                                                <div class="dropdown">
                                                    <button class="dropbtn toggleDropdownBtn">All Commercial <i
                                                            class="fa fa-angle-down"></i></button>
                                                    <div class="dropdown-content myDropdown">
                                                        <ul class="radio_list">
                                                            <li>
                                                                <input type="radio" class="radio2" name="buy"
                                                                    id="buy" value="2" checked="">
                                                                <label for="buy" class="label3">Buy</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" class="radio2" name="lease"
                                                                    id="lease" value="3">
                                                                <label for="lease" class="label3">Lease</label>
                                                            </li>
                                                        </ul>

                                                        <ul class="check_box_list">
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pflats" value="8"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pflats">Shops</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pindividual"
                                                                        value="9" class="comm_pt"
                                                                        name="comm_prop_type" checked="checked">
                                                                    <label for="pindividual">Showrooms</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pbuilder" value="11"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pbuilder">Office Space</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pfarm" value="12"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pfarm">Business Center</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pplots" value="25"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pplots">Guest House</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="ppenthouse" value="54"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="ppenthouse">Hotels</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pstudio" value="55"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pstudio">Warehouse/Godown</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="pt-checkbox">
                                                                    <input type="checkbox" id="pstudio" value="55"
                                                                        class="comm_pt" name="comm_prop_type"
                                                                        checked="checked">
                                                                    <label for="pstudio">Factory</label>
                                                                </div>
                                                            </li>
                                                        </ul>

                                                        <p class="looking-commercial">Looking for commercial properties
                                                            ? <span class="look_comm_tab">Click here</span></p>

                                                        <div class="main-button-div">
                                                            <ul class="tagWrap">
                                                                <li data-tab="Budget" id="_getBudget" class="">
                                                                    Budget</li>
                                                                <li data-tab="postedBy" class="">Posted By <span
                                                                        id="_get_PostedBy">( <b>1</b> )</span></li>
                                                            </ul>

                                                            <ul class="tagDataShow">
                                                                <li class="budget" id="Budget">
                                                                    <div class="tag_title">Select Price Range</div>
                                                                    <!-- <div class="listsearch-input-item">
                                                                                                        <div class="price-rage-item fl-wrap">
                                                                                                            <input type="text" class="price-range-double" data-min="100" data-max="10000"  name="price-range2"  data-step="100" value="1" data-prefix="₹">
                                                                                                        </div>
                                                                                                    </div> -->

                                                                    <div class="listsearch-input-item"
                                                                        style="margin-top:10px">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <select
                                                                                    class="chosen-select on-radius no-search-select">
                                                                                    <option>Min Budget</option>
                                                                                    <option>1000</option>
                                                                                    <option>2000</option>
                                                                                    <option>3000</option>
                                                                                    <option>4000</option>
                                                                                    <option>5000</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select
                                                                                    class="chosen-select on-radius no-search-select">
                                                                                    <option>Max Budget</option>
                                                                                    <option>1000</option>
                                                                                    <option>2000</option>
                                                                                    <option>3000</option>
                                                                                    <option>4000</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li id="postedBy" class="">
                                                                    <div class="tag_title">Posted By</div>
                                                                    <div class="tag_filter">
                                                                        <label><input type="checkbox" name="memtype_arr[]"
                                                                                id="memtype_arr_3"
                                                                                value="3"><span>Agent</span></label>
                                                                        <label><input type="checkbox" name="memtype_arr[]"
                                                                                id="memtype_arr_4"
                                                                                value="4"><span>Builder</span></label>
                                                                        <label><input type="checkbox" name="memtype_arr[]"
                                                                                id="memtype_arr_1"
                                                                                value="1"><span>Owner</span></label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="main-search-input-item item-input-search-sec">
                                                <input type="text" placeholder="What are you looking for?"
                                                    value="" />
                                            </div>

                                            <button class="main-search-button color-bg"> Search <i
                                                    class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div id="dealers" class="tab-content search-listings-tab">
                                        <div class="main-search-input fl-wrap mt-0">
                                            <div class="main-search-input-item item-input-search-sec" style="width:100%">
                                                <input type="text" placeholder="What are you looking for?"
                                                    value="" />
                                            </div>

                                            <button class="main-search-button color-bg"> Search <i
                                                    class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--  section  end-->

            <!-- property section -->
            <section class="property-p" id="property">
                <div class="container">
                    <div class="section-title">
                        <h2>GET STARTED WITH EXPLORING REAL ESTATE OPTIONS</h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                        <div class="service-carousel carousel">
                            @foreach (gethomeCategories() as $homecategory)
                                <div class="slick-slide-item">
                                    <div class="service-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <div class="geodir-category-img fl-wrap  agent_card">
                                                <a href="{{ route('property', $homecategory->slug) }}" class="geodir-category-img_item">
                                                    <img src="{{ asset('uploads/category/' . $homecategory->thumbnail) }}">
                                                </a>
                                            </div>
                                            <div class="geodir-category-content fl-wrap">
                                                <div class="service_card-title fl-wrap">
                                                    <h4><a href="{{ route('property', $homecategory->slug) }}">{{ $homecategory->name }}</a> </h4>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="fas fa-angle-left"></i></div>
                        <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="fas fa-angle-right"></i> </div>
                    </div>
                </div>
            </section>
            <!-- section end-->
            <!--lisiting property section -->
            <section class="gray-bg small-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="section-title fl-wrap">
                                <h2>Latest Properties</h2>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="listing-filters gallery-filters">
                                <a href="#" class="gallery-filter  gallery-filter-active" data-filter="*"> <span>All Categories</span></a>
                                <a href="#" class="gallery-filter" data-filter=".for_sale"> <span>For Sale</span></a>
                                <a href="#" class="gallery-filter" data-filter=".for_rent"> <span>For Rent</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="grid-item-holder gallery-items gisp fl-wrap"> 
                        @foreach ($propertiesresult as $propitem)
                            <div class="gallery-item @if ($propitem->property_type == 1) for_sale @elseif($propitem->property_type == 2) for_rent @endif"> 
                                <div class="listing-item">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img fl-wrap">
                                            <a href="#" class="geodir-category-img_item">
                                                @if (empty($propitem->thumbnail))
                                                    <img src="{{ asset('uploads/property-img.jpg') }}" alt="{{ $propitem->name }}" />
                                                @else
                                                    <img src="{{ asset('uploads/properties/' . $propitem->thumbnail . '') }}" alt="{{ $propitem->name }}" />
                                                @endif
                                                <div class="overlay"></div>
                                            </a>
                                            <div class="geodir-category-location">
                                                <a href="#" class="single-map-item tolt" data-newlatitude="40.72956781" data-newlongitude="-73.99726866" data-microtip-position="top-left" data-tooltip="On the map"><i class="fas fa-map-marker-alt"></i>
                                                    <span>{{ $propitem->address }}</span>
                                                </a>
                                            </div>
                                            <ul class="list-single-opt_header_cat">
                                                <li>
                                                    <a href="#" class="cat-opt blue-bg">
                                                        @if ($propitem->property_type == 1)
                                                            Sale
                                                        @elseif($propitem->property_type == 2)
                                                            Rent
                                                        @endif
                                                    </a>
                                                </li>
                                                <li><a href="#" class="cat-opt color-bg">Apartment</a></li>
                                            </ul>
                                            {{-- 
                                                <div class="geodir-category-listing_media-list">
                                                    <span><i class="fas fa-camera"></i> 8</span>
                                                </div> 
                                            --}}
                                        </div>
                                        <div class="geodir-category-content fl-wrap">
                                            <h3 class="title-sin_item"><a
                                                    href="{{ route('property.detail', $propitem->slug) }}">{{ $propitem->name }}</a>
                                            </h3>
                                            <div class="geodir-category-content_price"> ₹ {{ number_format($propitem->amount, 2) }} </div>
                                            <div class="bhk-apprtment">{{ \Illuminate\Support\Str::words(strip_tags($propitem->description), 10, '...') }}</div>
                                            <div class="geodir-category-content-details">
                                                <ul>
                                                    <li><i class="fal fa-bed"></i><span>{{ $propitem->bedrooms }}</span>
                                                    </li>
                                                    <li><i class="fal fa-bath"></i><span>{{ $propitem->bathrooms }}</span>
                                                    </li>
                                                    <li><i class="fal fa-cube"></i><span>{{ $propitem->area }} ft</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="geodir-category-footer fl-wrap">
                                                <a href="#" class="gcf-company">
                                                    @if (!empty($propitem->dealer))
                                                        <img src="{{ asset('uploads/dealer/' . $propitem->dealer->profile_photo . '') }}" alt="{{ $propitem->dealer->name }}">
                                                    @else
                                                        <img src="{{ asset('uploads/blank-img.png') }}" alt="realState24world">
                                                    @endif
                                                    @if (!empty($propitem->dealer))
                                                        <span> By {{ $propitem->dealer->name }}</span>
                                                    @else
                                                        <span> By realState24world</span>
                                                    @endif
                                                </a>
                                                <div class="agent-contact-boc">
                                                    <a href="{{ route('property.detail', $propitem->slug) }}" class="btn color-bg small-btn"> View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- listing-item end-->
                            </div>
                        @endforeach
                    </div>
                    <!-- grid-item-holder-->
                    <a href="{{route('property_list')}}" class="btn small-btn color-bg" style="margin-top:15px">View All Properties</a>
                </div>
            </section>
            <!-- section end-->



            <!--all list project section  -->
            <section class="featured hidden-section small-padding" id="locations">
                <!-- section-title -->
                <div class="section-title st-center fl-wrap">
                    <h2>Properties for Rent in Delhi</h2>
                </div>
                <div class="half-carousel-wrap">
                    <div class="half-carousel-conatiner">
                        <div class="half-carousel fl-wrap full-height">
                            <!--slick-item -->

                            @if (!empty($propertiesonrent))
                                @foreach ($propertiesonrent as $property)
                                    <div class="slick-item">
                                        <div class="half-carousel-item fl-wrap">
                                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                                @if (empty($property->thumbnail))
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/property-img.jpg') }}"></div>
                                                @else
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/properties/' . $property->thumbnail . '') }}">
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="half-carousel-content">
                                                {{-- <div class="hc-counter color-bg"></div> --}}
                                                <h3><a href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a></h3>
                                                <p>{{ \Illuminate\Support\Str::words(strip_tags($property->description), 10, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </section>
            <!--section end-->


            <!--all list project section  -->
            <section class="featured-collection hidden-section small-padding" id="locations">
                <!-- section-title -->
                <div class="section-title st-center fl-wrap">
                    <h2>Properties for Sell in Delhi</h2>
                </div>
                <div class="half-carousel-wrap">
                    <div class="half-carousel-conatiner">
                        <div class="half-carousel fl-wrap full-height">
                            <!--slick-item -->
                            @if (!empty($propertiesonsale))
                                @foreach ($propertiesonsale as $property)
                                    <div class="slick-item">
                                        <div class="half-carousel-item fl-wrap">
                                            <div class="bg-wrap bg-parallax-wrap-gradien">
                                                @if (empty($property->thumbnail))
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/property-img.jpg') }}"></div>
                                                @else
                                                    <div class="bg"
                                                        data-bg="{{ asset('uploads/properties/' . $property->thumbnail . '') }}">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="half-carousel-content">
                                                {{-- <div class="hc-counter color-bg"></div> --}}
                                                <h3><a href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a></h3>
                                                <p>{{ \Illuminate\Support\Str::words(strip_tags($property->description), 15, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif




                        </div>
                    </div>
                </div>
            </section>
            <!--section end-->



            <!-- projects section -->
            <section id="sellers">
                <div class="container">
                    <!-- section-title -->
                    <div class="section-title st-center fl-wrap">
                        <h2>Premium Projects in Delhi</h2>
                    </div>
                    <!-- section-title end -->
                    <div class="clearfix"></div>
                    <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                        <div class="listing-carousel carousel">
                            <!-- slick-slide-item -->
                            @if (!empty($premiumpropertiesresult))
                                @foreach ($premiumpropertiesresult as $property)
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap  agent_card">
                                                    <a href="{{ route('property.detail', $property->slug) }}"
                                                        class="geodir-category-img_item">
                                                        @if (empty($property->thumbnail))
                                                            <img src="{{ asset('uploads/property-img.jpg') }}"
                                                                alt="{{ $property->name }}" />
                                                        @else
                                                            <img src="{{ asset('uploads/properties/' . $property->thumbnail . '') }}"
                                                                alt="{{ $property->name }}" />
                                                        @endif
                                                        <ul class="list-single-opt_header_cat">
                                                            <li><span class="cat-opt color-bg">
                                                                    @if ($property->premium == 0)
                                                                        Ongoing
                                                                    @elseif($property->premium == 1)
                                                                        Upcoming
                                                                    @else
                                                                        Completed
                                                                    @endif
                                                                </span></li>
                                                        </ul>
                                                    </a>
                                                </div>
                                                <div class="agent-category-content fl-wrap">
                                                    <div class="agent_card-title fl-wrap">
                                                        <h4><a
                                                                href="{{ route('property.detail', $property->slug) }}">{{ $property->name }}</a>
                                                        </h4>
                                                        <h5><a
                                                                href="{{ route('property.detail', $property->slug) }}">{{ $property->address }}</a>
                                                        </h5>
                                                        <p>{{ $property->bedrooms }} BHK Flats</p>
                                                        <h6>{{ $property->area }} Sq.ft.</h6>
                                                        <div class="project-price">
                                                            ₹ {{ number_format($property->amount, 2) }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </article>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                            <!-- slick-slide-item end-->
                        </div>
                        <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="fas fa-angle-left"></i></div>
                        <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end-->


            <!-- section -->
            <section class="color-bg small-padding">
                <div class="container">
                    <div class="section-title st-center fl-wrap">
                        <h2 style="color:#fff">Insights And Tools</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="reiit-item">
                                <div class="reiit-img">
                                    <img src="images/destination.png" loading="lazy" decoding="async"
                                        fetchpriority="low" alt="">
                                </div>
                                <a href="" class="reiit-title">Delhi Top Residential <br>Localities</a>
                                <div class="reiit-sd">Planning to buy property in a posh localities in Delhi? Here are
                                    some of the top locations in Delhi with verified residential properties</div>
                                <a href="{{route('property_list')}}" class="btn color-bg small-btn">Explore More</a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="reiit-item">
                                <div class="reiit-img">
                                    <img src="images/recommend.png" loading="lazy" decoding="async" fetchpriority="low"
                                        alt="">
                                </div>
                                <a href="" class="reiit-title">Top Agents <br>And Brokers</a>
                                <div class="reiit-sd">Planning to buy property in a posh localities in Delhi? Here are
                                    some of the top locations in Delhi with verified residential properties</div>
                                <a href="{{ route('agent') }}" class="btn color-bg small-btn">Explore More</a>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="reiit-item">
                                <div class="reiit-img">
                                    <img src="images/newspaper.png" loading="lazy" decoding="async" fetchpriority="low"
                                        alt="">
                                </div>
                                <a href="#" class="reiit-title">Latest Real Estate News, <br>Views &amp;
                                    Updates</a>
                                <div class="reiit-sd">Planning to buy property in a posh localities in Delhi? Here are
                                    some of the top locations in Delhi with verified residential properties</div>
                                <a href="{{ route('blog') }}" class="btn color-bg small-btn">Explore More</a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="reiit-item">
                                <div class="reiit-img">
                                    <img src="images/residential.png" loading="lazy" decoding="async"
                                        fetchpriority="low" alt="">
                                </div>
                                <a href="#" class="reiit-title">Top Premium <br> Projects</a>
                                <div class="reiit-sd">Planning to buy property in a posh localities in Delhi? Here are
                                    some of the top locations in Delhi with verified residential properties</div>
                                <a href="{{route('property_list')}}" class="btn color-bg small-btn">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end-->

            <!-- section -->

            <section id="sellers">
                <div class="container">
                    <!-- section-title -->
                    <div class="section-title st-center fl-wrap">
                        <h2>Recommended Sellers</h2>
                    </div>
                    <!-- section-title end -->
                    <div class="clearfix"></div>
                    <div class="listing-carousel-wrapper lc_hero carousel-wrap fl-wrap">
                        <div class="listing-carousel carousel">
                            <!-- slick-slide-item -->

                            @if (!empty($dealerresult))
                                @foreach ($dealerresult as $user)
                                    <div class="slick-slide-item">
                                        <!--  agent card item -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img fl-wrap  agent_card">
                                                    <a href="{{ route('agent.detail', ['id' => encode_string($user->id)]) }}"
                                                        class="geodir-category-img_item">
                                                        @if (empty($user->company_logo))
                                                            <img src="images/agency/2.png" alt="">
                                                        @else
                                                            <img src="{{ asset('uploads/dealer/' . $user->company_logo . '') }}"
                                                                alt="">
                                                        @endif
                                                        <ul class="list-single-opt_header_cat">
                                                            <li><span
                                                                    class="cat-opt color-bg">{{ $user->property->count() ?? 0 }}
                                                                    listings</span></li>
                                                        </ul>
                                                    </a>


                                                </div>
                                                <div class="agent-category-content fl-wrap">
                                                    <div class="card-verified tolt" data-microtip-position="left"
                                                        data-tooltip="Verified"><i class="fal fa-user-check"></i></div>
                                                    <div class="agent_card-title fl-wrap">
                                                        <h4><a
                                                                href="{{ route('agent.detail', ['id' => encode_string($user->id)]) }}">{{ $user->name }}</a>
                                                        </h4>
                                                        <h5><a
                                                                href="{{ route('agent.detail', ['id' => encode_string($user->id)]) }}">{{ $user->company_name }}</a>
                                                        </h5>
                                                        <p> {{ \Illuminate\Support\Str::words($user->about, 5, '...') }}
                                                        </p>
                                                    </div>

                                                    <div class="agent-category-footer fl-wrap">
                                                        <a href="{{ route('agent.detail', ['id' => encode_string($user->id)]) }}"
                                                            class="btn float-btn color-bg small-btn">View
                                                            Profile</a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!--  agent card item end -->
                                    </div>
                                @endforeach
                            @endif


                        </div>
                        <div class="swiper-button-prev lc-wbtn lc-wbtn_prev"><i class="fas fa-angle-left"></i></div>
                        <div class="swiper-button-next lc-wbtn lc-wbtn_next"><i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end-->


            <!-- section -->


            @if (!empty($testimonial))
                @include('front.testimonial')
            @endif

            <section class="post-sec" id="news">
                <div class="container">
                    <div class="section-title st-center fl-wrap">
                        <h2>News & Articles</h2>
                        <!-- <h4>Read what's happening in Real Estate</h4> -->
                    </div>
                    <div class="row">

                        @if (!empty($blogData))
                            @foreach ($blogData as $blog)
                                <div class="col-md-4">
                                    <article class="post-article fl-wrap">
                                        <div class="list-single-main-media fl-wrap">
                                            <img src="{{ asset('uploads/blog/' . $blog->thumbnail) }}" class="respimg"
                                                alt="">
                                        </div>
                                        <div class="list-single-main-item fl-wrap block_box">
                                            <h2 class="post-opt-title"><a
                                                    href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h2>
                                            <p>{{ \Illuminate\Support\Str::words($blog->subtitle, 100, '...') }}</p>

                                            <span class="fw-separator fl-wrap"></span>
                                            <div class="post-author"><a href="#"><span>By ,
                                                        {{ $blog->author }}</span></a>
                                            </div>
                                            <div class="post-opt">
                                                <ul class="no-list-style">
                                                    <li><i class="fal fa-calendar"></i>
                                                        <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
                                                    </li>
                                                </ul>
                                            </div>

                                    </article>
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
