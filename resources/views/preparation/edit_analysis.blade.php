<form id="form_edit_analysis" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaleditanalysis" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT DATA ANALYSIS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="ea_id" name="ea_id">
                    <input type="hidden" id="ea_id_analysis" name="ea_id_analysis">
                    <input type="hidden" name="ea_users" value="{{ auth::user()->name; }}">
                </div>

                <div class="row form-group">
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Date</label>
                        <input type="text" name="ea_date" class="form-control form-control-sm text-theme" id="ea_date" required readonly placeholder="Pilih Tanggal Pengiriman" />
                    </div>
    
                    <div class="col-8 form-group mb-3">
                        <label class="form-label">Code Sample Final</label>
                        <input class="form-control form-control-sm text-theme is-invalid" type="text" name="ea_code_sample_final" id="ea_code_sample_final" required placeholder="Silahkan masukan final code sample" autocomplete="OFF">
                    </div>
    
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Ni</label>
                        <input class="form-control form-control-sm text-theme is-invalid" type="text" id="ea_ni" name="ea_ni" required placeholder="Ni" autocomplete="OFF">
                    </div>
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Fe</label>
                        <input class="form-control form-control-sm text-theme is-invalid" type="text" id="ea_fe" name="ea_fe" required placeholder="Fe" autocomplete="OFF">
                    </div>
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Inc</label>
                        <input class="form-control form-control-sm text-theme is-invalid" type="number" id="ea_increment" name="ea_increment" required placeholder="Fe" autocomplete="OFF">
                    </div>
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" id="ea_desc" name="ea_desc" rows="2" placeholder="Optional.." autocomplete="OFF"></textarea>
                    </div>

                    <div class="col-12 form-group position-relative mb-3 mt-2" >
                        <label class="form-label">File Contract Upload <small class="text-warning">optional</small></label>
                        <input type="file" class="form-control form-control-sm" name="file">
                    </div>
                </div>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformeditanalysis()">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

