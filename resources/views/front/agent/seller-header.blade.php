<header class="main-header">
    <div class="logo-holder"><a href="{{ route('user.dashboard') }}"><img src="images/logo.png" alt=""></a></div>
    <!-- nav-button-wrap-->
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    <!-- nav-button-wrap end-->
    <div class="header-search-button"><a href="{{ route('register') }}"><i class="fal fa-plus"></i> <span>Post
                Property</span></a></div>
    <!--  add new  btn -->
    <div class="add-list_wrap">
        <a href="{{ route('register') }}" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Post
                Property</span></a>
    </div>
    <!--  add new  btn end -->

    <!--  login btn -->
    <!-- <div class="show-reg-form">
                <a href="login.php"><i class="fas fa-user"></i><span>Login</span></a>
            </div> -->
    <!--  login btn  end -->

    <!--  login btn -->
    {{-- <div class="show-reg-form dasbdord-submenu-open"><i class="fas fa-user"></i><span>Login</span>/<span>Register</span>
    </div> --}}
    <a href="{{ route('index') }}" class="show-reg-form dasbdord-submenu-open"><i class="fas fa-home"></i><span>Main Page</span> </a> 
    <!--  login btn  end -->
    <!--  dashboard-submenu-->
    <div class="dashboard-submenu">
        <div class="dashboard-submenu-title fl-wrap">Welcome , <span>{{ auth()->user()->name }}</span></div>
        <ul>
            <li><a href="{{ route('front.dashboardaddlisting') }}"><i class="fas fa-user"></i><span>Dashboard Add Listing</a></li>
            <li><a href="{{ route('register') }}"> <i class="fal fa-file-plus"></i>Register</a></li>
            {{-- <li><a href="{{ route('frontend.dashboardmyprofile') }}"><i class="fal fa-user-edit"></i>Settings</a></li> --}}
        </ul>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            onclick="event.preventDefault(); if(confirm('Are you sure you want to log out?')) { document.getElementById('logout-form').submit(); }"
            class="color-bg db_log-out">
            <i class="fas fa-power-off">Log Out</i>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>


    </div>
    <!--  dashboard-submenu  end -->

</header>
<!-- header end  -->
