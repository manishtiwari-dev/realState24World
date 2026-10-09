@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix() . 'auctions.edit', ['id' => encode_string($propertyrow->id)]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="page-header mb-0">Update Auction Property</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Update Auction Property</li>
                    </ol>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'auctions.index') }}" class="btn btn-default px-4"><i
                            class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Cancel</a>
                    <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i
                            class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Save and New</button>
                    <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i
                            class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Save</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-info fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Auction Property Information
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
                                <label class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ $propertyrow->name }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="slug" id="slug"
                                            placeholder="Slug" value="{{ $propertyrow->slug }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Property Type<span class="text-danger">*</span></label>
                                        <select class="form-select type" name="property_type" id="type">
                                            <option value="1" @if ($propertyrow->property_type == '1') selected @endif>On Sale
                                            </option>
                                            <option value="2" @if ($propertyrow->property_type == '2') selected @endif>On Rent
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Last Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="last_date" id="last_date" placeholder="Enter Last Date" value="{{ $propertyrow->last_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="category">Select Category</label>
                                        <select class="form-select category" name="category" id="category">
                                            <option value="">Select Parent Category</option>
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

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Type<span class="text-danger">*</span></label>
                                        <select class="form-select type" name="type" id="type">
                                            <option value="all-residential"
                                                @if ($propertyrow->type == 'all-residential') selected @endif>All Residential</option>
                                            <option value="flats-apartments"
                                                @if ($propertyrow->type == 'flats-apartments') selected @endif>Flats/Apartments</option>
                                            <option value="house-villas" @if ($propertyrow->type == 'house-villas') selected @endif>
                                                House/Villas</option>
                                            <option value="builder-floors"
                                                @if ($propertyrow->type == 'builder-floors') selected @endif>Builder Floors</option>
                                            <option value="farm-house" @if ($propertyrow->type == 'farm-house') selected @endif>
                                                Farm House</option>
                                            <option value="residential-plots"
                                                @if ($propertyrow->type == 'residential-plots') selected @endif>Residential Plots
                                            </option>
                                            <option value="penthouse" @if ($propertyrow->type == 'penthouse') selected @endif>
                                                Penthouse</option>
                                            <option value="studio-apartments"
                                                @if ($propertyrow->type == 'studio-apartments') selected @endif>Studio Apartments
                                            </option>
                                            <option value="commercial" @if ($propertyrow->type == 'commercial') selected @endif>
                                                Commercial</option>
                                            <option value="plot" @if ($propertyrow->type == 'plot') selected @endif>
                                                Land/Plot</option>
                                            <option value="industrial" @if ($propertyrow->type == 'industrial') selected @endif>
                                                Industrial</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Listing Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount: 20000,40000" value="{{ $propertyrow->amount }}">
                                    </div>
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
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ $propertyrow->address }}">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">City<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $propertyrow->city }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">State<span class="text-danger">*</span></label>
                                        <select class="form-select state" name="state" id="state">
                                            <option value="0">-- Select State --</option>
                                            @foreach ($state as $states)
                                                <option value="{{ $states->id }}"
                                                    @if ($states->id == $propertyrow->state_id) selected @endif>{{ $states->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Landmark<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="landmark" id="landmark" placeholder="landmark" value="{{ $propertyrow->landmark }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-search fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Description
                        </div>
                        <textarea class="description form-control" id="description" name="description" placeholder="Enter text ...">{{ $propertyrow->description }}</textarea>
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
                                <img src="{{ asset('uploads/auction/' . $propertyrow->thumbnail) }}" id="thumbnail-view" class="rounded w-100px my-n1 mx-n1" />
                            </div>
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Multiple Images <span class="form-text">(optional)</span></label>
                                    <input type="file" class="form-control" id="banner" name="banner[]" multiple>
                                </div>
                                @if (!empty(json_decode($propertyrow->multiple_images)))
                                    <div class="row d-flex gap-2 mt-2" style="flex-wrap: nowrap; overflow-x: auto;">
                                        @foreach (json_decode($propertyrow->multiple_images) as $image)
                                            <div class="col-sm-3 text-center">
                                                <img src="{{ asset('uploads/auction/' . $image) }}" style="max-width: 100px; height: auto; border: 1px solid #ccc; padding: 5px;">
                                                <button class="btn btn-danger btn-xs mt-2 delete-image-btn"
                                                    data-image="{{ $image }}" data-id="{{ $propertyrow->id }}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="noticefile">Notice </label>
                                    <input type="file" class="form-control" name="noticefile" id="noticefile">
                                </div>
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
                                <label class="form-label" for="meta-title">Meta Title<span
                                        class="form-text">(optional)</span></label>
                                <input type="text" class="form-control" name="metatitle" id="meta-title"
                                    placeholder="Enter Seo Meta Title" value="{{ $propertyrow->metatitle }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-keyword">Meta Keyword<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metakeyword" id="meta-keyword" placeholder="Enter Seo Meta Keyword"
                                    rows="4">{{ $propertyrow->metakeyword }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-desc">Meta Description<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="metadescription" id="meta-desc" placeholder="Enter Seo Meta Description"
                                    rows="5">{{ $propertyrow->metadescription }}</textarea>
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
                                <label class="form-label" for="status">Select Dealer<span
                                        class="text-danger">*</span></label>
                                <select class="form-select dealer" name="dealer" id="dealer">
                                    <option value="0">-- Select Dealer --</option>
                                    @foreach ($dealers as $dealer)
                                        <option value="{{ $dealer->id }}"
                                            @if ($dealer->id == $propertyrow->dealer_id) selected @endif>{{ $dealer->name }}
                                        </option>
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
        $(document).ready(function() {
            $('.delete-image-btn').on('click', function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this image?')) return;
                var image = $(this).data('image');
                var propertyId = $(this).data('id');
                var button = $(this);
                $.ajax({
                    url: '{{ route(getRolePrefix() . 'auctions.image.delete') }}',
                    method: 'POST',
                    data: {
                        id: propertyId,
                        image: image,
                        _token: '{{ csrf_token() }}'
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
        $(".dealer").select2({
            minimumResultsForSearch: Infinity
        });
        $(".type").select2({
            minimumResultsForSearch: Infinity
        });
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
            height: "300"
        });
        //Banner Preview
        $("#thumbnail").change(function() {
            readURL(this, '#thumbnail-view');
        });
        $("#banner").change(function() {
            readURL(this, '#banner-view');
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
