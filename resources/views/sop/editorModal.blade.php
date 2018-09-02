<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">СОП</h4>
            </div>
            <div class="modal-body">
                <input id="document_id" type="hidden"/>
                <input id="action" type="hidden"/>
                <div class="form-group">
                    <label for="">Код документа</label>
                    <input class="form-control" id="document_code" type="text"/>
                </div>
                <div class="form-group">
                    <label for="">Название</label>
                    <input class="form-control" id="document_name" type="text"/>
                </div>
                <div class="form-group">
                    <label for="">Описание</label>
                    <textarea class="form-control" id="description"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Пустая форма</label>
                        <p class="removeFile" id="removeDocEmpty" type="doc_empty"><i class="fa text-danger pointer fa-times">Удалить</i></p>
                        <input id="doc_empty" class="form-control" type="file"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Пример заполнения</label>
                        <p class="removeFile" id="removeDocFull" type="doc_full"><i class="fa text-danger pointer fa-times">Удалить</i></p>
                        <input id="doc_full" class="form-control" type="file"/>
                    </div>
                </div>
                <div class="progress">
                    <div id="doc_progress" class="progress-bar"></div>
                </div>
                <div id="doc_success" class="alert hidden alert-success">
                    Сохранено!
                </div>
                <div id="doc_error" class="alert hidden alert-danger">
                    Ошибка!
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveSop" type="button" class="btn btn-success">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>