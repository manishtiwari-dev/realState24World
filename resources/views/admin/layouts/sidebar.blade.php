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



            <div class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'customer.index', getRolePrefix() . 'customer.block') ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-chalkboard-user"></i> </div>
                    <div class="menu-text"><b>Customer Manage...</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'customer.index') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'customer.index') }}" class="menu-link">
                            <div class="menu-text">Active Customers</div>
                        </a>
                    </div>
                    <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'customer.block') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'customer.block') }}" class="menu-link">
                            <div class="menu-text">Blocked Customers</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'booking.enquiry') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'booking.enquiry') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-list"></i> </div>
                    <div class="menu-text"><b>Booking Enquiry Man..</b></div>
                </a>
            </div>

            @can('banner-list')
                <div
                    class="menu-item {{ request()->routeIs(getRolePrefix() . 'banners.index', getRolePrefix() . 'banners.create', getRolePrefix() . 'banners.edit') ? 'active' : '' }}">
                    <a href="{{ route(getRolePrefix() . 'banners.index') }}" class="menu-link">
                        <div class="menu-icon"> <i class="fa fa-image"></i> </div>
                        <div class="menu-text"><b>Banner Management</b></div>
                    </a>
                </div>
            @endcan

            @if ($user && ($user->can('category-list') || $user->can('location-list') || $user->can('properties-list')))
                <div
                    class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'category.index', getRolePrefix() . 'category.create', getRolePrefix() . 'category.edit', getRolePrefix() . 'properties.verification', getRolePrefix() . 'location.create', getRolePrefix() . 'location.edit', getRolePrefix() . 'properties.index', getRolePrefix() . 'properties.create', getRolePrefix() . 'properties.edit') ? 'active' : '' }}">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"> <i class="fas fa-rectangle-list"></i> </div>
                        <div class="menu-text"><b>Property Manage...</b></div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        @can('category-list')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'category.index', getRolePrefix() . 'category.create', getRolePrefix() . 'category.edit') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'category.index') }}" class="menu-link">
                                    <div class="menu-text">Manage Category</div>
                                </a>
                            </div>
                        @endcan
                        @can('location-list')
                            {{-- <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'location.index', getRolePrefix() . 'location.create', getRolePrefix() . 'location.edit') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'location.index') }}" class="menu-link">
                                    <div class="menu-text">Manage Location</div>
                                </a>
                            </div> --}}
                        @endcan

                        <div
                            class="menu-item {{ request()->routeIs(getRolePrefix() . 'properties.index', getRolePrefix() . 'properties.create', getRolePrefix() . 'properties.edit') ? 'active' : '' }}">
                            <a href="{{ route(getRolePrefix() . 'properties.index') }}" class="menu-link">
                                <div class="menu-text">Manage Properties</div>
                            </a>
                        </div>
                        <div
                            class="menu-item {{ request()->routeIs(getRolePrefix() . 'properties.verification', getRolePrefix() . 'properties.verificationedit') ? 'active' : '' }}">
                            <a href="{{ route(getRolePrefix() . 'properties.verification') }}" class="menu-link">
                                <div class="menu-text">Under Verification Properties</div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif


              <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'project.index',getRolePrefix() . 'project.create',getRolePrefix() . 'project.edit',getRolePrefix() . 'project.show',getRolePrefix() . 'project.property_create',getRolePrefix() . 'project.property_update') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'project.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-rectangle-list"></i> </div>
                    <div class="menu-text"><b>Project Management</b></div>
                </a>
            </div>

             <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'pgproperty.index',getRolePrefix() . 'pgproperty.create',getRolePrefix() . 'pgproperty.edit',getRolePrefix() . 'pgproperty.show',getRolePrefix() . 'pgproperty.property_create',getRolePrefix() . 'pgproperty.property_update') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'pgproperty.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-rectangle-list"></i> </div>
                    <div class="menu-text"><b>PG Management</b></div>
                </a>
            </div>

            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'auctions.index',getRolePrefix() . 'auctions.create') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'auctions.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-list"></i> </div>
                    <div class="menu-text"><b>Auction Properties</b></div>
                </a>
            </div>


            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'review.index') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'review.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-star"></i> </div>
                    <div class="menu-text"><b>Properties Reviews</b></div>
                </a>
            </div>

            {{-- <div class="menu-item">
                <a href="#" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-hashtag"></i> </div>
                    <div class="menu-text"><b>Coupon Code Manage...</b></div>
                </a>
            </div>

            {{-- <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-blog"></i> </div>
                    <div class="menu-text"><b>Blogs Management</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="#" class="menu-link">
                            <div class="menu-text">Add New Blog</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="#" class="menu-link">
                            <div class="menu-text">Manage Blogs</div>
                        </a>
                    </div>
                </div>
            </div> --}}



            <div
                class="menu-item has-sub {{ request()->routeIs(
                    getRolePrefix() . 'blog_tag.index',
                    getRolePrefix() . 'blog_tag.create',
                    getRolePrefix() . 'blog_tag.update',
                    getRolePrefix() . 'blog.index',
                    getRolePrefix() . 'blog.create',
                    getRolePrefix() . 'blog.update',
                )
                    ? 'active'
                    : '' }}">

                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-blog"></i> </div>
                    <div class="menu-text"><b>Blogs Management</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu ">
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'blog_tag.index', getRolePrefix() . 'blog_tag.create', getRolePrefix() . 'blog_tag.update') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'blog_tag.index') }}" class="menu-link">
                            <div class="menu-text">Blog Tag</div>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'blog.index', getRolePrefix() . 'blog.create', getRolePrefix() . 'blog.update') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'blog.index') }}" class="menu-link">
                            <div class="menu-text">Manage Blogs</div>
                        </a>
                    </div>
                </div>
            </div>


            <div
                class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'privacy_policy', getRolePrefix() . 'term_condition', getRolePrefix() . 'returnPolicy') ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-file-invoice"></i> </div>
                    <div class="menu-text"><b>Policy Management</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'privacy_policy') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'privacy_policy') }}" class="menu-link">
                            <div class="menu-text">Privacy Policy</div>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'term_condition') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'term_condition') }}" class="menu-link">
                            <div class="menu-text">Term and Condition</div>
                        </a>
                    </div>
                    {{-- <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'returnPolicy') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'returnPolicy') }}" class="menu-link">
                            <div class="menu-text">Return Policy</div>
                        </a>
                    </div> --}}
                </div>
            </div>




            <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'about.index') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'about.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-info-circle"></i> </div>
                    <div class="menu-text"><b>About Content Man...</b></div>
                </a>
            </div>

            <div
                class="menu-item {{ request()->routeIs(getRolePrefix() . 'faq.index', getRolePrefix() . 'faq.create', getRolePrefix() . 'faq.update') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'faq.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-question-circle"></i> </div>
                    <div class="menu-text"><b>Help Center Man...</b></div>
                </a>
            </div>


            <div
                class="menu-item {{ request()->routeIs(getRolePrefix() . 'testimonial.index', getRolePrefix() . 'testimonial.create', getRolePrefix() . 'testimonial.update') ? 'active' : '' }}">
                <a href="{{ route(getRolePrefix() . 'testimonial.index') }}" class="menu-link">
                    <div class="menu-icon"> <i class="fa fa-comments"></i> </div>
                    <div class="menu-text"><b>Testimonial Man...</b></div>
                </a>
            </div>

            <div
                class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'dealer.index', getRolePrefix() . 'dealer.create', getRolePrefix() . 'dealer.edit', getRolePrefix() . 'dealer.show',getRolePrefix() . 'agent_review.index',getRolePrefix() . 'dealer.booking') ? 'active' : '' }}">

                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-user"></i> </div>
                    <div class="menu-text"><b>Dealer Management</b></div>
                    <div class="menu-caret"></div>
                </a>


                <div class="menu-submenu">
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'dealer.create') ? 'active' : '' }}">
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

                     <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'agent_review.index') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'agent_review.index') }}" class="menu-link">
                            <div class="menu-text">Reviews</div>
                        </a>
                    </div>

                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'dealer.booking') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'dealer.booking') }}" class="menu-link">
                            <div class="menu-text">Booking</div>
                        </a>
                    </div>

                </div>
            </div>

            <div
                class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'agent.index', getRolePrefix() . 'agent.create', getRolePrefix() . 'agent.edit', getRolePrefix() . 'agent.show') ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon"> <i class="fas fa-user"></i> </div>
                    <div class="menu-text"><b>Agent Management</b></div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ request()->routeIs(getRolePrefix() . 'agent.create') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'agent.create') }}" class="menu-link">
                            <div class="menu-text">Create New Agent</div>
                        </a>
                    </div>
                    <div
                        class="menu-item {{ request()->routeIs(getRolePrefix() . 'agent.index', getRolePrefix() . 'agent.edit') ? 'active' : '' }}">
                        <a href="{{ route(getRolePrefix() . 'agent.index') }}" class="menu-link">
                            <div class="menu-text">Manage Agents</div>
                        </a>
                    </div>

                   

                </div>
            </div>


            @if (
                $user &&
                    ($user->can('setting-dashboard') ||
                        $user->can('setting-activity-logs') ||
                        $user->can('user-list') ||
                        $user->can('role-list') ||
                        $user->can('permission-list')))
                <div
                    class="menu-item has-sub {{ request()->routeIs(getRolePrefix() . 'users.index', getRolePrefix() . 'users.create', getRolePrefix() . 'users.edit', getRolePrefix() . 'users.show', getRolePrefix() . 'roles.index', getRolePrefix() . 'roles.create', getRolePrefix() . 'roles.edit', getRolePrefix() . 'roles.show', getRolePrefix() . 'permissions.index', getRolePrefix() . 'permissions.create', getRolePrefix() . 'permissions.edit', getRolePrefix() . 'settings.index', getRolePrefix() . 'settings.profile', getRolePrefix() . 'settings.setting', getRolePrefix() . 'settings.social-media', getRolePrefix() . 'settings.password', getRolePrefix() . 'settings.logactivities') ? 'active' : '' }}">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"> <i class="fas fa-cog"></i> </div>
                        <div class="menu-text"><b>Website Settings</b></div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        @can('setting-dashboard')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'settings.profile', getRolePrefix() . 'settings.profile', getRolePrefix() . 'settings.setting', getRolePrefix() . 'settings.social-media', getRolePrefix() . 'settings.password') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'settings.profile') }}" class="menu-link">
                                    <div class="menu-text">Setting</div>
                                </a>
                            </div>
                        @endcan
                        @can('setting-activity-logs')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'settings.logactivities') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'settings.logactivities') }}" class="menu-link">
                                    <div class="menu-text">Activity Logs</div>
                                </a>
                            </div>
                        @endcan
                        @can('user-list')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'users.index', getRolePrefix() . 'users.create', getRolePrefix() . 'users.edit', getRolePrefix() . 'users.show') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'users.index') }}" class="menu-link">
                                    <div class="menu-text">Manage Users</div>
                                </a>
                            </div>
                        @endcan
                        @can('role-list')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'roles.index', getRolePrefix() . 'roles.create', getRolePrefix() . 'roles.edit', getRolePrefix() . 'roles.show') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'roles.index') }}" class="menu-link">
                                    <div class="menu-text">Role & Permission</div>
                                </a>
                            </div>
                        @endcan
                        @can('permission-list')
                            <div
                                class="menu-item {{ request()->routeIs(getRolePrefix() . 'permissions.index', getRolePrefix() . 'permissions.create', getRolePrefix() . 'permissions.edit') ? 'active' : '' }}">
                                <a href="{{ route(getRolePrefix() . 'permissions.index') }}" class="menu-link">
                                    <div class="menu-text">Manage Permission</div>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
            @endif

            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
