<form id="form_delete_analysis" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaldeleteanalysis" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning">DELETE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
               <p>Are You Sure Want To Delete This Item?</p>
            </div>
            <input type="hidden" id="del_id_analysis" name="del_id_analysis">
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-outline-warning" type="button" onclick="submitformdeleteanalysis()">Delete</button>
            </div>
        </div>
    </div>
</div>
</form>

