@php
    $permission = DB::table('module_permissions')
        ->where('Role_ID', $currentUser->Role_ID)
        ->first();
    $other_permission = DB::table('other_permissions')
        ->where('Role_ID', $currentUser->Role_ID)
        ->first();
@endphp
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ route('Main.Dashboard') }}">
            <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-lgo"
                alt="One Click Logo">
            <img src="{{ asset('assets/images/brand/logo-white.png') }}" class="header-brand-img dark-logo"
                alt="One Click Logo" style="height: 45px;">
            <img src="{{ asset('assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo"
                alt="One Click Logo">
            <img src="{{ asset('assets/images/brand/favicon1.png') }}" class="header-brand-img darkmobile-logo"
                alt="One Click Logo">
        </a>
    </div>
    <div class="app-sidebar3">
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ !empty($currentUser->basic_info->profile_photo_path) ? asset($currentUser->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                        alt="user-img" class="avatar-xxl rounded-circle mb-1">
                </div>
                <div class="user-info">
                    <h5 class=" mb-2">{{ $currentUser->basic_info->full_name }}</h5>
                    <span
                        class="text-muted app-sidebar__user-name text-sm">{{ $currentUser->designation->Designation_Name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu mb-lg-5">
            <li class="side-item side-item-category mt-4">Dashboards</li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('Main.Dashboard') }}">
                    <i class="feather feather-home sidemenu_icon"></i>
                    <span class="side-menu__label">Dashboard</span>
                </a>
            </li>
            @if ((int) !in_array($currentUser->Role_ID, [2, 14, 15, 1]))
                <li class="slide"><a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"> <i
                            class="feather feather-package sidemenu_icon"></i>
                        <span class="side-menu__label">Manage Orders</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu ">
                        <li class="side-menu-label1"><a href="javascript:void(0);">Manage Orders</a></li>

                        @if ((int) $permission->Research_view === 1)
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Research
                                        Orders</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @if ((int) $permission->Research_create === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Research.Create.Order') }}">Create
                                                Order</a></li>
                                    @endif
                                    @if ((int) $permission->Research_list === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Research.Orders') }}">All
                                                Orders</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Research_list === 1)
                                        <li>

                                            <a href="{{ route('Research.Completed.Orders') }}" class="sub-slide-item">
                                                Completed
                                                Orders</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (in_array((int) $currentUser->Role_ID, [3, 9, 10, 11]))
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Development
                                        Order</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">

                                    @if ((int) $currentUser->Role_ID !== 3)
                                        <li><a class="sub-slide-item"
                                                href="{{ route('create.development.order') }}">Create
                                                Order</a>
                                        </li>
                                    @endif

                                    <li><a class="sub-slide-item" href="{{ route('development.order.list') }}">All
                                            Orders</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if ((int) $permission->Content_view === 1)
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Content
                                        Orders</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @if ((int) $permission->Content_create === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Content.Create.Order') }}">Create
                                                Order</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Content_list === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Content.Orders') }}">All
                                                Orders</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Content_list === 1)
                                        <li><a href="{{ route('Content.Completed.Orders') }}"
                                                class="sub-slide-item">Completed
                                                Orders</a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        @if ((int) in_array($currentUser->Role_ID, [1, 9, 10, 11, 16]))
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Desiging Order
                                    </span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">

                                    @if ((int) $currentUser->Role_ID !== 16)
                                        <li><a class="sub-slide-item" href="{{ route('create.design.order') }}">Create
                                                Order</a>
                                        </li>
                                    @endif

                                    <li><a class="sub-slide-item" href="{{ route('design.order.list') }}">All
                                            Orders</a>
                                    </li>
                                </ul>
                            </li>

                        @endif

                        @if ((int) $permission->role_id === 1 || (int) $permission->role_id === 9 || (int) $permission->role_id === 10)
                            <li><a href="{{ route('Clients.List') }}" class="slide-item">Client List</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if ($currentUser->Role_ID == 1)
                <li class="slide"><a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"> <i
                            class="feather feather-package sidemenu_icon"></i>
                        <span class="side-menu__label">Manage Orders</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu ">
                        <li class="side-menu-label1"><a href="javascript:void(0);">Manage Orders</a></li>
                        @if ((int) $permission->Research_view === 1)
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Research
                                        Orders</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @if ((int) $permission->Research_list === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Research.Orders') }}">All
                                                Orders</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Research_view === 1 && (int) $permission->Research_list === 1)
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Research.Completed.Orders') }}">
                                                Complete
                                                Order</a></li>
                                    @endif
                                    @if ((int) $permission->Research_create === 1)
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Research.Create.Order') }}">Create
                                                Order</a></li>
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Research.Canceled.Orders') }}">Canceled
                                                Orders</a></li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        @if ((int) $permission->Website_view === 1)
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Development
                                        Order</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">

                                    <li><a class="sub-slide-item"
                                            href="{{ route('create.development.order') }}">Create
                                            Order</a>
                                    </li>

                                    <li><a class="sub-slide-item" href="{{ route('development.order.list') }}">All
                                            Orders</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if ((int) $permission->Content_view === 1)
                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Content
                                        Orders</span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">
                                    @if ((int) $permission->Content_list === 1)
                                        <li><a class="sub-slide-item" href="{{ route('Content.Orders') }}">All
                                                Orders</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Content_view === 1 && (int) $permission->Content_list === 1)
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Content.Completed.Orders') }}">Completed
                                                Order</a>
                                        </li>
                                    @endif
                                    @if ((int) $permission->Content_create === 1)
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Content.Create.Order') }}">Create
                                                Order</a>
                                        </li>
                                        <li><a class="sub-slide-item"
                                                href="{{ route('Content.Canceled.Orders') }}">Canceled
                                                Orders</a></li>
                                    @endif


                                </ul>
                            </li>
                        @endif

                        @if ((int) $permission->role_id === 1 || (int) $permission->role_id === 9 || (int) $permission->role_id === 10)
                            {{-- <li><a href="{{ route('Clients.List') }}" class="slide-item">Client List</a>
                        </li> --}}

                            <li class="sub-slide">
                                <a class="sub-side-menu__item" data-bs-toggle="sub-slide"
                                    href="javascript:void(0);"><span class="sub-side-menu__label">Desiging Order
                                    </span><i class="sub-angle fa fa-angle-right"></i></a>
                                <ul class="sub-slide-menu">

                                    <li><a class="sub-slide-item" href="{{ route('create.design.order') }}">Create
                                            Order</a>
                                    </li>
                                    <li><a class="sub-slide-item" href="{{ route('design.order.list') }}">All
                                            Orders</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ((int) $permission->role_id === 1 || (int) $permission->role_id === 2 || (int) $permission->role_id === 15)
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('Add.Portal.Permissions') }}">
                        <i class="feather feather-lock sidemenu_icon"></i>
                        <span class="side-menu__label">Permissions</span>
                    </a>
                </li>
            @endif

            @if ((int) $other_permission->Employee_view === 1)
                <li class="slide"><a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"> <i
                            class="feather feather-users sidemenu_icon"></i>
                        <span class="side-menu__label">Employees</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0);">Employees</a></li>
                        @if ((int) $other_permission->Employee_list === 1)
                            <li><a href="{{ route('All.Employee') }}" class="slide-item">View All</a></li>
                        @endif
                        @if ((int) $other_permission->Employee_create === 1)
                            <li><a href="{{ route('New.Employee') }}" class="slide-item">Add New</a></li>
                        @endif
                        <li>
                            <a href="{{ route('employee.trashed') }}" class="slide-item">Deactivate Employee</a>
                        </li>

                    </ul>
                </li>
            @endif
            @if ((int) $other_permission->Sales_Performance_view === 1 || (int) $other_permission->Writer_Performance_view === 1)
                <li class="slide"><a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"> <i
                            class="feather feather-trending-up sidemenu_icon"></i>
                        <span class="side-menu__label">Performance</span><i class="angle fa fa-angle-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0);">Performance</a></li>
                        @if ((int) $other_permission->Sales_Performance_view === 1)
                            <li><a href="javascript:void(0);" class="slide-item">Sales Performance</a></li>
                        @endif
                        @if ((int) $other_permission->Writer_Performance_view === 1)
                            <li><a href="{{ route('Research.Users.Performance') }}" class="slide-item">Writer
                                    Performance</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ((int) $currentUser->Role_ID === 1 || (int) $currentUser->Role_ID === 2 || (int) $currentUser->Role_ID === 15)

                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                        <i class="feather feather-user-check sidemenu_icon"></i>
                        <span class="side-menu__label">HR Department</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <!-- HR Department Management -->
                        <li class="side-menu-label1">
                            <a href="javascript:void(0);">HR Management</a>
                        </li>
                        <!-- Payroll Management -->
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0);">
                                <span class="sub-side-menu__label">Payroll</span>
                                <i class="sub-angle fa fa-angle-right"></i>
                            </a>
                            <ul class="sub-slide-menu">
                                <li><a class="sub-slide-item" href="{{ route('generate.payslip') }}">Generate
                                        Payslip</a>
                                </li>
                                <li><a class="sub-slide-item" href="{{ route('allowance.setting') }}">Allowance
                                        Setting</a></li>
                                <li><a class="sub-slide-item" href="{{ route('detaction.setting') }}">Deduction
                                        Setting</a></li>
                            </ul>
                        </li>
                        <!-- Leave Management -->
                        <li class="sub-slide">
                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0);">
                                <span class="sub-side-menu__label">Leave </span>
                                <i class="sub-angle fa fa-angle-right"></i>
                            </a>
                            <ul class="sub-slide-menu">
                                <li><a class="sub-slide-item" href="{{ route('Mark.Users.Leave') }}">Mark Users
                                        Leave</a>
                                </li>
                        </li>
                        <li><a class="sub-slide-item" href="{{ route('Mark.Holiday') }}">Manage Holiday</a></li>
                        <li><a class="sub-slide-item" href="{{ route('User.Leave.Quota') }}">User Leave Quota</a>
                        </li>
                    </ul>
                </li>
                <!-- Attendance Management -->
                <li class="sub-slide">
                    <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0);">
                        <span class="sub-side-menu__label">Attendance</span>
                        <i class="sub-angle fa fa-angle-right"></i>
                    </a>
                    <ul class="sub-slide-menu">
                        <li><a class="sub-slide-item" href="{{ route('Mark.Users.Attendance') }}">Manage
                                Attendance</a></li>
                    </ul>
                </li>
                <!-- Other HR Management Options -->
                <li><a href="{{ route('Get.Notices', ['interval' => 'false']) }}" class="slide-item">Notice
                        Board</a></li>
                @if ((int) $other_permission->department_view === 1)
                    <li><a href="{{ route('All.Departments') }}" class="slide-item">Departments</a></li>
                @endif
                @if ((int) $other_permission->designation_view === 1)
                    <li><a href="{{ route('All.Designations') }}" class="slide-item">Designations</a></li>
                @endif
                <li><a href="{{ route('Assigned.Targets') }}" class="slide-item">Assigned Targets</a></li>
                <li><a href="{{ route('company.policy') }}" class="slide-item">Company Policy</a></li>
        </ul>
        </li>

        @endif
        @if (
            (int) $other_permission->role_id !== 1 &&
                (int) $other_permission->role_id !== 2 &&
                (int) $other_permission->role_id !== 15)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide"
                    href="{{ route('User.Performance', ['EMP_ID' => Auth::guard('Authorized')->user()->EMP_ID, 'Role_ID' => Auth::guard('Authorized')->user()->Role_ID]) }}">
                    <i class="feather feather-book sidemenu_icon"></i>
                    <span class="side-menu__label">My Performance </span>
                </a>

            </li>
        @endif
        @if ($currentUser->Role_ID == 1 || $currentUser->Role_ID == 9)
            <li class="slide"><a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"> <i
                        class="feather feather-settings sidemenu_icon"></i>
                    <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li class="side-menu-label1"><a href="javascript:void(0);">Pre-Villages</a></li>

                    <li class="sub-slide">
                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span
                                class="sub-side-menu__label">Order Fields</span><i
                                class="sub-angle fa fa-angle-right"></i></a>
                        <ul class="sub-slide-menu">
                            @if ((int) $other_permission->Services_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Services') }}">Order
                                        Services</a>
                                </li>
                            @endif
                            @if ((int) $other_permission->Website_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Websites') }}">Order
                                        Websites</a>
                                </li>
                            @endif
                            @if ((int) $other_permission->Services_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Styles') }}">Writing Styles</a>
                                </li>
                            @endif
                            @if ((int) $other_permission->Services_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Voices') }}">Preferred
                                        Voices</a>
                                </li>
                            @endif
                            @if ((int) $other_permission->Services_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Industries') }}">Order
                                        Industries</a>
                                </li>
                            @endif
                            @if ((int) $other_permission->Services_view === 1)
                                <li><a class="sub-slide-item" href="{{ route('All.Generics') }}">Order
                                        Generics</a>
                                </li>
                            @endif
                            <li>
                                <a class="sub-slide-item" href="{{ route('preferred.language') }}">Preferred
                                    Language</a>
                            </li>


                        </ul>
                    </li>

                </ul>
            </li>
        @endif

        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('generate.payslip') }}">
                <i class="feather feather-credit-card sidemenu_icon"></i>
                <span class="side-menu__label">My Payslip</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide"
                href="{{ route('My.Attendance', ['User_ID' => $currentUser->id]) }}">
                <i class="feather feather-clock sidemenu_icon"></i>
                <span class="side-menu__label">My Attendance</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('Login.History') }}">
                <i class="feather feather-log-in sidemenu_icon"></i>
                <span class="side-menu__label">Login History</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('Clear.Cache') }}">
                <i class="feather feather-log-in sidemenu_icon"></i>
                <span class="side-menu__label">Clear Cache</span>
            </a>
        </li>
        @php
            $company_policy = App\Models\CompanyPolicy::first();
        @endphp
        @if ($company_policy)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" target="_blank"
                    href="{{ asset($company_policy->policy_path) }}">
                    <i class="feather feather-book sidemenu_icon"></i>
                    <span class="side-menu__label">Company Policy</span>
                </a>
            </li>
        @endif
        @if (
            (int) $other_permission->Search_order_view === 1 ||
                (int) $currentUser->Role_ID === 9 ||
                (int) $currentUser->Role_ID === 10 ||
                (int) $currentUser->Role_ID === 11)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('Searching.Queries') }}">
                    <i class="feather feather-search sidemenu_icon"></i>
                    <span class="side-menu__label">Search Order</span>
                </a>
            </li>
        @endif

        @if ((int) $currentUser->Role_ID === 1 || (int) $currentUser->Role_ID === 9)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                    <i class="feather feather-trash sidemenu_icon"></i>
                    <span class="side-menu__label">Trashed</span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                <ul class="slide-menu">
                    <li class="side-menu-label1"><a href="javascript:void(0);">Trashed</a></li>
                    <li><a href="{{ route('Trash.Research.Orders') }}" class="slide-item">Research Orders</a></li>
                    <li><a href="{{ route('Trash.Content.Orders') }}" class="slide-item">Content Orders</a></li>
                </ul>
            </li>
        @endif

        @if ((int) $currentUser->Role_ID === 1)
            <li class="slide ">
                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                    <i class="feather feather-code sidemenu_icon"></i>
                    <span class="side-menu__label">Developer</span>
                    <i class="angle fa fa-angle-right"></i>
                </a>
                <ul class="slide-menu">
                    <li class="side-menu-label1"><a href="javascript:void(0);">Developer</a></li>
                    <li><a href="{{ route('Portal.Errors') }}" class="slide-item">Error List</a></li>
                    <li><a href="{{ route('Clear.Cache') }}" class="slide-item">Clear Cache</a></li>
                    <li><a href="{{ route('Clear.Error.Logs') }}" class="slide-item mb-5">Clear Error Logs</a></li>
                </ul>
            </li>
        @endif

        </ul>
    </div>
</aside>
