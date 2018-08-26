@foreach($document_list as $item)

        <?php $delete_count = \App\Models\PharmacyDocumentDelete::leftJoin('document','document.document_id','=','pharmacy_document_delete.document_id')->leftJoin('requirement','requirement.requirement_id','=','pharmacy_document_delete.requirement_id')->where('requirement.is_show',1)->whereNULL('requirement.deleted_at')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('pharmacy_document_delete.document_id',$item->document_id)->where('pharmacy_id',$pharmacy_id)->count(); ?>
        <div class="requirement-item @if($delete_count > 0) disable-item @endif">
            <div class="requirement-first-part float-left">
                <div class="check-requirement" style="height: 30px;">
                    <input class="check-input" @if(\App\Models\PharmacyDocument::leftJoin('document','document.document_id','=','pharmacy_document.document_id')->leftJoin('requirement','requirement.requirement_id','=','pharmacy_document.requirement_id')->where('requirement.is_show',1)->whereNULL('requirement.deleted_at')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('pharmacy_document.document_id',$item->document_id)->where('pharmacy_id',$pharmacy_id)->count() > 0) checked="checked" @endif onchange="setRequirementDocument(this,'{{$item->document_id}}','{{$requirement_id}}')" style="font-size: 15px" value="1" type="checkbox">
                </div>
                <div style="height: 40px">
                    <a class="delete-doc-minus" @if($delete_count > 0) style="display: none" @endif href="javascript:void(0)" onclick="setRequirementDocumentDelete(1,this,'{{$item->document_id}}','{{$requirement_id}}')">
                        <i class="fa fa-minus-circle" style="color: red"></i>
                    </a>
                    <a class="delete-doc-plus" @if($delete_count == 0) style="display: none" @endif href="javascript:void(0)" onclick="setRequirementDocumentDelete(0,this,'{{$item->document_id}}','{{$requirement_id}}')">
                        <i class="fa fa-plus-circle" style="color: green"></i>
                    </a>
                </div>
                <div>
                    <?php $websites = \App\Models\DocumentWebsite::leftJoin('document','document.document_id','=','document_website.document_id')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('document_website.document_id',$item->document_id)->orderBy('document_website_id','asc')->get(); ?>
                    @if(count($websites) > 0)
                        <a href="javascript:void(0)" onclick="showDocWebsiteModal(this)">
                            <i class="fa fa-gavel" style="color: blue"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="requirement-second-part float-left">
				<div>
					<?php $images =  \App\Models\Image::leftJoin('document','document.document_id','=','image.document_id')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('image.document_id',$item->document_id)->get(); ?>
                    @if($images->count() > 0) <p class="image-count">{{$images->count()}}</p>@endif

					@foreach($images as $key_image => $im)
					 <a class="fancybox" href="{{$im->image_url}}" rel="fancy_{{$item->document_id}}" @if($key_image > 0) style="display: none" @endif>
                        <img src="{{$im->image_url}}"/>
               		 </a>
					@endforeach
				</div>
            </div>
            <div class="requirement-third-part float-left">
                <p class="title">{{$item->document_name_ru}}</p>
                <div style="display: none" class="full-desc">
                    {!! $item->document_text_ru !!}
                </div>
                <div style="display: none" class="file-list">
                    <?php $files = \App\Models\File::leftJoin('document','document.document_id','=','file.document_id')->where('document.is_show',1)->whereNULL('document.deleted_at')->where('file.document_id',$item->document_id)->orderBy('file_id','asc')->get(); ?>
                    @if(count($files) > 0)
                        @foreach($files as $key_image => $im)
                            <a style="text-decoration: underline"  href="{{$im['file_url']}}" target="_blank">@if($im['file_name'] != '') {{$im['file_name']}} @else Файл @endif</a></br>
                        @endforeach
                    @endif
                </div>
                <div style="display: none" class="website-list">
                    @if(count($websites) > 0)
                        @foreach($websites as $key_image => $im)
                            <a style="text-decoration: underline"  href="{{$im['website']}}" target="_blank">@if($im['website_name'] != '') {{$im['website_name']}} @else Ссылка @endif</a></br>
                        @endforeach
                    @endif
                </div>

                <?php $item->document_text_ru = strip_tags($item->document_text_ru);
                    $sentence = mb_substr($item->document_text_ru,0,200);
                ?>
                <p>{!! $sentence!!}@if(mb_strlen($item->document_text_ru) > 200)... <a href="javascript:void(0)" onclick="showDocDescModal(this)" class="read-more">Подробнее</a>@endif</p>
            </div>
            <div class="requirement-fourth-part">
                <div>
                    <p>Для скачивания</p>
                    <div  class="requirement-doc">
                        @if(count($files) > 0)
                            <a href="javascript:void(0)" onclick="showDocFileModal(this)">
                                Для скачивания <i class="fa fa-file"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="clear-float"></div>
        </div>


@endforeach

<script>
	$('a.fancybox').fancybox({
    	padding: 10
	});
</script>