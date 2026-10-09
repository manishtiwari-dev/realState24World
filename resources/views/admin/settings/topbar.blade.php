<div class="profile">
    <div class="profile-header">
        <div class="profile-header-cover"></div>
        <div class="profile-header-content">
            <div class="profile-header-img">
                <img src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}" width="200"/>
            </div>
            <div class="profile-header-info">
                <h4 class="mt-0 mb-1">{{ Auth::user()->name }}</h4>
                <p class="mb-2"><a href="#" style="color: #a7a7a7;"> {{ __('Setting') }} </a> </p>
                <a href="{{ route(getRolePrefix().'home') }}" class="btn btn-xs btn-yellow"> &nbsp; <i class="fa fa-arrow-left fa-lg ms-n2 "></i> BACK TO DASHBOARD</a>
            </div>
        </div>
        <ul class="profile-header-tab">
            {{-- @can('setting-dashboard')  
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.index') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.index') ? 'active' : '' }}">DASHBOARD</a></li>
            @endcan --}}
            @can('setting-profile')  
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.profile') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.profile') ? 'active' : '' }}">PROFILE</a></li>
            @endcan
            @can('setting-settings')    
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.setting') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.setting') ? 'active' : '' }}">GLOBAL SETTING</a></li>
            @endcan
            @can('setting-social-media')    
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.social-media') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.social-media') ? 'active' : '' }}">SOCIAL MEDIA</a></li>
            @endcan
            @can('setting-change-password')
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.password') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.password') ? 'active' : '' }}">CHANGE PASSWORD</a></li>
            @endcan
        </ul>
    </div>
</div>