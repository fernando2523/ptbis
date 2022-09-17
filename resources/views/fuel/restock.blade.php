<form id="form_restock" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modalrestock" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">RESTOCK FUEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="r_id">
                    <input class="form-control formm-control-sm" type="hidden" name="r_id_stock" id="r_id_stock">
                    <input class="form-control formm-control-sm" type="hidden" name="r_id_transaction" value="{{ $nomor }}">
                    <input class="form-control formm-control-sm" type="hidden" name="r_date" value="{{ $tanggalskrg }}">
                    <input class="form-control formm-control-sm" type="hidden" name="r_users" value="{{ auth::user()->name; }}">
                    <input class="form-control formm-control-sm" type="hidden" name="r_type_asset" id="r_type_asset">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="r_material" name="r_material" required readonly>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-2 form-group">
                        <label class="form-label">Qty</label>
                        <input  type="text" class="form-control formm-control-sm text-success" id="r_qty" name="r_qty"  onkeyup="r_qtyxprice()" placeholder="Qty" required autocomplete="OFF">
                    </div>

                    <script>
                        function r_qtyxprice() {
                            var price = document.getElementById("r_price").value;
                            var qty = document.getElementById("r_qty").value;
                            document.getElementById("r_total_price").value = qty * price;
                        }
                    </script>
                    <div class="col-2 form-group">
                        <label class="form-label">Price</label>
                        <input  type="text" class="form-control formm-control-sm text-success" id="r_price" name="r_price" onkeyup="r_qtyxprice()" placeholder="Price" required autocomplete="OFF">
                    </div>

                <div class="col-2 form-group">
                    <label class="form-label">Total Price</label>
                    <input  type="text" class="form-control formm-control-sm text-success" id="r_total_price" name="r_total_price" required readonly>
                </div>

               
                <div class="col-6 form-group position-relative mb-3">
                    <label class="form-label">Supplier</label>
                    <input  type="text" class="form-control formm-control-sm text-success" name="r_supplier" placeholder="Supplier" required autocomplete="OFF">
                        
                </div>
                    
                <div class="col-12 form-group mb-3">
                    <label class="form-label">Desc</label>
                    <input type="text" class="form-control formm-control-sm text-success" name="r_desc" placeholder="Optional.." autocomplete="OFF">
                </div>

                <div class="col-12 form-group position-relative mb-3">
                    <label class="form-label">Unit</label>
                    <select class="form-select text-theme" id="r_unit" name="r_unit" required>
                        <option value="LITER">LITER</option>
                        @foreach ($jerigen as $jerigen2)
                        <option value="{{ $jerigen2->material }}">{{ $jerigen2->material }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-tooltip">
                        Please select a valid Unit.
                    </div>
                </div>
                <div class="form-group mt-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformrestock()">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>

