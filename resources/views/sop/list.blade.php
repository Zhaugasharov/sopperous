@extends('admin')

@section('title')
    СОП
@endsection
@section('js')
    <script src="/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/js/jquery-ui.structure.min.css"></link>
    <script src="{{asset('js/admin/sop/sop.js')}}"></script>
    <script>
        $( "#sopListSort" ).sortable();
        $( "#sopListSort" ).disableSelection();
    </script>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div docId="" class="input-group-btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Скачать
                    <span class="fa fa-caret-down"></span></button>
                <ul class="dropdown-menu">
                    <li><a class="float-right" href="/sop/download/all/empty">Скачать все пустые формы</a></li>
                    <li><a class="float-right" href="/sop/download/all/full">Скачать все заполненые формы</a></li>
                    <li><a id="downloadSelected" class="float-right pointer">Скачать выбранные</a></li>
                </ul>
            </div>
            <form id="downloadForm" action="/sop/selected" method="POST">
                {{ csrf_field() }}
            <table id="sopTable" class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Код документа</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Пустая форма</th>
                        <th>Пример заполнения</th>
                        @if(in_array(Auth::user()->role_id, [1, 2]))
                            <th>
                                <div docId="" class="input-group-btn">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Действие
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li class="pointer"><a action="create" class="editor" data-toggle="modal" data-target="#modal-default">Добавить пункт</a></li>
                                        <li class="pointer"><a class="sort">Сортировать</a></li>
                                    </ul>
                                </div>
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(count($sops)>0)
                        @foreach($sops as $k => $sop)
                            <tr class="childFrom{{$sop->parent_id}}" parentId="{{$sop->parent_id}}" docId="{{$sop->id}}" id="row{{$sop->id}}">
                                <td>
                                    @if(!empty($sop->example_full) || !empty($sop->example_empty))
                                        <input class="checkAllRow" name="exp[]" value="{{$sop->id}}" type="checkbox">
                                    @endif
                                </td>
                                <td>
                                    @if($sop->has_children == 1)
                                        <div class="collapser">
                                            <i class="fa text-success fa-plus"></i>
                                        </div>
                                    @endif
                                </td>
                                <td id="doc_code{{$sop->id}}">{{$sop->document_code}}</td>
                                <td id="doc_number{{$sop->id}}">{{$sop->document_name}}</td>
                                <td id="doc_description{{$sop->id}}">{{$sop->description}}</td>
                                <td class="text-center" id="doc_empty{{$sop->id}}">
                                    @if(!empty($sop->example_empty))
                                        <input name="exp_empty[]" value="{{$sop->example_empty}}" class="checkEmpty float-left" type="checkbox">
                                        <a target="_blank" href="{{action('SopController@downloadExample', ['filename' => $sop->example_empty])}}">
                                            <i class="fa fa-file"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center" id="doc_full{{$sop->id}}">
                                    @if(!empty($sop->example_full))
                                        <input name="exp_full[]" value="{{$sop->example_full}}" class="checkFull float-left" type="checkbox"/>
                                        <a target="_blank" href="{{action('SopController@downloadExample', ['filename' => $sop->example_full])}}">
                                            <i class="fa fa-file"></i>
                                        </a>
                                    @endif
                                </td>
                                @if(in_array(Auth::user()->role_id, [1, 2]))
                                    <td>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Действие
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul docId="{{$sop->id}}" class="dropdown-menu">
                                                <li class="pointer"><a action="create" class="editor" data-toggle="modal" data-target="#modal-default">Добавить пункт</a></li>
                                                <li class="pointer"><a action="edit" class="editor" data-toggle="modal" data-target="#modal-default">Редактировать</a></li>
                                                <li class="pointer"><a class="thumbs" data-toggle="modal" data-target="#modal-thumb">Картинки</a></li>
                                                <li class="pointer"><a class="files" data-toggle="modal" data-target="#modal-files">Файлы</a></li>
                                                @if($sop->has_children == 1)
                                                    <li class="pointer"><a class="sort">Сортировать</a></li>
                                                @endif
                                                <li class="divider"></li>
                                                <li class="bg-danger pointer removeRow" ><a >Удалить</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            </form>
        </div>
        <div class="box-footer clearfix">
            Всего СОП: <strong>{{$total}}</strong>
        </div>
    </div>
    @include('sop/editorModal')
    @include('sop/thumbModal')
    @include('sop/filesModal')
    @include('sop/sortModal')
@endsection