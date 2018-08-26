@extends('admin')

@section('title')
    Требования
@endsection

@section('js')
    <link href="/css/jquery.orderable.css" rel="stylesheet" type="text/css">
    <script src="/js/jquery.orderable.js"></script>

    <script>
        $("#myOrderableTable").orderable({
            onOrderReorder: function (element) {
                setOrderTable('requirement');
            },
        });
    </script>

@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/requirement<? if(isset($_GET['parent_id']))echo '?parent_id='.$_GET['parent_id'];?>" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные требования</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/requirement?active=0<? if(isset($_GET['parent_id']))echo '&parent_id='.$_GET['parent_id'];?>" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные требования</a>
                    </h3>
                    <a href="/admin/requirement/create<? if(isset($_GET['parent_id']))echo '?parent_id='.$_GET['parent_id'];?>" style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить требование</button>
                    </a>
                    @if(isset($_GET['parent_id']))
                        <? $parent = \App\Models\Requirement::where('requirement_id',$_GET['parent_id'])->first();?>

                        @if($parent->parent_id != null)

                            <a href="/admin/requirement?parent_id=<?=$parent->parent_id;?>" style="float: right;  margin-right: 10px">
                                <button class="btn btn-block btn-success" style="margin-bottom: 10px;">Назад</button>
                            </a>

                        @else

                            <a href="/admin/requirement" style="float: right;  margin-right: 10px">
                                <button class="btn btn-block btn-success" style="margin-bottom: 10px;">Назад</button>
                            </a>

                        @endif

                    @endif
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('requirement')">Сделать активным отмеченные</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('requirement')">Сделать неактивным отмеченные</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('requirement')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="myOrderableTable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th style="width: 300px">Название</th>
                            <th style="width: 30px"></th>
                            <th style="width: 15px"></th>
                            <th style="width: 15px"></th>
                            <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                            </th>
                        </tr>
                        </thead>



                        <tr>
                            <td></td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="text" class="form-control" name="name" placeholder="Поиск">
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @include('admin.requirement.requirement-list-loop',['row' => $row, 'level' => '1'])


                    </table>

                    <div style="text-align: center">
                        {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection