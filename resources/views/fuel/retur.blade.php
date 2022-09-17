<form id="form_retur" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modalretur" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">RETUR FUEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="rt_id">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_id_stock" id="rt_id_stock">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_id_transaction" value="{{ $nomor }}">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_date" value="{{ $tanggalskrg }}">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_users" value="{{ auth::user()->name; }}">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_type_asset" id="rt_type_asset" value="BBM">
                    <input class="form-control formm-control-sm" type="hidden" name="rt_qty" id="rt_qty">
                </div>
                

                <div class="row form-group">
                    <div class="col-12 form-group position-relative mb-3">
                        <label class="form-label">ID Activity</label>
                        <select class="form-select text-theme" id="rt_act" name="rt_act" required>
                            <option value="" disabled selected>Choose</option>
                            @foreach ($act as $act2)
                            <option value="{{ $act2->id_activity }}">{{ $act2->date }} - {{ $act2->id_activity }} ({{ $act2->qty }} - {{ $act2->unit }}) | ({{ $act2->vehicle }} - {{ $act2->pic }})</option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            Please select a valid ID Activity.
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-10 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="rt_material" name="rt_material" required readonly>
                    </div>

                    <div class="col-2 form-group">
                        <label class="form-label">Qty</label>
                        <input  type="number" class="form-control formm-control-sm text-success" id="rt_qty_new" name="rt_qty_new" placeholder="Qty" required autocomplete="OFF">
                    </div>

                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Desc</label>
                        <input type="text" class="form-control formm-control-sm text-success" name="rt_desc" placeholder="Optional.." autocomplete="OFF">
                    </div>
                </div>

                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformretur()">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>

