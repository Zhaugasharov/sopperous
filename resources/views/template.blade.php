<!DOCTYPE>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="card  header">
            <div class="header-body">
                <div class="container">
                    <h4 class="float-left">Внедри GPP в свою аптеку <u>своими силами</u></h4>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <a class="min-w-100 float-right mb-sm-1 ml-2 btn btn-sm btn-primary" href="/register">{{trans('main.sign_up')}}</a>
                        <a class="min-w-100 float-right btn btn-sm btn-success" href="/login">{{trans('main.sign_in')}}</a>
                    @else
                        <a class="min-w-100 float-right mb-sm-1 ml-2 btn btn-sm btn-primary" href="/login">Войти</a>
                    @endif
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
    </body>
</html>