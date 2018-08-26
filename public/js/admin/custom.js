$('a.fancybox').fancybox({
    padding: 10
});

function getDocumentListByRequirement(ob,requirement_id) {
    $.ajax({
        url:'/cabinet/ajax/document-by-requirement',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            requirement_id: requirement_id,
            pharmacy_id: $('#pharmacy_id').val()
        },
        success: function (data) {
            $('.requirement-progress').removeClass('active');
            $('.ajax-loader').css('display','none');
            $('#requirement_document_list').html(data);
            $(ob).find('.requirement-progress').addClass('active');
            $('.parent-' + requirement_id).fadeToggle();
          /*  $(ob).toggleClass('active');*/

            /*if(!$(ob).hasClass('active')){
                $(ob).find('.progress-group').css('display','none');
            }*/
        }
    });
}

function setRequirementDocument(ob,document_id,requirement_id) {
    if($(ob).is(':checked')){
        is_checked = 1;
    }
    else {
        is_checked = 0;
    }
    $.ajax({
        url:'/cabinet/ajax/document-pharmacy',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            document_id: document_id,
            is_checked: is_checked,
            pharmacy_id: $('#pharmacy_id').val(),
            requirement_id: requirement_id
        },
        success: function (data) {
            getRequirementList(requirement_id,$('#pharmacy_id').val());
  /*          $('#requirement_item_' + data.requirement_id).find('.progress-number').html(data.requirement_count + '/' + data.requirement_all)
            $('#requirement_item_' + data.requirement_id).find('.progress-bar').css('width',data.requirement_procent + '%')*/
        }
    });
}

function setRequirementDocumentDelete(is_delete,ob,document_id,requirement_id) {
    $.ajax({
        url: '/cabinet/ajax/document-pharmacy-delete',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            document_id: document_id,
            pharmacy_id: $('#pharmacy_id').val(),
            requirement_id: requirement_id,
            is_delete: is_delete
        },
        success: function (data) {
            if(is_delete == 1){
                $(ob).closest('.requirement-item').addClass('disable-item');
                $(ob).closest('.requirement-item').find('.delete-doc-minus').css('display','none');
                $(ob).closest('.requirement-item').find('.delete-doc-plus').css('display','block');

                $(ob).closest('.requirement-item').find('.check-input').prop("checked", false);
            }
            else {
                $(ob).closest('.requirement-item').removeClass('disable-item');
                $(ob).closest('.requirement-item').find('.delete-doc-minus').css('display','block');
                $(ob).closest('.requirement-item').find('.delete-doc-plus').css('display','none');
            }
            getRequirementList(requirement_id,$('#pharmacy_id').val());
        }
    });
}

function uploadSeveralImage(){
    $('.ajax-loader').css('display','block');
    $("#image3_form").submit();
}

$("#image3_form").submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:'/image/upload',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.ajax-loader').css('display','none');
            if(data.success == 0){
                showError(data.error);
                return;
            }
            $('.nav-tabs li').removeClass('active');
            $('.tab-pane').removeClass('active');
            $('#photo').addClass('active');
            $('.photo-tab').closest('li').addClass('active');
            getImageList(data.file_name);
        }
    });
});

function getImageList(image_url){
    $.ajax({
        type: 'GET',
        url: "/admin/document/image",
        data:{
            image_url: image_url,
            image_type: $('#image_type').val()
        },
        success: function(data){
            $('#photo_content').prepend(data);
        }
    });
}

function confirmDeleteImage(ob) {
    $(ob).closest(".image-item").remove();
    $('.message').html('Чтобы сохранить изменения, Вам следует нажать на кнопку "Сохранить"');
}

function showDocDescModal(ob) {
    html = $(ob).closest('.requirement-item').find('.full-desc').html();
    name = $(ob).closest('.requirement-item').find('.title').html();
    $('#modal_body').html(html);
    $('#modal_title').html(name);
    $('#modal').fadeIn();
}

function showDocFileModal(ob) {
    html = $(ob).closest('.requirement-item').find('.file-list').html();
    name = $(ob).closest('.requirement-item').find('.title').html();
    $('#modal_body').html(html);
    $('#modal_title').html(name);
    $('#modal').fadeIn();
}

function showDocWebsiteModal(ob) {
    html = $(ob).closest('.requirement-item').find('.website-list').html();
    name = $(ob).closest('.requirement-item').find('.title').html();
    $('#modal_body').html(html);
    $('#modal_title').html(name);
    $('#modal').fadeIn();
}

function closeModal() {
    $('#modal').fadeOut();
}

function getRequirementList(requirement_id,pharmacy_id){
    $.ajax({
        type: 'GET',
        url: "/cabinet/ajax/requirement",
        data:{
            requirement_id: requirement_id,
            pharmacy_id: pharmacy_id
        },
        success: function(data){
            $('#requirement_category_list').html(data);
        }
    });
}

function setOrderTable(model) {
    requirement_list = [];
    $('.requirement-list-item').each(function () {
        requirement_list.push($(this).val())
    });
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/requirement/sort",
        data:{
            requirement_list: requirement_list
        },
        success: function(data){
            $('#photo_content').prepend(data);
        }
    });
}