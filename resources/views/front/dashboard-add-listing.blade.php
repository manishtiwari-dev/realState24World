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
                <div class="dasboard-scrollnav-wrap scroll-to-fixed-fixed scroll-init2 fl-wrap">

                    <ul>
                        <li><a href="#sec1" class="act-scrlink">Info</a></li>
                        <li><a href="#sec2">Location</a></li>
                        <!-- <li><a href="#sec3">Media</a></li> -->
                        <li><a href="#sec4">Details</a></li>
                        {{-- <li><a href="#sec5">Rooms</a></li>
                                    <li><a href="#sec6">Plans</a></li> --}}
                        <!-- <li><a href="#sec7">Widgets</a></li> -->
                    </ul>
                    <div class="progress-indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
                            <circle cx="16" cy="16" r="15.9155"
                                class="progress-bar__progress 
                                            js-progress-bar" />
                        </svg>
                    </div>
                </div>

                <form method="POST" action="{{ route('front.dashboardaddlisting') }}" enctype="multipart/form-data"
                    class="">
                    @csrf
                    <!-- dasboard-widget-title -->
                    <div class="dasboard-widget-title fl-wrap" id="sec1">
                        <h5><i class="fas fa-info"></i>Basic Informations</h5>
                        @if (Session::has('error'))
                            <div
                                style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div
                                style="background: #0ca60c; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    </div>
                    <!-- dasboard-widget-title end -->
                    <!-- dasboard-widget-box  -->
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Listing Title <span class="dec-icon"><i
                                                class="fas fa-briefcase"></i></span></label>
                                    <input type="text" name="name" id="name" placeholder="Name of your business"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-8">
                                    <label>Slug <span class="dec-icon"><i class="fas fa-briefcase"></i></span></label>
                                    <input type="text" placeholder="Slug" name="slug" id="slug"
                                        value="{{ old('slug') }}" readonly />
                                </div>

                                <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Property Type <span class="dec-icon"><i class="fas fa-home-lg-alt"></i></span></label>
                                    <select data-placeholder="property_type" name="property_type">
                                        <option value="1">On Sale</option>
                                        <option value="2">On Rent</option>
                                    </select>
                                    @error('property_type')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Listing Category <span class="dec-icon"><i class="fas fa-home-lg-alt"></i></span></label>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="All Types" name="category" class="chosen-select no-search-select">
                                            <option value="">Select Category</option>
                                                @if ($categories)
                                                    @foreach ($categories as $category)
                                                        <?php $dash = ''; ?>
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @if (count($category->subcategory))
                                                            @include('admin.category.sub-category-option', [
                                                                'subcategories' => $category->subcategory,
                                                            ])
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Type <span class="dec-icon"><i class="fas fa-home-lg-alt"></i></span></label>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Apartments" name="type" class="chosen-select no-search-select">
                                            <option value="All Categories">All Categories</option>
                                            <option value="Residential">Residential </option>
                                            <option value="Commercial">Commercial </option>
                                            <option value="Plot">Plot </option>
                                            <option value="Industrial">Industrial</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Listing Price <span class="dec-icon"><i class="fas fa-money-bill-wave"></i></span></label>
                                    <input type="text" name="amount" placeholder="Enter Amount: 20000,40000" value="{{ old('amount') }}" />
                                    @error('amount')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-12">
                                    <label>Keywords <span class="dec-icon"><i class="fas fa-key"></i></span></label>
                                    <input type="text" name="keyword" placeholder="Maximum 15 , should be separated by commas" value="{{ old('keyword') }}" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec2">
                        <h5><i class="fas fa-street-view"></i>Location / Contacts</h5>
                    </div>

                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Address <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="address" placeholder="Address of your business"
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>City <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="city" placeholder="City"
                                        value="{{ old('city') }}" />
                                    @error('city')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>State <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Apartments" name="state"
                                            class="chosen-select no-search-select">
                                            <option value="0">-- Select State --</option>
                                            @foreach ($state as $states)
                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Landmark <span class="dec-icon"><i
                                                class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="landmark" placeholder="Address of your business"
                                        value="{{ old('landmark') }}" />
                                    @error('landmark')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- dasboard-widget-title -->
                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec4">
                        <h5><i class="fas fa-list"></i>Listing Details</h5>
                    </div>
                    <!-- dasboard-widget-title end -->
                    <!-- dasboard-widget-box  -->
                    <div class="dasboard-widget-box   fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Area: <span class="dec-icon"><i class="fas fa-sort"></i></span></label>
                                            <input type="text" name="area" placeholder="House Area"
                                                value="{{ old('area') }}" />
                                            @error('area')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Accomodation: <span class="dec-icon"><i
                                                        class="fas fa-users"></i></span></label>
                                            <input type="text" name="accomodation" placeholder="Listing Accomodation"
                                                value="{{ old('accomodation') }}" />
                                            @error('accomodation')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Yard size: <span class="dec-icon"><i
                                                        class="fas fa-tree"></i></span></label>
                                            <input type="text" name="yard_size" placeholder="Yard size"
                                                value="{{ old('yard_size') }}" />
                                            @error('yard_size')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-sm-6">
                                            <label>Bedrooms: <span class="dec-icon"><i
                                                        class="fas fa-bed"></i></span></label>
                                            <input type="text" name="bedrooms" placeholder="House Bedrooms"
                                                value="{{ old('bedrooms') }}" />
                                            @error('bedrooms')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Bathrooms: <span class="dec-icon"><i
                                                        class="fas fa-bath"></i></span></label>
                                            <input type="text" name="bathrooms" placeholder="House Bathrooms"
                                                value="{{ old('bathrooms') }}" />
                                            @error('bathrooms')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Garage: <span class="dec-icon"><i
                                                        class="fas fa-warehouse"></i></span></label>
                                            <input type="text" name="garage" placeholder="Number of cars"
                                                value="{{ old('garage') }}" />
                                            @error('garage')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <label>Amenities: </label>
                            <div class=" add-list-tags fl-wrap">
                                <!-- Checkboxes -->
                                <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                    <li>
                                        <input type="checkbox" name="wifi" id="wifi" value="1">
                                        <label for="wifi"> Wi Fi</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="pool" id="pool" value="1">
                                        <label for="pool">Pool</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="security" id="security" value="1">
                                        <label for="security"> Security</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="laundry" id="laundry" value="1">
                                        <label for="laundry"> Laundry Room</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="equipped-kitchen" id="equipped-kitchen"
                                            value="1">
                                        <label for="equipped-kitchen"> Equipped Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="air-conditioning" id="air-conditioning"
                                            value="1">
                                        <label for="air-conditioning">Air Conditioning</label>
                                    </li>
                                    <li>
                                        <input id="gym" type="checkbox" name="gym" id="gym"
                                            value="1">
                                        <label for="gym">Gym</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="parking" id="parking" value="1">
                                        <label for="parking">Parking</label>
                                    </li>
                                     <li>
                                        <input type="checkbox" name="elevator" id="elevator" value="1">
                                        <label for="elevator">Elevator</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec4">
                        <h5><i class="fas fa-list"></i>Description Details</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap" style="padding: 0 !important;">
                        <div class="custom-form">
                            <textarea class="description" id="description" name="description" placeholder="Enter text ..."></textarea>
                        </div>
                    </div>

                    <!-- dasboard-widget-title -->
                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec5">
                        <h5><i class="fas fa-home-lg-alt"></i>Nearby facilities</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form add_room-item-wrap">
                            <div class="add_room-container fl-wrap">
                                <div class="add_room-item fl-wrap">
                                    <label>Nearby facilities: </label>
                                    <div class="add-list-tags fl-wrap">
                                        <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                            <li>
                                                <input type="checkbox" name="airport" id="airport" value="1">
                                                <label for="airport">Airport</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="park" id="park" value="1">
                                                <label for="park">Park</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="busstand" id="busstand" value="1">
                                                <label for="busstand">Bus Stand</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="mandir" id="mandir" value="1">
                                                <label for="mandir">Mandir</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="hospital" id="hospital" value="1">
                                                <label for="hospital">Hospital</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="school" id="school" value="1">
                                                <label for="school">School</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="railwaystation" id="railwaystation"
                                                    value="1">
                                                <label for="railwaystation">Railway Station</label>
                                            </li>
                                        </ul>
                                        <!-- Checkboxes end -->
                                    </div>
                                </div>
                                <!--add_room-item end  -->
                            </div>

                        </div>
                    </div>



                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec2">
                        <h5><i class="fas fa-cloud-upload-alt"></i>Images</h5>
                    </div>

                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Upload Images</label>
                                    <div class="listsearch-input-item fl-wrap">
                                        <div class="fu-text">
                                            <span><i class="fas fa-cloud-upload-alt"></i> Click here or drop files to
                                                upload</span>
                                            <div class="photoUpload-files fl-wrap"></div>
                                        </div>
                                        <input type="file" class="upload" name="thumbnail" id="thumbnail">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Multiple Images<span class="form-text">(optional)</span></label>
                                    <div class="listsearch-input-item fl-wrap">
                                        {{-- <form class="fuzone"> --}}
                                        <div class="fu-text">
                                            <span><i class="fas fa-cloud-upload-alt"></i> Click here or drop files to
                                                upload</span>
                                            <div class="photoUpload-files fl-wrap"></div>
                                        </div>
                                        <input type="file" class="upload" name="banners[]" id="banner" multiple>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec2">
                        <h5><i class="fas fa-list"></i>Seo Content</h5>
                    </div>

                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">

                                <div class="col-md-4">
                                    <label>Meta Title<span class="form-text">(optional)</span> </label>
                                    <textarea cols="40" rows="1" name="metatitle" placeholder="Enter Seo Meta Title" spellcheck="false">{{ old('metatitle') }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label>Meta Keyword<span class="form-text">(optional)</span> </label>
                                    <textarea cols="40" rows="1" name="metakeyword" placeholder="Enter Seo Meta Keyword" spellcheck="false">{{ old('metakeyword') }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label>Meta Description<span class="form-text">(optional)</span> </label>
                                    <textarea cols="40" rows="3" name="metadescription" placeholder="Enter Seo Meta Description" spellcheck="false">{{ old('metadescription') }}</textarea>

                                </div>
                            </div>

                        </div>
                    </div>

                    @if (auth()->user()->is_role != 3)
                        <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec2">
                            <h5> <i class="fas fa-list"></i>Dealer Details</h5>
                        </div>
                        <div class="dasboard-widget-box fl-wrap">
                            <div class="custom-form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Select Dealer <span class="dec-icon"><i
                                                    class="fas fa-map-marker"></i></span></label>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Apartments" name="dealer"
                                                class="chosen-select no-search-select">
                                                <option value="0">-- Select Dealer --</option>
                                                @foreach ($dealers as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                    <button class="btn color-bg float-btn" type="submit">Save Changes</button>
                    <button class="btn float-btn" type="reset" style="background: red; margin-right:5px;">Reset</button>
                </form>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>

    </div>
@endsection
@section('custom-javascript')
    <script>
        // $(".dealer").select2({
        //     minimumResultsForSearch: Infinity
        // });
        // $(".type").select2({
        //     minimumResultsForSearch: Infinity
        // });
        // $(".state").select2();
        // $(".category").select2();
        $(document).ready(function() {
            $('#name').on('input', function() {
                var name = $(this).val().trim().toLowerCase();
                var slug = name.replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });

        //Editor
        $(".description").summernote({
            placeholder: 'Enter Description here....',
            height: "250"
        });
    </script>
@endsection
