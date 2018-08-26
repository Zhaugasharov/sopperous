@extends('admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="box box-primary">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->pharmacy_id > 0)
                            <form action="/admin/pharmacy/{{$row->pharmacy_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/pharmacy" method="POST">
                                        @endif

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="pharmacy_id" type="hidden" name="pharmacy_id" value="{{ $row->pharmacy_id }}">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Название</label>
                                                <input value="{{ $row->pharmacy_name }}" type="text" class="form-control" name="pharmacy_name" placeholder="Введите">
                                            </div>
                                            <div class="form-group">
                                                <label>Владелец</label>
                                                <select class="form-control" name="user_id">

                                                    @foreach($users as $item)

                                                        <option value="{{$item->id}}" @if($item->id == $row->user_id) selected="selected" @endif >{{$item->sname}} {{$item->fname}} {{$item->pname}}</option>

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
    </section>


@endsection

