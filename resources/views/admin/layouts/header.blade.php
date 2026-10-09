<div id="header" class="app-header">
    <div class="navbar-header">
        <a href="{{ route(getRolePrefix().'home') }}" class="navbar-brand">
            <img src="{{ asset('uploads/logo.png') }}" width="80px">
        </a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-nav">
        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}" /><span>
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                @can('setting-profile')  
                    <a href="{{ route(getRolePrefix().'settings.profile') }}" class="dropdown-item">Edit Profile</a>
                @endcan
                @can('setting-change-password')
                    <a href="{{ route(getRolePrefix() .'settings.password') }}" class="dropdown-item">Change Password</a>
                @endcan
                @can('setting-settings')   
                    <a href="{{ route(getRolePrefix() .'settings.setting') }}" class="dropdown-item">Setting</a>
                @endcan
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route(getRolePrefix().'logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form-{{ session('guard') }}').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form-{{ session('guard') }}" action="{{ route(getRolePrefix().'logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
