<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT LOCATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                    <input type="hidden" id="e_id_lands1" name="e_id_lands1">
                    <input type="hidden" id="e_land" name="e_land">
                    <input type="hidden" id="e_id_location" name="e_id_location">
                </div>

                <div class="row form-group">
                    <div class="col-6 form-group position-relative mb-3 mt-3">
                        <label class="form-label">Land Owner</label>
                        <select class="form-select text-theme" id="id_vendor" name="id_vendor" required>
                            <option id="e_id_vendor_default" selected>Choose</option>
                            @foreach ($getvendor as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->vendor }} = {{ $vendor->name_product }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Land Owner.
                        </div>
                    </div>
                    <div class="col-6 form-group mb-3 mt-3">
                        <label class="form-label">Name Location</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="e_location" id="e_location" required placeholder="Please provide a name location" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col-6 form-group mb-2">
                        <label class="form-label">Latitude</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="e_lat" id="e_lat"  placeholder="latitude" autocomplete="OFF" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col-6 form-group mb-2">
                        <label class="form-label">Longitude</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="e_long" id="e_long"  placeholder="longitude" autocomplete="OFF" required>
                        <div class="valid-feedback">Looks good!</div>
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

