<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
@php
    $currentUser = \Illuminate\Support\Facades\Auth::guard('Authorized')->user();
@endphp

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta
        content="1Click - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
        name="description">
    <meta content="Muhammad Yasir Amin" name="author">
    <meta name="keywords"
        content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard, bootstrap 5 dashboard, bootstrap5 dashboard" />
    <!-- Title -->
    <title>1Click - Portal System</title>

    @include('partials.stylesheets')
    <style>
        .phpdebugbar.phpdebugbar-minimized {
            display: none !important;
        }

        .modal-open .ui-datepicker {
            z-index: 9999999 !important;
        }
    </style>


</head>

<body class="app sidebar-mini ltr light-mode main-navbar-show default-sidemenu">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('assets/images/svgs/loader.svg') }}" alt="loader">
    </div>

    <div class="page">
        <div class="page-main">
            @include('partials.layouts.side-bar', ['currentUser' => $currentUser])
            <div class="app-content main-content">
                <div class="side-app"  style="background:url({{asset('assets/images/images/photos/login1.jpg')}})">
                    @include('partials.layouts.app-header', ['currentUser' => $currentUser])
                    {{ $slot }}
                </div>
            </div><!-- end app-content-->
        </div>
        @php
            $currentYear = date('Y');
        @endphp
        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2023 @if ($currentYear > 2023)
                            - {{ $currentYear }}
                        @endif
                        <a href="{{ route('Main.Dashboard') }}">1Click</a>. Designed
                        {{-- with <span class="fa fa-heart text-danger"></span> --}}
                        by <a href="{{ route('Main.Dashboard') }}">1Click Developer Team</a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->

        <!--sidebar-right-->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="card-header border-bottom pb-5">


                <h4 class="card-title">
                    Notifications
                    <span class="badge badge-primary NotificationCount">0</span>
                </h4>
                <button
                    class="btn btn-primary text-black px-2 mx-2 btn-loading btn-icon notification-side-bar-header d-none"><i
                        class="fe fe-check"></i></button>
                <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="feather feather-more-vertical"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" role="menu">
                    <li>
                        <a href="JavaScript:void(0);" class="MarkReadAll">
                            <i class="feather feather-eye me-2"></i>
                            Read All
                            <input type="hidden" value="{{ $currentUser->id }}">
                        </a>
                        <a href="{{ route('View.All.Notification') }}" target="_blank">
                            <i class="feather feather-eye me-2"></i>
                            View All
                        </a>
                    </li>
                </ul>
                <div class="card-options">
                    <a href="#" class="btn btn-sm btn-icon btn-light text-primary" data-bs-toggle="sidebar-right"
                        data-bs-target=".sidebar-right"><i class="feather feather-x"></i>
                    </a>
                </div>
            </div>
            <div class="Portal-Notification">

            </div>
        </div>
        <!--/sidebar-right-->

    </div>

    <!-- Back to the top -->
    <a href="#top" id="back-to-top" style="font-size: 21px !important; line-height: 51px !important;">
        <span class="feather feather-home"></span>
    </a>

    @include('partials.scripts')
    @include('partials.custom-scripts')

    @if (session('interval') === 'true')
        <script>
            function checkForActiveNotices() {
                const current = new Date();
                console.log("if part is running : chek for notice: " + current.toLocaleTimeString());

                $.ajax({
                    url: '{{ route('check.active.notices') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        submitbtn: 'show',
                    },
                    success: function(response) {

                        if (response.success && response.noticeDetail) {

                            const current1 = new Date();
                            console.log("notice available: " + current1.toLocaleTimeString());
                            renderNoticeDetail(response.noticeDetail);
                            timeLimit = parseInt(response.time_limit);
                            hideClose(timeLimit);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                function renderNoticeDetail(noticeDetail) {
                    $('.noticeDetailContent').html(noticeDetail);
                    $('.noticeDetailModal').modal('show');
                }

                function hideClose(timeLimit) {
                    if (timeLimit > 0) {
                        var $closeButton = $('.btn-close');
                        $closeButton.hide();
                        startTimer(timeLimit * 60);
                    } else {
                        $closeButton.fadeIn();
                    }
                }

                function startTimer(totalSeconds) {
                    var interval = setInterval(function() {
                        if (totalSeconds <= 0) {
                            var $closeButton = $('.btn-close');
                            $closeButton.fadeIn();
                            $('.timmerdisplay').text("");
                        } else {
                            var minutes = Math.floor(totalSeconds / 60);
                            var seconds = totalSeconds % 60;
                            var formattedTime = pad(minutes) + ":" + pad(seconds);
                            $('#timerDisplay').text(formattedTime);
                            totalSeconds--;
                        }
                    }, 1000);
                }

                function pad(val) {
                    return val < 10 ? "0" + val : val;
                }
            }

            setInterval(checkForActiveNotices, 30 * 1000);
        </script>
    @else
        <script>
            function check() {
                const currentTime = new Date();
                console.log("else part is running: " + currentTime.toLocaleTimeString());
            }
            setInterval(check, 30 * 1000);
        </script>
    @endif
    <div class="modal fade noticeDetailModal" id="noticeDetailModal" tabindex="-1"
        aria-labelledby="noticeDetailModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg noticeDetailContent" id="noticeDetailContent">
            @include('livewire.notice.notice-detail')

        </div>
    </div>
</body>

</html>
