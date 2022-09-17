<form id="form_edit" class="was-validated" method="POST" action="/">
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
                    <input type="hidden" id="e_id_ritase" name="e_id_ritase">
                    <input type="hidden" id="e_id_form" name="e_id_form">
                </div>

                <div class="row form-group">
                    {{-- <div class="col-5 form-group mb-3 text-center">
                       
                    </div> --}}
                    <div class="col-4 form-group mb-3  text-center">
                        <label class="form-label">IDENTIFY</label>
                        <select class="form-select text-theme text-center fw-bold" id="e_identify" name="e_identify" required>
                            <option class="text-default fw-bold" id="e_identify_default" selected>Choose</option>
                            @foreach ($getidentify as $keyidentify)
                            <option value="{{ $keyidentify->type_vehicle }}">{{ $keyidentify->type_vehicle }}</option>  
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Identify.
                        </div>
                    </div>
                    <div class="col-4 form-group mb-3  text-center">
                        <label class="form-label">OPERATOR</label>
                        <input class="form-control formm-control-sm text-success  text-center fw-bold" type="text" id="e_operator" name="e_operator" required autocomplete="off">
                    </div>
                    <div class="col-4 form-group mb-3 text-center">
                        <label class="form-label">MATERIAL</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="text" id="e_material" name="e_material" required autocomplete="off">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-4 form-group mb-3 text-center">
                        <label class="form-label">BUCKET</label>
                        <input class="form-control formm-control-sm text-success text-center fw-bold" type="number" id="e_bucket" name="e_bucket" required autocomplete="off">
                    </div>
                    <div class="col-4 form-group mb-3 text-center">
                        <label class="form-label">DEPARTURE LOC</label>
                        <select class="form-select text-theme text-center fw-bold" id="e_departure_location" name="e_departure_location" required>
                            <option class="text-default fw-bold" id="e_departure_location_default" selected>Choose</option>
                            @foreach ($getdeparture as $keydeparture)
                            <option value="{{ $keydeparture->location }}">{{ $keydeparture->location }}</option>  
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Type Vehicle.
                        </div>
                    </div>
                    <div class="col-4 form-group mb-3 text-center">
                        <label class="form-label">ARRIVAL LOC</label>
                        <select class="form-select text-theme text-center fw-bold" id="e_arrival_location" name="e_arrival_location" required>
                            <option class="text-default fw-bold" id="e_arrival_location_default" selected>Choose</option>
                            @foreach ($getarrival as $keyarrival)
                            <option value="{{ $keyarrival->location }}">{{ $keyarrival->location }}</option>  
                            @endforeach
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

