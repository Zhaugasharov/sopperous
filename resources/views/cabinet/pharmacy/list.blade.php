@extends('admin')
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
                @if(count($pharmacy_list)>0)
                    @foreach($pharmacy_list as $item)

                            <div class="col-md-5 col-lg-4 mb-xl-2 mb-sm-2 offset-lg-1 pharmacy-item">
                                <i class="fa fa-5x fa-times fa-delete" onclick="delItem2(this,'{{ $item->pharmacy_id }}','pharmacy')"></i>
                                <a class="row" href="/cabinet/pharmacy/{{$item->pharmacy_id}}" >
                                    <div class="col-md-12 pb-8 p-5 text-center btn btn-primary" style="width: 100%">
                                        <h3>{{$item->pharmacy_name}}</h3>
                                    </div>
                                </a>
                            </div>

                    @endforeach
                @endif
                <div class="col-md-5 col-lg-4 mb-xl-2 mb-sm-2 offset-lg-1">
                    <a class="row" href="/cabinet/pharmacy/add">
                        <div class="col-md-12 pb-8 p-5 text-center btn btn-success" style="width: 100%">
                            <i class="fa fa-5x fa-plus"></i><br/><br/>
                            <h3>Добавить</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
