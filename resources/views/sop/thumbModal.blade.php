<div class="modal fade" id="modal-thumb" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Картинки</h4>
            </div>
            <div class="modal-body">
                <div class="row mb-1">
                    <div class="container-fluid" id="images">

                    </div>
                </div>
                <div class="progress">
                    <div id="thumb-progress" class="progress-bar"></div>
                </div>
                <div class="form-group">
                    <input id="thumbs-input" class="form-control" accept="image/jpeg" multiple type="file"/>
                </div>
                <div id="doc_success" class="alert hidden alert-success">
                    Сохранено!
                </div>
                <div id="doc_error" class="alert hidden alert-danger">
                    Ошибка!
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveThumbs" type="button" class="btn btn-success">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>