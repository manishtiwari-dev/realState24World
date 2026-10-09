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
                <h1 class="page-header mb-0">Update Agent</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Agent</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Update Agent</li>
                </ol>
            </div>
            @can('agent-list')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() . 'agent.index') }}" class="btn btn-primary px-4"><i
                            class="fa fa-list fa-lg ms-n2 "></i> &nbsp;AGENT LIST</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route(getRolePrefix() . 'agent.update', $agent->id) }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="form-section-title">1. Images</div>
                        <div class="card-body d-flex align-items-center gap-4">
                            <div class="col-md-3">
                                @if (empty($agent->company_logo))
                                    <img src="https://ui-avatars.com/api/?background=random&name={{ $agent->name }}"
                                        class="profile-preview" id="thumbnail-view" />
                                @else
                                    <img src="{{ asset('uploads/agents/' . $agent->company_logo . '') }}"
                                        class="profile-preview" id="thumbnail-view" />
                                @endif
                                <div>
                                    <label for="company_logo" class="form-label">Upload Company Logo</label>
                                    <input type="file" class="form-control" name="company_logo" id="company_logo"
                                        accept="image/*" />
                                    <small class="text-muted">Max 2MB, JPG/PNG only.</small>
                                </div>
                            </div>

                             <div class="col-md-3">
                                @if (empty($agent->profile_photo))
                                    <img src="https://ui-avatars.com/api/?background=random&name={{ $agent->name }}"
                                        class="profile-preview" id="profile-view" />
                                @else
                                    <img src="{{ asset('uploads/agents/' . $agent->profile_photo . '') }}"
                                        class="profile-preview" id="profile-view" />
                                @endif
                                <div>
                                    <label for="thumbnail" class="form-label">Upload Profile Photo</label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                        accept="image/*" />
                                    <small class="text-muted">Max 2MB, JPG/PNG only.</small>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card">
                        <div class="form-section-title">2. Personal Details, Bio & Social</div>
                        <div class="card-body row g-3">
                            <div class="col-md-3">
                                <label class="form-label">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"
                                    value="{{ $agent->first_name }}" />
                                @error('first_name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name"
                                    value="{{ $agent->last_name }}" />
                                @error('last_name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter Phone No."
                                    value="{{ $agent->phone }}" />
                                @error('phone')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">About<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="about" rows="3" placeholder="Enter Agent Detail...">{{ $agent->about }}</textarea>
                                @error('about')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Company Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name"
                                    value="{{ $agent->company_name }}" placeholder="Enter Company Name" />
                                @error('company_name')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Website</label>
                                <input type="url" class="form-control" name="website" placeholder="Enter Website Url"
                                    value="{{ $agent->website }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook Link</label>
                                <input type="url" class="form-control" name="facebook_link"
                                    placeholder="Enter Facebook Profile Url" value="{{ $agent->facebook_link }}" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Instagram Link</label>
                                <input type="url" class="form-control" name="instagram_link"
                                    placeholder="Enter Instagram Profile Url" value="{{ $agent->instagram_link }}" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Twitter Link</label>
                                <input type="url" class="form-control" name="twitter_link"
                                    placeholder="Enter Twitter Profile Url" value="{{ $agent->twitter_link }}" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">LinkedIn Link</label>
                                <input type="url" class="form-control" name="linkedin_link"
                                    placeholder="Enter Linkedin Profile Url" value="{{ $agent->linkedin_link }}" />
                            </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="form-section-title">3. Login Credential</div>
                        <div class="card-body row g-3">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="Enter Email"
                                        class="form-control" value="{{ $agent->email }}">
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
                    </div>

                    <div class="card">
                        <div class="form-section-title">4. Address Details</div>
                        <div class="card-body row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address"
                                    value="{{ $agent->address }}" />
                                @error('address')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" placeholder="Enter City"
                                    value="{{ $agent->city }}" />
                                @error('city')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State<span class="text-danger">*</span></label>
                                {{-- <input type="text" class="form-control" name="state" placeholder="Enter State" value="{{ $agent->state }}"/> --}}
                                <select class="form-select state" name="state" id="state">
                                    <option value="0">-- Select State --</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->name }}"
                                            {{ $agent->state == $states->name ? 'selected' : '' }}>{{ $states->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('state')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="zip" placeholder="Enter Zip Code"
                                    value="{{ $agent->zip }}" />
                                @error('zip')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="country" value="India"
                                    placeholder="Enter Country" value="{{ $agent->country }}" />
                                @error('country')
                                    <p class="invalid-feedback d-block" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="form-section-title">5. License & Documents</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">License Number</label>
                                <input type="text" class="form-control" name="license_number"
                                    placeholder="Enter License Number" value="{{ $agent->license_number }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Upload Supporting Documents</label>
                                <input type="file" class="form-control" name="documents" multiple />
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="form-section-title">6. Verification</div>
                        <div class="card-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Agent Verified<span class="text-danger">*</span></label>
                                <select class="form-select" name="is_verified">
                                    <option value="1" {{ $agent->is_verified == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $agent->is_verified == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-select" name="is_status">
                                    <option value="1" {{ $agent->is_status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $agent->is_status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer bg-dark p-3" style="text-align: right;">
                            <a href="{{ route(getRolePrefix() . 'agent.index') }}" class="btn btn-danger ms-2">CANCEL</a>
                            <button type="submit" name="btnsubmit" value="saveandnew" class="btn btn-primary px-4"><i
                                    class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; CLICK TO UPDATE DETAIL</button>
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
