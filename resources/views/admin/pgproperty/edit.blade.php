@extends('admin.layouts.app')
@section('content')
    <style>
        .card {
            margin-bottom: 0px;
        }

        .form-section-title {
            background-color: #2e353c;
            color: white;
            padding: 5px 15px;
            font-weight: 500;
        }

        .profile-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
    </style>
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Update PG/Co-Living</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">PG</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Update PG/Co-Living</li>
                </ol>
            </div>
            @can('dealer-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'pgproperty.index') }}" class="btn btn-primary px-4"><i
                            class="fa fa-list fa-lg ms-n2 "></i> &nbsp; BACK TO PG/Co-Living LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route(getRolePrefix() . 'pgproperty.edit', ['id' => encode_string($projectrow->id)]) }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="property_type" value="2">
                    <div class="card">
                        <div class="form-section-title">Basic Information</div>
                        <div class="card-body row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Your Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter  Name" value="{{ $projectrow->agent_name }}" />
                                <input type="hidden" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ $projectrow->slug }}" readonly>
                                @error('name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                <label class="form-label" for="status">Select Dealer<span class="text-danger">*</span></label>
                                <select class="form-select dealer" name="dealer" id="dealer">
                                    <option value="0">-- Select Dealer --</option>
                                    @foreach ($dealers as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $projectrow->dealer_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="category">Select Category</label>
                                    <select class="form-select category" name="category" id="category">
                                        <option value="">Select Parent Category</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <?php $dash=''; ?>
                                                <option value="{{$category->id}}" {{ $category->id == 6 ? 'selected' : '' }}>{{$category->name}}</option>
                                                @if(count($category->subcategory))
                                                    @include('admin.category.sub-category-option',['subcategories' => $category->subcategory])
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger">*</span></label>
                                    <select class="form-select type" name="type" id="type">
                                        <option value="all-residential" {{ $projectrow->type == 'all-residential' ? 'selected' : '' }}>All Residential</option>
                                        <option value="flats-apartments" {{ $projectrow->type == 'flats-apartments' ? 'selected' : '' }}>Flats/Apartments</option>
                                        <option value="house-villas" {{ $projectrow->type == 'house-villas' ? 'selected' : '' }}>House/Villas</option>
                                        <option value="builder-floors" {{ $projectrow->type == 'builder-floors' ? 'selected' : '' }}>Builder Floors</option>
                                        <option value="farm-house" {{ $projectrow->type == 'farm-house' ? 'selected' : '' }}>Farm House</option>
                                        <option value="residential-plots" {{ $projectrow->type == 'residential-plots' ? 'selected' : '' }}>Residential Plots</option>
                                        <option value="penthouse" {{ $projectrow->type == 'penthouse' ? 'selected' : '' }}>Penthouse</option>
                                        <option value="studio-apartments" {{ $projectrow->type == 'studio-apartments' ? 'selected' : '' }}>Studio Apartments</option>
                                        <option value="commercial" {{ $projectrow->type == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                        <option value="plot" {{ $projectrow->type == 'plot' ? 'selected' : '' }}>Land/Plot</option>
                                        <option value="industrial" {{ $projectrow->type == 'industrial' ? 'selected' : '' }}>Industrial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Landmark<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="landmark" id="landmark" placeholder="landmark" value="{{ $projectrow->landmark }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address On Google<span class="form-text">(optional)</span></label>
                                <div class="form-control p-0 overflow-hidden">
                                    <textarea class="textarea form-control" id="keyword" name="keyword" rows="1" placeholder="Google Map Link">{{ $projectrow->keyword }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Website</label>
                                <input type="url" class="form-control" name="website" placeholder="Enter Website Url" value="{{ $projectrow->website }}" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Facebook Link</label>
                                <input type="url" class="form-control" name="facebook_link"
                                    placeholder="Enter Facebook Profile Url" value="{{ $projectrow->facebook_link }}" />
                            </div>

                             <div class="col-md-3">
                                <label class="form-label">Instagram Link</label>
                                <input type="url" class="form-control" name="instagram_link"
                                    placeholder="Enter Instagram Profile Url" value="{{ $projectrow->instagram_link }}" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Twitter Link</label>
                                <input type="url" class="form-control" name="twitter_link"
                                    placeholder="Enter Twitter Profile Url" value="{{ $projectrow->twitter_link }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">LinkedIn Link</label>
                                <input type="url" class="form-control" name="linkedin_link"
                                    placeholder="Enter Linkedin Profile Url" value="{{ $projectrow->linkedin_link }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="form-section-title">Address Details</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" value="{{ $projectrow->address }}" />
                                @error('address')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" placeholder="Enter City" value="{{ $projectrow->city }}" />
                                @error('city')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">State<span class="text-danger">*</span></label>
                                <select class="form-select state" name="state" id="state">
                                    <option value="0">-- Select State --</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->id }}" {{ $states->id == $projectrow->state_id ? 'selected' : '' }}>{{ $states->name }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="form-section-title">Listing Details</div>
                        <div class="card-body row g-3">
                            <div class="col-md-12">
                                <label class="form-label">PG Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pgname" id="name" placeholder="Enter PG Name" value="{{ $projectrow->name }}" />
                                @error('pgname')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cover Image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="coverimage" placeholder="Enter Cover Image URL" />
                                @error('coverimage')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Beds<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="pgbed" placeholder="Enter Total Beds" value="{{ $projectrow->total_beds }}" />
                                @error('pgbed')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Meal Available<span class="text-danger">*</span></label>
                                <select class="form-select state" name="meal" id="meals">
                                    <option value="No Meal" {{ $projectrow->meals == 'No Meal' ? 'selected' : '' }}>No Meal</option>
                                    <option value="Veg Meal" {{ $projectrow->meals == 'Veg Meal' ? 'selected' : '' }}>Meal - Veg (Breakfast, Lunch, Dinner)</option>
                                    <option value="NonVeg Meal" {{ $projectrow->meals == 'NonVeg Meal' ? 'selected' : '' }}>Meal - Non Veg (Breakfast, Lunch, Dinner)</option>
                                    <option value="Breakfast Only" {{ $projectrow->meals == 'Breakfast Only' ? 'selected' : '' }}>Breakfast Only</option>
                                    <option value="Lunch Only" {{ $projectrow->meals == 'Lunch Only' ? 'selected' : '' }}>Lunch Only</option>
                                    <option value="Dinner Only" {{ $projectrow->meals == 'Dinner Only' ? 'selected' : '' }}>Dinner Only</option>
                                    <option value="Veg Breakfast" {{ $projectrow->meals == 'Veg Breakfast' ? 'selected' : '' }}>Veg Breakfast</option>
                                    <option value="Veg Lunch" {{ $projectrow->meals == 'Veg Lunch' ? 'selected' : '' }}>Veg Lunch</option>
                                    <option value="Veg Dinner" {{ $projectrow->meals == 'Veg Dinner' ? 'selected' : '' }}>Veg Dinner</option>
                                    <option value="NonVeg Lunch" {{ $projectrow->meals == 'NonVeg Lunch' ? 'selected' : '' }}>Non Veg Lunch</option>
                                    <option value="NonVeg Dinner" {{ $projectrow->meals == 'NonVeg Dinner' ? 'selected' : '' }}>Non Veg Dinner</option>
                                </select>
                                @error('meals')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label col-form-label">Common Areas</label>
                                <div class="pt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="livingroom" id="livingroom" value="1" @if ($oneprop->livingroom == '1') checked @endif>
                                        <label class="form-check-label" for="livingroom">Living Room</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="kitchen" id="kitchen" value="1" @if ($oneprop->kitchen == '1') checked @endif>
                                        <label class="form-check-label" for="kitchen">Kitchen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="dininghall" id="dininghall" value="1" @if ($oneprop->dininghall == '1') checked @endif>
                                        <label class="form-check-label" for="dininghall">Dining Hall</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="library" id="library" value="1" @if ($oneprop->library == '1') checked @endif>
                                        <label class="form-check-label" for="library">Study Room / Library</label>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label col-form-label">Amenities</label>
                                <div class="pt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="wifi" id="wifi" value="1"  @if ($oneprop->wifi == '1') checked @endif>
                                        <label class="form-check-label" for="wifi"><i class="fa fa-wifi"></i> Wi Fi</label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="pool" id="pool" value="1" @if ($oneprop->pool == '1') checked @endif>
                                        <label class="form-check-label" for="pool"><i class="fa fa-swimmer"></i> Pool</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="security" id="security" value="1" @if ($oneprop->security == '1') checked @endif>
                                        <label class="form-check-label" for="security"><i class="fa fa-eye"></i> Security</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="laundry" id="laundry" value="1" @if ($oneprop->laundry == '1') checked @endif>
                                        <label class="form-check-label" for="laundry"><i class="fa fa-washer"></i> Laundry Room</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="equipped_kitchen" id="equipped-kitchen" value="1" @if ($oneprop->equipped_kitchen == '1') checked @endif>
                                        <label class="form-check-label" for="equipped-kitchen"><i class="fa fa-utensils"></i> Equipped Kitchen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="air_conditioning" id="air-conditioning" value="1" @if ($oneprop->air_conditioning == '1') checked @endif>
                                        <label class="form-check-label" for="air-conditioning"><i class="fa fa-cloud"></i> Air Conditioning</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="gym" id="gym" value="1" @if ($oneprop->gym == '1') checked @endif>
                                        <label class="form-check-label" for="gym"><i class="fa fa-dumbbell"></i> GYM</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="parking" id="parking" value="1" @if ($oneprop->parking == '1') checked @endif>
                                        <label class="form-check-label" for="parking"><i class="fa fa-parking"></i> Parking</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="garden" id="garden" value="1" @if ($oneprop->garden == '1') checked @endif>
                                        <label class="form-check-label" for="garden"><i class="fa fa-cloud"></i> Garden</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="elevator" id="elevator" value="1" @if ($oneprop->elevator == '1') checked @endif>
                                        <label class="form-check-label" for="elevator"><i class="fa fa-pause"></i> Elevator</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="form-section-title">Nearby facilities</div>
                        <div class="card-body">
                            <div class="row">
									<div class="pt-2">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="airport" id="airport" value="1"  @if ($oneprop->airport == '1') checked @endif>
											<label class="form-check-label" for="airport">Airport</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="park" id="park" value="1"  @if ($oneprop->park == '1') checked @endif>
											<label class="form-check-label" for="park">Park</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="busstand" id="busstand" value="1"  @if ($oneprop->busstand == '1') checked @endif>
											<label class="form-check-label" for="busstand">Bus Stand</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="mandir" id="mandir" value="1"  @if ($oneprop->mandir == '1') checked @endif>
											<label class="form-check-label" for="mandir">Mandir</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="hospital" id="hospital" value="1"  @if ($oneprop->hospital == '1') checked @endif>
											<label class="form-check-label" for="hospital">Hospital</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="school" id="school" value="1"  @if ($oneprop->school == '1') checked @endif>
											<label class="form-check-label" for="school">School</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="market" id="market" value="1"  @if ($oneprop->market == '1') checked @endif>
											<label class="form-check-label" for="market">Market</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="railwaystation" id="railwaystation" value="1"  @if ($oneprop->railwaystation == '1') checked @endif>
											<label class="form-check-label" for="railwaystation">Railway Station</label>
										</div>
									</div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="form-section-title">Description</div>
                        <textarea class="description form-control" id="description" name="description" placeholder="Enter text ...">{{ $projectrow->about }}</textarea>
                    </div>
                    {{-- <div class="card">
                        <div class="form-section-title">Room</div>
                        <div id="property-container">
                            <div class="property-row">
                                <div class="card-body row g-3" style="border-bottom: 1px solid #dee2e6;">
                                    <div class="col-md-11">
                                        <div class="pt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="roomtype[0]" id="roomtype1" value="Private Room">
                                                <label class="form-check-label" for="roomtype1">Private Room</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="roomtype[0]" id="roomtype2" value="Double Sharing">
                                                <label class="form-check-label" for="roomtype2">Double Sharing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="roomtype[0]" id="roomtype3" value="Triple Sharing">
                                                <label class="form-check-label" for="roomtype3">Triple Sharing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="roomtype[0]" id="roomtype4" value="3+ Sharing">
                                                <label class="form-check-label" for="roomtype4">3+ Sharing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"><a href="javascript:void(0)" class="remove-row" style="margin-top: 10px; background: #d01616; color: white; padding: 2px 10px;display:none;"><i class="fas fa-trash-alt"></i> Remove</a></div>
                                    <div class="col-md-3">
                                        <label class="form-label">Listing Price</label>
                                        <input class="form-control" type="text" name="amount[0]" placeholder="Enter Amount" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Security Price</label>
                                        <input class="form-control" type="text" name="securityamount[0]" placeholder="Enter Security Amount" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" name="thumbnail[0]" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Multiple Images</label>
                                        <input type="file" class="form-control" name="banners[0][]" multiple />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary w-20" id="add-property"> + Add Property </button>
                    </div> --}}
                    <div class="card">
                        <div class="form-section-title">Room</div>
                        <div id="property-container">
                            @foreach($rooms as $key => $room)
                            <div class="property-row">
                                <div class="card-body row g-3" style="border-bottom: 1px solid #dee2e6;">
                                    
                                    <!-- Hidden input for property_id -->
                                    <input type="hidden" name="property_id[{{ $key }}]" value="{{ $room->id }}">

                                    <div class="col-md-11">
                                        <div class="pt-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" 
                                                    name="roomtype[{{ $key }}]" id="roomtype1_{{ $key }}" 
                                                    value="Private Room"
                                                    {{ $room->room_type == 'Private Room' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="roomtype1_{{ $key }}">Private Room</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" 
                                                    name="roomtype[{{ $key }}]" id="roomtype2_{{ $key }}" 
                                                    value="Double Sharing"
                                                    {{ $room->room_type == 'Double Sharing' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="roomtype2_{{ $key }}">Double Sharing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" 
                                                    name="roomtype[{{ $key }}]" id="roomtype3_{{ $key }}" 
                                                    value="Triple Sharing"
                                                    {{ $room->room_type == 'Triple Sharing' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="roomtype3_{{ $key }}">Triple Sharing</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" 
                                                    name="roomtype[{{ $key }}]" id="roomtype4_{{ $key }}" 
                                                    value="3+ Sharing"
                                                    {{ $room->room_type == '3+ Sharing' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="roomtype4_{{ $key }}">3+ Sharing</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <a href="javascript:void(0)" class="remove-row" style="margin-top: 10px; background: #d01616; color: white; padding: 2px 10px;">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </a>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Listing Price</label>
                                        <input class="form-control" type="text" 
                                            name="amount[{{ $key }}]" 
                                            value="{{ old('amount.'.$key, $room->amount) }}" 
                                            placeholder="Enter Amount" />
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Security Price</label>
                                        <input class="form-control" type="text" 
                                            name="securityamount[{{ $key }}]" 
                                            value="{{ old('securityamount.'.$key, $room->security_amount) }}" 
                                            placeholder="Enter Security Amount" />
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" name="thumbnail[{{ $key }}]" />
                                        @if($room->thumbnail)
                                            <img src="{{ asset('uploads/properties/'.$room->thumbnail) }}" width="80" class="mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Multiple Images</label>
                                        <input type="file" class="form-control" name="banners[{{ $key }}][]" multiple />
                                        @if($room->multiple_images)
                                            @foreach(json_decode($room->multiple_images) as $img)
                                                <img src="{{ asset('uploads/properties/'.$img) }}" width="60" class="mt-2">
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary w-20" id="add-property"> + Add Property </button>
                    </div>

                    <div class="card border-0">
                        <div class="form-section-title">Seo Content</div>
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label class="form-label" for="meta-title">Meta Title<span class="form-text">(optional)</span></label>
                                <input type="text" class="form-control" name="metatitle" id="meta-title"
                                    placeholder="Enter Seo Meta Title" value="{{ $projectrow->metatitle }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-keyword">Meta Keyword<span class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metakeyword" id="meta-keyword" placeholder="Enter Seo Meta Keyword" rows="1">{{ $projectrow->metakeyword }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-desc">Meta Description<span class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metadescription" id="meta-desc" placeholder="Enter Seo Meta Description" rows="1">{{ $projectrow->metadescription }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-footer bg-dark p-3" style="text-align: right;">
                            <a href="{{ route(getRolePrefix() . 'pgproperty.index') }}" class="btn btn-danger ms-2">CANCEL</a>
                            <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(".default-select").select2({
            minimumResultsForSearch: Infinity
        });
         $(document).ready(function() {
            $('#name').on('input', function() {
                var name = $(this).val().trim().toLowerCase();
                var slug = name.replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });
        $(".state").select2();
        //Description
        $(".description").summernote({
          placeholder: 'Enter Description here....',
          height: "150"
        });
        //addmore
        let i = 1;
        $("#add-property").click(function() {
            let newRow = $(".property-row:first").clone();
            newRow.find("input[type=text], input[type=file]").val("");
            newRow.find("img").remove();
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
        //Thumbnail
        $("#thumbnail").change(function() {
            readURL(this, '#profile-view');
        });
        $("#company_logo").change(function() {
            readURL(this, '#thumbnail-view');
        });
        //Banner Status Toggle
        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
