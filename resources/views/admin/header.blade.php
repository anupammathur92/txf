<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('public/images/favicon-32x32.png') }}" sizes="32x32" />
    <link href="{{ asset('public/css/admin/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/datatables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/tempusdominus-bootstrap-4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/admin/select2.min.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('public/js/admin/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/bootstrap.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/daterangepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/jquery.nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/tempusdominus-bootstrap-4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/admin/select2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin/lobibox-font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/admin/lobibox.min.css')}}">
    <script type="text/javascript" src="{{asset('public/js/admin/lobibox.js')}}"></script>
</head>