@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content p-0">
        {{-- Heading --}}
        @include('admin.settings.topbar')
        {{-- Heading --}}
        {{-- Body Here --}}
        <div class="container-fluid" style="width:99%;">
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="card border-0 mb-4">
                        <form method="POST" action="{{ route(getRolePrefix().'settings.social-media') }}">
                            @csrf
                            <div class="card-header h6 mb-0 bg-none p-3">
                                <i class="fa fa-share-square fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                {{ __('Social Media') }}
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert" class="text-danger">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="card-body">
								<div class="row">

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-facebook"></i></div>
											<input type="text" class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter Facebook Link :- https://www.facebook.com" name="facebook" value="{{ !empty($setting->facebook) ? $setting->facebook : old('facebook') }}">
										</div>
										@error('facebook')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-instagram"></i></div>
											<input type="text" class="form-control @error('instagram') is-invalid @enderror" placeholder="Enter Instagran Link :- https://www.instagram.com" name="instagram" value="{{ !empty($setting->instagram) ? $setting->instagram : old('instagram') }}">
										</div>
										@error('instagram')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-linkedin"></i></div>
											<input type="text" class="form-control @error('linkedin') is-invalid @enderror" placeholder="Enter Iinkedin Link :- https://www.linkedin.com" name="linkedin" value="{{ !empty($setting->linkedin) ? $setting->linkedin : old('linkedin') }}">
										</div>
										@error('linkedin')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-twitter"></i></div>
											<input type="text" class="form-control @error('twitter') is-invalid @enderror" placeholder="Enter Twitter Link :- https://www.twitter.com" name="twitter" value="{{ !empty($setting->twitter) ? $setting->twitter : old('twitter') }}">
										</div>
										@error('twitter')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-youtube"></i></div>
											<input type="text" class="form-control @error('youtube') is-invalid @enderror" placeholder="Enter Youtube Link :- https://www.youtube.com" name="youtube" value="{{ !empty($setting->youtube) ? $setting->youtube : old('youtube') }}">
										</div>
										@error('youtube')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-pinterest"></i></div>
											<input type="text" class="form-control @error('pinterest') is-invalid @enderror" placeholder="Enter Pinterest Link :- https://www.pinterest.com" name="pinterest" value="{{ !empty($setting->pinterest) ? $setting->pinterest : old('pinterest') }}">
										</div>
										@error('pinterest')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-whatsapp"></i></div>
											<input type="text" class="form-control @error('whatsapp') is-invalid @enderror" placeholder="Enter Whatsapp Link" name="whatsapp" value="{{ !empty($setting->whatsapp) ? $setting->whatsapp : old('whatsapp') }}">
										</div>
										@error('whatsapp')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

									<div class="col-xl-6 mb-3">
										<div class="input-group">
											<div class="input-group-text"><i class="fab fa-telegram"></i></div>
											<input type="text" class="form-control @error('telegram') is-invalid @enderror" placeholder="Enter Telegram Link" name="telegram" value="{{ !empty($setting->telegram) ? $setting->telegram : old('telegram') }}">
										</div>
										@error('telegram')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>

								</div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-danger px-4"><i
                                    class="fa fa-refresh fa-lg ms-n2 "></i> &nbsp; Reset</button>
                                <button type="submit" name="btnsubmit" value="update" class="btn btn-primary px-4"> &nbsp; {{ __('Update Social Media') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        {{-- Body Here --}}
    </div>
@endsection
