@extends('front.layouts.app')
@section('titlename', 'Dealer Register')
@section('content')
    <div id="wrapper">
        <div class="content">
            <section class="gray-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">



                            <div class="dasboard-widget-box fl-wrap">
                                <div class="register-title fl-wrap">
                                    <h2>Register Form</h2><br>

                                </div>
                                <p>Create an Account to Avail the Best Real Estate Solutions</p>
                                <hr>
                                <div class="custom-form">
                                    <form method="POST" action="{{ route('dealerregister') }}">
                                        @csrf
                                        <div class="row">
                                            {{-- <div class="col-md-12 py-3">
                                                <div class="col-md-12 py-3 form-nmb">
                                                    <div class="radio-sec">
                                                        <label for="">I Am<span style="color: red;">*</span></label>
                                                        <div class="rad1 fl-wrap">
                                                            <div class="add-list-media-header">
                                                                <label class="radio inline">
                                                                    <input type="radio" name="is_role"
                                                                        value="3" checked>
                                                                    <span>As Dealer</span>
                                                                </label>
                                                            </div>

                                                            <div class="add-list-media-header">
                                                                <label class="radio inline">
                                                                    <input type="radio" name="is_role"
                                                                        value="0">
                                                                    <span>As Builder</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <label>First Name <span class="dec-icon"><i
                                                            class="fas fa-user"></i></span></label>
                                                <input type="text" name="first_name" placeholder="Enter First Name"
                                                    value="{{ old('first_name') }}">
                                                @error('first_name')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Mobile No.<span class="dec-icon"><i class="fas fa-phone"></i>
                                                    </span></label>
                                                <input type="text" name="phone" placeholder="Enter Mobile No"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 form-nmb">
                                                <label>Company Name<span style="color: red;">*</span>
                                                    <span class="dec-icon"><i class="far fa-user"></i></span>
                                                </label>
                                                <input type="text" name="company_name" placeholder="Enter Company Name"
                                                    id="companyname" value="{{ old('company_name') }}">
                                                @error('company_name')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label>Email Address <span class="dec-icon"><i
                                                            class="fas fa-envelope"></i></span></label>
                                                <input type="text" name="email" placeholder="Enter  Email"
                                                    value="">
                                                @error('email')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>Password * <span class="dec-icon"><i
                                                                class="fal fa-key"></i></span></label>
                                                    <input name="password" type="password" autocomplete="off"
                                                        placeholder="Password">
                                                    <span class="eye"><i class="fal fa-eye"></i> </span>

                                                </div>
                                                @error('password')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <div class="pass-input-wrap fl-wrap">
                                                    <label>Confirm Password * <span class="dec-icon"><i
                                                                class="fal fa-key"></i></span></label>
                                                    <input name="confirm-password" type="password" autocomplete="off"
                                                        placeholder="Confirm Password">
                                                    <span class="eye"><i class="fal fa-eye"></i> </span>

                                                </div>
                                                @error('confirm-password')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <label>Adress <span class="dec-icon"><i class="fas fa-home-lg-alt"></i>
                                                    </span></label>
                                                <input type="text" name="address" placeholder="USA 27TH Brooklyn NY"
                                                    value="{{ old('address') }}">
                                                @error('address')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label>City <span class="dec-icon"><i class="fas fa-map-marker"></i>
                                                    </span></label>
                                                <input type="text" name="city" placeholder="Delhi"
                                                    value="{{ old('city') }}">
                                                @error('city')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>State <span class="dec-icon"><i class="fas fa-globe"></i>
                                                    </span></label>
                                                <select name="state" id="state" class="form-select state">
                                                    <option value="">Select</option>
                                                    @if (!empty($stateList))
                                                        @foreach ($stateList as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('state')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Pin Code <span class="dec-icon"><i class="fas fa-map-marker"></i>
                                                    </span></label>
                                                <input type="text" name="zip" placeholder="Zip Code"
                                                    value="{{ old('zip') }}">
                                                @error('zip')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Country <span class="dec-icon"><i class="fas fa-map-marker"></i>
                                                    </span></label>
                                                <input type="text" name="country" placeholder="India" value="India">
                                                @error('country')
                                                    <span style="color: red; font-weight: bold;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Property Type</label>
                                                <div class="rad1 fl-wrap">
                                                    <div class="add-list-media-header">
                                                        <label class="radio inline">
                                                            <input type="radio" name="property_type" value="1"
                                                                checked>
                                                            <span>Rara</span>
                                                        </label>
                                                    </div>
                                                    <div class="add-list-media-header">
                                                        <label class="radio inline">
                                                            <input type="radio" name="property_type" value="2">
                                                            <span>Non Rara</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                    <label for="">Builder</label>
                                                    <div class="rad1 fl-wrap">
                                                        <div class="add-list-media-header">
                                                            <label class="radio inline">
                                                            <input type="radio" name="builder"  checked>
                                                            <span>Rara</span>
                                                            </label>
                                                        </div>
                                                        <div class="add-list-media-header">
                                                            <label class="radio inline">
                                                            <input type="radio" name="builder">
                                                            <span>Non Rara</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            <div class="col-md-12 form-nmb" id="rera-number-group">
                                                <label>RERA Number
                                                    {{-- <span style="color: red;">*</span> --}}
                                                    <span class="dec-icon"><i class="fas fa-id-card"></i></span>
                                                </label>
                                                <input type="text" placeholder="ENTER RERA NUMBER" name="reranumber"
                                                    id="reranumber" value="RERA NUMBER">
                                            </div>

                                            <div class="col-md-12 form-nmb">
                                                <label>Agent Id <span class="dec-icon"><i
                                                            class="far fa-user"></i></span></label>
                                                <input type="text" placeholder="ENTER AGENT CODE" name="agentcode"
                                                    id="agentcode" value="AGENT CODE">
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" name="btnsubmit"
                                                    class="btn color-bg float-btn">SUBMIT YOUR
                                                    FORM</button>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="already-login">Already Register <a
                                                        href="{{ route('login') }}">Login</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('custom-javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const agentInput = document.getElementById("agentcode");
            const date = new Date();
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); 
            const year = String(date.getFullYear()).slice(-2);

            const randomStr = Math.random().toString(36).substr(2, 5).toUpperCase();
            const agentCode = `H24D${day}${month}${year}${randomStr}`;

            agentInput.value = agentCode;
        });

        $(document).ready(function() {
            $('.state').select2({
                placeholder: "Select a state",
                allowClear: true
            });
        });
        
    </script>
@endsection
