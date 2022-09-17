@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/location/locations">LOCATION</a></li>
            <li class="breadcrumb-item active">LOCATION PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Location
        </h1>
        </div>
        <div class="ms-auto">
            <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a>
        </div>
        <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Location</a></div>
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
					<h5 class="modal-title text-theme">NEW LOCATION</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
                <form class="was-validated" method="POST" action="{{ url('/location/locations/store') }}">
                    @csrf
				<div class="modal-body">
                    <div>
                    <input id="id_location" type="hidden" class="validate" value="{{ $idloc }}" name="id_location">
                    <input id="users" type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                    </div>
                    <div class="row form-group">
                        <div class="col-4 form-group position-relative mb-3 mt-3">
                            <label class="form-label">Land Owner</label>
                            <select class="form-select text-theme" id="id_vendor" name="id_vendor" required>
                                <option value="" disabled selected>Choose Land Owner</option>
                                @foreach ($getvendor as $vendor)
                                <option value="{{ $vendor->id_vendor }}">{{ $vendor->vendor }} = {{ $vendor->name_product }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Land Owner.
                            </div>
                        </div>
                        <div class="col-8 form-group mb-3 mt-3">
                            <label class="form-label">Name Location</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="location" id="location" required placeholder="Please provide a name location" autocomplete="OFF">
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group mb-2">
                            <label class="form-label">Latitude</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="lat" id="lat"  placeholder="latitude" autocomplete="OFF" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div>

                        <div class="col-6 form-group mb-2">
                            <label class="form-label">Longitude</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="text" name="long" id="long"  placeholder="longitude" autocomplete="OFF" required>
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
            <div class="card-body p-3" style="height: 460px;">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">DATA LOCATION</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" class="form-control ps-35px" id="search_location" placeholder="Search location.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_location">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">ID LOC</th>
                                <th class="text-center" width="20%" style="color: #a8b6bc !important;">LAND OWNER</th>
                                <th class="text-center" width="35%" style="color: #a8b6bc !important;">LOCATION</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">LATITUDE</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">LONGITUDE</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">USERS</th>
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

@include('location.delete')
@include('location.edit')

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
    var table = $('#tb_location').DataTable({
    lengthMenu: [ 15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablelocation",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
        searchable: false},
        {data: 'id_location', name: 'id_location', class : 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'vendor', name: 'vendor', class : 'text-center',
        searchable: true},
        {data: 'location', name: 'location', class : 'text-center',
        searchable: true},
        {data: 'lat', name: 'lat', class : 'text-center text-warning fw-bold',
        searchable: true},
        {data: 'long', name: 'long', class : 'text-center text-primary fw-bold',
        searchable: true},
        {data: 'users', name: 'users', class : 'text-center text-white fw-bold',
        searchable: true},
        {data: 'action', name: 'action', class : 'text-center fw-bold',
                "render": function (data, type, row) {
                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('+"'"+row.id+"'"+','+"'"+row.id_vendor+"'"+','+"'"+row.vendor+"'"+','+"'"+row.name_land+"'"+','+"'"+row.location+"'"+','+"'"+row.lat+"'"+','+"'"+row.long+"'"+','+"'"+row.id_location+"'"+')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                },
            },
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [4,5,6,7] },
       
      ],
    });
    
    $('#search_location').on( 'keyup', function () {
        table.search(this.value).draw();
    } );
    });
    // end
</script>
{{-- expired --}}

<script>
    // edit
    function openmodaledit(id,id_vendor,vendor,name_land,location,lat,long,id_location) {
        $('#modaledit').modal('show');
        document.getElementById('e_id').value = id;
        document.getElementById('e_location').value = location;
        document.getElementById('e_lat').value = lat;
        document.getElementById('e_long').value = long;
        document.getElementById('e_id_location').value = id_location;

        document.getElementById('e_id_vendor_default').value = id_vendor;
        document.getElementById("e_id_vendor_default").innerHTML = "DEFAULT : " + vendor + " = " + name_land;
    }

    function submitformedit() {
        var value = document.getElementById('e_id').value;
        document.getElementById('form_edit').action = "../locations/editact/"+value;
        document.getElementById("form_edit").submit();
    }

     // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../locations/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

@endsection