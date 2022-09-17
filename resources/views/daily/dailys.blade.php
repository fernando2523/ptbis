@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/location/locations">DAILY ACTIVITY</a></li>
            <li class="breadcrumb-item active">DAILY ACTIVITY PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Daily Activity
        </h1>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a>
        </div>
        <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Activity</a></div>
    </div>
    <style>
         .button-hover{
            padding:0.5%;
            border-radius:5px;
         }

         .button-hover:hover{
            background-color:rgba(255,255,255,.15);
         }

         .datepicker.datepicker-dropdown {
            z-index: 200000!important;
        }
    </style>

    <div class="modal fade" id="modaladd" data-bs-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-theme">ADD DAILY ACTIVITY</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" method="POST" action="{{ url('/daily/dailys/store') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                    <input id="id_act" type="hidden" class="validate" value="{{ $idact }}" name="id_act">
                    <input id="users" type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                    </div>
                    <div class="row form-group">
                        <div class="col-3 form-group position-relative mb-3 mt-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" name="date"  class="form-control form-control-sm" id="datepicker" required autocomplete="OFF" placeholder="Pilih Tanggal Kegiatan" />
                        </div>
                        <div class="col-9 form-group position-relative mb-3 mt-3">
                            <label class="form-label">Aktivitas</label>
                            <select class="form-select text-theme form-select-sm" id="activity" name="activity" required>
                                <option value="" disabled selected>Pilih Aktivitas</option>
                                <option value="WORKING">WORKING</option>
                                <option value="STAND BY">STAND BY</option>    
                                <option value="LIBUR">LIBUR</option>
                                <option value="LIBUR NASIONAL">LIBUR NASIONAL</option>
                            </select>
                            <div class="invalid-tooltip">
                                Silahkan Pilih Jenis Aktivitas.
                            </div>
                        </div>
                        <div class="col-12 form-group mb-3 mt-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" name="desc" rows="2" required placeholder="Keterangan.." autocomplete="OFF"></textarea>
                            <div class="valid-feedback">Looks good!</div>
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
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: 490px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA ACTIVITY</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control ps-35px" id="search_daily" placeholder="Search activity.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_daily">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">ID ACT</th>
                                <th class="text-center" width="8%" style="color: #a8b6bc !important;">DATE</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">ACVITITY</th>
                                <th class="text-center" width="40%" style="color: #a8b6bc !important;">KETERANGAN</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">USERS</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT</th>
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

@include('daily.delete')
@include('daily.edit')

<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); }}"></script>
<script>
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });
</script>

<link href="{{ URL::asset('/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css'); }}" rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'); }}" rel="stylesheet" />
<link href="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css'); }}" rel="stylesheet" />

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
    var table = $('#tb_daily').DataTable({
    lengthMenu: [ 10],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatabledaily",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
        searchable: false},
        {data: 'id_act', name: 'id_act', class : 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'date', name: 'date', class : 'text-center fw-bold',
        searchable: true},
        {data: 'activity', name: 'activity', class : 'text-center fw-bold',
        searchable: true,
            "render": function (data, type, row) {
                if (row.activity === "STANDY BY") {
                    return '<span class="text-danger">'+row.activity+'</span>';
                } else if (row.activity === "WORKING") {
                    return '<span class="text-success">'+row.activity+'</span>';
                } else {
                    return '<span class="text-warning">'+row.activity+'</span>';
                } 
            },
        },
        {data: 'desc', name: 'desc', class : 'text-center',
        searchable: true},
        {data: 'users', name: 'users', class : 'text-center fw-bold',
        searchable: false},
        {data: 'action', name: 'action', class : 'text-center fw-bold',
                "render": function (data, type, row) {
                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.id_act+"'"+','+"'"+row.activity+"'"+','+"'"+row.desc+"'"+')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                },
            },
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [4,5,6] },
       
      ],
    });
    
    $('#search_daily').on( 'keyup', function () {
        table.search(this.value).draw();
    } );
    });
    // end
</script>



<script>
    // edit
    function openmodaledit(id,id_act,activity,desc) {
        $('#modaledit').modal('show');

    
        document.getElementById('e_id').value = id;
        document.getElementById('e_id_act').value = id_act;
        document.getElementById('e_desc').value = desc;

        document.getElementById('e_activity_default').value = activity;
        document.getElementById("e_activity_default").innerHTML = "DEFAULT : " + activity;

        
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../daily/editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../daily/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

@endsection