@extends('agent.layouts.app')
@section('content')
    <div id="content" class="app-content p-0">
        {{-- Heading --}}
        @include('agent.settings.topbar')
        {{-- Heading --}}
        <div class="container">
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- Website Logo --}}
                                @if(!empty($settingrow->logo))
                                    <div class="col-md-4">
                                        <div class="card shadow-sm border-0 text-center p-4 h-100 d-flex flex-column">
                                            <h6 class="mb-4">Website Logo</h6>
                                            <div class="text-center">
                                                <img src="{{ asset('uploads/'.$settingrow->logo) }}" alt="Logo" class="img-fluid mb-4" width="120">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- Favicon --}}
                                @if(!empty($settingrow->favicon))
                                    <div class="col-md-4">
                                        <div class="card shadow-sm border-0 text-center p-4 h-100 d-flex flex-column">
                                            <h6 class="mb-4">Favicon</h6>
                                            <div class="text-center">
                                                <img src="{{ asset('uploads/'.$settingrow->favicon) }}" alt="Favicon" class="img-fluid mb-2" width="50">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                               

                                {{-- Social Media Links --}}
                                
                                <div class="col-md-4">
                                    <div class="card shadow-sm border-0 text-center p-4 h-100 d-flex flex-column">
                                        <h6 class="mb-5">Social Media Links</h6>
                                        <div>
                                            @if(!empty($settingrow->facebook))
                                                <a target="_blank" href="{{ $settingrow->facebook }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-facebook"></span></a>
                                            @endif   
                                            @if(!empty($settingrow->twitter))
                                                <a target="_blank" href="{{ $settingrow->twitter }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-twitter"></span></a>
                                            @endif
                                            @if(!empty($settingrow->linkedin))   
                                                <a target="_blank" href="{{ $settingrow->linkedin }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-linkedin"></span></a>
                                            @endif
                                            @if(!empty($settingrow->instagram))
                                                <a target="_blank" href="{{ $settingrow->instagram }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-instagram"></span></a>
                                            @endif
                                            @if(!empty($settingrow->youtube))
                                                <a target="_blank" href="{{ $settingrow->youtube }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-youtube"></span></a>
                                            @endif
                                            @if(!empty($settingrow->pinterest))    
                                                <a target="_blank" href="{{ $settingrow->pinterest }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-pinterest"></span></a>
                                            @endif
                                            @if(!empty($settingrow->whatsapp))    
                                                <a target="_blank" href="{{ $settingrow->whatsapp }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-whatsapp"></span></a>
                                            @endif
                                            @if(!empty($settingrow->telegram))    
                                                <a target="_blank" href="{{ $settingrow->telegram }}" class="btn btn-social btn-default float-start me-5px mb-5px"><span class="fab fa-telegram"></span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                               
                                {{-- Company Details --}}
                                
                                <div class="col-md-6">
                                    <div class="card shadow-sm border-0 text-center p-4 h-100 d-flex flex-column">
                                        <h6 class="mb-4">Company Details</h6>
                                        @if(!empty($settingrow->company_name))
                                        <p class="mb-0"><strong>Company Name:</strong> {{ $settingrow->company_name }}</p>
                                        @endif
                                        @if(!empty($settingrow->email))   
                                            <p class="mb-0"><a style="text-decoration: none; color:#000;" href="mailto:{{ $settingrow->email }}"><strong>Email:</strong> {{ $settingrow->email }}</a></p>
                                        @endif
                                        @if(!empty($settingrow->alt_email))   
                                            <p class="mb-0"><a style="text-decoration: none; color:#000;" href="mailto:{{ $settingrow->alt_email }}"><strong>Alt Email:</strong> {{ $settingrow->alt_email }}</a></p>
                                        @endif
                                    </div>
                                </div>
                                

                                {{-- Contact Information --}}
                                @if(!empty($settingrow->address)) 
                                <div class="col-md-6">
                                    <div class="card shadow-sm border-0 text-center p-4 h-100 d-flex flex-column">
                                        <h6 class="mb-4">Contact Information</h6>
                                        @if(!empty($settingrow->address))  
                                            <p class="mb-0"><strong>Address:</strong> {{ $settingrow->address }}</p>
                                        @endif
                                        @if(!empty($settingrow->alt_address))  
                                            <p class="mb-0"><strong>Other Address:</strong> {{ $settingrow->alt_address }}</p>
                                        @endif
                                        @if(!empty($settingrow->phone))  
                                            <p class="mb-0"><a style="text-decoration: none; color:#000;" href="tel:{{ $settingrow->phone }}"><strong>Phone:</strong> {{ $settingrow->phone }} </a></p>
                                        @endif
                                        @if(!empty($settingrow->alt_phone))  
                                            <p class="mb-0"><a style="text-decoration: none; color:#000;" href="tel:{{ $settingrow->phone }}"><strong>Alt Phone:</strong> {{ $settingrow->alt_phone }}</a></p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
