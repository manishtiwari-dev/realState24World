@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Add New Banner</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Banner Management</li>
                </ol>
            </div>
            <div class="ms-auto">
                <a href="{{ route(getRolePrefix().'banners.index') }}" class="btn btn-default px-4"><i class="fa fa-arrow-left fa-lg ms-n2 "></i> Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-image fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Add Banner
                    </div>
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
                    <form action="{{ route(getRolePrefix().'banners.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Title<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="btitle"
                                            placeholder="Enter Banner Title" value="{{ old('btitle') }}" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Banner For<span class="text-danger">*</span></label>
                                        <select class="form-select banner-select" name="btype">
                                            <option value="1" selected>Main Banner</option>
                                            <option value="2">Home Section - 1</option>
                                            <option value="3">Home Section - 2</option>
                                            <option value="4">Home Section - 3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Redirect Link <span
                                                class="form-text">(optional)</span></label>
                                        <input class="form-control" type="text" name="burl"
                                            placeholder="Enter Banner Redirect Link" value="{{ old('burl') }}" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Last Date<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" name="last_date" placeholder="Select Last Date" value="{{ old('last_date') }}" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Display Order<span
                                                class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="bsort"
                                            placeholder="Enter Display Order" value="{{ old('bsort') }}" />
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Status<span class="text-danger">*</span></label>
                                        <select class="form-select default-select" name="bstatus">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Description</label>
                                        <input class="form-control" type="text" name="bdescription"
                                            placeholder="Enter Banner Description" value="{{ old('bdescription') }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Banner Image<span class="text-danger">*</span></label>
                                        <input class="form-control" type="file" name="bimage"
                                            accept="image/png, image/webp, image/jpeg" id="main-banner"/>
                                    </div>
                                    <img src="" id="main-banner-view" width="400px" />
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile Banner Image</label>
                                        <input class="form-control" type="file" name="mimage"
                                            accept="image/png, image/webp, image/jpeg" id="mobile-banner" />
                                    </div>
                                    <img src="" id="mobile-banner-view" width="140px" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-none d-flex p-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> CLICK TO SAVE DETAIL
                            </button>
                            <button type="reset" class="btn btn-danger ms-2">RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
    <script>
        $(".default-select").select2({
            minimumResultsForSearch: Infinity
        });
        $(".banner-select").select2({
            minimumResultsForSearch: Infinity
        });
        //Banner Preview
        $("#main-banner").change(function () {
            readURL(this, '#main-banner-view');
        });
        //Mobile Banner Preview
        $("#mobile-banner").change(function () {
            readURL(this, '#mobile-banner-view');
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
