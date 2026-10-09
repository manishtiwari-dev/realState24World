<div id="wrapper">
    <!-- dashbard-menu-wrap -->
    <div class="dashbard-menu-overlay"></div>
    <div class="dashbard-menu-wrap">
        <div class="dashbard-menu-close"><i class="fal fa-times"></i></div>
        <div class="dashbard-menu-container">
            <!-- user-profile-menu-->
            <div class="user-profile-menu">
                <h3>Main</h3>
                <ul class="no-list-style">
                     <li><a href="{{ route('user.dashboard') }}"><i class="fal fa-chart-line"></i>Dashboard</a></li>
                    <li><a href="{{ route('front.dashboardmyprofile') }}"><i class="fal fa-user-edit"></i> Edit profile</a></li>  
                    <!-- <li><a href="dashboard-messages.php"><i class="fal fa-envelope"></i> Messages <span>3</span></a></li> -->
                    {{-- <li><a href="{{ route('front.dashboardagents') }}"><i class="fal fa-users"></i> Agents List</a></li> --}}
                    
                </ul>
            </div>
            <!-- user-profile-menu end-->
            <!-- user-profile-menu-->
            <div class="user-profile-menu">
                <h3>Listings</h3>
                <ul  class="no-list-style">
                    <li><a href="{{ route('front.dashboardlistingtable') }}" class="{{ request()->routeIs('front.dashboardlistingtable') ? 'user-profile-act' : '' }}"><i class="fal fa-th-list"></i> My listigs  </a></li>
                    <li><a href="{{ route('front.dashboardbookings') }}" class="{{ request()->routeIs('front.dashboardbookings') ? 'user-profile-act' : '' }}"><i class="fal fa-calendar-check"></i> Bookings </a></li>
                    <li><a href="{{ route('front.dashboardreview') }}" class="{{ request()->routeIs('front.dashboardreview') ? 'user-profile-act' : '' }}"><i class="fal fa-comments-alt"></i> Review </a></li>
                    <li><a href="{{ route('front.dashboardaddlisting') }}" class="{{ request()->routeIs('front.dashboardaddlisting') ? 'user-profile-act' : '' }}"><i class="fal fa-file-plus"></i> Add New</a></li>
                    {{-- <li><a href="{{ route('front.dashboardpg') }}" class="{{ request()->routeIs('front.dashboardpg') ? 'user-profile-act' : '' }}"><i class="fal fa-list"></i> PG Properties</a></li> --}}
                    <li><a href="{{ route('front.dashboardpglist') }}" class="{{ request()->routeIs('front.dashboardpglist','front.dashboardpg') ? 'user-profile-act' : '' }}"><i class="fal fa-list"></i> PG Properties</a></li>
                </ul>
            </div>
            <!-- user-profile-menu end--> 
        </div>
        <div class="dashbard-menu-footer"> &#169;  realState24world 2024 .  All rights reserved.</div>
    </div>
    <!-- dashbard-menu-wrap end  -->	