<form id="form_contract" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modalcontract" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">CONTRACT STATUS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="con_id">
                    <input type="hidden" id="con_vehicle_id" name="con_vehicle_id">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group position-relative mb-3">
                        <label class="form-label">STATUS</label>
                        <select class="form-select text-theme" id="con_status" name="con_status" required>
                            <option id="con_statusdefault" selected>Choose</option>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="NON ACTIVE">NON ACTIVE</option>
                            <option value="STAND BY">STAND BY</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Vehicle.
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformcontract()">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

