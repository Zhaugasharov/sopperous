@extends('company')
@section('title')
    Мои аптеки
@endsection
@section('content')
    <div class="card glass">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-12 mb-xl-2">
                    <h4>Мои аптеки</h4>
                </div>
            </div>
            <div class="row">
                @if(count($enterprises)>0)
                    @foreach($enterprises as $enterpris)
                        <div class="col-md-5 col-lg-4 mb-xl-2 mb-sm-2 offset-lg-1">
                            <a class="row" href="">
                                <div class="col-md-12 pb-8 p-5 text-center btn btn-primary">
                                    <h3>{{$enterpris->name}}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-5 col-lg-4 mb-xl-2 mb-sm-2 offset-lg-1">
                        <a class="row" href="/enterprise/add">
                            <div class="col-md-12 pb-8 p-5 text-center btn btn-success">
                                <i class="fa fa-5x fa-plus"></i><br/><br/>
                                <h3>Добавить</h3>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
