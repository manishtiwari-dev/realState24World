@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix() . 'about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;">Page</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i>About Management</li>
                    </ol>
                    <h1 class="page-header mb-0">About Management</h1>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'home') }}" class="btn btn-default px-4"><i
                            class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Back</a>
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
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> About Management
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
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $aboutData->title ?? '' }}" placeholder="Enter Main Title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subtitle<span class="text-danger">*</span></label>
                                <textarea class="description form-control" id="subtitle" name="subtitle" placeholder="Enter text ..." rows="5">{{ $aboutData->subtitle ?? '' }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="description form-control" id="description" name="description" placeholder="Enter text ..."
                                    rows="8">{{ $aboutData->description ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="main_subtitle">Image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="banner" name="banner">
                            </div>
                            @if (!empty($aboutData->banner))
                                <div style="margin: 5px;">
                                    <img src="{{ asset('uploads/about/' . $aboutData->banner . '') }}"
                                        class="rounded w-100px my-n1 mx-n1" />
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="main_subtitle">Alternate</label>
                                <input type="text" class="form-control" id="main_subtitle" name="alt"
                                    value="{{ $aboutData->alt ?? '' }}" placeholder="Enter Alternate">
                            </div>


                        </div>
                    </div>

                </div>

                <div class="col-lg-4">




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
                                <input type="text" class="form-control" name="meta_title" id="meta-title"
                                    placeholder="Enter Seo Meta Title" value="{{ $aboutData->meta_title ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-keyword">Meta Keyword<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="meta_keyword" id="meta-keyword" placeholder="Enter Seo Meta Keyword"
                                    rows="4">{{ $aboutData->meta_keyword ?? '' }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-desc">Meta Description<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="meta_description" id="meta-desc" placeholder="Enter Seo Meta Description"
                                    rows="5">{{ $aboutData->meta_description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
        </form>
    </div>

@endsection
