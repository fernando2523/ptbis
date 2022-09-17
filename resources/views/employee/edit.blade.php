<form id="form_edit" class="was-validated"  enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT EMPLOYEE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                </div>

                <div class="row form-group">
                    <div class="col-8 form-group position-relative mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="e_name" id="e_name" required placeholder="Please provide a name" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-4 form-group mb-3">
                        <label class="form-label">Phone</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="e_tlp" id="e_tlp" required placeholder="Please provide number Phone" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-6 form-group mb-2">
                        <label class="form-label">Domisili <small class="text-warning">(kota)</small></label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="e_domisili" id="e_domisili"  placeholder="domisili" autocomplete="OFF" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-6 form-group position-relative mb-2">
                        <label class="form-label">Gender</label>
                        <select class="form-select text-theme" id="e_gender" name="e_gender" required>
                            <option id="e_genderdefault" selected>Choose Gender</option>
                            <option value="PRIA">PRIA</option>
                            <option value="WANITA">WANITA</option>
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid gender.
                        </div>
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4 form-group position-relative mb-2 profile-img" align="center">
                        <img class="mb-2"  id="e_img" width="200px">
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <div class="col-4">
                    </div>
                </div>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="submit" onclick="submitformedit()">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

