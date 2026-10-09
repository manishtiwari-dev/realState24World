<header class="main-header">
    <div class="logo-holder">
        <a href="{{ route('index') }}"><img src="{{ asset('images/logo.png') }}" alt="Homez 24 World"></a>
    </div>
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    @auth
        <div class="add-list_wrap">
            <a href="{{ route('front.dashboardmyprofile') }}" class="add-list color-bg"><i class="fal fa-user"></i> <span>My Account</span></a>
        </div>
    @else
        <div class="header-search-button">
            <a href="{{ route('register') }}"><i class="fal fa-plus"></i> <span>Register</span></a>
        </div>
        <div class="add-list_wrap">
            <a href="{{ route('register') }}" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Register</span></a>
        </div>
        <div class="add-list_wrap">
            <a href="{{ route('register') }}" class="add-list color-bg"> <span>Post Property For Free</span></a>
        </div>
        <div class="show-reg-form">
            <a href="{{ route('login') }}"><i class="fas fa-user"></i><span>Login</span></a>
        </div>
    @endauth
    <div class="nav-holder main-menu">
        <nav>
            <ul class="no-list-style">
                <li><a href="{{ route('index') }}">Home</a></li> 
                <li>
                    <a href="#">Property Services <i class="fa fa-caret-down"></i></a>
                    <ul>
                        @foreach (getCategories() as $category)
                            <li><a href="{{ route('property', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>       
                <li><a href="{{ route('pg') }}">PG/Co-Living</a></li> 
                <li><a href="{{ route('auction') }}">Auction</a></li>
                <li><a href="{{ route('agent') }}">Seller</a> </li>    
                 <li><a href="{{ route('project') }}">Project</a> </li>                          
                <li><a href="{{ route('blog') }}">News</a></li>                
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>                
            </ul>
        </nav>
    </div>
</header>
