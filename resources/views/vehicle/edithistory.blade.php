<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EXTEND CONTRACT PERIOD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                    <input type="hidden" id="e_days" name="e_days">
                </div>

                <div class="row form-group mt-3">
                    <div class="col-2 form-group  mb-3">
                    </div>
                    <div class="col-8 form-group mb-3">
                        <label class="form-label text-center">CONTRACT PERIOD (DAYS)</label>
                        <input class="form-control formm-control-sm text-success" type="number" id="e_daysnew" name="e_daysnew" required>
                    </div>
                    <div class="col-2 form-group mb-3">
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

