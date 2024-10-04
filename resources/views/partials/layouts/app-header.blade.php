<!--app header-->
<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('Main.Dashboard') }}">
                <img src="{{ asset('assets/images/brand/logo.png') }}"
                     class="header-brand-img desktop-lgo"
                     alt="One Click Logo">
                <img src="{{ asset('assets/images/brand/logo-white.png') }}"
                     class="header-brand-img dark-logo" alt="One Click Logo">
                <img src="{{ asset('assets/images/brand/favicon.png') }}"
                     class="header-brand-img mobile-logo" alt="One Click Logo">
                <img src="{{ asset('assets/images/brand/favicon1.png') }}"
                     class="header-brand-img darkmobile-logo" alt="One Click Logo">
            </a>
            <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                <a class="open-toggle" href="#">
                    <i class="feather feather-menu"></i>
                </a>
                <a class="close-toggle" href="#">
                    <i class="feather feather-x"></i>
                </a>
            </div>
            <div class="d-flex order-lg-2 my-auto ms-auto">
                <button
                    class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                </button>
                <div
                    class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex ms-auto">
                            <a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch"
                               href="#" data-bs-toggle="search">
                                <i class="feather feather-search search-icon header-icon"></i>
                            </a>
                            <div class="dropdown header-fullscreen">
                                <a class="nav-link icon full-screen-link">
                                    <i
                                        class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
                                    <i
                                        class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                </a>
                            </div>
                           <div class="dropdown header-notify">
                                <a class="nav-link icon" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right">
                                    <i class="feather feather-bell header-icon"></i>
                                    <span class="badge side-badge NotificationCount"
                                        style="background-color: #1f3577 !important; height: 1.5rem !important; width: 2rem !important; padding: 5px 0 !important; top: -10px !important;"></span>
                                </a>
                            </div>
                            <div class="dropdown profile-dropdown">
                                <a href="#" class="nav-link pe-1 ps-0 leading-none"
                                   data-bs-toggle="dropdown">
                                                        <span>
                                                            <img
                                                                src="{{ !empty($currentUser->basic_info->profile_photo_path) ? asset($currentUser->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}"
                                                                alt="img" class="avatar avatar-md bradius">
                                                        </span>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-end dropdown-menu-arrow animated">
                                    <div class="p-3 text-center border-bottom">
                                        <a href="JavaScript:void(0);"
                                           class="text-center user pb-0 font-weight-bold">{{ $currentUser->basic_info->full_name }}</a>
                                        <p class="text-center user-semi-title">
                                            {{ $currentUser->email }}
                                            <br>
                                            {{ $currentUser->EMP_ID }}</p>
                                    </div>
                                    <a class="dropdown-item d-flex"
                                       href="{{ route('View.Employee', ['EMP_ID' => $currentUser->EMP_ID]) }}">
                                        <i class="feather feather-user me-3 fs-16 my-auto"></i>
                                        <div class="mt-1">View Profile</div>
                                    </a>
                                    <a class="dropdown-item d-flex"
                                       href="{{ route('User.LogOut') }}">
                                        <i class="feather feather-power me-3 fs-16 my-auto"></i>
                                        <div class="mt-1">Sign Out</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/app header-->
