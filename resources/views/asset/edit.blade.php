<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT ASSET</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                    <input type="hidden" id="e_id_transaction" name="e_id_transaction" value="{{ $nomor }}">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_material" name="e_material" required>
                    </div>

                    <div class="col-6 form-group position-relative mb-3">
                        <label class="form-label">Unit</label>
                        <select class="form-select text-theme" id="e_unit" name="e_unit" required>
                            <option id="e_unitdefault" value="" selected>Choose</option>
                            <option value="PCS">PCS</option>
                            <option value="PACKAGE">PACKAGE</option>
                            <option value="BOX">BOX</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Unit.
                        </div>
                    </div>

                    <div class="col-6 form-group position-relative mb-3">
                        <label class="form-label">Type Material</label>
                        <select class="form-select text-theme" id="e_type_asset" name="e_type_asset" required>
                            <option id="e_type_assetdefault" value=""  selected>Choose</option>
                            <option value="ASET TETAP">ASET TETAP</option>
                            <option value="BAHAN BAKU">BAHAN BAKU</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Material.
                        </div>
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

