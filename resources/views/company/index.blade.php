@extends('company')
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
            <div class="row">
                <div class="col-md-5 col-lg-4 mb-xl-2 mb-sm-2 offset-lg-1">
                    <a class="row" href="/sop/template">
                        <div class="col-md-12 pb-8 p-5 text-center btn btn-primary">
                            <i class="fas fa-7x fa-notes-medical"></i><br/><br/>
                            <h3>Шаблоны СОП</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-5 col-lg-4  offset-md-2 offset-lg-2">
                    <a class="row" href="/enterprise">
                        <div class="col-md-12  p-5 text-center btn btn-primary">
                            <i class="fas fa-5x fa-hospital-alt"></i><br/><br/>
                            <h2>Мои аптеки<br><small>у вас {{$enterprises}} аптек(и)</small></h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
