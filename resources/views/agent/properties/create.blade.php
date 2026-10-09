@extends('agent.layouts.app')
@section('content')
<style>
    .fl-wrap {
        float: left;
        width: 100%;
        position: relative;
    }
</style>
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'properties.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="page-header mb-0">Create New Property</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create New Property</li>
                    </ol>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'properties.index') }}" class="btn btn-default px-4"><i class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Cancel</a>
                    <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Save and New</button>
                    <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Save</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-info fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Property Information
                        </div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-0">
                                <strong> Success! </strong> {{ \Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show rounded-0">
                                <strong> Opps! </strong> Something went wrong, please check below errors.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Listing Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type<span class="text-danger">*</span></label>
                                        <select class="form-select type" name="property_type" id="type">
                                            <option value="1">On Sale</option>
                                            <option value="2">On Rent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="category">Select Category</label>
                                        <select class="form-select category" name="category" id="category">
                                            <option value="">Select Parent Category</option>
                                            @if($categories)
                                                @foreach($categories as $category)
                                                    <?php $dash=''; ?>
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
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

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Listing Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount: 20000,40000" value="{{ old('amount') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keyword<span class="form-text">(optional)</span></label>
                                <div class="form-control p-0 overflow-hidden">
                                    <textarea class="textarea form-control" id="keyword" name="keyword" rows="1" placeholder="Maximum 30 , should be separated by commas"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-street-view fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Location / Contacts
                        </div>
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">City<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ old('city') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">State<span class="text-danger">*</span></label>
                                        <select class="form-select state" name="state" id="state">
                                            <option value="0">-- Select State --</option>
                                            @foreach ($state as $states)
                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Landmark<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="landmark" value="{{ old('landmark') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Listing Details
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Area<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="area" id="area" placeholder="Enter area" value="{{ old('area') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Bedrooms<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bedrooms" id="bedrooms" placeholder="Enter number of bedrooms" value="{{ old('bedrooms') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Accomodation<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="accomodation" id="accomodation" placeholder="Enter number of accomodation" value="{{ old('accomodation') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Bathrooms<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bathrooms" id="bathrooms" placeholder="Enter bathrooms" value="{{ old('bathrooms') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Yard size<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bedrooms" id="bedrooms" placeholder="Enter number of bedrooms" value="{{ old('bedrooms') }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Garage<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="garage" id="garage" placeholder="Enter number of garage" value="{{ old('garage') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
									<label class="form-label col-form-label">Amenities</label>
									<div class="pt-2">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="wifi" id="wifi" value="1">
											<label class="form-check-label" for="wifi"><i class="fa fa-wifi"></i> Wi Fi</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="pool" id="pool" value="1">
											<label class="form-check-label" for="pool"><i class="fa fa-swimmer"></i> Pool</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="security" id="security" value="1">
											<label class="form-check-label" for="security"><i class="fa fa-eye"></i> Security</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="laundry" id="laundry" value="1">
											<label class="form-check-label" for="laundry"><i class="fa fa-washer"></i> Laundry Room</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="equipped-kitchen" id="equipped-kitchen" value="1">
											<label class="form-check-label" for="equipped-kitchen"><i class="fa fa-utensils"></i> Equipped Kitchen</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="air-conditioning" id="air-conditioning" value="1">
											<label class="form-check-label" for="air-conditioning"><i class="fa fa-cloud"></i> Air Conditioning</label>
										</div>
                                        
									</div>
                                    <div class="pt-2">
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="gym" id="gym" value="1">
											<label class="form-check-label" for="gym"><i class="fa fa-dumbbell"></i> GYM</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="parking" id="parking" value="1">
											<label class="form-check-label" for="parking"><i class="fa fa-parking"></i> Parking</label>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-home fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Nearby facilities
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
									<div class="pt-2">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="airport" id="airport" value="1">
											<label class="form-check-label" for="airport">Airport</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="park" id="park" value="1">
											<label class="form-check-label" for="park">Park</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="busstand" id="busstand" value="1">
											<label class="form-check-label" for="busstand">Bus Stand</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="mandir" id="mandir" value="1">
											<label class="form-check-label" for="mandir">Mandir</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="hospital" id="hospital" value="1">
											<label class="form-check-label" for="hospital">Hospital</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="school" id="school" value="1">
											<label class="form-check-label" for="school">School</label>
										</div>
                                        <div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" name="railwaystation" id="railwaystation" value="1">
											<label class="form-check-label" for="railwaystation">Railway Station</label>
										</div>
									</div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-search fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Description
                        </div>
                        <textarea class="description form-control" id="description" name="description" placeholder="Enter text ..."></textarea>
                    </div>
                    
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Property Image</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Thumbnail </label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                                </div>
                                <img src="" id="thumbnail-view" class="rounded w-100px my-n1 mx-n1"/>
                            </div>
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Multiple Images <span class="form-text">(optional)</span></label>
                                     <input type="file" class="form-control" id="banner" name="banner[]"
                                        multiple>
                                </div>
                                <img src="" id="banner-view" class="rounded w-350px my-n1 mx-n1"/>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Seo Content</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label class="form-label" for="meta-title">Meta Title<span class="form-text">(optional)</span></label>
                                <input type="text" class="form-control" name="metatitle" id="meta-title"
                                    placeholder="Enter Seo Meta Title" value="{{ old('metatitle') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-keyword">Meta Keyword<span class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metakeyword" id="meta-keyword" placeholder="Enter Seo Meta Keyword" rows="4">{{ old('metakeyword') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-desc">Meta Description<span class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metadescription" id="meta-desc" placeholder="Enter Seo Meta Description" rows="5">{{ old('metadescription') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Dealer Detail</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label class="form-label" for="status">Select Dealer<span class="text-danger">*</span></label>
                                <select class="form-select dealer" name="dealer" id="dealer">
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
        </form>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(".dealer").select2({ minimumResultsForSearch: Infinity });
        $(".type").select2({ minimumResultsForSearch: Infinity });
        $(".state").select2();
        $(".category").select2();
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
        //Banner Preview
        $("#thumbnail").change(function () {
            readURL(this, '#thumbnail-view');
        });
        $("#banner").change(function () {
            readURL(this, '#banner-view');
        });
        //Banner Status Toggle
        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(target).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
