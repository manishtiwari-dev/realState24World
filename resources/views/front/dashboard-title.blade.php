 <div class="dashboard-title fl-wrap">
     <div class="dashboard-title-item">
        <span>
            @if(request()->routeIs('front.dashboardlistingtable'))
                My Listings
            @elseif(request()->routeIs('front.dashboardbookings'))
                Bookings
            @elseif(request()->routeIs('front.dashboardreview'))
                Review
            @elseif(request()->routeIs('front.dashboardaddlisting'))
                Add New
            @elseif(request()->routeIs('front.dashboardpg'))
                PG Properties
            @elseif(request()->routeIs('front.dashboardpglist'))
                PG Properties
            @else
                Account
            @endif
        </span>
    </div>
     <div class="dashbard-menu-header">
         <div class="dashbard-menu-avatar fl-wrap">
             @if (auth()->user()->is_role == 0)
                 @if (!empty(auth()->user()->profile_photo))
                     <img src="{{ asset('uploads/user/' . auth()->user()->profile_photo) }}" class="respimg" alt="">
                 @else
                     <img src="{{ asset('images/blank-img.jpg') }}" class="respimg" alt="">
                 @endif
             @else
                 @if (!empty(auth()->user()->profile_photo))
                     <img src="{{ asset('uploads/dealer/' . auth()->user()->profile_photo) }}" class="respimg"
                         alt="">
                 @else
                     {{-- <img src="{{ asset('images/blank-img.jpg') }}" class="respimg" alt=""> --}}
                 @endif
             @endif
             <h4>Welcome, <span>{{ auth()->user()->name }}  @if (auth()->user()->is_role == 3) (Dealer) @endif</span></h4>
         </div>
         @php
             $guard = session('guard', 'web');
         @endphp




         <a href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
             onclick="event.preventDefault(); if(confirm('Are you sure you want to log out?')) { document.getElementById('logout-form').submit(); }"
             class="log-out-btn tolt" data-microtip-position="bottom" data-tooltip="Log Out">
             <i class="fas fa-power-off"></i>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>


     </div>
     <!--Tariff Plan menu-->
     {{-- <div class="tfp-det-container">
         <div class="tfp-btn"><span>Your Tariff Plan : </span> <a href=""><strong>Extended</strong></a>
         </div>

     </div> --}}
     <!--Tariff Plan menu end-->
 </div>
