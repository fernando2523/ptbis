@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/fuel">FUEL</a></li>
        <li class="breadcrumb-item active">FUEL PAGE</li>
    </ul>
    
    <h1 class="page-header">
        Fuel
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
        <div class="mt-sm-0 mt-2" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modalLg"><i class="fa fa-plus-circle fa-fw me-1"></i> Add New Fuel</a></div>
        <div class="ms-sm-3 mt-sm-0 mt-2" style="cursor: pointer;" ><a class="btn btn-outline-indigo" data-bs-toggle="modal" data-bs-target="#modaloutstock"><i class="bi bi-droplet-half me-1"></i> Fuel Refill</a></div>
        <div class="ms-sm-3 mt-sm-0 mt-2"><a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export</a></div>
    </div>

    <div class="modal fade" id="modalLg" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-theme">NEW FUEL</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" method="POST" action="{{ url('fuel/fuel') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                    <input id="id_stock" type="hidden" class="validate" value="{{ $nomorstok }}" name="id_stock">
                    <input id="id_transaction" type="hidden" class="validate" value="{{ $nomor }}" name="id_transaction">
                    <input id="date" type="hidden" class="validate" name="date" value="{{ $tanggalskrg }}">
                    <input id="type_asset" type="hidden" class="validate" name="type_asset" value="BBM">
                    <input id="users" type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
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

                        <div class="col-12 form-group position-relative mb-3">
                            <label class="form-label">Unit</label>
                            <select class="form-select text-theme" id="unit" name="unit" required>
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

                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                        </div>
				</div>
            </form>
			</div>
		</div>
	</div>

<div class="row">
    <!-- TOTAL STOCK -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">AVG VALUE</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ currency_IDR($purchased) }}</h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i  style="font-size: 40px;" class="bi bi-cash-stack"></i>
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
                    <span class="flex-grow-1">FUEL STOCK</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ $fuel_stock }} <small>Liter</small></h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi bi-moisture"></i>
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
                    <span class="flex-grow-1">FUEL DELIVERY</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <?php $hasiltotal=0; ?>
                        @foreach ($fuel_stoker as $key=>$values3)
                        @foreach ($jerigen as $key=>$jerigens)
                            @if ($values3->unit === $jerigens->material)
                                 <?php $hasiltotal = $hasiltotal + (intval($values3->qty) * intval($jerigens->isi_jerigen)) ?>
                            @endif
                        @endforeach
                    @endforeach

                        <h5 class="mb-0">{{ $hasiltotal }} <small>Liter</small></h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-truck"></i>
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
                    <span class="flex-grow-1">FUEL REFILL</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ $fuel_refill }} <small>Liter</small></h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-droplet-half"></i>
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
            <div class="card-body p-3" style="height: 460px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA FUEL</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="search_fuel" class="form-control ps-35px" placeholder="Search fuel.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_fuel">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">ID FUL</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">DATE</th>
                                <th class="text-center" width="17%" style="color: #a8b6bc !important;">MATERIAL</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">QTY</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">UNIT</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">TYPE FUEL</th>
                                <th class="text-center" style="width: 5%;color: #a8b6bc !important;">RESTOCK</th>
                                <th class="text-center" style="width: 8%;color: #a8b6bc !important;">RETURN</th>
                                {{-- <th class="text-center" style="width: 8%;color: #a8b6bc !important;">REFILL</th> --}}
                                <th class="text-center" style="width: 8%;color: #a8b6bc !important;">ACT</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 11px;">
                        </tbody>
                    </table>
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
                                @elseif ($values->in_out === "REFILL IN OFFICE")
                                <td width="5%" style="font-weight: bold;"><small>{{ $values->qty }}</small></td>
                                @elseif ($values->in_out === "FUEL DELIVERY")
                                <td width="5%" style="font-weight: bold;"><small>{{ $values->qty }}</small></td>
                                @elseif ($values->in_out === "RETUR")
                                <td width="5%" style="font-weight: bold;"><small>{{ $values->qty }}</small></td>
                                @else
                                <td width="5%" style="font-weight: bold;"><small>-</small></td>
                                @endif
                                <td align="right" width="25%">
                                    @if ($values->in_out === "IN")
                                    <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-100px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "REFILL IN OFFICE")
                                    <span class="badge d-block bg-indigo rounded-0 bg-opacity-75 pt-5px w-100px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "DELETED")
                                    <span class="badge d-block bg-danger rounded-0 pt-5px w-100px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "EDITED")
                                    <span class="badge d-block bg-primary rounded-0 pt-5px w-100px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "FUEL DELIVERY")
                                    <span class="badge d-block bg-yellow rounded-0 bg-opacity-75 pt-5px w-100px" style="min-height: 18px;font-size: 10px;">{{ $values->in_out }}</span>
                                    @elseif ($values->in_out === "RETUR")
                                    <span class="badge d-block bg-warning rounded-0 pt-5px w-100px" style="min-height: 18px;font-size: 10px;;">{{ $values->in_out }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul align="right" class="mt-3">
                        <a type="button" href="/fuel/history"  class="btn btn-outline-theme btn-sm">See All</a>
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

    <!-- FUEL DELIVERY -->
    <div class="col-xl-12">
        <div class="card mb-3">
            <div class="card-body p-3" style="height: 330px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">FUEL DELIVERY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%">NO</th>
                                <th class="text-center" width="7%">ID ACT</th>
                                <th class="text-center" width="7%">DATE</th>
                                <th class="text-center" width="7%">STOCKER</th>
                                <th class="text-center" width="7%">FUEL</th>
                                <th class="text-center" width="5%">QTY</th>
                                <th class="text-center" width="10%">UNIT</th>
                                <th class="text-center" width="5%">HOUR</th>
                                <th class="text-center" width="12%">PIC</th>
                                <th class="text-center" width="12%">VEHICLE</th>
                                <th class="text-center" width="3%">RETURN</th>
                                <th class="text-center" width="5%">SERVER</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 11px;">
                            @foreach ($delivery as $key=>$deliv)
                            <tr>
                                <td class="text-center" width="2%" style="font-weight: bold;">{{ ++$key }}</td>
                                <td class="text-center text-theme" width="10%" style="font-weight: bold;">{{ $deliv->id_activity }}</td>
                                <td class="text-center" width="10%">{{ $deliv->date }}</td>
                                <td class="text-center" width="10%">{{ $deliv->stocker }}</td>
                                <td class="text-center" width="7%">{{ $deliv->material }}</td>
                                <td class="text-center" width="5%">{{ $deliv->qty }}</td>
                                <td class="text-center" width="10%">{{ $deliv->unit }}</td>
                                <td class="text-center" style="width: 5%">{{ $deliv->hour_stocker }}</td>
                                <td class="text-center" style="width: 12%">{{ $deliv->pic }}</td>
                                <td class="text-center" style="width: 12%">{{ $deliv->vehicle }}</td>

                                @if ($deliv->retur === "")
                                <td class="text-center fw-bold" style="width: 5%">{{ $deliv->retur }}</td>
                                @elseif ($deliv->retur === "0")
                                <td class="text-center fw-bold" style="width: 5%">{{ $deliv->retur }}</td>
                                @else
                                <td class="text-center fw-bold text-danger" style="width: 5%">{{ $deliv->retur }}</td>
                                @endif

                                @if ($deliv->server_stocker === "ONLINE")
                                <td class="text-center text-success" style="width: 5%;font-weight: bold;">{{ $deliv->server_stocker }}</td>
                                @else
                                <td class="text-center text-danger" style="width: 5%;font-weight: bold;">{{ $deliv->server_stocker }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
            <ul align="right" class="mt-3 me-4">
                <a type="button" href="/fuel-delivery"  class="btn btn-outline-theme btn-sm">See All</a>
            </ul>
        </div>
    </div>
    <!-- END -->

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: 330px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">FUEL REFILL</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%">NO</th>
                                <th class="text-center" width="5%">ID ACT</th>
                                <th class="text-center" width="6%">DATE</th>
                                <th class="text-center" width="5%">MATERIAL</th>
                                <th class="text-center" width="5%">VEHICLE</th>
                                <th class="text-center" width="5%">OPERATOR</th>
                                <th class="text-center" width="3%">QTY</th>
                                <th class="text-center" width="6%">UNIT</th>
                                <th class="text-center" width="12%">LOCATION</th>
                                <th class="text-center" width="5%">HOUR</th>
                                <th class="text-center" width="5%">SERVER</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 11px;">
                            @foreach ($refill as $key=>$reff)
                            <tr>
                                <td class="text-center" width="2%" style="font-weight: bold;">{{ ++$key }}</td>
                                <td class="text-center text-theme" width="5%" style="font-weight: bold;">{{ $reff->id_activity }}</td>
                                <td class="text-center" width="6%">{{ $reff->date }}</td>
                                <td class="text-center" width="5%">{{ $reff->material }}</td>
                                <td class="text-center fw-bold text-theme" width="5%">{{ $reff->vehicle_unit }}</td>
                                <td class="text-center" width="5%">{{ $reff->operator }}</td>
                                <td class="text-center" width="3%">{{ $reff->qty }}</td>
                                <td class="text-center" width="6%">{{ $reff->unit }}</td>
                                <td class="text-center" width="12%">{{ $reff->location }}</td>
                                <td class="text-center" width="5%">{{ $reff->hour }}</td>
                                @if ($reff->server === "ONLINE")
                                <td class="text-center text-success" width="5%" style="font-weight: bold;">{{ $reff->server }}</td>
                                @else
                                <td class="text-center text-danger" width="5%" style="font-weight: bold;">{{ $reff->server }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <div class="card-arrow">
                <div class="card-arrow-top-left"></div>
                <div class="card-arrow-top-right"></div>
                <div class="card-arrow-bottom-left"></div>
                <div class="card-arrow-bottom-right"></div>
            </div>
            <ul align="right" class="mt-3 me-4">
                <a type="button" href="/fuel-refill"  class="btn btn-outline-theme btn-sm">See All</a>
            </ul>
        </div>
    </div>
</div>

@include('fuel.retur')
@include('fuel.outstock')
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
    
var table = $('#tb_fuel').DataTable({
lengthMenu: [ 15],
responsive: true,
processing: false,
serverSide: true,
ajax: "/datatablefuel",
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

    {data: 'restock', name: 'restock',
        "render": function (data, type, row) {
            return '<span><a class="theme-success" style="cursor: pointer;" onclick="openmodalrestock('+"'"+row.id+"'"+','+"'"+row.id_stock+"'"+','+"'"+row.type_asset+"'"+','+"'"+row.material+"'"+')" style="cursor: pointer;"><i class="fas fa-xl fa-retweet"></i></a></span>';
        },
    },

    {data: 'retur', name: 'retur',
        "render": function (data, type, row) {
            return '<span><a class="text-yellow" style="cursor: pointer;" onclick="openmodalretur('+"'"+row.id+"'"+','+"'"+row.id_stock+"'"+','+"'"+row.material+"'"+','+"'"+row.qty+"'"+')" style="cursor: pointer;"><i class="fas fa-lg fa-fw fa-redo"></a></span>';
        },
    },

    {data: 'action', name: 'action',
    "render": function (data, type, row) {
            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.material+"'"+','+"'"+row.unit+"'"+')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
        },
    },
],
dom: 'tip',
// "ordering" : true,
order: [[1, 'desc']],
columnDefs: [
    
    { orderable: false, targets: [5,6,7,8,9] 
    },
    {
        targets: 0,
        className: 'text-center fw-bold'},
    {
        targets: 1,
        className: 'text-center text-theme fw-bold'},
    {
        targets: 2,
        className: 'text-center'},
    {
        targets: 3,
        className: 'text-center'},
    {
        targets: 4,
        className: 'text-center'},
    {
        targets: 5,
        className: 'text-center'},
    {
        targets: 6,
        className: 'text-center'},
    {
        targets: 7,
        className: 'text-center'},
    {
        targets: 8,
        className: 'text-center'},
        {
        targets: 9,
        className: 'text-center'},
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

$('#search_fuel').on( 'keyup', function () {
    table.search(this.value).draw();
} );
});
// end
</script>
@include('fuel.edit')
@include('fuel.delete')
@include('fuel.restock')

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
        document.getElementById('form_restock').action = "../fuel/restock/"+value;
        document.getElementById("form_restock").submit();
    }

    // retur
    function openmodalretur(id,id_stock,material,qty) {
        $('#modalretur').modal('show');
        document.getElementById('rt_id').value = id;
        document.getElementById('rt_id_stock').value = id_stock;
        document.getElementById('rt_material').value = material;
        document.getElementById('rt_qty').value = qty;
    }

    function submitformretur() {
        if (document.forms["form_retur"]["rt_qty_new"].value == "") {
                alert("Please input value");
                document.forms["form_retur"]["rt_qty_new"].focus();
                return false;
        }

        // if (document.forms["form_retur"]["rt_unit"].value == "") {
        //         alert("Select a valid unit");
        //         document.forms["form_retur"]["rt_unit"].focus();
        //         return false;
        // }

        var value = document.getElementById('rt_id').value;
        document.getElementById('form_retur').action = "../fuel/retur/"+value;
        document.getElementById("form_retur").submit();
    }

    // outstock
    function openmodaloutstock(id,id_stock,material) {
        $('#modaloutstock').modal('show');
        document.getElementById('o_id').value = id;
        document.getElementById('o_id_stock').value = id_stock;
        document.getElementById('o_material').value = material;
    }

    function submitformoutstock() {
        if (document.forms["form_outstock"]["o_unit"].value == "") {
                alert("Select a valid unit");
                document.forms["form_outstock"]["o_unit"].focus();
                return false;
        }

        if (document.forms["form_outstock"]["o_qty"].value == "") {
                alert("Please input value");
                document.forms["form_outstock"]["o_qty"].focus();
                return false;
        }

        if (document.forms["form_outstock"]["o_id_stock"].value == "") {
                alert("Please Select a valid material");
                document.forms["form_outstock"]["o_id_stock"].focus();
                return false;
        }
        if (document.forms["form_outstock"]["o_vehicle_id"].value == "") {
                alert("Please Select a valid vehicle");
                document.forms["form_outstock"]["o_vehicle_id"].focus();
                return false;
        }
        if (document.forms["form_outstock"]["o_operator"].value == "") {
                alert("Please provide a name operator");
                document.forms["form_outstock"]["o_operator"].focus();
                return false;
        }
        if (document.forms["form_outstock"]["o_pic"].value == "") {
                alert("Please provide a name PIC");
                document.forms["form_outstock"]["o_pic"].focus();
                return false;
        }

        // var value = document.getElementById('o_id').value;
        document.getElementById('form_outstock').action = "../fuel/outstockact";
        document.getElementById("form_outstock").submit();
    }

    // edit
    function openmodaledit(id,material, unit) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_material').value = material;
        
        document.getElementById("e_unitdefault").innerHTML = "DEFAULT : " + unit;

        document.getElementById("e_unitdefault").value = unit;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../fuel/editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../fuel/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>
@endsection