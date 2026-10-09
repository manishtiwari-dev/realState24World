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
                <h1 class="page-header mb-0">Register Project</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Project</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create New Project</li>
                </ol>
            </div>
            @can('dealer-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'project.index') }}" class="btn btn-primary px-4"><i
                            class="fa fa-list fa-lg ms-n2 "></i> &nbsp;PROJECT LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route(getRolePrefix() . 'project.create') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="form-section-title">1. Images</div>
                        <div class="card-body d-flex align-items-center gap-4">

                            <div class="col-md-3">
                                <img src="{{ asset('uploads/profileagent.png') }}" class="profile-preview"
                                    id="thumbnail-view" />
                                <div>
                                    <label for="company_logo" class="form-label">Upload Banner</label>
                                    <input type="file" class="form-control" name="company_logo" id="company_logo"
                                        accept="image/*" />
                                    <small class="text-muted">Max 2MB, JPG/PNG only.</small>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <img src="{{ asset('uploads/profileagent.png') }}" class="profile-preview"
                                    id="profile-view" />
                                <div>
                                    <label for="thumbnail" class="form-label">Upload Logo</label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                        accept="image/*" />
                                    <small class="text-muted">Max 2MB, JPG/PNG only.</small>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="form-section-title">2. Project Details,  & Social</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter  Name" />
                                @error('name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                             <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug') }}" readonly>
                                    </div>
                                </div>

                            {{-- <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" />
                                @error('last_name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter Phone No." />
                                @error('phone')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Another Phone<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="altphone" placeholder="Enter Another Phone No." />
                                @error('altphone')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <div class="col-md-12">
                                <label class="form-label">About<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="about" rows="3" placeholder="Enter Detail..."></textarea>
                                @error('about')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company_name"
                                    placeholder="Enter Company Name" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Website</label>
                                <input type="url" class="form-control" name="website" placeholder="Enter Website Url" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook Link</label>
                                <input type="url" class="form-control" name="facebook_link"
                                    placeholder="Enter Facebook Profile Url" />
                            </div>

                             <div class="col-md-6">
                                <label class="form-label">Instagram Link</label>
                                <input type="url" class="form-control" name="instagram_link"
                                    placeholder="Enter Instagram Profile Url" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Twitter Link</label>
                                <input type="url" class="form-control" name="twitter_link"
                                    placeholder="Enter Twitter Profile Url" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">LinkedIn Link</label>
                                <input type="url" class="form-control" name="linkedin_link"
                                    placeholder="Enter Linkedin Profile Url" />
                            </div>

                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="form-section-title">3. Login Credential</div>
                        <div class="card-body row g-3">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="Enter Email"
                                        class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                    @enderror
                                    <div class="form-text">This email will be used for login.</div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password"
                                            placeholder="Enter Password" class="form-control"
                                            autocomplete="new-password">
                                        <div class="input-group-text"><i class="fa fa-eye toggle-password"
                                                data-target="#password"></i></div>
                                        @error('password')
                                            <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="confirm">Confirm Password<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="confirm-password" id="confirmpassword"
                                            placeholder="Confirm Password" class="form-control"
                                            autocomplete="new-confirm-password">
                                        <div class="input-group-text"><i class="fa fa-eye toggle-password"
                                                data-target="#confirmpassword"></i></div>
                                        @error('confirm-password')
                                            <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="form-section-title">4. Address Details</div>
                        <div class="card-body row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" />
                                @error('address')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" placeholder="Enter City" />
                                @error('city')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State<span class="text-danger">*</span></label>
                                {{-- <input type="text" class="form-control" name="state" placeholder="Enter State"/> --}}
                                <select class="form-select state" name="state" id="state">
                                    <option value="0">-- Select State --</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="zip"
                                    placeholder="Enter Zip Code" />
                                @error('zip')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="country" value="India"
                                    placeholder="Enter Country" />
                                @error('country')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="form-section-title">5. License & Documents</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">License Number</label>
                                <input type="text" class="form-control" name="license_number"
                                    placeholder="Enter License Number" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Upload Supporting Documents</label>
                                <input type="file" class="form-control" name="documents" multiple />
                            </div>
                        </div>
                    </div> --}}

                    <div class="card">
                        {{-- <div class="form-section-title">6. Verification</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Agent Verified<span class="text-danger">*</span></label>
                                <select class="form-select" name="is_verified">
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-select" name="is_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="card-footer bg-dark p-3" style="text-align: right;">
                            <a href="{{ route(getRolePrefix() . 'project.index') }}" class="btn btn-danger ms-2">CANCEL</a>
                            <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i
                                    class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Submit and Create New</button>
                            <button type="submit" name="btnsubmit" value="save" class="btn btn-primary px-4"><i
                                    class="fa fa-floppy-disk fa-lg ms-n2 "></i> &nbsp; Submit</button>
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
        //SHOW PASSWORD HIDE SHOW
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                let input = $($(this).data("target"));
                let type = input.attr("type") === "password" ? "text" : "password";
                input.attr("type", type);
                // Toggle eye icon class
                $(this).toggleClass("fa-eye fa-eye-slash");
            });
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
