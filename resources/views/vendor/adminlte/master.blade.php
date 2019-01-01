<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" type="text/css" href="//az700140.vo.msecnd.net/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Bootstrap Switch -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap-switch/css/bootstrap-switch.min.css') }}">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css">
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.print.css"> -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/fullcalendar-scheduler-1.9.1/scheduler.min.css') }}">

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
@endif

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/style.css') }}">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')


<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('vendor/adminlte/js/currentcy.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/jquery.numeric.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/jQuery.tmpl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/adminlte/js/bootstrap-datetimepicker-v2.min.js') }}"></script>

@if(config('adminlte.plugins.bootstrap-datepicker'))
    <!-- bootstrap datepicker -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
@endif

@if(config('adminlte.plugins.bootstrap-switch'))
    <!-- Bootstrap Switch -->
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
@endif

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="{{ asset('vendor/adminlte/js/select2.full.min.js') }}"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
@endif

@if(config('adminlte.plugins.tinymce'))
    <!-- tinymce -->
    <script src="{{ asset('vendor/adminlte/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
@endif

@yield('adminlte_js')

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<script src="{{ asset('vendor/adminlte/vendor/fullcalendar-scheduler-1.9.1/scheduler.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/js/script.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
