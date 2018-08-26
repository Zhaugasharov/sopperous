@extends('admin')
@section('title')
    Аптека
@endsection
@section('content')
    <div class="card glass">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-12 mb-xl-2">
                    <h4>Аптека</h4>
                </div>
            </div>
            <div class="row">
                <div class="1col-md-6" style="margin: auto; width: 50%">
                     <p style="color: red">@if (isset($error)){{ $error }}@endif</p>
                    <form action="/cabinet/pharmacy" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input id="pharmacy_id" type="hidden" name="pharmacy_id" value="{{ $row->pharmacy_id }}">

                        <div class="box-body">
                            <div class="form-group">
                                <label>Название</label>
                                <input value="{{ $row->pharmacy_name }}" type="text" class="form-control" name="pharmacy_name" placeholder="Введите">
                            </div>
                            <div class="form-group">
                                <label>Город</label>
                                <select class="form-control" name="city_id">

                                    @foreach($city as $item)

                                        <option value="{{$item->id}}" @if($item->id == $row->city_id) selected="selected" @endif >{{$item->city}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Адрес</label>
                                <textarea name="address" class="form-control"><?=$row->address?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection