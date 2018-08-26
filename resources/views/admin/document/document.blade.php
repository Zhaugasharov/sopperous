@extends('admin')

@section('title')
    Документы
@endsection

@section('js')
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title box-title-first">
                        <a href="/admin/document" class="menu-tab @if(!isset($request->active) || $request->active == '1') active-page @endif">Активные документы</a>
                    </h3>
                    <h3 class="box-title box-title-second" >
                        <a href="/admin/document?active=0" class="menu-tab @if($request->active == '0') active-page @endif">Неактивные документы</a>
                    </h3>
                    <a href="/admin/document/create" style="float: right">
                        <button class="btn btn-primary box-add-btn">Добавить документ</button>
                    </a>
                    <div class="clear-float"></div>
                </div>
                <div>
                    <div style="text-align: left" class="form-group col-md-6" >

                        @if($request->active == '0')

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowEnabledAll('document')">Сделать активным отмеченные</a>
                            </h4>

                        @else

                            <h4 class="box-title box-edit-click">
                                <a href="javascript:void(0)" onclick="isShowDisabledAll('document')">Сделать неактивным отмеченные</a>
                            </h4>

                        @endif


                    </div>
                    <div style="text-align: right" class="form-group col-md-6" >
                        <h4 class="box-title box-delete-click">
                            <a href="javascript:void(0)" onclick="deleteAll('document')">Удалить отмеченные</a>
                        </h4>
                    </div>
                </div>
                <div class="box-body">
                    <table id="document_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th style="width: 100px"></th>
                            <th style="width: 300px">Название</th>
                            <th>Категория</th>
                            <th>Файлы</th>
                            <th>Ссылки</th>
                            <th>Сортировка</th>
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
                            <td></td>
                            <td>
                                <form>
                                    <input value="{{$request->name}}" type="text" class="form-control" name="name" placeholder="Поиск">
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->requirement_name}}" type="text" class="form-control" name="requirement_name" placeholder="Поиск">
                                </form>
                            </td>
                            <td></td>
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
                                    <?php $images = \App\Models\Image::where('document_id',$val->document_id)->orderBy('image_id','asc')->get(); ?>
                                    @if(count($images) > 0)
                                        <div class="object-image" style="margin: 0px">
                                            <div style="color: red; position: absolute; font-weight: bold; font-size: 17px; margin-left: 45px;">{{$images->count()}}</div>
                                            @foreach($images as $key_image => $im)
                                                <a @if($key_image > 0) style="display: none" @endif class="fancybox" href="{{$im->image_url}}" rel="image_{{$val->document_id}}">
                                                    <img src="{{$im->image_url}}">
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="clear-float"></div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $val['document_name_ru']}}</strong>
                                </td>
                                <td>
                                   {{ $val['requirement_name_ru']}}
                                </td>
                                <td>


                                    <?php $images = \App\Models\File::where('document_id',$val->document_id)->orderBy('file_id','asc')->get(); ?>
                                    @if(count($images) > 0)
                                        @foreach($images as $key_image => $im)
                                            <a style="text-decoration: underline"  href="{{$im['file_url']}}" target="_blank">@if($im['file_name'] != '') {{$im['file_name']}} @else Файл @endif</a></br>
                                        @endforeach
                                    @endif

                                </td>
                                <td>


                                    <?php $images = \App\Models\DocumentWebsite::where('document_id',$val->document_id)->orderBy('document_website_id','asc')->get(); ?>
                                    @if(count($images) > 0)
                                        @foreach($images as $key_image => $im)
                                            <a style="text-decoration: underline"  href="{{$im['website']}}" target="_blank">@if($im['website_name'] != '') {{$im['website_name']}} @else Ссылка @endif</a></br>
                                        @endforeach
                                    @endif

                                </td>
                                <td>
                                    {{ $val['sort_num']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->document_id }}','document')">
                                        <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center">
                                    <a href="/admin/document/{{ $val->document_id }}/edit">
                                        <li class="fa fa-pencil" style="font-size: 20px;"></li>
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->document_id}}"/>
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