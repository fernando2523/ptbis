<form id="form_outstock" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaloutstock" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">REFILL FUEL IN OFFICE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    {{-- <input class="form-control formm-control-sm" type="text" name="o_id_stock" id="o_id_stock"> --}}
                    <input class="form-control formm-control-sm" type="hidden" name="o_id_transaction" value="{{ $nomor }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_id_activity" value="{{ $idact }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_date" value="{{ $tanggalskrg }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_users" value="{{ auth::user()->name; }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_type_asset" value="BBM">
                    <input class="form-control formm-control-sm" type="hidden" name="o_location" value="OFFICE">
                    <input class="form-control formm-control-sm" type="hidden" name="o_stock_from" value="OFFICE">
                    <input class="form-control formm-control-sm" type="hidden" name="o_device" value="PC/LAPTOP">
                    <input class="form-control formm-control-sm" type="hidden" name="o_server" value="ONLINE">
                    <input class="form-control formm-control-sm" type="hidden" name="o_hour" value="{{ $time }}">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <select class="form-select text-theme" id="o_id_stock" name="o_id_stock" required>
                            <option value="" disabled selected>Choose Fuel</option>
                            @foreach ($datareceiver as $datas)
                            <option value="{{ $datas->id_stock }}">{{ $datas->material }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Fuel.
                        </div>
                    </div>
                </div>

                <div class="row form-group mb-3">
                    <div class="col-10 form-group position-relative mb-3">
                        <label class="form-label">Unit</label>
                        <select class="form-select text-theme" id="o_unit" name="o_unit" required>
                            <option value="" disabled selected>Choose</option>
                            <option value="LITER">LITER</option>
                            @foreach ($jerigen as $jerigen2)
                            <option value="{{ $jerigen2->material }}">{{ $jerigen2->material }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Unit.
                        </div>
                    </div>

                    <div class="col-2 form-group">
                        <label class="form-label">Qty</label>
                        <input  type="number" class="form-control formm-control-sm text-success" id="o_qty" name="o_qty" value="" placeholder="Qty" required autocomplete="OFF">
                    </div>
                    
                    <div class="col-4 form-group position-relative mb-3">
                        <label class="form-label">Vehicle</label>
                        <select class="form-select text-theme" id="o_vehicle_id" name="o_vehicle_id" required>
                            <option value="" disabled selected>Choose Vehicle</option>
                            @foreach ($datavehicle as $vehic)
                            <option value="{{ $vehic->vehicle_id }}">{{ $vehic->vehicle_unit }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid Vehicle.
                        </div>
                    </div>
                    <div class="col-4 form-group position-relative mb-3">
                        <label class="form-label">Operator / Driver</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="o_operator" id="o_operator" required placeholder="Please provide a Operator name" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col-4 form-group position-relative mb-3">
                        <label class="form-label">PIC Refill</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="o_pic" id="o_pic" required placeholder="Please provide a PIC name" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    
                    <div class="col-12 form-group mb-3">
                            <label class="form-label">Desc</label>
                            <input type="text" class="form-control formm-control-sm text-success" name="o_desc" placeholder="Optional.." autocomplete="OFF">
                    </div>
                </div>

                </div>
                    
                <div class="form-group mb-3 me-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformoutstock()">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>