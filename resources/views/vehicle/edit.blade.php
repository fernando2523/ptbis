<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT VEHICLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                    <input type="hidden" id="e_vehicle_id" name="e_vehicle_id">
                </div>

                <div class="row form-group">
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Vehicle</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_vehicle_unit" name="e_vehicle_unit" required autocomplete="off">
                    </div>
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Operator</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_operator" name="e_operator" required autocomplete="off">
                    </div>
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Model Unit</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_model_unit" name="e_model_unit" required autocomplete="off">
                    </div>
                    <div class="col-6 form-group mb-3">
                        <label class="form-label">Type Unit</label>
                        <select class="form-select text-theme" id="e_type_unit" name="e_type_unit" required>
                            <option id="e_type_unit_default" selected>Choose</option>
                            <option value="OWNED">OWNED</option>
                            <option value="CONTRACT">CONTRACT</option>
                            <option value="EXTERNAL">EXTERNAL</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Unit.
                        </div>
                    </div>

                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Type Unit</label>
                        <select class="form-select text-theme" id="e_vendor" name="e_vendor" required>
                            <option id="e_vendordefault" selected>Choose</option>
                            @foreach ($getvendor as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->vendor }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Vendor.
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

