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

                        <form action="/admin/users/limit" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{ $row->id }}">

                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Дата окончания подписки</label>
                                        <input value="{{ $row->limit_date }}" type="text" class="form-control datetimepicker-input" name="limit_date" placeholder="Введите">
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

