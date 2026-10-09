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
                        <li><a href="#sec4">Details</a></li>
                    </ul>
                    <div class="progress-indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 34 34">
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background" />
                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__progress js-progress-bar" />
                        </svg>
                    </div>
                </div>

                <form method="POST" action="{{ route('front.dashboardeditlisting', ['id' => encode_string($propertyrow->id)]) }}" enctype="multipart/form-data" class="">
                    @csrf
                    <div class="dasboard-widget-title fl-wrap" id="sec1">
                        <h5><i class="fas fa-info"></i>Basic Informations</h5>
                        @if (Session::has('error'))
                            <div style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div style="background: #0ca60c; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
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
                                    <label>Listing Title <span class="dec-icon"><i class="fas fa-briefcase"></i></span></label>
                                    <input type="text" name="name" id="name" placeholder="Name of your business" value="{{ $propertyrow->name }}" />
                                    @error('name')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-8">
                                    <label>Slug <span class="dec-icon"><i class="fas fa-briefcase"></i></span></label>
                                    <input type="text" placeholder="Slug" name="slug" id="slug" value="{{ $propertyrow->slug }}" readonly />
                                </div>
                                   <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Property Type <span class="dec-icon"><i class="fas fa-home-lg-alt"></i></span></label>
                                    <select data-placeholder="property_type" name="property_type">
                                        <option value="1" @if ($propertyrow->property_type == '1') selected @endif>On Sale</option>
                                        <option value="2" @if ($propertyrow->property_type == '2') selected @endif>On Rent</option>
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
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $propertyrow->category_id) selected @endif>
                                                        {{ $category->name }}</option>
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
                                        <select data-placeholder="Apartments" name="type"
                                            class="chosen-select no-search-select">
                                            <option value="All Categories" {{ $propertyrow->type == 'All Categories' ? 'selected' : '' }}>All Categories</option>
                                            <option value="Residential" {{ $propertyrow->type == 'Residential' ? 'selected' : '' }}> Residential </option>
                                            <option value="Commercial" {{ $propertyrow->type == 'Commercial' ? 'selected' : '' }}> Commercial </option>
                                            <option value="Plot" {{ $propertyrow->type == 'Plot' ? 'selected' : '' }}> Plot </option>
                                            <option value="Industrial" {{ $propertyrow->type == 'Industrial' ? 'selected' : '' }}> Industrial </option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-4" style="padding:10px !important;">
                                    <label>Listing Price <span class="dec-icon"><i class="fas fa-money-bill-wave"></i></span></label>
                                    <input type="text" name="amount" placeholder="Enter Amount: 20000,40000" value="{{ $propertyrow->amount }}" />
                                    @error('amount')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px">

                                <div class="col-sm-12">
                                    <label>Keywords <span class="dec-icon"><i class="fas fa-key"></i></span></label>
                                    <input type="text" name="keyword" placeholder="Maximum 15 , should be separated by commas" value="{{ $propertyrow->keyword }}" />
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
                                        value="{{ $propertyrow->address }}" />
                                    @error('address')
                                        <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>City <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                    <input type="text" name="city" placeholder="City"
                                        value="{{ $propertyrow->city }}" />
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
                                                <option value="{{ $states->id }}"
                                                    @if ($states->id == $propertyrow->state_id) selected @endif>{{ $states->name }}
                                                </option>
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
                                        value="{{ $propertyrow->landmark }}" />
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
                                                value="{{ $propertyrow->area }}" />
                                            @error('area')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Accomodation: <span class="dec-icon"><i
                                                        class="fas fa-users"></i></span></label>
                                            <input type="text" name="accomodation" placeholder="Listing Accomodation"
                                                value="{{ $propertyrow->accomodation }}" />
                                            @error('accomodation')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Yard size: <span class="dec-icon"><i
                                                        class="fas fa-tree"></i></span></label>
                                            <input type="text" name="yard_size" placeholder="Yard size"
                                                value="{{ $propertyrow->yard_size }}" />
                                            @error('yard_size')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror


                                        </div>
                                        <div class="col-sm-6">
                                            <label>Bedrooms: <span class="dec-icon"><i
                                                        class="fas fa-bed"></i></span></label>
                                            <input type="text" name="bedrooms" placeholder="House Bedrooms"
                                                value="{{ $propertyrow->bedrooms }}" />
                                            @error('bedrooms')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Bathrooms: <span class="dec-icon"><i
                                                        class="fas fa-bath"></i></span></label>
                                            <input type="text" name="bathrooms" placeholder="House Bathrooms"
                                                value="{{ $propertyrow->bathrooms }}" />
                                            @error('bathrooms')
                                                <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                            @enderror
                                            <label>Garage: <span class="dec-icon"><i
                                                        class="fas fa-warehouse"></i></span></label>
                                            <input type="text" name="garage" placeholder="Number of cars"
                                                value="{{ $propertyrow->garage }}" />
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
                                        <input type="checkbox" name="wifi" id="wifi" value="1"
                                            @if ($propertyrow->wifi == '1') checked @endif>
                                        <label for="wifi"> Wi Fi</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="pool" id="pool" value="1"
                                            @if ($propertyrow->pool == '1') checked @endif>
                                        <label for="pool">Pool</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="security" id="security" value="1"
                                            @if ($propertyrow->security == '1') checked @endif>
                                        <label for="security"> Security</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="laundry" id="laundry" value="1"
                                            @if ($propertyrow->laundry == '1') checked @endif>
                                        <label for="laundry"> Laundry Room</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="equipped-kitchen" id="equipped-kitchen"
                                            value="1" @if ($propertyrow->equipped_kitchen == '1') checked @endif>
                                        <label for="equipped-kitchen"> Equipped Kitchen</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="air-conditioning" id="air-conditioning"
                                            value="1" @if ($propertyrow->air_conditioning == '1') checked @endif>
                                        <label for="air-conditioning">Air Conditioning</label>
                                    </li>
                                    <li>
                                        <input id="gym" type="checkbox" name="gym" id="gym"
                                            value="1" @if ($propertyrow->gym == '1') checked @endif>
                                        <label for="gym">Gym</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" name="parking" id="parking" value="1"
                                            @if ($propertyrow->parking == '1') checked @endif>
                                        <label for="parking">Parking</label>
                                    </li>

                                       <li>
                                        <input type="checkbox" name="elevator" id="elevator" value="1"  @if ($propertyrow->elevator == '1') checked @endif>
                                        <label for="elevator">Elevator</label>
                                    </li>
                                </ul>
                                <!-- Checkboxes end -->
                            </div>
                        </div>
                    </div>

                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec4">
                        <h5><i class="fas fa-list"></i>Description Details</h5>
                    </div>
                    <div class="dasboard-widget-box fl-wrap" style="padding: 0 !important;">
                        <div class="custom-form">
                            <textarea class="description" id="description" name="description" placeholder="Enter text ...">{{ $propertyrow->description }}</textarea>
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
                                        <!-- Checkboxes -->
                                        <ul class="fl-wrap filter-tags no-list-style ds-tg">
                                            <li>
                                                <input type="checkbox" name="airport" id="airport" value="1"
                                                    @if ($propertyrow->airport == '1') checked @endif>
                                                <label for="airport">Airport</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="park" id="park" value="1"
                                                    @if ($propertyrow->park == '1') checked @endif>
                                                <label for="park">Park</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="busstand" id="busstand" value="1"
                                                    @if ($propertyrow->busstand == '1') checked @endif>
                                                <label for="busstand">Bus Stand</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="mandir" id="mandir" value="1"
                                                    @if ($propertyrow->mandir == '1') checked @endif>
                                                <label for="mandir">Mandir</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="hospital" id="hospital" value="1"
                                                    @if ($propertyrow->hospital == '1') checked @endif>
                                                <label for="hospital">Hospital</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="school" id="school" value="1"
                                                    @if ($propertyrow->school == '1') checked @endif>
                                                <label for="school">School</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="railwaystation" id="railwaystation"
                                                    value="1" @if ($propertyrow->railwaystation == '1') checked @endif>
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
                                        @if (!empty($propertyrow->thumbnail))
                                            <div style="margin-top:10px;">
                                                <img src="{{ asset('uploads/properties/' . $propertyrow->thumbnail) }}"
                                                    alt="Thumbnail"
                                                    style="max-width: 200px; height: auto; border: 1px solid #ccc; padding: 5px;">
                                            </div>
                                        @endif

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

                                        @if (!empty(json_decode($propertyrow->multiple_images)))
                                            <div class="row d-flex gap-2 mt-2"
                                                style="flex-wrap: nowrap; overflow-x: auto;">
                                                @foreach (json_decode($propertyrow->multiple_images) as $image)
                                                    <div class="col-sm-3">
                                                        <img src="{{ asset('uploads/properties/' . $image) }}"
                                                            alt="Image"
                                                            style="max-width: 100px; height: auto; border: 1px solid #ccc; padding: 5px;">

                                                        <button class="  mt-2 delete-image-btn"
                                                            data-image="{{ $image }}"
                                                            data-id="{{ $propertyrow->id }}">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>

                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif



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
                                    <textarea cols="40" rows="3" name="metatitle" style="height: 175px;margin-bottom: 10px" placeholder="Enter Meta Title" spellcheck="false">{{ $propertyrow->metatitle }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label>Meta Keyword<span class="form-text">(optional)</span> </label>
                                    <textarea cols="40" rows="3" name="metakeyword" style="height: 175px;margin-bottom: 10px" placeholder="Enter Meta Keyword" spellcheck="false">{{ $propertyrow->metakeyword }}</textarea>

                                </div>

                                <div class="col-md-4">
                                    <label>Meta Description<span class="form-text">(optional)</span> </label>
                                    <textarea cols="40" rows="3" name="metadescription" style="height: 175px;margin-bottom: 10px" placeholder="Enter Meta Description" spellcheck="false">{{ $propertyrow->metadescription }}</textarea>

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
                                        <label>Select Dealer <span class="dec-icon"><i class="fas fa-map-marker"></i></span></label>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Apartments" name="dealer"
                                                class="chosen-select no-search-select">
                                                <option value="0">-- Select Dealer --</option>
                                                @foreach ($dealers as $item)
                                                    <option value="{{ $item->id }}" {{ $propertyrow->dealer_id == $item->id ? 'selected' : '' }}> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <button class="btn color-bg float-btn" type="submit">Save Changes</button>
                </form>

            </div>
        </div>
        <div class="limit-box fl-wrap"></div>

    </div>
@endsection
@section('custom-javascript')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-image-btn').on('click', function(e) {
                e.preventDefault();

                if (!confirm('Are you sure you want to delete this image?')) return;

                var image = $(this).data('image');
                var propertyId = $(this).data('id');
                var button = $(this);


                $.ajax({

                    url: '{{ route('listing.image.delete') }}',
                    method: 'POST',
                    data: {
                        id: propertyId,
                        image: image,
                    },
                    success: function(response) {
                        if (response.success) {
                            button.closest('.col-sm-3').remove();
                            toastr.success(response.message);
                        } else {
                            alert('Failed to delete image.');
                        }
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                    }
                });
            });
        });
    </script>

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
