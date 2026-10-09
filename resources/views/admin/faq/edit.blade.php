@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'faq.update', ['id' => encode_string($faq->id)]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="page-header mb-0">Update </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Update  </li>
                    </ol>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'faq.index') }}" class="btn btn-default px-4"><i
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
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i> FAQ  Information
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
                                <label class="form-label">Navigation Type<span class="text-danger">*</span></label>
                                <select class="form-select navigation_type" name="navigation_type" id="navigation_type">
                                    <option value="1" {{ $faq->navigation_type == 1 ? 'selected' : '' }}>Payments</option>
                                    <option value="2" {{ $faq->navigation_type == 2 ? 'selected' : '' }}>Suggestions</option>
                                    <option value="3" {{ $faq->navigation_type == 3 ? 'selected' : '' }}>Reccomendations</option>
                                    <option value="4" {{ $faq->navigation_type == 4 ? 'selected' : '' }}>Booking</option>
                                    <option value="5" {{ $faq->navigation_type == 5 ? 'selected' : '' }}>Listing</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Question<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="question" id="question"
                                    placeholder="Question" value="{{ $faq->question }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Answer</label>
                                <div class="form-control p-0 overflow-hidden">
                                    <textarea class="textarea form-control" id="answer" name="answer" placeholder="Enter text ..." rows="9">{{ $faq->answer }}</textarea>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="status"> Status<span class="text-danger">*</span></label>
                                <select class="form-select status" name="status" id="status">
                                         <option value="1" {{ $faq->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $faq->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label class="form-label" for="display_order">Display Order <span
                                        class="form-text">(optional)</span></label>
                                <input type="number" class="form-control" name="display_order" id="display_order"
                                    placeholder="Enter Display Order" value="{{ $faq->display_order }}">
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
        $(".status").select2({
            minimumResultsForSearch: Infinity
        });


        $(".description").summernote({
            placeholder: 'Enter Category Description here....',
            height: "250"
        });
    </script>
@endsection
