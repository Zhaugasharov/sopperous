var SopApp = {
    mainTable: null,
    initSopApp: function(table){
        this.mainTable = table;
        //Открыть закрыть слот
        $(table).on('click', ".collapser", function(){SopApp.actions.collapseSop($(this));});
        $(table).on('click', ".editor", function(){SopApp.actions.setForm($(this));});
        $(table).on('click', ".thumbs", function(){SopApp.actions.setThumbForm($(this));});
        $(table).on('click', ".files", function(){SopApp.actions.setFileForm($(this));});
        $("#images").on('click', ".removeThumb", function(){SopApp.actions.removeThumb($(this))});
        $("#images").on('click', ".setMain", function(){SopApp.actions.setMainThumb($(this))});
        $("#saveSop").click(function () { SopApp.actions.saveData($(this))});
        $("#saveThumbs").click(function(){SopApp.actions.saveThumbs()});
        $(table).on('click', ".checkAllRow", function(){SopApp.actions.checkAllFiles($(this))});
        $(table).on('click', ".checkEmpty", function(){SopApp.actions.checkEmptyFiles($(this))});
        $(table).on('click', ".checkFull", function(){SopApp.actions.checkFullFiles($(this))});
        $(table).on('click', ".removeRow", function(){SopApp.actions.removeRow($(this))});
        $("#downloadSelected").click(function(){$("#downloadForm").submit()});
    },
    actions: {
        checkAllFiles: function(e){
            var tr = $(e).closest('tr');
            if(e.prop('checked')){
                $($(tr).find('.checkEmpty')).prop('checked', true);
                $($(tr).find('.checkFull ')).prop('checked', true);
            }else{
                $($(tr).find('.checkEmpty')).prop('checked', false);
                $($(tr).find('.checkFull ')).prop('checked', false);
            }
        },
        checkEmptyFiles: function(e){
            var tr = $(e).closest('tr');
            if(e.prop('checked')){
                $($(tr).find('.checkAllRow')).prop('checked', true);
            }else {
                if (!$($(tr).find('.checkFull ')).prop('checked'))
                    $($(tr).find('.checkAllRow')).prop('checked', false);
            }
        },
        checkFullFiles: function(e){
            var tr = $(e).closest('tr');
            if(e.prop('checked')){
                $($(tr).find('.checkAllRow')).prop('checked', true);
            }else {
                if (!$($(tr).find('.checkEmpty ')).prop('checked'))
                    $($(tr).find('.checkAllRow')).prop('checked', false);
            }
        },
        setForm: function(e) {
            $($('#doc_progress').closest('.progress')).hide();

            var docId = e.closest('ul').attr('docId');
            var action = e.attr('action');
            if (docId == undefined) docId = 0;

            var fields = ["#document_code", "#document_name", "#description"];
            var tds = ["#doc_code", "#doc_number", "#doc_description"];

            $("#action").val(action);
            $("#document_id").val(docId);

            switch (action) {
                case "create":
                    for (var i = 0; i < fields.length; i++)
                        $(fields[i]).val("");
                break;
                case "edit":
                    for (var i = 0; i < fields.length; i++)
                        $(fields[i]).val($(tds[i]+docId).html());
                break;
            }
        },
        saveData: function(e){
            var formData = new FormData();
            var emptyExample = $('#doc_empty').prop('files')[0];
            var fullExample = $('#doc_full').prop('files')[0];
            formData.append('example_empty', emptyExample);
            formData.append('example_full', fullExample);

            var fields = ["#action", "#document_id" ,"#document_code", "#document_name", "#description"];
            var fieldNames = ["action", "sopId", "document_code", "document_name", "description"];

            for (var i = 0; i < fields.length; i++)
                formData.append(fieldNames[i], $(fields[i]).val());

            e.attr('disabled', true);
            SopApp.requests.saveSop(formData);
            
            e.attr('disabled', false);
        },
        hider: function(docId){
            $(".childFrom"+docId).each(function(){
                var innerDocId = $(this).attr('docId');
                $(this).hide();
                if ($(".childFrom" + innerDocId).length != 0){
                    $('#row'+innerDocId).find('i').removeClass('fa-minus');
                    $('#row'+innerDocId).find('i').addClass('fa-plus');
                    SopApp.actions.hider(innerDocId);
                }
            });
        },
        remover: function(docId){
            $(".childFrom"+docId).each(function(){
                var innerDocId = $(this).attr('docId');
                $(this).remove();
                if ($(".childFrom" + innerDocId).length != 0)
                    SopApp.actions.remover(innerDocId);
            });
        },
        collapseSop: function(e) {
            var docId = $(e).closest('tr').attr('docId');
            if ($(".childFrom" + docId).length == 0 || !$(".childFrom" + docId).is(":visible")) {
                if ($(".childFrom" + docId).length == 0)
                    SopApp.requests.getChild(docId);
                else
                    $(".childFrom" + docId).show();

                $(e).find('i').removeClass('fa-plus');
                $(e).find('i').addClass('fa-minus');

            } else{
                $(e).find('i').removeClass('fa-minus');
                $(e).find('i').addClass('fa-plus');
                SopApp.actions.hider(docId);
            }
        },
        setThumbForm: function(e){
            var docId = $($(e).closest('tr')).attr('docId');
            $("#document_id").val(docId);
            $($('#thumb-progress').closest('.progress')).hide();
            SopApp.requests.getThumb(docId);
        },
        saveThumbs: function(){
            var formData = new FormData();
            var files =  $("#thumbs-input")[0].files;

            for(var i = 0; i<files.length; i++)
                formData.append('thumbs[]', files[i]);

            SopApp.requests.setThumb($("#document_id").val(), formData);
        },
        removeThumb: function(e){
            SopApp.requests.removeThumb($(e).attr('thumb-id'),$("#document_id").val());
        },
        setMainThumb: function(e){
            SopApp.requests.mainThumb($(e).attr('thumb-id'),$("#document_id").val());
        },
        setFileForm: function(){
            var docId = $($(e).closest('tr')).attr('docId');
            $("#document_id").val(docId);
            $($('#files_progress').closest('.progress')).hide();

        },
        removeRow: function(e){
            var docId = $($(e).closest('tr')).attr('docId');
            var docId = $(e).closest('tr').attr('docId');
            if ($(".childFrom" + docId).length != 0 && $(".childFrom" + docId).is(":visible")) {
                $(e).find('i').removeClass('fa-minus');
                $(e).find('i').addClass('fa-plus');
                SopApp.actions.hider(docId);
            }
            SopApp.requests.removeRow(docId);
        }
    },
    requests: {
        removeRow: function(docId){
            $("#row"+docId).remove();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: "POST",
                url: "/admin/ajax/remove/sop/"+docId,
                dataType: 'json',
                data: {},
                success: function(data){
                    SopApp.actions.remover(docId);
                }
            });
        },
        getChild: function(docId){
            var colors = ['#E0DFE2', '#e4f0f6', '#E0DFE2', '#FFF2C3','#ffffff', '#F3FFAC',  '#BFFFBB', '#DDFFE5', '#FFE2D9', '#FFFFF', '#F8D9E8'];
            var deep = 0;
            var parent = false;
            var parentId = $("#row"+docId).attr('parentId');

            while(!parent){
                if(parentId == null || parentId == '' || parentId == undefined)
                    parent = true;
                ++deep;
                parentId = $("#row"+parentId).attr('parentId');
            }

            var color = (colors[deep] == undefined)?colors[0]:colors[deep];

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: "POST",
                url: "/ajax/get-sop/"+docId,
                dataType: 'json',
                data: {},
                success: function(data){
                    for(var i = 0; i<data.length; i++){
                        var tr = SopApp.view.getRow(data[i], color);
                        $("#row"+docId).after(tr);
                    }
                }
            });
        },
        saveSop: function(formData){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '/admin/ajax/save/sop',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data){
                    data = JSON.parse(data);

                    if($("#row"+data.id).length != 0){
                        var fields = ["document_code", "document_name", "description"];
                        var tds = ["#doc_code", "#doc_number", "#doc_description"];
                        for(var i = 0; i<tds.length; i++)
                            $(tds[i]+data.id).html(data[fields[i]]);

                        if(data.example_empty != '' && data.example_empty != null && data.example_empty != undefined)
                            $("#doc_empty"+data.id).html('<a href="/download/example/'+data.example_empty+'"><i class="fa fa-file"></i></a>');
                        else
                            $("#doc_empty"+data.id).html('');

                        if(data.example_full != '' && data.example_full != null && data.example_full != undefined)
                            $("#doc_full"+data.id).html('<a href="/download/example/'+data.example_full+'"><i class="fa fa-file"></i></a>');
                        else
                            $("#doc_full"+data.id).html('');

                    }else{

                        if(data.parent_id == 0){
                            var row = SopApp.view.getRow(data, '');
                            $("#sopTable").find('tbody').prepend(row);
                        }
                        else{
                            var docId = data.parent_id;
                            var i = $("#row"+docId).find('i');

                            if ($(i).length != 0) {
                                if ($(".childFrom" + docId).length == 0)
                                    SopApp.requests.getChild(docId);
                                else{
                                    var colors = ['#E0DFE2', '#e4f0f6', '#E0DFE2', '#FFF2C3','#ffffff', '#F3FFAC',  '#BFFFBB', '#DDFFE5', '#FFE2D9', '#FFFFF', '#F8D9E8'];
                                    var deep = 0;
                                    var parent = false;
                                    var parentId = $("#row"+docId).attr('parentId');

                                    while(!parent){
                                        if(parentId == null || parentId == '' || parentId == undefined)
                                            parent = true;
                                        ++deep;
                                        parentId = $("#row"+parentId).attr('parentId');
                                    }

                                    var color = (colors[deep] == undefined)?colors[0]:colors[deep];
                                    var row = SopApp.view.getRow(data, color);
                                    $("#row"+docId).after(row);

                                    $(".childFrom" + docId).show();
                                }


                                $("#row"+docId).find('i').removeClass('fa-plus');
                                $("#row"+docId).find('i').addClass('fa-minus');

                            } else{
                                $($("#row"+docId).find('td')[0]).html('<div class="collapser"><i class="fa text-success fa-minus"></i></div>');
                                var li = $($("#row"+docId).find('.dropdown-menu')).find('li');
                                $(li[1]).after('<li><a href="#">Сортировать</a></li>');

                                var colors = ['#E0DFE2', '#e4f0f6', '#E0DFE2', '#FFF2C3','#ffffff', '#F3FFAC',  '#BFFFBB', '#DDFFE5', '#FFE2D9', '#FFFFF', '#F8D9E8'];
                                var deep = 0;
                                var parent = false;
                                var parentId = $("#row"+docId).attr('parentId');

                                while(!parent){
                                    if(parentId == null || parentId == '' || parentId == undefined)
                                        parent = true;
                                    ++deep;
                                    parentId = $("#row"+parentId).attr('parentId');
                                }

                                var color = (colors[deep] == undefined)?colors[0]:colors[deep];
                                var row = SopApp.view.getRow(data, color);
                                $("#row"+docId).after(row);

                            }
                        }
                    }

                    $("#doc_success").removeClass('hidden');
                    setTimeout(function(){
                        $("#doc_success").addClass('hidden');
                    },1500);
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    var progress = 0;

                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(e){
                        if (e.lengthComputable) {
                            $($('#doc_progress').closest('.progress')).show();
                            $('#doc_progress').css('width', '' + (100 * e.loaded / e.total) + '%');
                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(e){
                        $($('#doc_progress').closest('.progress')).hide();
                        $('#doc_progress').css('width', 0);
                    }, false);
                    return xhr;
                }
            });
        },
        getThumb: function(docId){
            $("#images").html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'GET',
                url: '/ajax/get/thumbs/'+docId+'/150',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: {},
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    var progress = 0;
                    //Download progress
                    xhr.addEventListener("progress", function(e){
                        $($('#thumb-progress').closest('.progress')).show();
                        if (e.lengthComputable) {
                            $('#thumb-progress').css('width', '' + (100 * e.loaded / e.total) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data){
                    for(var i = 0; i< data.length; i++){
                        var imgBox = SopApp.view.imgBox(data[i]);
                        $("#images").append(imgBox);
                    }

                    $($('#thumb-progress').closest('.progress')).hide();
                    $('#thumb-progress').css('width', '0%');
                }
            });
        },
        setThumb: function(sopId,formData){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '/admin/ajax/save/thumbs/'+sopId,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    var progress = 0;
                    //Download progress
                    xhr.upload.addEventListener("progress", function(e){
                        $($('#thumb-progress').closest('.progress')).show();
                        if (e.lengthComputable) {
                            $('#thumb-progress').css('width', '' + (100 * e.loaded / e.total) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data){
                    SopApp.requests.getThumb(sopId);
                    $("#thumbs-input").val('');

                    $($('#thumb-progress').closest('.progress')).hide();
                    $('#thumb-progress').css('width', '0%');
                }
            });
        },
        removeThumb: function(id, sopId){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '/admin/ajax/delete/thumbs/'+id+'/'+sopId,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: {},
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    var progress = 0;
                    //Download progress
                    xhr.addEventListener("progress", function(e){
                        $($('#thumb-progress').closest('.progress')).show();
                        if (e.lengthComputable) {
                            $('#thumb-progress').css('width', '' + (100 * e.loaded / e.total) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data){
                    $("#thumb_"+id).remove();
                    $($('#thumb-progress').closest('.progress')).hide();
                    $('#thumb-progress').css('width', '0%');
                }
            });
        },
        mainThumb: function(id, sopId){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                type: 'POST',
                url: '/admin/ajax/main/thumb/'+id+'/'+sopId,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: {},
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    var progress = 0;
                    //Download progress
                    xhr.addEventListener("progress", function(e){
                        $($('#thumb-progress').closest('.progress')).show();
                        if (e.lengthComputable) {
                            $('#thumb-progress').css('width', '' + (100 * e.loaded / e.total) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data){
                    $($('#thumb-progress').closest('.progress')).hide();
                    $('#thumb-progress').css('width', '0%');
                }
            });
        }
    },
    view: {
        getRow: function(data, color){
            var tr = '<tr style="background-color: '+color+'" class="childFrom'+data.parent_id+'" parentId="'+data.parent_id+'" docId="'+data.id+'" id="row'+data.id+'">';
            tr += '<td>';
            if(data.example_empty != null || data.example_full != null)
                tr += '<input name="exp[]" class="checkAllRow" value="'+data.id+'" type="checkbox">';
            tr += '</td>';
            tr += '<td>';
            if(data.has_children == 1)
                tr += '<div docId="'+data.id+'" class="collapser"><i class="fa text-success fa-plus"></i></div>';
            tr += '</td>';
            tr += '<td id="doc_code'+data.id+'">'+data.document_code+'</td>';
            tr += ' <td id="doc_number'+data.id+'">'+data.document_name+'</td>';
            tr += '<td id="doc_description'+data.id+'">'+((data.description != null)?data.description:'')+'</td>';
            tr += '<td class="text-center" id="doc_empty'+data.id+'">';

            if(data.example_empty != null && data.example_empty != ''){
                tr += '<input name="exp_empty[]" value="'+data.example_empty+'" class="checkEmpty float-left" type="checkbox"/>';
                tr += '<a href="/download/example/'+data.example_empty+'"><i class="fa fa-file"></i></a>';
            }

            tr += '</td>';
            tr += '<td class="text-center" id="doc_full'+data.id+'">';
            if(data.example_full != null && data.example_full != ''){
                tr += '<input name="exp_full[]" value="'+data.example_full+'" class="checkFull float-left" type="checkbox"/>';
                tr += '<a href="/download/example/'+data.example_full+'"><i class="fa fa-file"></i></a>';
            }

            tr += '</td>';

            if(data.hide === undefined){
                tr += '<td>';
                tr += '<div class="input-group-btn">';
                tr += '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Действие';
                tr += '<span class="fa fa-caret-down"></span></button>';
                tr += '<ul docId="'+data.id+'" class="dropdown-menu">';
                tr += '<li class="pointer"><a action="create" class="editor" data-toggle="modal" data-target="#modal-default">Добавить пункт</a></li>';
                tr += '<li class="pointer"><a action="edit" class="editor" data-toggle="modal" data-target="#modal-default">Редактировать</a></li>';
                tr += '<li class="pointer"><a class="thumbs" data-toggle="modal" data-target="#modal-thumb">Картинки</a></li>';
                tr += '<li class="pointer"><a class="files" data-toggle="modal" data-target="#modal-files">Файлы</a></li>';
                if(data.has_children == 1)
                    tr += '<li><a href="#">Сортировать</a></li>';

                tr += '<li class="divider"></li>';
                tr += '<li class="bg-danger pointer removeRow" ><a >Удалить</a></li>';
                tr += '</ul>';
                tr += '</div>';
                tr += '</td>';
            }

            tr += '</tr>';
            return tr;
        },
        imgBox: function(data){
            return "<div id='thumb_"+data.id+"' class='thumb-box x150 float-left'><i thumb-id='"+data.id+"' class='setMain fa fa-check'></i><i thumb-id='"+data.id+"' class='removeThumb fa fa-times'></i><img src='/download/thumb/"+data.filename+"' alt=''></div>";
        },
        getFileRow: function (data) {
            var fileId = (data.id != undefined)?data.id:'';
            var filename = (data.filename != undefined)?data.filename:'';
            var fileDesc = (data.description != undefined)?data.description:'';

            var tr = '<tr><td>';
            tr += '<input value="'+fileId+'" class="sop_file_id" type="hidden"/>';
            tr += '<input value="'+fileDesc+'" class="form-control sop_file_name" type="text"></td>';
            tr += '<td>';
                if(filename != ''){
                    tr += '<a href="'+filename+'">'+filename+'</a>';
                    tr += '<input class="form-control sop_file" type="hidden">';
                }
                else
                    tr += '<input class="form-control sop_file" type="file">';
            tr += '</td>';
            tr += '</tr>';

            return tr;
        }
    }
};

SopApp.initSopApp("#sopTable");