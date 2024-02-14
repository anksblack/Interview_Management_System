<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" content="{{ csrf_token() }}">
    @stack('title')
    <link rel="stylesheet" href="{{ url('style.css') }}">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <!-- Tostr style -->
    <link rel="stylesheet" href="{{ url('plugins/toastr/toastr.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ url('js/jsgrid/jsgrid.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ url('js/jsgrid/jsgrid-theme.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    @stack('css')
    <style>
        .select2-container .select2-selection--single {
            height: 36px !important;
        }
    </style>

    <style>
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        td:nth-child(2) {
            width: 40%;
            /* Extend the cell as much as possible */
            max-width: 0;
            /* Avoid resizing beyond table width */
        }

        .with-fb {
            display: flex;
            white-space: nowrap;
        }

        .with-fb .text {
            overflow: hidden;
            text-overflow: ellipsis;
            flex: 1;
            /* optionally extend to make labels line up */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Dashboard</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="float-down text-muted text-sm">{{ auth()->user()->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">


            <!-- Sidebar -->
            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Admin
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}" class="nav-link">
                                            <p>Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('role.index') }}" class="nav-link">

                                            <p>Roles</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('permission.index') }}" class="nav-link">

                                            <p>Permissions</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('modules.index') }}" class="nav-link">

                                            <p>Modules</p>
                                        </a>
                                    </li>
                            </li>
                    </ul>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Interview
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('interviews.index') }}" class="nav-link">

                                    <p>Interviews</p>
                                </a>
                            </li>
                            @can('update', new App\Models\Interview())
                                <li class="nav-item">
                                    <a href="{{ route('interviews.create') }}" class="nav-link">

                                        <p>Schedule Interview</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ url('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{url('dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ url('dist/js/pages/dashboard.js') }}"></script>
    <script src="vendor/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('js/jsgrid/jsgrid.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            @if ($message = Session::get('success'))
                toastr.success('{{ $message }}');
            @endif
            @if ($message = Session::get('failure'))
                toastr.warning('{{ $message }}');
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.warning('{{ $error }}');
                @endforeach
            @endif
        });
    </script>




    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a candidate",
                allowClear: true
            });
        });
    </script>
</body>

</html>
