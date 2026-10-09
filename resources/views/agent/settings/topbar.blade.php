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
           
                {{-- <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.index') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.index') ? 'active' : '' }}">DASHBOARD</a></li> --}}
            
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.profile') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.profile') ? 'active' : '' }}">PROFILE</a></li>
            
                <li class="nav-item"><a href="{{ route(getRolePrefix().'settings.password') }}" class="nav-link {{ request()->routeIs(getRolePrefix().'settings.password') ? 'active' : '' }}">CHANGE PASSWORD</a></li>
           
        </ul>
    </div>
</div>