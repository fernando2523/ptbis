@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/vehicle/vehicles">VEHICLE</a></li>
            <li class="breadcrumb-item active">VEHICLE PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Vehicle
        </h1>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a>
        </div>
        <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Vehicles</a></div>
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

    <div class="modal fade" id="modaladd" data-bs-backdrop="static">
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
                        <div class="col-4 form-group mb-3">
                            <label class="form-label">Vehicle</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="vehicle_unit" id="vehicle_unit" required placeholder="Please provide a name vehicle" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-4 form-group mb-3">
                            <label class="form-label">Model Vehicle / Series</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="model_unit" id="model_unit" required placeholder="Please provide a model vehicle" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-4 form-group mb-3">
                            <label class="form-label">Operator / Driver</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="operator" id="operator" required placeholder="Please provide a name operator" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">Type Unit</label>
                            <select class="form-select text-theme" id="type_unit" name="type_unit" required>
                                <option value="" disabled selected>Choose</option>
                                <option value="OWNED">OWNED</option>
                                <option value="CONTRACT">CONTRACT</option>
                                <option value="EXTERNAL">EXTERNAL</option>
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
                                <option value="DUMP TRUCK EXTERNAL">DUMP TRUCK EXTERNAL</option>
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Type Vehicle.
                            </div>
                        </div>

                        <div class="col-12 form-group position-relative mb-3" id="isidiv">
                            <label class="form-label">Vendor</label>
                            <select class="form-select text-theme" id="id_vendor" name="id_vendor" required>
                                <option value="" disabled selected>Choose Vendor</option>
                                @foreach ($getvendor as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->vendor }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Vendor.
                            </div>
                        </div>
                        {{-- <div class="col-6 form-group mb-3" style="display:none;" id="isidiv2">
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
                        </div> --}}
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="submit">Save</button>
                    </div>
				</div>
            </form>
			</div>
		</div>
	</div>

    {{-- <script>
        function statusvehicle() {
            var select = document.getElementById('type_unit');
            var value = select.options[select.selectedIndex].value;

            if (value == 'OWNED') {
                document.getElementById("isidiv").style.display = 'none';
            } else if (value == 'CONTRACT') {
                document.getElementById("isidiv").style.display = 'block';
            }
        }

        // function statuscontract() {
        //     var select = document.getElementById('contract');
        //     var value = select.options[select.selectedIndex].value;

        //     if (value == 'EXPIRED DAYS') {
        //         document.getElementById("isidiv2").style.display = 'block';
        //         document.getElementById("isidiv3").style.display = 'block';
        //         document.getElementById("isidiv4").style.display = 'block';
        //     } else if (value == 'HOUR METER') {
        //         document.getElementById("isidiv2").style.display = 'none';
        //         document.getElementById("isidiv3").style.display = 'block';
        //         document.getElementById("isidiv4").style.display = 'block';
        //     } else if (value == 'RITASE') {
        //         document.getElementById("isidiv2").style.display = 'none';
        //         document.getElementById("isidiv3").style.display = 'block';
        //         document.getElementById("isidiv4").style.display = 'block';
        //     }
        // }
    </script> --}}

<div class="row">

    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">OWNED</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ $countowned }} <small>Unit</small></h5>
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
                    <span class="flex-grow-1">VENDOR ACTIVE UNITS</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ $countvendor }} <small>Unit</small></h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-check2-circle fa-3x"></i>
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

    <div class="col-xl-9 col-lg-6">

        <div class="card mb-3" >
            <div class="card-body" style="height: 236px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">ACTIVITY VEHICLE LOG</span>
                    <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-2px small text-nowrap">
                        <tbody>
                            @foreach ($datahistories as $keys=>$values)
                            <tr>
                                <td width="50%">
                                    <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                        <i class="bi bi-circle-fill fs-6px text-warning me-2"></i>
                                        {{ $values->vehicle_unit }}&nbsp; = &nbsp;<span class="text-warning">{{ $values->type_vehicle }}</span>
                                    </span>
                                </td>

                                <td width="30%">
                                    <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">
                                        {{ $values->type_unit }}
                                    </span>
                                </td>

                                <td width="20%" class="text-warning" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>
                                
                                <td align="right" width="30%">
                                    @if ($values->status === "ACTIVE")
                                    <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-80px" style="min-height: 18px;font-size: 10px;">{{ $values->status }}</span>
                                    @else
                                    <span class="badge d-block bg-warning rounded-0 pt-5px w-80px" style="min-height: 18px;font-size: 10px;">{{ $values->status }}</span>
                                    @endif
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
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA VEHICLE</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control ps-35px" id="search_vehicle" placeholder="Search vehicle.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_vehicle">
                        <thead style="font-size: 10px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">ID</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">VEHICLE</th>
                                <th class="text-center" width="4%" style="color: #a8b6bc !important;">MODEL</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">IDENTITY</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">OPERATOR</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">TYPE UNIT</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">STATUS</th>
                                <th class="text-center" width="15%" style="color: #a8b6bc !important;">VENDOR</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">EXTEND</th>
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
var table = $('#tb_vehicle').DataTable({
lengthMenu: [10],
responsive: true,
processing: false,
serverSide: true,
ajax: "/datatablevehicle",
columns: [
    {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
    searchable: false},
    {data: 'vehicle_id', name: 'vehicle_id', class : 'text-center text-theme fw-bold',
    searchable: true},
    {data: 'vehicle_unit', name: 'vehicle_unit', class : 'text-center',
    searchable: true},
    {data: 'model_unit', name: 'model_unit', class : 'text-center',
    searchable: true},
    {data: 'type_vehicle', name: 'type_vehicle', class : 'text-center text-warning fw-bold',
    searchable: true},
    {data: 'operator', name: 'operator', class : 'text-center',
    searchable: true},
    {data: 'type_unit', name: 'type_unit', class : 'text-center',
    searchable: true,
        "render": function (data, type, row) {
            if (row.type_unit === "OWNED") {
                return '<span class="text-center text-success" style="font-weight: bold;">'+row.type_unit+'</span>';
            } else if (row.type_unit === "CONTRACT") {
            return '<span class="text-center text-info" style="font-weight: bold;">'+row.type_unit+'</span>';
            } else if (row.type_unit === "EXTERNAL") {
            return '<span class="text-center text-indigo" style="font-weight: bold;">'+row.type_unit+'</span>';
            }
        },
    },
    {data: 'status', name: 'status', class : 'text-center',
    searchable: true,
        "render": function (data, type, row) {
            if (row.status === "OWNED") {
                return '<span class="text-success" style="font-weight: bold;">'+row.status+'</span>';
            } else if (row.status === "ACTIVE") {
            return '<span class="text-success" style="font-weight: bold;">'+row.status+'</span>';
            } else if (row.status === "NON ACTIVE") {
            return '<span class="text-danger" style="font-weight: bold;">'+row.status+'</span>';
            } else if (row.status === "STAND BY") {
            return '<span class="text-warning" style="font-weight: bold;">'+row.status+'</span>';
            }
        },
    },
    {data: 'vendor', name: 'vendor', class : 'text-center fw-bold',
    searchable: false},

    {data: 'action_contract', name: 'action_contract', class : 'text-center',
    "render": function (data, type, row) {
        return '<span><a class="text-success" style="cursor: pointer;" onclick="openmodalcontract('+"'"+row.id+"'"+','+"'"+row.status+"'"+','+"'"+row.vehicle_id+"'"+')"><i class="fas fa-xl fa-exchange-alt">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">';
        },
    },

    {data: 'action', name: 'action', class : 'text-center',
    "render": function (data, type, row) {
        return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.vehicle_id+"'"+','+"'"+row.vehicle_unit+"'"+','+"'"+row.operator+"'"+','+"'"+row.model_unit+"'"+','+"'"+row.type_unit+"'"+','+"'"+row.vendor+"'"+')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+','+"'"+row.vehicle_id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                },
            },
    ],
dom: 'tip',
// "ordering" : true,
order: [[1, 'desc']],
columnDefs: [
    
    { orderable: false, targets: [9,10] },
  ],
});

$(document).ready(function() {
    var isAdmin = "{{ (auth::user()->role) }}";
    if (isAdmin === "SUPER-ADMIN") {
        table.column(8).visible(true);
    } else {
        table.column(8).visible(false);
    }
});

$('#search_vehicle').on( 'keyup', function () {
    table.search(this.value).draw();
} );
});
// end
</script>

@include('vehicle.delete')
@include('vehicle.edit')
@include('vehicle.contract')
<script>
    // edit
    function openmodaledit(id,vehicle_id,vehicle_unit, operator,model_unit,type_unit,vendor) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_vehicle_id').value = vehicle_id;
        document.getElementById('e_vehicle_unit').value = vehicle_unit;
        document.getElementById('e_operator').value = operator;
        document.getElementById('e_model_unit').value = model_unit;

        document.getElementById("e_type_unit_default").innerHTML = "DEFAULT : " + type_unit;
        document.getElementById("e_type_unit_default").value = type_unit;
        
        document.getElementById("e_vendordefault").innerHTML = "DEFAULT : " + vendor;
        document.getElementById("e_vendordefault").value = vendor;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../vehicles/editact/"+value;
        document.getElementById("form_edit").submit();
    }

    function openmodalcontract(id,status,vehicle_id) {
        $('#modalcontract').modal('show');
        document.getElementById('con_id').value = id;
        document.getElementById('con_status').value = status;
        document.getElementById('con_vehicle_id').value = vehicle_id;

        document.getElementById("con_statusdefault").innerHTML = "DEFAULT : " + status;
        document.getElementById("con_statusdefault").value = status;
    }

    function submitformcontract() {
        var value = document.getElementById('con_id').value;
        document.getElementById('form_contract').action = "../vehicles/contractact/"+value;
        document.getElementById("form_contract").submit();
    }

     // delete
    function openmodaldelete(id,vehicle_id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
        document.getElementById('del_vehicle_id').value = vehicle_id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../vehicles/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

@endsection