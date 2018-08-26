<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}?v=1"/>
    <link href="/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<div class="card  header">
    <div class="header-body">
        <div class="container">
            <div class="float-left menu-a">
                <a href="/">Главная</a>
                <a href="/cabinet/pharmacy">Мои аптеки</a>
                <a href="/cabinet/requirement">Требования к аптеке</a>
                <a href="/sop/template">СОП и формы</a>
            </div>
            <a class="min-w-100 float-right mb-sm-1 ml-3 btn btn-sm btn-primary" href="{{ route('logout') }}">Выйти</a>
            <p class="float-right">{{Auth::user()->getFullName()}}</p>
        </div>
    </div>
</div>
<div class="container mb-3">
    @if (Session::has('error'))
        <div class="alert alert-dismissible alert-danger fade show" role="alert">
            <h4 class="alert-heading">{{ trans('main.error') }}</h4>
            <p> {!! Session::get('error') !!} </p>
            <button type="button" class="close " data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-dismissible alert-success fade show" role="alert">
            <h4 class="alert-heading">{{ trans('main.success') }}</h4>
            <p> {{ Session::get('success') }} </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>

<div class="container">
    @yield('content')
</div>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="{{asset('js/admin/custom.js')}}"></script>
</body>
</html>