@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'returnPolicy_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="page-header mb-0">Return Policy</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Return Policy</li>
                    </ol>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'returnPolicy') }}" class="btn btn-default px-4"><i
                            class="fa fa-angle-left fa-lg ms-n2 "></i> &nbsp; Cancel</a>
                    {{-- <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Save and New</button> --}}
                    <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i
                            class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Save</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3">
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Return Policy
                            Information
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
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                    value="{{ $list->title ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <div class="form-control p-0 overflow-hidden">
                                    <textarea class="description form-control" id="description" name="description" placeholder="Enter text ...">{{ $list->description ?? '' }}</textarea>
                                </div>
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
        //Editor
        $(".description").summernote({
            placeholder: 'Enter  Description here....',
            height: "250"
        });
    </script>
@endsection
