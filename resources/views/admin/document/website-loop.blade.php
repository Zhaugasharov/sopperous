@if(isset($website_list) && $website_list != null)
    @foreach($website_list as $key => $val)
        <div class="image-item" style="width: 100%" >
            <p>Название ссылки</p>
            <input type="text" value="{{$val['website_name']}}" name="website_name[]" style="width: 100%">
            <p>Ссылка на статью</p>
            <input type="text" value="{{$val['website']}}" name="website_list[]" style="width: 100%">

            <a href="javascript:void(0)" onclick="confirmDeleteImage(this)">
                <i class="fa fa-times" style="font-size: 20px; margin-left: 10px; color: red; float: right"></i>
            </a>
            <div class="clear-float"></div>
        </div>

    @endforeach
@endif

