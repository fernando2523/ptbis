@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/asset">ASSET</a></li>
        <li class="breadcrumb-item active">ASSETT PAGE</li>
    </ul>
    
    <h1 class="page-header">
        Asset
    </h1>
    
    <style>
         .button-hover{
            padding:0.5%;
            border-radius:5px;
         }

         .button-hover:hover{
            background-color:rgba(255,255,255,.15);
         }
    </style>

    <div class="mb-sm-3 mb-2 d-sm-flex">
        <div class="mt-sm-0 mt-2r" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modalLg" class="text-white text-opacity-75 text-decoration-none"><i class="fas fa-plus-circle fa-fw me-1 text-theme"></i> Add New Asset</a></div>
        <div class="ms-sm-3 mt-sm-0 mt-2 button-hover"><a href="#" class="text-white text-opacity-75 text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-theme"></i> Export CSV</a></div>
    </div>

    <div class="modal fade" id="modalLg" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-theme">NEW ASSET</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" method="POST" action="{{ url('asset/assets') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                        <input class="form-control formm-control-sm" type="hidden" name="id_stock" id="id_stock" value="{{ $nomorstok }}">
                        <input class="form-control formm-control-sm" type="hidden" name="id_transaction" id="id_transaction" value="{{ $nomor }}">
                        <input class="form-control formm-control-sm" type="hidden" name="date" id="date" value="{{ $tanggalskrg }}">
                        <input class="form-control formm-control-sm" type="hidden" name="users" id="users" value="{{ auth::user()->name; }}">
                    </div>
					<div class="col-12 form-group mb-3">
                        <label class="form-label">Material</label>
                        <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="material" id="material" required placeholder="Please provide a name material" autocomplete="OFF">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="row form-group">
                        <div class="col-2 form-group">
                            <label class="form-label">Qty</label>
                            <input id="qty" type="number" class="form-control formm-control-sm text-theme" name="qty"  onkeyup="qtyxprice()" placeholder="Qty" required>
                        </div>
                        <div class="col-2 form-group">
                            <label class="form-label">Price</label>
                            <input id="price" type="text" class="form-control formm-control-sm text-theme" name="price" onkeyup="qtyxprice()" placeholder="Price" required autocomplete="OFF">
                        </div>

                        <script>
                            function qtyxprice() {
                                var price = document.getElementById("price").value;
                                var qty = document.getElementById("qty").value;
                                document.getElementById("total_price").value = qty * price;
                            }
                        </script>

                        <div class="col-2 form-group">
                            <label class="form-label">Total Price</label>
                            <input id="total_price" type="text" class="form-control formm-control-sm text-theme" name="total_price" required readonly>
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Supplier</label>
                            <input id="supplier" type="text" class="form-control formm-control-sm text-theme" name="supplier" placeholder="Supplier" required autocomplete="OFF">
                            
                        </div>
                        
                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Desc</label>
                            <input id="desc" type="text" class="form-control formm-control-sm text-theme" name="desc" placeholder="Optional.." autocomplete="OFF">
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Unit</label>
                            <select class="form-select text-theme" id="unit" name="unit" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="PCS">PCS</option>
                                <option value="PACKAGE">PACKAGE</option>
                                <option value="BOX">BOX</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Unit.
                            </div>
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Type Material</label>
                            <select class="form-select text-theme" id="type_asset" name="type_asset" required onchange="status_jerigen()">
                                <option value="" disabled selected>Choose</option>
                                @if (auth::user()->role === "SUPER-ADMIN")
                                <option value="ASET TETAP">ASET TETAP</option>
                                <option value="BAHAN BAKU">BAHAN BAKU</option>
                                <option value="JERIGEN">JERIGEN</option>
                                @else
                                <option value="ASET TETAP">ASET TETAP</option>
                                <option value="BAHAN BAKU">BAHAN BAKU</option>
                                @endif
                                
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Type Material.
                            </div>
                        </div>

                        <div class="col-10 form-group mb-3">
                        </div>
                        <div class="col-2 form-group mb-3 text-right" id="div_jerigen"  style="display:none;">
                            <label class="form-label">Volume Jerigen</label>
                            <input id="isi_jerigen" type="number" class="form-control formm-control-sm text-theme" name="isi_jerigen" autocomplete="OFF">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                        </div>
				</div>
                
            </form>
			</div>
		</div>
	</div>

    <script>
        function status_jerigen() {
            var select = document.getElementById('type_asset');
            var value = select.options[select.selectedIndex].value;

            if (value == 'JERIGEN') {
                document.getElementById("div_jerigen").style.display = 'block';
            } else {
                document.getElementById("div_jerigen").style.display = 'none';
            }
        }
    </script>

<div class="row">
    <!-- TOTAL STOCK -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">TOTAL STOCK</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ $totalstock }}</h3>
                    </div>
                    <div class="col-4 text-theme">
                        <i  style="font-size: 40px;" class="bi bi-archive-fill"></i>
                    </div>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
    <!-- END -->
    
    <!-- ASSET TETAP -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">ASSET TETAP</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ $totalasset }}</h3>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-pie-chart-fill"></i>
                    </div>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
    <!-- END -->
    
    <!-- BAHAN BAKU -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">BAHAN BAKU</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ $totalbahanbaku }}</h3>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-pie-chart"></i>
                    </div>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
    <!-- END -->
    
    <!-- VALUE ASSET -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">VALUE ASSET</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ currency_IDR($purchased) }}</h3>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
    <!-- END -->

    <!-- DATA ASSSET -->
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA ASSETS</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="search_assets" class="form-control ps-35px" placeholder="Search assets.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_assets">
                        <thead style="font-size: 10px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: white !important;">NO</th>
                                <th class="text-center" width="10%" style="color: white !important;">ID</th>
                                <th class="text-center" width="10%" style="color: white !important;">DATE</th>
                                <th class="text-center" width="17%" style="color: white !important;">MATERIAL</th>
                                <th class="text-center" width="5%" style="color: white !important;">QTY</th>
                                <th class="text-center" width="5%" style="color: white !important;">UNIT</th>
                                <th class="text-center" width="10%" style="color: white !important;">TYPE ASSET</th>
                                <th class="text-center" style="width: 5%;color: white !important;">RESTOCK</th>
                                <th class="text-center" style="width: 10%;color: white !important;">OUT STOCK</th>
                                <th class="text-center" style="width: 8%;color: white !important;">ACT</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 9px;" align="center">
                        </tbody>
                    </table>
                    <br>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
    <!-- END -->

    
    <div class="col-xl-4">
        <div class="card mb-3" >
            <div class="card-body" style="height: 460px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">ACTIVITY LOG</span>
                    <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-2px small text-nowrap">
                        <tbody>
                            @foreach ($history as $keys=>$values)
                            <tr>
                                <td width="50%">
                                    <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                        @if ($values->in_out === "IN")
                                        <i class="bi bi-circle-fill fs-6px text-success me-2"></i>
                                        @else
                                        <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>
                                        @endif
                                        {{ $values->material }}
                                    </span>
                                </td>

                                <td width="20%" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>
                                
                                @if ($values->in_out === "IN")
                                <td width="5%" style="font-weight: bold;"><small>{{ $values->qty }}</small></td>
                                @elseif ($values->in_out === "OUT")
                                <td width="5%" style="font-weight: bold;"><small>{{ $values->qty }}</small></td>
                                @else
                                <td width="5%" style="font-weight: bold;"><small>-</small></td>
                                @endif
                                <td align="right" width="25%">
                                    @if ($values->in_out === "IN")
                                    <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "OUT")
                                    <span class="badge d-block bg-warning rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "DELETED")
                                    <span class="badge d-block bg-danger rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "EDITED")
                                    <span class="badge d-block bg-primary rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul align="right" class="mt-3">
                        <a type="button" href="/asset/history"  class="btn btn-outline-theme btn-sm">See All</a>
                        </ul>
                </div>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
        </div>
    </div>
</div>

{{-- begin --}}
<!-- required css -->
<link href="{{ URL::asset('/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css'); }}" rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'); }}" rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css'); }}" rel="stylesheet" />

<!-- required js -->
<script src="{{ URL::asset('/assets/plugins/datatables.net/js/jquery.dataTables.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.print.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js'); }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js'); }}"></script>
<script type="text/javascript">
$(function () {

var table = $('#tb_assets').DataTable({
lengthMenu: [ 15],
responsive: true,
processing: false,
serverSide: true,
ajax: "/datatable",
columns: [
    {data: 'DT_RowIndex', name: 'id',
    searchable: false},
    {data: 'id_stock', name: 'id_stock',
    searchable: true},
    {data: 'date', name: 'date',
    searchable: false},
    {data: 'material', name: 'material',
    searchable: true},
    {data: 'qty', name: 'qty',  
    searchable: false},
    {data: 'unit', name: 'unit',
    searchable: false},
    {data: 'type_asset', name: 'type_asset',
    searchable: false},
    
    {data: 'restock', name: 'restock',},
    {data: 'outstock', name: 'outstock',},
    {data: 'action', name: 'action',},
    ],
dom: 'tip',
// "ordering" : true,
order: [[0, 'desc']],
columnDefs: [
    { orderable: false, targets: [5,6,7,8,9] },
    {
        targets: 0,
        className: 'fw-bold'
    },
    {
        targets: 1,
        className: 'text-theme fw-bold'
    }
  ],
});

$(document).ready(function() {
    var isAdmin = "{{ (auth::user()->role) }}";
    if (isAdmin === "SUPER-ADMIN") {
        table.column(9).visible(true);
    } else {
        table.column(9).visible(false);
    }
});

$('#search_assets').on( 'keyup', function () {
    table.search(this.value).draw();
} );

$('#tb_assets tbody').on('click', '#restock_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodalrestock(data.id,data.id_stock,data.type_asset,data.material,data.unit);
});

$('#tb_assets tbody').on('click', '#outstock_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaloutstock(data.id,data.id_stock,data.type_asset,data.material,data.unit);
});

$('#tb_assets tbody').on('click', '#edit_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaledit(data.id,data.material,data.unit,data.type_asset);
});

$('#tb_assets tbody').on('click', '#delete_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaldelete(data.id);
});

});
// end
</script>

@include('asset.delete')
@include('asset.edit')
@include('asset.outstock')
@include('asset.restock')

<script>
    // restock
    function openmodalrestock(id,id_stock, type_asset,material,unit) {
        $('#modalrestock').modal('show');
        document.getElementById('r_id').value = id;
        document.getElementById('r_id_stock').value = id_stock;
        document.getElementById('r_type_asset').value = type_asset;
        document.getElementById('r_material').value = material;
        document.getElementById('r_unit').value = unit;
    }

    function submitformrestock() {
        if (document.forms["form_restock"]["r_qty"].value == "") {
                alert("Please input qty");
                document.forms["form_restock"]["r_qty"].focus();
                return false;
        }

        if (document.forms["form_restock"]["r_price"].value == "") {
                alert("Please input price");
                document.forms["form_restock"]["r_price"].focus();
                return false;
        }

        if (document.forms["form_restock"]["r_supplier"].value == "") {
                alert("Please input supplier");
                document.forms["form_restock"]["r_supplier"].focus();
                return false;
        }

        if (document.forms["form_restock"]["r_unit"].value == "") {
                alert("Please iselect a valid unit");
                document.forms["form_restock"]["r_unit"].focus();
                return false;
        }

        var value = document.getElementById('r_id').value;
        document.getElementById('form_restock').action = "../restock/"+value;
        document.getElementById("form_restock").submit();
    }

    // outstock
    function openmodaloutstock(id,id_stock, type_asset,material,unit) {
        $('#modaloutstock').modal('show');
        document.getElementById('o_id').value = id;
        document.getElementById('o_id_stock').value = id_stock;
        document.getElementById('o_type_asset').value = type_asset;
        document.getElementById('o_material').value = material;
        document.getElementById('o_unit').value = unit;
    }

    function submitformoutstock() {
        if (document.forms["form_outstock"]["o_qty"].value == "") {
                alert("Please provide a qty");
                document.forms["form_outstock"]["o_qty"].focus();
                return false;
        }

        var value = document.getElementById('o_id').value;
        document.getElementById('form_outstock').action = "../outstockact/"+value;
        document.getElementById("form_outstock").submit();
    }

    // edit
    function openmodaledit(id,material, unit, type_asset) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_material').value = material;
        
        document.getElementById("e_unitdefault").innerHTML = "DEFAULT : " + unit;
        document.getElementById("e_type_assetdefault").innerHTML = "DEFAULT : " + type_asset;

        document.getElementById("e_unitdefault").value = unit;
        document.getElementById("e_type_assetdefault").value = type_asset;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

@endsection