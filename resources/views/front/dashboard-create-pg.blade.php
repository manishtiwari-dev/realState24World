@extends('front.agent.app')
@section('content')
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
        <div class="container dasboard-container">
            @include('front.dashboard-title')
            <div class="dasboard-wrapper fl-wrap no-pag">
                <div class="dasboard-scrollnav-wrap scroll-to-fixed-fixed scroll-init2 fl-wrap">
                    <ul>
                        <li><a href="#sec1" class="act-scrlink">Info</a></li>
                        <li><a href="#sec2">Location</a></li>
                        <li><a href="#sec3">Details</a></li>
                        <li><a href="#sec4">Near By</a></li>
                        <li><a href="#sec5">Description</a></li>
                        <li><a href="#sec6">Room Details</a></li>
                        <li><a href="#sec7">Social Media</a></li>
                    </ul>
                    <div class="progress-indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__progress js-progress-bar" />
                        </svg>
                    </div>
                </div>

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

                <form method="POST" action="{{ route('front.dashboardpg') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dealer" value="{{ $dealers->id }}">
                    <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
                    <input type="hidden" name="property_type" value="2">
                    <div class="dasboard-widget-title fl-wrap" id="sec1">
                        <h5><i class="fas fa-info"></i>Basic Informations</h5>
                    </div>
                    <!-- dasboard-widget-box  -->
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Your Name <span class="dec-icon"><i class="fas fa-briefcase"></i></span></label>
                                    <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" />
                                    @error('name')
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
                                                        <option value="{{ $category->id }}" {{ $category->id == 6 ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                            <option value="Residential" selected>Residential </option>
                                            <option value="Commercial">Commercial </option>
                                            <option value="Plot">Plot </option>
                                            <option value="Industrial">Industrial</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4" style="padding:10px !important;">
                                    <label>Landmark <span class="dec-icon"><i
                                                class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="landmark" placeholder="Landmark"
                                        value="{{ old('landmark') }}" />
                                    @error('landmark')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <div class="col-sm-12">
                                    <label>Address On Google <span class="dec-icon"><i class="fas fa-key"></i></span></label>
                                    <input type="text" name="keyword" placeholder="Address As Per Google Map" value="{{ old('keyword') }}" />
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
                                <div class="col-md-6">
                                    <label>Address <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="address" placeholder="Address of your business"
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label>City <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="city" placeholder="City"
                                        value="{{ old('city') }}" />
                                    @error('city')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>State <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="State" name="state"
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
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec3">
                        <h5><i class="fas fa-list"></i>Listing Details</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12" style="padding:10px !important;">
                                            <label>PG Name <span class="dec-icon"><i class="fas fa-list"></i></span></label>
                                            <input type="text" name="pgname" id="name" placeholder="Enter PG Name" value="{{ old('pgname') }}" />
                                            @error('pgname')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4" style="padding:20px !important;">
                                            <label>Cover Image</label>
                                            <input type="file" name="coverimage"/>
                                        </div>
                                        <div class="col-sm-3" style="padding:10px !important;">
                                            <label>Total Bed <span class="dec-icon"><i class="fas fa-list"></i></span></label>
                                            <input type="text" name="pgbed" value="{{ old('pgbed', 2) }}" />
                                            @error('pgbed')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-5" style="padding:10px !important;">
                                            <label>Meals Available <span class="dec-icon"><i class="fas fa-list"></i></span></label>
                                            <div class="listsearch-input-item">
                                                <select data-placeholder="Meal Available" name="meal" class="chosen-select no-search-select">
                                                    <option value="No Meal" selected>No Meal</option>
                                                    <option value="Veg Meal">Meal - Veg (Breakfast, Lunch, Dinner)</option>
                                                    <option value="NonVeg Meal">Meal - Non Veg (Breakfast, Lunch, Dinner)</option>
                                                    <option value="Breakfast Only">Breakfast Only</option>
                                                    <option value="Lunch Only">Lunch Only</option>
                                                    <option value="Dinner Only">Dinner Only</option>
                                                    <option value="Veg Breakfast">Veg Breakfast</option>
                                                    <option value="Veg Lunch">Veg Lunch</option>
                                                    <option value="Veg Dinner">Veg Dinner</option>
                                                    <option value="NonVeg Lunch">Non Veg Lunch</option>
                                                    <option value="NonVeg Dinner">Non Veg Dinner</option>
                                                </select>
                                            </div>
                                            @error('meal')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <label>Common Areas*: </label>
                            <div class="add-list-tags fl-wrap" style="margin-bottom: 15px;">
                                <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                    <li>
                                        <input type="checkbox" name="livingroom" id="LivingRoom" value="1">
                                        <label for="LivingRoom">Living Room</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="kitchen" id="kitchen" value="1">
                                        <label for="kitchen">Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="dininghall" id="dininghall" value="1">
                                        <label for="dininghall"> Dining Hall</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="library" id="library" value="1">
                                        <label for="library"> Study Room / Library</label>
                                    </li>
                                </ul>
                            </div>
                            <label>Amenities: </label>
                            <div class=" add-list-tags fl-wrap">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec5">
                        <h5><i class="fas fa-list"></i>Description Details</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap" style="padding: 0 !important;">
                        <div class="custom-form">
                            <textarea class="description" id="description" name="description" placeholder="Enter text ..."></textarea>
                        </div>
                    </div>
                    
                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec6">
                        <h5><i class="fas fa-cloud-upload-alt"></i>Room</h5>
                    </div>
                    <div id="property-container">
                        <div class="dasboard-widget-box fl-wrap property-row">
                            <div class="custom-form">
                                <div class="add-list-tags fl-wrap" style="margin-bottom: 15px;">
                                    <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                        <li>
                                            <input type="radio" name="roomtype[0]" id="roomtype1" value="Private Room">
                                            <label for="roomtype1">Private Room</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="roomtype[0]" id="roomtype2" value="Double Sharing">
                                            <label for="roomtype2">Double Sharing</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="roomtype[0]" id="roomtype3" value="Triple Sharing">
                                            <label for="roomtype3">Triple Sharing</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="roomtype[0]" id="roomtype4" value="3+ Sharing">
                                            <label for="roomtype4">3+ Sharing</label>
                                        </li>
                                    </ul>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6" style="padding:10px !important;">
                                        <label>Listing Price</label>
                                        <input type="text" name="amount[0]" placeholder="Enter Amount" style="padding: 10px 15px 10px 20px;" />
                                    </div>
                                    <div class="col-sm-6" style="padding:10px !important;">
                                        <label>Security Price</label>
                                        <input type="text" name="securityamount[0]" placeholder="Enter Security Amount" style="padding: 10px 15px 10px 20px;" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6" style="background:#eeeff3;border:1px solid #cdcdcd;padding:20px;">
                                        <label>Upload Image</label>
                                        <input type="file" name="thumbnail[0]" />
                                    </div>
                                    <div class="col-sm-6" style="background:#eeeff3;border:1px solid #cdcdcd;padding:20px;">
                                        <label>Multiple Images</label>
                                        <input type="file" name="banners[0][]" multiple />
                                    </div>
                                    <a href="javascript:void(0)" class="remove-row" style="margin-top: 10px; background: #d01616; color: white; padding: 2px 10px;display:none;"><i class="fas fa-trash-alt"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add button -->
                    <button type="button" class="btn color-bg" id="add-property" style="margin-top:20px;">
                        + Add Property
                    </button>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec7">
                        <h5><i class="fas fa-list"></i>Social Media</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap">
                        <div class="custom-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Website</label>
                                    <input type="text" name="website" placeholder="Enter Website Url" style="padding: 10px 15px 10px 20px;" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Facebook Link</label>
                                    <input type="text" name="facebook_link"
                                        placeholder="Enter Facebook Profile Url" style="padding: 10px 15px 10px 20px;"/>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Instagram Link</label>
                                    <input type="text" name="instagram_link"
                                        placeholder="Enter Instagram Profile Url" style="padding: 10px 15px 10px 20px;"/>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Twitter Link</label>
                                    <input type="text" name="twitter_link"
                                        placeholder="Enter Twitter Profile Url" style="padding: 10px 15px 10px 20px;"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">LinkedIn Link</label>
                                    <input type="text" name="linkedin_link"
                                        placeholder="Enter Linkedin Profile Url" style="padding: 10px 15px 10px 20px;"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec8">
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
        $(document).ready(function() {
            $('#name').on('input', function() {
                var name = $(this).val().trim().toLowerCase();
                var slug = name.replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });
        $(".description").summernote({
            placeholder: 'Enter Description here....',
            height: "250"
        });
        // Add new property row
        let i = 1;
        $("#add-property").click(function() {
            let newRow = $(".property-row:first").clone();
            newRow.find("input[type=text], input[type=file]").val("");
            newRow.find("input[type=radio]").each(function(index) {
                let oldId = $(this).attr("id");
                let newId = oldId + "_" + i; 
                $(this).attr("id", newId);
                $(this).next("label").attr("for", newId);
                let oldName = $(this).attr("name");
                let newName = oldName.replace(/\[\d+\]/, "[" + i + "]");
                $(this).attr("name", newName);
                $(this).prop("checked", false);
            });
            newRow.find("input[type=text], input[type=file]").each(function() {
                let name = $(this).attr("name");
                if (name) {
                    let newName = name.replace(/\[\d+\]/, "[" + i + "]");
                    $(this).attr("name", newName);
                }
            });
            newRow.find(".remove-row").show();
            $("#property-container").append(newRow);
            i++;
        });
        $(document).on("click", ".remove-row", function() {
            $(this).closest(".property-row").remove();
        });
    </script>
@endsection
