<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT FUEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="text" id="e_id">
                </div>

                <div class="row form-group">
                    <div class="col-8 form-group mb-3">
                        <label class="form-label">Owner</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_owner" name="e_owner" required autocomplete="off">
                    </div>
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Royalty</label>
                        <input class="form-control formm-control-sm text-success" type="number" id="e_royalty" name="e_royalty" required autocomplete="off">
                    </div>
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Name Land</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_land" name="e_land" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

