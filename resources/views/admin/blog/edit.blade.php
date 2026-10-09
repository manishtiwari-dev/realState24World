@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <form action="{{ route(getRolePrefix().'blog.update', ['id' => encode_string($blog->id)]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">About Management</a></li> --}}
                        <li class="breadcrumb-item"><a href="javascript:;">Page</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i>Update Management</li>
                    </ol>
                    <h1 class="page-header mb-0">Update Blog</h1>
                </div>
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix().'blog.index') }}" class="btn btn-default px-4"><i
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
                            <i class="fa fa-dolly fa-lg fa-fw text-dark text-opacity-50 me-1"></i>Update Blog
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
                                <label class="form-label">Author<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="author" name="author"
                                    value="{{ $blog->author }}" placeholder="Enter Author Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $blog->title }}" placeholder="Enter Title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    value="{{ $blog->slug }}" placeholder="Enter Slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subtitle<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="main_subtitle" name="subtitle" placeholder="Enter text ..." rows="5">{{ $blog->subtitle }}</textarea>
                            </div>
                            @php
                                $selectedTagIds = json_decode($blog->tag_id ?? '[]');
                                $selectedCategoryIds = json_decode($blog->category_id ?? '[]');
                            @endphp


                            <div class="mb-3">
                                <label class="form-label" for="tag-id">Tag<span class="text-danger">*</span></label>
                                <select class="form-select" name="tag_id[]" id="tag-id" multiple>
                                    <option value="">
                                        Select</option>
                                    @if (!empty($blogs_tag))
                                        @foreach ($blogs_tag as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, $selectedTagIds ?? []) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>




                            <div class="mb-3">
                                <label class="form-label">Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date"
                                    placeholder="Enter Date" value="{{ $blog->date }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description<span class="text-danger">*</span></label>
                                <textarea class="description form-control" id="description" name="description" placeholder="Enter text ..."
                                    rows="8">{{ $blog->description }}</textarea>
                            </div>



                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex">
                            <div class="flex-1">
                                <div>Blogs Images</div>
                            </div>
                        </div>
                        <div class="card-body fw-bold">
                            <div class="mb-3">
                                <label for="main_subtitle">Thumbnail<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                            </div>
                            @if (!empty($blog->thumbnail))
                                <div style="margin: 5px;">
                                    <img src="{{ asset('uploads/blog/' . $blog->thumbnail . '') }}"
                                        class="rounded h-50px my-n1 mx-n1" />
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="main_subtitle">Alternate</label>
                                <input type="text" class="form-control" id="thumbnail_alt" name="thumbnail_alt"
                                    value="{{ $blog->thumbnail_alt }}" placeholder="Enter Alternate">
                            </div>
                            <div class="mb-3">
                                <label for="main_subtitle">Banner<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="banner" name="banner">
                            </div>

                            @if (!empty($blog->banner))
                                <div style="margin: 5px;">
                                    <img src="{{ asset('uploads/blog/' . $blog->banner . '') }}"
                                        class="rounded h-50px my-n1 mx-n1" />
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="main_subtitle">Alternate</label>
                                <input type="text" class="form-control" id="banner_alt" name="banner_alt"
                                    value="{{ $blog->banner_alt }}" placeholder="Enter Alternate">
                            </div>

                              <div class="mb-3">
                                <label for="main_subtitle">Multiple Images<span
                                        class="form-text">(optional)</span></label>
                                <input type="file" class="form-control" id="mult_img" name="multiple_images[]" multiple>
                            </div>

                                @if (!empty(json_decode($blog->multiple_images)))
                                    <div class="row d-flex gap-2 mt-2" style="flex-wrap: nowrap; overflow-x: auto;">
                                        @foreach (json_decode($blog->multiple_images) as $image)
                                            <div class="col-sm-3 text-center">
                                                <img src="{{ asset('uploads/blog/' . $image) }}" alt="Image"
                                                    style="max-width: 100px; height: auto; border: 1px solid #ccc; padding: 5px;">

                                                <button class="btn btn-danger btn-xs mt-2 delete-image-btn"
                                                    data-image="{{ $image }}" data-id="{{ $blog->id }}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        @endforeach

                                    </div>
                                @endif

                            
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>


                              <div class="mb-3">
                                <label class="form-label" for="status">Is Popular<span class="text-danger">*</span></label>
                                <select class="form-select status" name="is_popular" id="is_popular">
                                    <option value="1" {{ $blog->is_popular == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0" {{ $blog->is_popular == 0 ? 'selected' : '' }}>
                                        No</option>
                                </select>
                            </div>
                            

                            <div class="mb-3">
                                <label class="form-label" for="display_order">Display Order <span
                                        class="form-text">(optional)</span></label>
                                <input type="number" class="form-control" name="display_order" id="display_order"
                                    placeholder="Enter Display Order" value="{{ $blog->display_order }}">
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
                                <input type="text" class="form-control" name="meta_title" id="meta-title"
                                    placeholder="Enter Seo Meta Title" value="{{ $blog->meta_title }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-keyword">Meta Keyword<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="meta_keyword" id="meta-keyword" placeholder="Enter Seo Meta Keyword"
                                    rows="4">{{ $blog->meta_keyword }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta-desc">Meta Description<span
                                        class="form-text">(optional)</span></label>
                                <textarea class="form-control" name="meta_description" id="meta_description"
                                    placeholder="Enter Seo Meta Description" rows="5">{{ $blog->meta_description }}</textarea>
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
            $('#title').on('input', function() {
                var name = $(this).val().trim().toLowerCase();
                var slug = name.replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });

        //Editor
        $(".description").summernote({
            placeholder: 'Enter Blog Description here....',
            height: "400"
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tag-id').select2({
                placeholder: "Select Tag"
            });


        });
    </script>
      <script>
        $(document).ready(function() {
            $('.delete-image-btn').on('click', function(e) {
                e.preventDefault();

                if (!confirm('Are you sure you want to delete this image?')) return;

                var image = $(this).data('image');
                var blogId = $(this).data('id');
                var button = $(this);


                $.ajax({

                    url: '{{ route(getRolePrefix() . 'blog.image.delete') }}',
                    method: 'POST',
                    data: {
                        id:blogId,
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
    
@endsection
