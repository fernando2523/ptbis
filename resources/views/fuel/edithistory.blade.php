<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
<div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:3%;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-theme">EDIT FUEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <input type="hidden" id="e_id">
                </div>

                <div class="row form-group">
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-success" type="text" id="e_material" required readonly>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-2 form-group">
                        <label class="form-label">Qty</label>
                        <input id="e_qty" type="number" class="form-control formm-control-sm text-theme" name="e_qty"  onkeyup="qtyxprice()" placeholder="Qty" required>
                    </div>
                    <div class="col-2 form-group">
                        <label class="form-label">Price</label>
                        <input id="e_price" type="text" class="form-control formm-control-sm text-theme" name="e_price" onkeyup="qtyxprice()" placeholder="Price" required autocomplete="OFF">
                    </div>

                    <script>
                        function qtyxprice() {
                            var price = document.getElementById("e_price").value;
                            var qty = document.getElementById("e_qty").value;
                            document.getElementById("e_total_price").value = qty * price;
                        }
                    </script>

                    <div class="col-2 form-group">
                        <label class="form-label">Total Price</label>
                        <input id="e_total_price" type="text" class="form-control formm-control-sm text-theme" name="e_total_price" required readonly>
                    </div>

                    <div class="col-6 form-group position-relative mb-3">
                        <label class="form-label">Supplier</label>
                        <input id="e_supplier" type="text" class="form-control formm-control-sm text-theme" name="e_supplier" placeholder="Supplier" required autocomplete="OFF">
                    </div>
                    
                    <div class="col-12 form-group mb-3">
                        <label class="form-label">Desc</label>
                        <input id="e_desc" type="text" class="form-control formm-control-sm text-theme" name="e_desc" placeholder="Optional.." autocomplete="OFF">
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

