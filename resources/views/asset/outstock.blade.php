<form id="form_outstock" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaloutstock" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">OUTSTOCK ASSET</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="o_id">
                    <input class="form-control formm-control-sm" type="hidden" name="o_id_stock" id="o_id_stock">
                    <input class="form-control formm-control-sm" type="hidden" name="o_id_transaction" value="{{ $nomor }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_date" value="{{ $tanggalskrg }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_users" value="{{ auth::user()->name; }}">
                    <input class="form-control formm-control-sm" type="hidden" name="o_type_asset" id="o_type_asset">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="o_material" name="o_material" required readonly>
                    </div>
                </div>

                <div class="row form-group mb-3">
                    <div class="col-2 form-group mb-3">
                        <label class="form-label">Unit</label>
                        <input class="form-control formm-control-sm" type="text" name="o_unit" id="o_unit" readonly>
                    </div>
                
                    <div class="col-2 form-group">
                        <label class="form-label">Qty</label>
                        <input  type="text" class="form-control formm-control-sm text-success" id="o_qty" name="o_qty"  onkeyup="o_qtyxprice()" placeholder="Qty" required autocomplete="OFF">
                    </div>

                <div class="col-8 form-group mb-3">
                        <label class="form-label">Desc</label>
                        <input type="text" class="form-control formm-control-sm text-success" name="o_desc" placeholder="Optional.." autocomplete="OFF">
                </div>
                </div>

                    <script>
                        function o_qtyxprice() {
                            var price = document.getElementById("o_price").value;
                            var qty = document.getElementById("o_qty").value;
                            document.getElementById("o_total_price").value = qty * price;
                        }
                    </script>

                </div>
                    
                <div class="form-group mb-3 me-3" align="right">
                    <button class="btn btn-theme" type="button" onclick="submitformoutstock()">Save</button>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>