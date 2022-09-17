<form id="form_status" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modalstatus" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">COMPLETED BARG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <div class="col-12 text-center">
                        <input type="hidden" id="st_id">
                        <label class="text-indigo fs-18px" style="font-weight: bold;" id="st_id_barg"></label>
                    </div>
                </div>

                <div class="form-group mt-3" align="center">
                    <button class="btn btn-outline-theme btn-lg active" type="button" onclick="submitformstatus()">COMPLETED BARG</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

