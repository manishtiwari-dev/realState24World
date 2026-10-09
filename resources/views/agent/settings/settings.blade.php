@extends('admin.layouts.app')
@section('content')
<style>
	.logo-class{
		border: 1px solid #dee2e6;
		padding: 16px;
		margin-top: 5px;
		text-align: center;
	}
</style>
    <div id="content" class="app-content p-0">
        {{-- Heading --}}
        @include('admin.settings.topbar')
        {{-- Heading --}}
        {{-- Body Here --}}
        <div class="container-fluid" style="width:99%;">
            <div class="mt-3">
				<div class="row">
					<div class="col-xl-6">
						<div class="card border-0 mb-4">
							<form method="POST" action="{{ route(getRolePrefix().'settings.setting') }}" enctype="multipart/form-data">
								@csrf
								<div class="card-header h6 mb-0 bg-none p-3">
									<i class="fa fa-gear fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
									{{ __('Global Setting') }}
								</div>
								@if (session('settingsuccess'))
									<div class="alert alert-success rounded-0" role="alert" class="text-danger">
										{{ session('settingsuccess') }}
									</div>
								@elseif (session('error'))
									<div class="alert alert-danger" role="alert">
										{{ session('error') }}
									</div>
								@endif
								<div class="card-body">
									<div class="row">
										<div class="col-xl-12 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-home"></i></div>
												<input type="text" class="form-control @error('companyname') is-invalid @enderror" placeholder="Enter Company Name" name="companyname" value="{{ !empty($setting->company_name) ? $setting->company_name : old('companyname') }}">
											</div>
											@error('companyname')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-xl-6 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-phone"></i></div>
												<input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Mobile Number" name="phone" value="{{ !empty($setting->phone) ? $setting->phone : old('phone') }}">
											</div>
											@error('phone')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-xl-6 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-phone"></i></div>
												<input type="text" class="form-control @error('altphone') is-invalid @enderror" placeholder="Alt Mobile Number" name="altphone" value="{{ !empty($setting->alt_phone) ? $setting->alt_phone : old('altphone') }}">
											</div>
											@error('altphone')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-xl-6 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-envelope"></i></div>
												<input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ !empty($setting->email) ? $setting->email : old('email') }}">
											</div>
											@error('email')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-xl-6 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-envelope"></i></div>
												<input type="text" class="form-control @error('altemail') is-invalid @enderror" placeholder="Another Email Address" name="altemail" value="{{ !empty($setting->alt_email) ? $setting->alt_email : old('altemail') }}">
											</div>
											@error('altemail')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										
										<div class="col-xl-12 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-map-marker"></i></div>
												<input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Office Address" name="address" value="{{ !empty($setting->address) ? $setting->address : old('address') }}">
											</div>
											@error('address')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>
										<div class="col-xl-12 mb-3">
											<div class="input-group">
												<div class="input-group-text"><i class="fas fa-map-marker"></i></div>
												<input type="text" class="form-control @error('altaddress') is-invalid @enderror" placeholder="Another Address" name="altaddress" value="{{ !empty($setting->alt_address) ? $setting->alt_address : old('altaddress') }}">
											</div>
											@error('altaddress')
												<span class="text-danger">{{ $message }}</span>
											@enderror
										</div>

										<div class="col-xl-6">
											<div class="mb-3">
												<label for="logo">Main Logo</label>
												<input type="file" class="form-control" name="logo" id="logo">
												@if(!empty($setting->logo))
												<div class="logo-class">
													<img src="{{asset('uploads/'.$setting->logo)}}" style="height:50px;">
												</div>
												@endif
												@error('logo')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
										
										<div class="col-xl-6">
											<div class="mb-3">
												<label for="favicon">Favicon</label>
												<input type="file" class="form-control" name="favicon" id="favicon">
												@if(!empty($setting->favicon))
												<div class="logo-class">
													<img src="{{asset('uploads/'.$setting->favicon)}}" style="height:50px;">
												</div>
												@endif
												@error('favicon')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>

										<div class="col-xl-12">
											<div class="mb-3">
												<label for="googlemap">Google Map iframe</label>
												<textarea class="form-control @error('googlemap') is-invalid @enderror" id="googlemap" name="googlemap" rows="2">{{ !empty($setting->google_map) ? $setting->google_map : old('googlemap') }}</textarea>
												@error('googlemap')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
										<div class="col-xl-12">
											<div class="mb-3">
												<label for="headerscript">Custom Text Field</label>
												<textarea class="form-control @error('customtext') is-invalid @enderror" id="customtext" name="customtext"
													rows="2">{{ !empty($setting->custom_text) ? $setting->custom_text : old('customtext') }}</textarea>
												@error('customtext')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="reset" class="btn btn-danger px-4"><i class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; {{ __('Reset') }}</button>
									<button type="submit" name="btnsubmit" value="update" class="btn btn-primary px-4"> &nbsp; {{ __('Update Setting') }}</button>
								</div>
							</form>
						</div>
					</div>

					<div class="col-xl-6">
						<div class="card border-0 mb-4">
							<form method="POST" action="{{ route('admin.settings.websitescript') }}" enctype="multipart/form-data">
								@csrf
								<div class="card-header h6 mb-0 bg-none p-3">
									<i class="fa fa-code fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
									{{ __('Website Script') }}
								</div>
								@if (session('success'))
									<div class="alert alert-success rounded-0" role="alert" class="text-danger">
										{{ session('success') }}
									</div>
								@elseif (session('error'))
									<div class="alert alert-danger rounded-0" role="alert">
										{{ session('error') }}
									</div>
								@endif
								<div class="card-body">
									<div class="row">
										{{-- Header Tags --}}
										<div class="col-xl-12">
											<div class="mb-3">
												<label for="headerscript">Header Script Tags</label>
												<textarea class="form-control @error('headerscript') is-invalid @enderror" id="headerscript" name="headerscript"
													rows="8">{{ !empty($setting->header_script) ? $setting->header_script : old('headerscript') }}</textarea>
												@error('headerscript')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
										{{-- Body Tags --}}
										<div class="col-xl-12">
											<div class="mb-3">
												<label for="bodyscript">Body Script Tags</label>
												<textarea class="form-control @error('bodyscript') is-invalid @enderror" id="bodyscript" name="bodyscript"
													rows="7">{{ !empty($setting->body_script) ? $setting->body_script : old('bodyscript') }}</textarea>
												@error('bodyscript')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
										{{-- Footer Tags --}}
										<div class="col-xl-12">
											<div class="mb-3">
												<label for="footerscript">Footer Script Tags</label>
												<textarea class="form-control @error('footerscript') is-invalid @enderror" id="footerscript" name="footerscript"
													rows="7">{{ !empty($setting->footer_script) ? $setting->footer_script : old('footerscript') }}</textarea>
												@error('footerscript')
													<span class="text-danger">{{ $message }}</span>
												@enderror
											</div>
										</div>
										{{-- Footer Tags --}}
									</div>
								</div>
								<div class="card-footer">
									<button type="reset" class="btn btn-danger px-4"><i
											class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; {{ __('Reset') }}</button>
									<button type="submit" name="btnsubmit" value="update" class="btn btn-primary px-4"> &nbsp;
										{{ __('Update Script') }}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
        </div>
        {{-- Body Here --}}
    </div>
@endsection
