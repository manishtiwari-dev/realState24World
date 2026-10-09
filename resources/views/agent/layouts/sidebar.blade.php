<div id="sidebar" class="app-sidebar">
    @php $user = current_auth_user(); @endphp

    <div class="app-sidebar-content find-link" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'home') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'home') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-home"></i> </div>
                    <div class="menu-text"><b>Dashboard</b></div>
                </a>
            </div>





            <div
                class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'category.index', getRolePrefix() . 'category.create', getRolePrefix() . 'category.edit', getRolePrefix() . 'location.index', getRolePrefix() . 'location.create', getRolePrefix() . 'location.edit', getRolePrefix() . 'properties.index', getRolePrefix() . 'properties.create', getRolePrefix() . 'properties.edit') ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-rectangle-list"></i> </div>
                    <div class="menu-text"><b>Property Manage...</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">

                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'properties.index', getRolePrefix() . 'properties.create', getRolePrefix() . 'properties.edit') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'properties.index') }}" class="menu-link">
                            <div class="menu-text">Manage Properties</div>
                        </a>
                    </div>
                </div>
            </div>


{{-- 
            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'review.index') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'review.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-star"></i> </div>
                    <div class="menu-text"><b>Properties Reviews</b></div>
                </a>
            </div> --}}



            <div
                class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'dealer.index', getRolePrefix() . 'dealer.create', getRolePrefix() . 'dealer.edit', getRolePrefix() . 'dealer.show') ? 'active' : '' }}">

                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-user"></i> </div>
                    <div class="menu-text"><b>Dealer Management</b></div>
                    <div class="menu-caret"></div>
                </a>


                <div class="menu-submenu">
                    <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'dealer.create') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'dealer.create') }}" class="menu-link">
                            <div class="menu-text">Create New Dealer</div>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'dealer.index', getRolePrefix() . 'dealer.edit', getRolePrefix() . 'dealer.show') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'dealer.index') }}" class="menu-link">
                            <div class="menu-text">Manage Dealers</div>
                        </a>
                    </div>
                </div>
            </div>



            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
