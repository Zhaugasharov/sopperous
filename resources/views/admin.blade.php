<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/admin/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/font-awesome.min.css')}}">
	  
    <link rel="stylesheet" href="{{asset('css/admin/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}?v=1">
    <link href="/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
    <link href="/wysiwyg/default.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/admin-custom.css')}}">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker-standalone.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>GxP</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">GxP Company</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-power-off"></i> Выход
                        </a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('img/user.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{\Illuminate\Support\Facades\Auth::user()->getFullName()}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- МЕНЮ -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Меню</li>
				@if(Auth::user()->role_id < 3)
                   <li><a href="/admin"><i class="fa fa-home"></i> <span>Главная</span></a></li>
                   <li>
                       <a href="/admin/users">
                           <i class="fa fa-user"></i> <span>Пользователи</span>
                           <?php $users_count = \App\User::where('confirm',0)->count();?>
                           <span class="label label-primary pull-right notice-icon" style="background-color: #fd3a3a !important; position: absolute; top: 50%; right: 10px;margin-top: -7px; @if($users_count > 0) display: block; @endif">{{$users_count}}</span>
                       </a>
                   </li>
                   <li><a href="/admin/requirement"><i class="fa fa-list"></i> <span>Требование</span></a></li>
                   <li><a href="/admin/document"><i class="fa fa-book"></i> <span>Документ</span></a></li>
                   <li><a href="/admin/pharmacy"><i class="fa fa-heartbeat"></i> <span>Аптека</span></a></li>
                   <li><a href="/admin/sop"><i class="fa fa-clone"></i> <span>СОП</span></a></li>
			    @else
				   <li><a href="/cabinet"><i class="fa fa-home"></i> <span>Главная</span></a></li>
                   <li><a href="/cabinet/pharmacy"><i class="fa fa-heartbeat"></i> <span>Мои аптеки</span></a></li>
                   <li><a href="/cabinet/requirement"><i class="fa fa-list"></i> <span>Требования к аптеке</span></a></li>
                   <li><a href="/sop/template"><i class="fa fa-clone"></i> <span>СОП и формы</span></a></li>
			    @endif
                <li><a href="{{ route('logout') }}"><i class="fa text-danger fa-power-off"></i> <span>Выход</span></a></li>
            </ul>
            <!--МЕНЮ-->
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>GPP Version</b> 3.1.0
        </div>
        <strong>Copyright &copy; 2018</strong>
    </footer>

</div>
    <!-- ./wrapper -->
    <script src="{{asset('js/admin/jquery.min.js')}}"></script>
    <script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin/fastclick.js')}}"></script>
    <script src="{{asset('js/admin/adminlte.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.slimscroll.min.js')}}"></script>
    <script src="/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script type="text/javascript" src="/wysiwyg/kindeditor.js"></script>
    <script type="text/javascript" src="/wysiwyg/ru_Ru.js"></script>

   {{-- <script src="{{asset('js/admin/dashboard2.js')}}"></script>--}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script >
        var CSRF_TOKEN = document.getElementById('csrf-token').getAttribute('content');
    </script>
        @yield('js')

    <script src="/js/moment.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{asset('js/admin/admin-custom.js')}}?v=4"></script>
	<script src="{{asset('js/admin/custom.js')}}?v=4"></script>
    </body>
</html>