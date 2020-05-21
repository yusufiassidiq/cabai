<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Monitoring Produksi dan Distribusi Cabai Jawa Barat</title>
    <!-- Load css -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ secure_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ secure_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Muli Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ secure_asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="{{ secure_asset('plugins/daterangepicker/daterangepicker.css')}}"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="{{ secure_asset('plugins/summernote/summernote-bs4.css')}}"> -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127341144-1"></script> -->
    <!-- <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-127341144-1');
    </script> -->
    <!-- external javascripts -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @yield('content')

    <!-- jQuery -->
    <script src="{{ secure_asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ secure_asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- overlayScrollbars -->
    <script src="{{ secure_asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ secure_asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Form Select2 -->
    <script src="{{ secure_asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ secure_asset('plugins/moment/moment.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ secure_asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ secure_asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Chart -->
    <!-- <script src="{{ secure_asset('dist/js/pages/dashboard2.js') }}"></script> -->
    <!-- Sparkline -->
    <!-- <script src="{{ secure_asset('plugins/sparklines/sparkline.js')}}"></script> -->
    <!-- JQVMap -->
    <!-- <script src="{{ secure_asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
    <!-- <script src="{{ secure_asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="{{ secure_asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script> -->
    <!-- <script src="{{ secure_asset('plugins/daterangepicker/daterangepicker.js') }}"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <script src="{{ secure_asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> -->
    <!-- Summernote -->
    <!-- <script src="{{ secure_asset('plugins/summernote/summernote-bs4.min.js') }}"></script> -->
    <!-- AdminLTE App -->
    <script src="{{ secure_asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{ secure_asset('dist/js/pages/dashboard.js') }}"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ secure_asset('dist/js/demo.js') }}"></script> -->
    
</body>
</html>
