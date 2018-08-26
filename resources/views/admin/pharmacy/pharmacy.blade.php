@extends('admin')

@section('title')
    Аптека
@endsection

@section('js')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Список всех аптек</a>
                    </h3>
                    <a href="/admin/pharmacy/create" style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить аптеку</button>
                    </a>
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('pharmacy')">Удалить отмеченные</a>
                        </h4>
                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >

                    </div>
                </div>
                <div class="box-body">
                    <table id="pharmacy_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th style="width: 300px">Название</th>
                            <th>Адрес</th>
                            <th>Владелец</th>
                            <th>Email</th>
                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                            <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                            </th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td></td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="text" class="form-control" name="name" placeholder="Поиск">
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->address}}" type="text" class="form-control" name="address" placeholder="Поиск">
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    <strong>{{ $val['pharmacy_name']}}</strong>
                                </td>
                                <td>
                                   {{ $val['address']}}
                                </td>
                                <td>
                                    {{ $val['sname']}} {{ $val['fname']}} {{ $val['pname']}}
                                </td>
                                <td>
                                    {{ $val['email']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->pharmacy_id }}','pharmacy')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/pharmacy/{{ $val->pharmacy_id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->pharmacy_id}}"/>
                                </td>
                            </tr>


                        @endforeach


                        </tbody>

                    </table>

                    <div style="text-align: center">
                        {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection