@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/fuel">FUEL</a></li>
            <li class="breadcrumb-item active">FUEL DELIVERY PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Fuel Delivery
        </h1>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Create Delivery</a>
        </div>
    </div>
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
        <div class="mt-sm-0 mt-2 button-hover"><a href="#" class="text-white text-opacity-75 text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-theme"></i> Export CSV</a></div>
    </div>

    <div class="modal fade" id="modaladd" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-theme">NEW DELIVERY</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" id="form_add" method="POST" action="{{ url('store') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                    <input id="id_activity" type="hidden" class="validate" value="{{ $idact }}" name="id_activity">
                    <input id="date" type="hidden" class="validate" name="date" value="{{ $tanggalskrg }}">
                    <input id="stocker" type="hidden" class="validate" name="stocker" value="{{ auth::user()->name; }}">
                    <input id="device_stocker" type="hidden" class="validate" name="device_stocker" value="LAPTOP ASUS">
                    <input id="hour_stocker" type="hidden" class="validate" name="hour_stocker" value="{{ $time }}">
                    <input id="server_stocker" type="hidden" class="validate" name="server_stocker" value="ONLINE">
                    </div>
					<div class="col-12 form-group mb-3">
                        <div class="col-12 form-group position-relative mb-3">
                            <label class="form-label">Material</label>
                            <select class="form-select text-theme" id="id_stock" name="id_stock" required>
                                <option value="" disabled selected>Choose Fuel</option>
                                @foreach ($datafuel as $datas)
                                <option value="{{ $datas->id_stock }}">{{ $datas->material }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Fuel.
                            </div>
                        </div>
                    </div>
                   
                    <div class="row form-group">
                        <div class="col-2 form-group">
                            <label class="form-label">Qty</label>
                            <input id="qty" type="number" class="form-control formm-control-sm text-theme" name="qty" placeholder="Qty" required>
                        </div>
                        <div class="col-3 form-group position-relative mb-3">
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
                        <div class="col-4 form-group">
                            <label class="form-label">PIC</label>
                            <input id="pic" type="text" class="form-control formm-control-sm text-theme" name="pic" placeholder="PIC" required>
                        </div>
                        <div class="col-3 form-group position-relative mb-3">
                            <label class="form-label">Vehicle</label>
                            <select class="form-select text-theme" id="vehicle" name="vehicle" required>
                                <option value="" disabled selected>Choose</option>
                                @foreach ($vehicle as $vehicle2)
                                <option value="{{ $vehicle2->type_vehicle }}">{{ $vehicle2->type_vehicle }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Vehicle.
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit" onclick="validasi()">Save</button>
                    </div>
				</div>
            </form>
			</div>
		</div>
	</div>

<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-2">
                        <span class="flex-grow-1">FUEL DELIVERY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="search_stocker" class="form-control ps-35px" placeholder="Search delivery.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_stocker">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">ID FUEL</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">DATE</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">FUEL</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">QTY</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">UNIT</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">STOCKER</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">HOUR</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">PIC</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">VEHICLE</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">RETURN</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">QR CODE</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">ACT</th>
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
var table = $('#tb_stocker').DataTable({
lengthMenu: [ 15],
responsive: true,
processing: false,
serverSide: true,
ajax: "/datatablefuel_stocker",
columns: [
    {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
    searchable: false},
    {data: 'id_activity', name: 'id_activity', class : 'text-center text-theme fw-bold',
    searchable: true},
    {data: 'date', name: 'date', class : 'text-center',
    searchable: false},
    {data: 'material', name: 'material', class : 'text-center',
    searchable: true},
    {data: 'qty', name: 'qty', class : 'text-center fw-bold text-success',
    searchable: false},
    {data: 'unit', name: 'unit', class : 'text-center',
    searchable: false},
    {data: 'stocker', name: 'stocker', class : 'text-center',
    searchable: true},
    {data: 'hour_stocker', name: 'hour_stocker', class : 'text-center',
    searchable: false},
    {data: 'pic', name: 'pic', class : 'text-center',
    searchable: false},
    {data: 'vehicle', name: 'vehicle', class : 'text-center text-warning fw-bold',
    searchable: false},
    {data: 'retur', name: 'retur', class : 'text-center fw-bold text-warning',
    searchable: false},

    {data: 'qrcodes', name: 'qrcodes', class : 'text-center',
        "render": function (data, type, row) {
            return '<span><a class="text-secondary" style="cursor: pointer;" id="qrcodes_btn" onclick="openmodalqr('+"'"+row.id_stock+"'"+','+"'"+row.id_activity+"'"+',)"><i class="fas fa-xl fa-qrcode"></i></a></span>';
        },
    },

    {data: 'action', name: 'action', class : 'text-center',
    "render": function (data, type, row) {
            return '<span><a class="text-danger" style="cursor: pointer;" id="delete_btn" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
        },
    },
],
dom: 'tip',
// "ordering" : true,
order: [[1, 'desc']],
columnDefs: [
    
    { orderable: false, targets: [6,7,8,9,10,11] },

],
});

$(document).ready(function() {
    var isAdmin = "{{ (auth::user()->role) }}";
    if (isAdmin === "SUPER-ADMIN") {
        table.column(12).visible(true);
    } else {
        table.column(12).visible(false);
    }
});

$('#search_stocker').on( 'keyup', function () {
    table.search(this.value).draw();
} );


$('#tb_stocker tbody').on('click', '#qrcodes_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaloutstock(data.id_stock,data.id_activity);
});


$('#tb_stocker tbody').on('click', '#delete_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaldelete(data.id);
});

});
// end
</script>




@include('fueldelivery.qr')
@include('fueldelivery.delete')
<script>
    // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../fueldelivery/destroy/"+value;
        document.getElementById("form_delete").submit();
    }

    function validasi() {
        if (document.forms["form_add"]["o_unit"].value == "") {
                alert("Select a valid fuel");
                document.forms["form_add"]["o_unit"].focus();
                return false;
        }
    }

    // qr
    function openmodalqr(id_stock,id_activity) {
        document.getElementById('m_id_activity').innerHTML = id_activity;
        $('#modalqr').modal('show');
        setiframe(id_activity);
    }

    function setiframe(qr_code){
        document.getElementById('ifrm').src = "/load_barcode/"+qr_code;
    }
</script>
@endsection