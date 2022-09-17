<form id="form_edit" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT DATA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                </div>

                <div class="row form-group">
                    <div class="col-5 form-group mb-3 text-center">
                        <label class="form-label">LOCATION</label>
                        <select class="form-select text-theme text-center fw-bold" id="e_location" name="e_location" required>
                            <option class="text-default fw-bold" id="e_location_default" selected>Choose</option>
                            @foreach ($dataloc as $keyloc)
                            <option value="{{ $keyloc->location }}">{{ $keyloc->location }}</option>  
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Vehicle.
                        </div>
                    </div>
                    <div class="col-5 form-group mb-3  text-center">
                        <label class="form-label">SAMPLE MINING</label>
                        <input class="form-control formm-control-sm text-success  text-center fw-bold" type="text" id="e_sample_mining" name="e_sample_mining" required autocomplete="off">
                    </div>
                    <div class="col-2 form-group mb-3  text-center">
                        <label class="form-label">INCREMENT</label>
                        <input class="form-control formm-control-sm text-success  text-center fw-bold" type="text" id="e_increment" name="e_increment" required autocomplete="off">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-3 form-group mb-3 text-center">
                        <label class="form-label">NICKEL (Ni)</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="number" id="e_ni" name="e_ni" required autocomplete="off">
                    </div>
                    <div class="col-3 form-group mb-3 text-center">
                        <label class="form-label">IRON (Fe)</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="number" id="e_fe" name="e_fe" required autocomplete="off">
                    </div>
                    <div class="col-6 form-group mb-3 text-center">
                        <label class="form-label">STATUS</label>
                        <select class="form-select text-theme text-center fw-bold" id="e_status" name="e_status" required>
                            <option class="text-default fw-bold" id="e_status_default" selected>Choose</option>
                            <option class="text-danger fw-bold" value="PENDING">PENDING</option>
                            <option class="text-success fw-bold"  value="FINISH">FINISH</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Vehicle.
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

