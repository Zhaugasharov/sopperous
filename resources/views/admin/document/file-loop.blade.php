@if(isset($file_list) && $file_list != null)
    @foreach($file_list as $key => $val)

        <div class="image-item" >
            <input type="hidden" value="{{$val['file_url']}}" name="file_list[]">
            <input type="hidden" value="{{$val['file_name']}}" name="file_name[]">
            <p style="position: absolute;width: 260px;">{{$val['file_name']}}</p>
            <a href="javascript:void(0)" onclick="confirmDeleteImage(this)">
                <i class="fa fa-times" style="font-size: 20px; margin-left: 10px; color: red; float: right"></i>
            </a>
            <div class="left-float" style="width: 100%;">
                <a href="{{$val['file_url']}}" target="_blank">
                    <img  src="/media/doc.png">
                </a>
            </div>
            <div class="clear-float"></div>
        </div>

    @endforeach
@endif

