@extends('admin')

@section('title')
    Пользователи
@endsection

@section('js')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/users" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные пользователи</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/users?active=0" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные пользователи</a>
                    </h3>
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('users')">Сделать активным отмеченные</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('users')">Сделать неактивным отмеченные</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('users')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="user_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th style="width: 300px">Имя</th>
                            <th>Email</th>
                            <th>Аптека</th>
                            <th>Дата окон. подписки</th>
                            <th>Дата регистр.</th>
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
                                    <input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="Поиск">
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->company}}" type="text" class="form-control" name="company" placeholder="Поиск">
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    <strong>  {{ $val['sname']}} {{ $val['fname']}} {{ $val['pname']}}</strong>
                                    <p style="margin-bottom: 0px">{{ $val['email']}}</p>
                                    <p style="font-weight: 800; color: red; margin-top: 3px">{{ $val['phone']}}</p>
                                </td>
                                <td>
                                    <p>{{ $val['name']}}</p>
                                    <p style="font-weight: 800">{{ $val['city']}}</p>
                                    <p>{{ $val['address']}}</p>
                                </td>
                                <td>
                                    <?php $pharmacy = \App\Models\Pharmacy::where('user_id',$val->id)->orderBy('pharmacy.created_at','desc')->get();?>

                                    @foreach($pharmacy as $key2 => $item)
                                           {{$key2 + 1}}. <a href=""> {{ $item['pharmacy_name']}} </a></br>
                                    @endforeach

                                </td>
                                <td>
                                    <b>{{ $val['limit_date']}}</b></br>
                                    <a href="/admin/users/limit/{{$val->user_id}}" style="text-decoration: underline; font-weight: 800; color: red;">Редактировать дату</a>
                                </td>
                                <td>
                                    {{ $val['date']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->user_id }}','users')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->user_id}}"/>
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