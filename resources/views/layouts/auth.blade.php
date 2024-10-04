<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta
        content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
        name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords"
          content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard, bootstrap 5 dashboard, bootstrap5 dashboard"/>

    <!-- Title -->
    <title>1Click - Portal System</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand/favicon.png') }}" type="image/x-icon"/>

    <!-- Bootstrap css -->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"/>

    <!-- Style css -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/boxed.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/dark.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet"/>

    <!-- Animate css -->
    <link href="{{asset('assets/css/animated.css')}}" rel="stylesheet"/>

    <!---Icons css-->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet"/>

    <!-- Select2 css -->
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>

    <!-- P-scroll bar css-->
    <link href="{{asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet"/>
    <!-- INTERNAL Notifications  Css -->
    <link href="{{ asset('assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <style>
        @media screen and (min-width: 768px) {
            body {
                zoom: 95% !important; 
            }
        }

        @media screen and (max-width: 1200px) {
            body {
                zoom: 100% !important; 
            }
        }
        .phpdebugbar.phpdebugbar-minimized{
            display: none !important;
        }
    </style>
</head>

<body class="" >


{{ $slot }}

<!-- Jquery js-->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Select2 js -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

<!-- P-scroll js-->
<script src="{{asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
<!-- INTERNAL Notifications js -->
<script src="{{ asset('assets/plugins/notify/js/rainbow.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/sample.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/jquery.growl.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<!-- Custom js-->
<script src="{{asset('assets/js/custom.js')}}"></script>

@if (Session::has('Success!'))
    <script>
        not1('{!! Session::get('Success!') !!}');
    </script>
@endif
@if (Session::has('Error!'))
    <script>
        not2('{!! Session::get('Error!') !!}');
    </script>
@endif

</body>

</html>
