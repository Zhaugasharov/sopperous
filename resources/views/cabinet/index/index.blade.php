@extends('admin')
@section('title')
    Кабинет
@endsection
@section('content')
    <div class="card glass">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-12 mb-xl-2">
                    <h4>Выберите раздел:</h4>
                </div>
            </div>
            <div class="row" style="width:60%; margin:auto">
                <div class="col-md-6">
                    <a class="row" href="/sop/template">
                        <div class="col-md-12 pb-8 p-5 text-center btn btn-primary" style="padding-top: 30px; min-height: 230px">
                            <i class="fa fa-5x fa-file"></i><br/><br/>
                            <h3>Шаблоны СОП</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="row" href="/cabinet/pharmacy">
                        <div class="col-md-12  p-5 text-center btn btn-primary" style="padding-top: 30px; min-height: 230px">
                            <i class="fa fa-5x fa-university  "></i><br/><br/>
                            <h2>Мои аптеки<br><small>у вас {{$pharmacy_count}} аптек(и)</small></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
