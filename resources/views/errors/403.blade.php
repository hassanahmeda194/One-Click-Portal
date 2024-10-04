<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
    <meta content="Spruce Technologies Private Limited" name="author">
    <meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard, bootstrap 5 dashboard, bootstrap5 dashboard"/>

    <!-- Title -->
    <title>1Click Portal | 403 Error!</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand/favicon.ico') }}" type="image/x-icon"/>

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/boxed.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('assets/css/animated.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

    <!-- Select2 css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

</head>

<body class="">

<div class="page error-bg">
    <div class="page-content m-0">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('assets/images/png/error.png') }}" alt="img" class="mt-7">
                </div>
                <div class="col-md-7 mt-6">
                    <div class="display-1 text-primary  mb-2 font-weight-semibold"> 403</div>
                    <h1 class="h3  mb-3 font-weight-semibold">Sorry, Forbidden Error, Requested Page not found!</h1>
                    <p class="h5 font-weight-normal mb-7 leading-normal">You may have mistyped the address or the page may have moved.</p>
                    <a class="btn btn-primary" href="{{ route('Main.Dashboard') }}"><i class="fe fe-arrow-left-circle me-1"></i>Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<!-- P-scroll js-->
<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>

<!-- Custom js-->
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
