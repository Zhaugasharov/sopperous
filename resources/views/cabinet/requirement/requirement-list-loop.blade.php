
@foreach($requirement_list as $item)

    <?php
    $result = array();
    $requirement_ids = array();
    $requirement_ids[0] = $item->requirement_id;
    $requirement_db = new \App\Models\Requirement();
    $requirement_ids = $requirement_db->getChildList($requirement_ids,$item->requirement_id);

    $result['requirement_id'] =  $item->requirement_id;
    $result['requirement_count'] =  \App\Models\PharmacyDocument::leftJoin('document','document.document_id','=','pharmacy_document.document_id')
                                                                ->where('pharmacy_id',$pharmacy_id)
                                                                ->where('document.is_show',1)
                                                                ->whereNULL('document.deleted_at')
                                                                ->whereIn('pharmacy_document.requirement_id',$requirement_ids)
                                                                ->count();

    $procent = \App\Models\Document::whereIn('requirement_id',$requirement_ids)->where('is_show',1)->count() -
               \App\Models\PharmacyDocumentDelete::leftJoin('document','document.document_id','=','pharmacy_document_delete.document_id')
                                                  ->where('pharmacy_id',$pharmacy_id)
                                                  ->where('document.is_show',1)
                                                  ->whereNULL('document.deleted_at')
                                                  ->whereIn('pharmacy_document_delete.requirement_id',$requirement_ids)->count();

    if($procent < 0) $procent = 0;
    $result['requirement_all'] = $procent;

    if($procent == 0){
        $result['requirement_procent'] =  $procent;
    }
    else {
        $result['requirement_procent'] =  $result['requirement_count'] * 100 / $procent;
    }
    ?>

    <?php $requirement_list_child = \App\Models\Requirement::where('parent_id',$item->requirement_id)->where('is_show',1)->orderBy('sort_num','asc')->get(); ?>

    <a href="javascript:void(0)" onclick="getDocumentListByRequirement(this,'{{$item->requirement_id}}')">
        <div class="parent-{{$item->parent_id}} progress-group requirement-progress @if(isset($requirement_id) && $requirement_id == $item->requirement_id) active @endif" id="requirement_item_{{$item->requirement_id}}" style="@if($level > 1) padding-left: {{$level * 20}}px; display: none @endif">
            <div class="first-block">
                <div>
                    <img src="{{$item->requirement_icon}}"/>
                </div>
                <div>
                    <span class="progress-number"><b>{{$result['requirement_count']}}</b>/{{$procent}}</span>
                </div>
            </div>
            <div class="second-block">
                <span class="progress-text">{{$item->requirement_name_ru}} @if(count($requirement_list_child) > 0)  <i class="fa fa-5x fa-arrow-down fa-bottom"></i> @endif</span>
                <div class="progress sm">
                    <div class="progress-bar progress-bar-aqua" style="width: {{$result['requirement_procent']}}%"></div>
                </div>
            </div>
            <div class="clear-float"></div>
        </div>
    </a>

    @include('cabinet.requirement.requirement-list-loop',['requirement_list' => $requirement_list_child, 'level' => $level + 1])

@endforeach