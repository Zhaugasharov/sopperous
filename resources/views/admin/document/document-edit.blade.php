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
                        @if($row->document_id > 0)
                            <form action="/admin/document/{{$row->document_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/document" method="POST">
                                        @endif

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id="document_id" type="hidden" name="document_id" value="{{ $row->document_id }}">
                                        <input type="hidden" class="image-name" id="document_image" name="document_image" value="{{ $row->document_image }}"/>
                                        <input type="hidden" class="doc-name" name="document_doc" value="{{ $row->document_doc }}"/>

                                        <div class="box-body">
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#info" data-toggle="tab">Инфо</a>
                                                    </li>
                                                    <li>
                                                        <a href="#photo" data-toggle="tab">Фото</a>
                                                    </li>
                                                    <li>
                                                        <a href="#file" data-toggle="tab">Файлы</a>
                                                    </li>
                                                    <li>
                                                        <a href="#website" data-toggle="tab">Ссылки</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="info">
                                                        <div class="form-group">
                                                            <label>Название</label>
                                                            <input value="{{ $row->document_name_ru }}" type="text" class="form-control" name="document_name_ru" placeholder="Введите">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Категория</label>
                                                            <select class="form-control" name="requirement_id">

                                                                @foreach($requirement as $item)

                                                                    <option value="{{$item->requirement_id}}" @if(($row->document_id > 0 && $item->requirement_id == $row->requirement_id) || (isset($_GET['requirement_id']) && $_GET['requirement_id'] == $item->requirement_id)) selected="selected" @endif >{{$item->requirement_name_ru}}</option>

                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Описание</label>
                                                            <textarea name="document_text_ru" class="form-control text_editor"><?=$row->document_text_ru?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Порядковый номер сортировки</label>
                                                            <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="Введите">
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="photo">
                                                        <div class="form-group">
                                                            <p class="message" style="color: red"></p>
                                                            <div id="photo_content">
                                                                @include('admin.document.image-loop')
                                                            </div>
                                                            <div style="clear: both"></div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="file">
                                                        <div class="form-group">
                                                            <p class="message" style="color: red"></p>
                                                            <div id="file_content">
                                                                @include('admin.document.file-loop')
                                                            </div>
                                                            <div style="clear: both"></div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="website">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>Название ссылки</label>
                                                                <input type="text" class="form-control" id="website_name1" placeholder="Введите">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ссылка</label>
                                                                <input type="text" class="form-control" id="website1" placeholder="Введите">
                                                            </div>
                                                            <button type="button" class="btn btn-primary" onclick="addWebsite()">Добавить ссылку</button>
                                                            <div id="website_content" style="padding-top: 30px">
                                                                @include('admin.document.website-loop')
                                                            </div>
                                                            <div style="clear: both"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="box box-primary" style="padding: 30px; text-align: center">
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <p style="font-weight: 800; font-size: 16px;">Загрузите фотки</p>
                                <img class="image-src" src="/media/default.png" style="width: 100%; "/>
                            </div>
                            <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                            <form id="image3_form" enctype="multipart/form-data" method="post" class="image-form" style="padding-top: 8px">
                                <i class="fa fa-plus"></i>
                                <input id="avatar-file" type="file" onchange="uploadSeveralImage()" name="image"/>
                            </form>
                        </div>
                        <div class="box box-primary" style="padding: 30px; text-align: center">
                            <div style="font-weight: bold;padding-bottom: 10px">Загрузите файл</div>

                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <div style="margin-bottom: 20px">
                                    <input placeholder="Название файла" type="text" class="form-control" id="file_name" name="file_name">
                                </div>
                                <img class="image-src" src="/media/doc.png" style="width: 100%; "/>
                            </div>
                            <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                            <form id="file_form" enctype="multipart/form-data" method="post" class="image-form">
                                <i class="fa fa-plus"></i>
                                <input id="avatar-file" type="file" onchange="uploadDoc()" name="image"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

