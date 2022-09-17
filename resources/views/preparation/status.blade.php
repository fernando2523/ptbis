<form id="form_status" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modalstatus" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">COMPLETED STATUS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="st_id">
                </div>

                <div class="row form-group text-center">
                    <div class="col-6 form-group mb-3">
                        <label for="st_location">Location</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="text" id="st_location" name="st_location" readonly>
                    </div>
                    <div class="col-6 form-group mb-3 ">
                        <label for="st_code_sample">Code Sample</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="text" id="st_code_sample" name="st_code_sample" readonly>
                    </div>
                    <div class="col-12 form-group mb-3 ">
                        <label for="st_date">Date SM</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="text" id="st_date" name="st_date" readonly>
                    </div>
                </div>

                <div class="row form-group text-center">
                    <div class="col-12 form-group mb-3">
                        <label for="st_id_analysis">ID Analysis</label>
                        <select class="form-select text-success fw-bold" name="st_id_analysis" id="st_id_analysis">
                            @foreach ($data_analisa as $keys=>$values)
                            <option value="{{ $values->id_analysis }}">{{ $values->date.' : '.$values->code_sample_final }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformstatus()">Save</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

