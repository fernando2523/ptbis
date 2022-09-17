@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/hauling/haulings">HAULING</a></li>
            <li class="breadcrumb-item active">REPORT DETAIL PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Report Detail Hauling
        </h1>
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
{{-- 
    <div class="mb-sm-3 mb-2 d-sm-flex">
        <div class=" mt-sm-0 mt-2"><a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a></div>
    </div> --}}

    {{-- <div class="modal fade" id="modaladd" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-theme">NEW VEHICLE</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" enctype="multipart/form-data" method="POST" action="{{ url('/vehicle/vehicles/store') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                        <input id="vehicle_id" type="hidden" class="validate" value="{{ $idvhc }}" name="vehicle_id">
                        <input id="users" type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                        <input id="status" type="hidden" class="validate" name="status" value="ACTIVE">
                    </div>
					
                    <div class="row form-group">
                        <div class="col-6 form-group mb-3">
                            <label class="form-label">Vehicle</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="vehicle_unit" id="vehicle_unit" required placeholder="Please provide a name vehicle" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-6 form-group mb-3">
                            <label class="form-label">Operator / Driver</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="operator" id="operator" required placeholder="Please provide a name operator" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Type Unit</label>
                            <select class="form-select text-theme" id="type_unit" name="type_unit" onchange="statusvehicle()" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="OWNED">OWNED</option>
                                <option value="CONTRACT">CONTRACT</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Type.
                            </div>
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Type Vehicle</label>
                            <select class="form-select text-theme" id="type_vehicle" name="type_vehicle" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="MOBIL">MOBIL</option>
                                <option value="MOTOR">MOTOR</option>
                                <option value="DUMP TRUCK">DUMP TRUCK</option>
                                <option value="EXCAVATOR">EXCAVATOR</option>
                                <option value="BULLDOZER">BULLDOZER</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Type Vehicle.
                            </div>
                        </div>

                        <div class="col-12 form-group position-relative mb-3" style="display:none;" id="isidiv" onchange="statuscontract()">
                            <label class="form-label">Contract</label>
                            <select class="form-select text-theme" id="contract" name="contract" required>
                                <option value="-" disabled selected>Choose</option>
                                <option value="EXPIRED DAYS">EXPIRED DAYS</option>
                                <option value="HOUR METER">HOUR METER</option>
                                <option value="RITASE">RITASE</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Type.
                            </div>
                        </div>
                        <div class="col-6 form-group mb-3" style="display:none;" id="isidiv2">
                            <label class="form-label">Days Contract</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="days" id="days" value="0" placeholder="Please provide how long day contract" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-6 form-group mb-3" style="display:none;" id="isidiv4">
                            <label class="form-label">Contract Nominal</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="price" id="price" value="0" placeholder="Please provide nominal contract" autocomplete="OFF" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-6 form-group mb-3" style="display:none;" id="isidiv3">
                            <label class="form-label">File Upload <small class="text-warning">optional</small></label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                    </div>
				</div>
            </form>
			</div>
		</div>
	</div> --}}

    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body" style="padding-bottom: 0px;">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">RITASE TODAY</span>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0">{{ $totalritase }} <small>Ritase</small></h5>
                        </div>
                        <div class="col-4 text-theme">
                            <i  style="font-size: 40px;" class="bi bi-truck"></i>
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

            <div class="card mb-3">
                <div class="card-body" style="padding-bottom: 0px;">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">BUCKET TODAY</span>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="mb-0">{{ $totalbucket }} <small>Bucket</small></h5>
                        </div>
                        <div class="col-4 text-theme">
                            <i style="font-size: 40px;" class="bi bi-minecart-loaded"></i>
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

        <div class="col-xl-9 col-lg-9">
            <div class="card mb-3" >
                <div class="card-body" style="height: 236px;">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">ACTIVITY HAULING LOG</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless mb-2px small text-nowrap">
                            <tbody>
                                @foreach ($datahistories as $keys=>$values)
                                <tr>
                                    <td width="40%">
                                        <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                            <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>
                                            {{ $values->id_ritase }}
                                        </span>
                                    </td>
                                    <td width="20%">
                                        <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                            {{ $values->identify }} 
                                        </span>
                                    </td>
                                    <td width="20%">
                                        <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                            {{ $values->operator }} 
                                        </span>
                                    </td>
                                    <td width="20%"  class="text-theme" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>
                                    <td align="right" width="20%">
                                        <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-150px" style="min-height: 18px;font-size: 10px;">ORIGIN : {{ $values->origin }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: auto;">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA REPORT DETAIL HAULING</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control ps-35px" id="search_hauling" placeholder="Search ritase.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_hauling">
                        <thead style="font-size: 10px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center"  width="6%" style="color: #a8b6bc !important;">ID</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">NOTA</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">IDENTIFY</th>
                                <th class="text-center" width="4%" style="color: #a8b6bc !important;">MODEL</th>
                                <th class="text-center"  width="6%" style="color: #a8b6bc !important;">OPERATOR</th>
                                <th class="text-center"  width="8%"  style="color: #a8b6bc !important;">DPTR TIME</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">ARVL TIME</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">MATERIAL</th>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">BUCKET</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">DEPARTURE</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">ARRIVAL</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">ACT</th>
                            </tr>
                        </thead>
                        
                        <tbody style="font-size: 10px;">
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
    var table = $('#tb_hauling').DataTable({
    lengthMenu: [10],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablehauling",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
        searchable: false},
        {data: 'id_ritase', name: 'id_ritase', class : 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'id_form', name: 'id_form', class : 'text-center',
        searchable: true},
        {data: 'identify', name: 'identify', class : 'text-center',
        searchable: true},
        {data: 'model_unit', name: 'model_unit', class : 'text-center fw-bold',
        searchable: true},
        {data: 'operator', name: 'operator', class : 'text-center',
        searchable: true},
        {data: 'departure_ts', name: 'departure_ts', class : 'text-center text-info',
        searchable: false},
        {data: 'arrival_ts', name: 'arrival_ts', class : 'text-center text-success',
        searchable: false},
        {data: 'material', name: 'material', class : 'text-center',
        searchable: true},
        {data: 'bucket', name: 'bucket', class : 'text-center',
        searchable: false},
        {data: 'departure_location', name: 'departure_location', class : 'text-center fw-bold text-info',
        searchable: true},
        {data: 'arrival_location', name: 'arrival_location', class : 'text-center  fw-bold text-success',
        searchable: true},
        {data: 'action', name: 'action', class : 'text-center',
            "render": function (data, type, row) {
            return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.id_ritase+"'"+','+"'"+row.identify+"'"+','+"'"+row.operator+"'"+','+"'"+row.material+"'"+','+"'"+row.bucket+"'"+','+"'"+row.departure_location+"'"+','+"'"+row.arrival_location+"'"+','+"'"+row.id_form+"'"+')"><i class="fas fa-xl fa-edit"></i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+','+"'"+row.id_form+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                },
            },
        ],

    dom: 'tip',
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [6,7,12] },
],
    });
    
    $('#search_hauling').on( 'keyup', function () {
        table.search(this.value).draw();
    } );

    });

    $(document).ready(function() {
    var isAdmin = "{{ (auth::user()->role) }}";
    if (isAdmin === "SUPER-ADMIN") {
        table.column(12).visible(true);
    } else {
        table.column(12).visible(false);
    }
});
</script>

@include('hauling.edit')
@include('hauling.delete')

<script>
    // edit
    function openmodaledit(id,id_ritase,identify,operator,material,bucket,departure_location,arrival_location,id_form) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_id_ritase').value = id_ritase;
        document.getElementById('e_operator').value = operator;
        document.getElementById('e_material').value = material;
        document.getElementById('e_bucket').value = bucket;
        document.getElementById('e_id_form').value = id_form;

        document.getElementById('e_identify_default').innerHTML = identify;
        document.getElementById('e_departure_location_default').innerHTML = departure_location;
        document.getElementById('e_arrival_location_default').innerHTML = arrival_location;

    }

    function submitformedit() {
        if (document.forms["form_edit"]["e_operator"].value == "") {
                alert("Please select a valid Operator");
                document.forms["form_edit"]["e_operator"].focus();
                return false;
        }

        if (document.forms["form_edit"]["e_material"].value == "") {
                alert("Please select a valid Material");
                document.forms["form_edit"]["e_material"].focus();
                return false;
        }

        if (document.forms["form_edit"]["e_bucket"].value == "") {
                alert("Please select a valid Bucket");
                document.forms["form_edit"]["e_bucket"].focus();
                return false;
        }

        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../hauling/editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id,id_form) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
        document.getElementById('del_id_form').value = id_form;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../hauling/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>
@endsection