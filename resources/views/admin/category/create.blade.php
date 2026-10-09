@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'category.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="page-header mb-0">Create New Category</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create New Category</li>
                    </ol>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'category.index') }}" class="btn btn-default px-4"><i class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Cancel</a>
                    <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Save and New</button>
                    <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Save</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Category Information
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
                                <label class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Category Slug" value="{{ old('slug') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Short Description<span class="form-text">(optional)</span></label>
                                <div class="form-control p-0 overflow-hidden">
                                    <textarea class="textarea form-control" id="shortdescription" name="shortdescription" placeholder="Enter text ..." rows="9"></textarea>
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
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Status</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
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
                            <div class="mb-3">
                                <label class="form-label" for="status">Category Status<span class="text-danger">*</span></label>
                                <select class="form-select status" name="status" id="status">
                                    <option value="1" selected>Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="showinmenu">Show on Menu / Header<span class="text-danger">*</span></label>
                                <select class="form-select showinmenu" name="showinmenu" id="showinmenu">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="showinmenu">Show on Homepage<span class="text-danger">*</span></label>
                                <select class="form-select showonhome" name="showonhome" id="showonhome">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="display_order">Display Order <span class="form-text">(optional)</span></label>
                                <input type="number" class="form-control" name="display_order" id="display_order"
                                    placeholder="Enter Display Order" value="{{ old('display_order') }}">
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Category Image</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Category Thumbnail <span class="form-text">(optional)</span></label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                                </div>
                                <img src="" id="thumbnail-view" class="rounded w-100px my-n1 mx-n1"/>
                            </div>
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Category Banner <span class="form-text">(optional)</span></label>
                                    <input type="file" class="form-control" name="banner" id="banner">
                                </div>
                                <img src="" id="banner-view" class="rounded w-350px my-n1 mx-n1"/>
                            </div>
                            <div class="preview-banner mb-1">
                                <div class="mb-3">
                                    <label class="form-label" for="image">Category Mobile Banner <span class="form-text">(optional)</span></label>
                                    <input type="file" class="form-control" name="mobilebanner" id="mobilebanner">
                                </div>
                                <img src="" id="mobilebanner-view" class="rounded w-350px my-n1 mx-n1"/>
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
        $(".status").select2({ minimumResultsForSearch: Infinity });
        $(".showinmenu").select2({ minimumResultsForSearch: Infinity });
        $(".showonhome").select2({ minimumResultsForSearch: Infinity });
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
          placeholder: 'Enter Category Description here....',
          height: "250"
        });
        //Banner Preview
        $("#thumbnail").change(function () {
            readURL(this, '#thumbnail-view');
        });
        $("#banner").change(function () {
            readURL(this, '#banner-view');
        });
        //Mobile Banner Preview
        $("#mobilebanner").change(function () {
            readURL(this, '#mobilebanner-view');
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
