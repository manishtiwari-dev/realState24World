@extends('front.agent.app')

@section('content')
    <!-- wrapper  -->

    <!-- content -->
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Dasboard Menu</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
            {{-- <div class="dashboard-title fl-wrap">
                <div class="dashboard-title-item"><span>Your Listings</span></div>
                <div class="dashbard-menu-header">
                    <div class="dashbard-menu-avatar fl-wrap">
                        <img src="images/blank-img.jpg" alt="">

                        <h4>Welcome, <span>{{ $editData->name }}</span></h4>
                    </div>
                    <a href="{{ route('user.dashboard') }}" class="log-out-btn tolt" data-microtip-position="bottom"
                        data-tooltip="Log Out"><i class="fas fa-power-off"></i></a>
                </div>
                <!--Tariff Plan menu-->
                <div class="tfp-det-container">
                    <div class="tfp-btn"><span>Your Tariff Plan : </span> <a href=""><strong>Extended</strong></a>
                    </div>
                </div>
                <!--Tariff Plan menu end-->
            </div> --}}
            @include('front.dashboard-title')

            <!-- dasboard-wrapper-->
            <div class="dasboard-wrapper fl-wrap no-pag">
                @if (Session::has('error'))
                    <div
                        style="background: #c50909cf; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div
                        style="background: #0ca60c; padding: 5px 11px 8px; font-weight: 700; color: white; border-radius: 0px; text-align:center;">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-7">
                        <form method="POST" action="{{ route('front.update_profile') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}" id="dealerID">
                            <div class="dasboard-widget-title fl-wrap">
                                <h5><i class="fas fa-user-circle"></i>Change Avatar</h5>
                            </div>
                            <div class="dasboard-widget-box nopad-dash-widget-box fl-wrap">
                                <div class="edit-profile-photo">


                                    @if ($userData->is_role == 0)
                                        @if (!empty(auth()->user()->profile_photo))
                                            <img src="{{ asset('uploads/user/' . auth()->user()->profile_photo) }}"
                                                class="respimg" alt="">
                                        @else
                                            <img src="{{ asset('images/blank-img.jpg') }}" class="respimg" alt="">
                                        @endif
                                    @else
                                        @if (!empty($editData->profile_photo))
                                            <img src="{{ asset('uploads/dealer/' . $editData->profile_photo) }}"
                                                class="respimg" alt="">
                                        @else
                                            <img src="{{ asset('images/blank-img.jpg') }}" class="respimg" alt="">
                                        @endif
                                    @endif

                                    <div class="change-photo-btn">
                                        <div class="photoUpload">
                                            <span> Upload New Photo</span>
                                            {{-- <input type="file" class="upload"> --}}
                                            <input type="file" id="profilepic" name="profile_photo" class="upload">

                                        </div>
                                    </div>
                                </div>
                                <div class="bg-wrap bg-parallax-wrap-gradien">

                                    @if ($userData->is_role == 0)
                                        <div class="bg" data-bg="images/bg/3.jpg"></div>
                                    @else
                                        @if (!empty($editData->company_logo))
                                            <div class="bg"
                                                data-bg="{{ asset('uploads/dealer/' . $editData->company_logo) }}"></div>
                                        @else
                                            <div class="bg"
                                                data-bg="https://ui-avatars.com/api/?background=random&name={{ $editData->name }}">
                                            </div>
                                        @endif
                                    @endif

                                </div>
                                @if ($userData->is_role == 3)
                                    <div class="change-photo-btn cpb-2">
                                        <div class="photoUpload color-bg">
                                            <span> <i class="fal fa-camera"></i> Change Company Logo </span>
                                            <input type="file" id="coverbanner" name="company_logo" class="upload">

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="dasboard-widget-title fl-wrap">
                                <h5><i class="fas fa-key"></i>Personal Info</h5>
                            </div>
                            <div class="dasboard-widget-box fl-wrap">
                                <div class="custom-form">
                                    <label>First Name <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                    <input type="text" name="first_name" placeholder="Enter First Name"
                                        value="{{ $editData->first_name }}" />
                                    <label>Last Name <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                    <input type="text" name="last_name" placeholder="Enter Last Name"
                                        value="{{ $editData->last_name }}" />
                                    <label>Email Address <span class="dec-icon"><i
                                                class="fas fa-envelope"></i></span></label>
                                    <input type="text" name="email" placeholder="Enter Email"
                                        value="{{ $editData->email }}" />
                                    <label>Phone<span class="dec-icon"><i class="fas fa-phone"></i> </span></label>
                                    <input type="text" name="phone" placeholder="Enter Phone Number"
                                        value="{{ $editData->phone }}" />
                                    <label>Alt Phone<span class="dec-icon"><i class="fas fa-phone"></i> </span></label>
                                    <input type="text" name="altphone" placeholder="Enter Another Phone Number"
                                        value="{{ $editData->altphone }}" />
                                    <label>Address <span class="dec-icon"><i class="fas fa-map-marker"></i> </span></label>
                                    <input type="text" name="address" placeholder="Enter Address"
                                        value="{{ $editData->address }}" />

                                    <label>Agency/Company Name<span class="dec-icon"><i class="fas fa-home-lg-alt"></i> </span></label>
                                    <input type="text" name="company_name" placeholder="Enter Company Name"
                                        value="{{ $editData->company_name }}" />
                                    <label>Notes </label>
                                    <textarea cols="40" rows="3" name="about" placeholder="About Me" style="margin-bottom:20px;">{{ $editData->about }}</textarea>
                                    <button class="btn    color-bg  float-btn" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-5">
                        <div class="dasboard-widget-title dbt-mm fl-wrap">
                            <h5><i class="fas fa-key"></i>Change Password</h5>
                        </div>

                        <form method="POST" action="{{ route('front.updatePassword') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}">

                            <div class="dasboard-widget-box fl-wrap">
                                <div class="custom-form">
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>Current Password<span class="dec-icon"><i
                                                    class="fas fa-lock-open"></i></span></label>
                                        <input type="password" name="current_password" class="pass-input" placeholder=""
                                            value="" />
                                        <span class="eye"><i class="fas fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>New Password<span class="dec-icon"><i
                                                    class="fas fa-lock"></i></span></label>
                                        <input type="password" name="new_password" class="pass-input" placeholder=""
                                            value="" />
                                        <span class="eye"><i class="fas fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>Confirm New Password<span class="dec-icon"><i class="fas fa-shield"></i>
                                            </span></label>
                                        <input type="password" name="new_password_confirmation" class="pass-input"
                                            placeholder="" value="" />
                                        <span class="eye"><i class="fas fa-eye" aria-hidden="true"></i> </span>
                                    </div>
                                    <button class="btn    color-bg  float-btn" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>

                        <div class="dasboard-widget-title fl-wrap" style="margin-top: 30px;">
                            <h5><i class="fas fa-share-alt"></i>Your Socials</h5>
                        </div>
                        <form method="POST" action="{{ route('front.update_social_profile') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $editData->id }}">

                            <div class="dasboard-widget-box fl-wrap">
                                <div class="custom-form">
                                    <label>Facebook <span class="dec-icon"><i class="fab fa-facebook"></i></span></label>
                                    <input type="text" name="facebook_link" placeholder="https://www.facebook.com/"
                                        value="{{ $editData->facebook_link }}" />
                                    <label>Twitter <span class="dec-icon"><i class="fab fa-twitter"></i></span></label>
                                    <input type="text" name="twitter_link" placeholder="https://twitter.com/"
                                        value="{{ $editData->twitter_link }}" />
                                    <label>Instagram<span class="dec-icon"><i class="fab fa-instagram"></i>
                                        </span></label>
                                    <input type="text" name="instagram_link" placeholder="https://www.instagram.com/"
                                        value="{{ $editData->instagram_link }}" />

                                    <button class="btn color-bg float-btn" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- dasboard-wrapper end -->
        </div>

    </div>
@endsection

@section('custom-javascript')
    <script>
        $(document).on("change", "#coverbanner", function(event) {
            event.preventDefault();
            var id = $('#dealerID').val();
            var imageInput = $('#coverbanner');
            
            var file = imageInput[0].files[0];
            if (file) {
                var formData = new FormData();
                formData.append('company_logo', file);
                formData.append('id', id);
                $.ajax({
                    url: '{{ route('upload-cover') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Image uploaded successfully:', response.filePath);
                            location.reload();
                        } else {
                            console.log('Failed to upload image:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
        //PROFILE UPDATE
        $(document).on("change", "#profilepic", function(event) {
            event.preventDefault();
            var id = $('#dealerID').val();
            var imageInput = $('#profilepic');
            var file = imageInput[0].files[0];
            if (file) {
                var formData = new FormData();
                formData.append('profile_photo', file);
                formData.append('id', id);
                $.ajax({
                    url: '{{ route('upload-profile') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Image uploaded successfully:', response.filePath);
                            location.reload();
                        } else {
                            console.log('Failed to upload image:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
@endsection
