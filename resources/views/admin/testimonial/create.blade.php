@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'testimonial.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Page</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Testimonial</li>
                    </ol>
                    <h1 class="page-header mb-0">Create Testimonial</h1>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'testimonial.index') }}" class="btn btn-default px-4"><i
                            class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Back</a>
                    <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i
                            class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Save and New</button>
                    <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i
                            class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Save</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Testimonial Information
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
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label for="title"> Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter Name">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="title"> Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}"
                                    placeholder="Enter Designation">
                            </div> -->

                            <div class="card border-0 mb-4">
                                <div class="card-header h6 mb-0 bg-none p-3">
                                    <div class="mb-3">
                                        <label for="title"> Subtitle <span class="text-danger">*</span></label>
                                        <textarea class="description form-control" id="subtitle" name="subtitle" placeholder="Enter Text ..."
                                            rows="12">{{ old('subtitle') }}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="main_subtitle">Image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alternate</label>
                                <input type="text" class="form-control" name="alt" id="alt"
                                    placeholder="Enter Alternate" value="{{ old('alt') }}">
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="display_order">Display Order <span class="form-text">(optional)</span></label>
                                <input type="number" class="form-control" name="display_order" id="display_order"
                                    placeholder="Enter Display Order" value="{{ old('display_order') }}">
                            </div>

                        </div>

                    </div>
                </div>

        </form>
    </div>
@endsection
