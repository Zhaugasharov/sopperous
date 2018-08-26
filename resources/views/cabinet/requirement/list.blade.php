@extends('admin')
@section('title')
    Мои аптеки
@endsection
@section('content')
    <div class="card glass" style="padding-bottom: 100px">
        <div class="card-body">

                    <div class="row" style="margin:0; padding-left:10px; padding-top:10px">
                        <div class="col-md-3 requirement-left-part">
                            <p class="text-center">
                                <strong>Требования к аптеке</strong>
                            </p>
                            <div id="requirement_category_list">
                                @include('cabinet.requirement.requirement-list')
                            </div>
                        </div>
                        <div class="col-md-9" id="requirement_list">
                            <input type="hidden" id="pharmacy_id" value="{{$pharmacy_id}}"/>

                            <div class="text-center pharmacy-list">
                                @foreach($pharmacy_list as $item)
                                    <a @if($pharmacy_id == $item->pharmacy_id) style="text-decoration: underline" @endif href="/cabinet/requirement/{{$item->pharmacy_id}}">{{$item->pharmacy_name}} ({{\App\Models\PharmacyDocument::leftJoin('document','document.document_id','=','pharmacy_document.document_id')->leftJoin('requirement','requirement.requirement_id','=','pharmacy_document.requirement_id')->where('requirement.is_show',1)->whereNULL('requirement.deleted_at')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('pharmacy_id',$item->pharmacy_id)->count()}}/{{\App\Models\Document::where('is_show',1)->count() - \App\Models\PharmacyDocumentDelete::leftJoin('document','document.document_id','=','pharmacy_document_delete.document_id')->leftJoin('requirement','requirement.requirement_id','=','pharmacy_document_delete.requirement_id')->where('requirement.is_show',1)->whereNULL('requirement.deleted_at')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('pharmacy_id',$item->pharmacy_id)->count()}})</a>
                                @endforeach
                            </div>

                            <div id="requirement_document_list">
                                <div id="requirement_document_default">
                                    <h2>ВЫБЕРИТЕ РАЗДЕЛ ТРЕБОВАНИЯ И</h2>
                                    <div style="width: 500px; margin: auto; text-align: left">
                                        <p><input class="select-all" style="font-size: 15px" value="1" type="checkbox">ОТМЕТЬТЕ СООТВЕТСТВИЕ</p>
                                        <p><i class="fa fa-minus-circle" style="color: red"></i> ИСКЛЮЧИТЕ ТРЕБОВАНИЕ, ЕСЛИ ОНО ВАС НЕ КАСАЕТСЯ</p>
                                        <p><i class="fa fa-gavel" style="color: blue"></i>  УЗНАЙТЕ ГДЕ ЭТО ТРЕБУЕТСЯ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @include('cabinet.requirement.modal')
    
@endsection
