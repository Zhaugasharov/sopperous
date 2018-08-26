<div class="row section-row" id="request">
    <div class="container">
        <p class="title-box">{{Lang::get('app.send_request')}}<span class="grey-text">{{Lang::get('app.we_contact')}}</span></p>
        <div class="row form-orders">
            <form id="request_form" enctype="multipart/form-data" method="post">
                <div class="col-md-4">
                    <input class="form-control user_name" type="text" name="user_name" placeholder="{{Lang::get('app.user_name')}}">
                </div>
                <div class="col-md-4">
                    <input class="form-control phone-mask user_phone" name="phone" type="text" placeholder="{{Lang::get('app.user_name')}}">
                </div>
                <div class="col-md-4">
                    <input class="form-control user_email" type="email" name="email" placeholder="{{Lang::get('app.email')}}">
                </div>
                <div class="col-md-12">
                    <textarea class="form-control request_desc" rows="1" name="message" placeholder="{{Lang::get('app.write_about_project')}}"></textarea>
                </div>
                <div class="col-md-12 clearfix bottom-form">
                    <div class="pull-left text-blue">
                        <input id="upload" type="file" name="file"><i class="icons ic-file"></i><span id="upload_label">{{Lang::get('app.upload_file')}}</span>
                    </div>
                    <button class="btn btn-blue pull-right" type="button" onclick="addRequest(this)">{{Lang::get('app.upload_file')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>