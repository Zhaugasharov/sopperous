<div class="modal fade" id="modal-files" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Файлы</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Название файла</th>
                            <th>Файл</th>
                            <th><button class="pull-right btn btn-success">Добавить</button></th>
                        </tr>
                    </thead>
                    <tbody id="sop_files">
                        <tr>
                            <td>
                                <input class="sop_file_id" type="hidden">
                                <input class="form-control sop_file_name" type="text">
                            </td>
                            <td>
                                <input class="sop_file form-control" type="file">
                            </td>
                            <td>
                                <button class="btn btn-danger">Удалить</button>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <div class="progress">
                    <div id="files_progress" class="progress-bar"></div>
                </div>
                <div id="doc_success" class="alert hidden alert-success">
                    Сохранено!
                </div>
                <div id="doc_error" class="alert hidden alert-danger">
                    Ошибка!
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveFiles" type="button" class="btn btn-success">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>