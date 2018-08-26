@foreach($row as $key => $val)
    <tbody>
    <tr>
        <td> {{ $key + 1 }}</td>
        <td style="@if($level > 1) padding-left: {{$level * 20}}px @endif">
            <input type="hidden" value="{{$val->requirement_id}}" class="requirement-list-item" />

            <a class="object-name" href="/admin/requirement?parent_id={{$val->requirement_id}}" style="text-decoration: underline">
                {{ $val['requirement_name_ru']}}
            </a>

        </td>
        <td>
            <div class="object-image" style="margin: 0px">
                <a class="fancybox" href="{{$val->requirement_icon}}">
                    <img src="{{$val->requirement_icon}}" style="width: 20px; height: 20px">
                </a>
            </div>
            <div class="clear-float"></div>
        </td>
        <td style="text-align: center">
            <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->requirement_id }}','requirement')">
                <li class="fa fa-trash-o" style="font-size: 20px; color: red;"></li>
            </a>
        </td>
        <td style="text-align: center">
            <a href="/admin/requirement/{{ $val->requirement_id }}/edit">
                <li class="fa fa-pencil" style="font-size: 20px;"></li>
            </a>
        </td>
        <td style="text-align: center;">
            <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->requirement_id}}"/>
        </td>
    </tr>
    </tbody>

@endforeach
