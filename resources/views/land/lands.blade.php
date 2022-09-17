@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/land/lands">LAND OWNER</a></li>
            <li class="breadcrumb-item active">LAND OWNER PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Land Owner
        </h1>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Land</a>
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
					<h5 class="modal-title text-theme">NEW LAND</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" method="POST" enctype="multipart/form-data" action="{{ url('/land/lands/store') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                    <input id="id_land" type="hidden" class="validate" value="{{ $idowl }}" name="id_land">
                    <input id="users" type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                    <input id="status_land" type="hidden" class="validate" name="status_land" value="ACTIVE">
                    </div>
                    <div class="row form-group">
                        <div class="col-8 form-group mb-3">
                            <label class="form-label">Owner</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="owner" id="owner" required placeholder="Please provide a name owner" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label class="form-label">Royalty</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="royalty" id="royalty"  placeholder="how much is the total royalty" autocomplete="OFF" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group mb-3">
                            <label class="form-label">Name Land</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="land" id="land" required placeholder="Please provide a name land" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-6 form-group mb-3">
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
	</div>

<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3" style="height: 460px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA LAND OWNER</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control ps-35px" id="search_land" placeholder="Search land.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_land">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">ID</th>
                                <th class="text-center" width="35%" style="color: #a8b6bc !important;">OWNER</th>
                                <th class="text-center" width="15%" style="color: #a8b6bc !important;">LAND</th>
                                <th class="text-center" width="15%" style="color: #a8b6bc !important;">STATUS</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">ROYALTY</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">CONTRACT</th>
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

@include('land.delete')
@include('land.edit')

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


{{-- expired --}}
<script type="text/javascript">
    $(function () {
    var table = $('#tb_land').DataTable({
    lengthMenu: [ 15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatableland",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
        searchable: false},
        {data: 'id_land', name: 'id_land', class : 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'owner', name: 'owner', class : 'text-center',
        searchable: true},
        {data: 'land', name: 'land', class : 'text-center',
        searchable: true},
        {data: 'status_land', name: 'status_land', class : 'text-center text-white fw-bold',
        searchable: true},
        {data: 'royalty',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'royalty', class : 'text-center fw-bold',
        searchable: true},
        {data: 'path', name: 'pdf_exp',class : 'text-center text-warning fw-bold',
        searchable: false,
            "render": function (data, type, row) {
                if (row.path === "") {
                    return ' <span style="font-weight: bold;" class="text-warning">NO DATA</span> ';
                } 
                else {
                return '<span><a class="text-danger" style="cursor: pointer;" href="view_pdf/'+row.path+'" target="_blank"><i class="fas fa-xl fa-file-pdf"></i></a></span>';
                }
            },
        },
        {data: 'action', name: 'action', class : 'text-center fw-bold',
                "render": function (data, type, row) {
                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.owner+"'"+','+"'"+row.land+"'"+','+"'"+row.royalty+"'"+')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                },
            },
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [6,7] },
       
      ],
    });
    
    $('#search_land').on( 'keyup', function () {
        table.search(this.value).draw();
    } );
    });
    // end
</script>
{{-- expired --}}

<script>
    // edit
    function openmodaledit(id,owner,land,royalty) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_owner').value = owner;
        document.getElementById('e_land').value = land;
        document.getElementById('e_royalty').value = royalty;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../lands/editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id,owner,royalty) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../lands/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

@endsection