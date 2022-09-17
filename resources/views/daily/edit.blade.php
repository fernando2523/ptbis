<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT ACTIVITY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                    <input type="hidden" id="e_id_act" name="e_id_act">
                    <input type="hidden" name="e_users" value="{{ auth::user()->name; }}">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group position-relative mb-3">
                        <label class="form-label">Aktivitas</label>
                        <select class="form-select text-theme form-select-sm" name="e_activity" required>
                            <option id="e_activity_default" selected>Pilih Aktivitas</option>
                            <option value="WORKING">WORKING</option>
                            <option value="STAND BY">STAND BY</option>    
                            <option value="LIBUR">LIBUR</option>
                            <option value="LIBUR NASIONAL">LIBUR NASIONAL</option>
                        </select>
                        <div class="invalid-tooltip">
                            Silahkan Pilih Jenis Aktivitas.
                        </div>
                    </div>
                    <div class="col-12 form-group mb-3 mt-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" id="e_desc" name="e_desc" rows="2" required placeholder="Keterangan.." autocomplete="OFF"></textarea>
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

