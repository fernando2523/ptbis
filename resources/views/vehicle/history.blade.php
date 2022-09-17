@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/vehicle/vehicles">VEHICLE</a></li>
        <li class="breadcrumb-item active">HISTORY PAGE</li>
    </ul>
    
    <h1 class="page-header">
        Vehicle
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
        <div class="mt-sm-0 mt-2 button-hover"><a href="#" class="text-white text-opacity-75 text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-theme"></i> Export CSV</a></div>
    </div>

<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-1">
                        <span class="flex-grow-1">HISTORY CONTRACT</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <ul class="nav nav-tabs pt-3 px-3">
                        <li class="nav-item me-1"><a href="#EXPIREDDAYS" class="nav-link active" data-bs-toggle="tab">EXPIRED DAYS</a></li>
                        <li class="nav-item me-1"><a href="#HOURMETER" class="nav-link" data-bs-toggle="tab">HOUR METER</a></li>
                        <li class="nav-item me-1"><a href="#RITASE" class="nav-link" data-bs-toggle="tab">RITASE</a></li>
                    </ul>
                    <div class="tab-content p-4">
                        <!-- BEGIN tab-pane -->
                        <div class="tab-pane fade show active" id="EXPIREDDAYS">
                            <P class="text-theme" style="font-weight: bold;">EXPIRED DAYS</P>
                            <div class="input-group mb-4">
                                <div class="flex-fill position-relative">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <input type="text" class="form-control ps-35px" id="search_expired" placeholder="Search vehicle.." />
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_expired">
                                <thead style="font-size: 10px;">
                                    <tr>
                                        <th class="text-center" width="2%" id="id" style="color: #a8b6bc !important;">NO</th>
                                        <th class="text-center" width="5%" id="vehicle_id"  style="color: #a8b6bc !important;">ID</th>
                                        <th class="text-center" width="15%" id="vehicle_unit" style="color: #a8b6bc !important;">VEHICLE</th>
                                        <th class="text-center" width="5%" id="model_unit" style="color: #a8b6bc !important;">MODEL</th>
                                        <th class="text-center" width="25%" id="operator" style="color: #a8b6bc !important;">OPERATOR / DRIVER</th>
                                        <th class="text-center" width="10%" id="contract" style="color: #a8b6bc !important;">CONTRACT EXPIRED</th>
                                        <th class="text-center" width="10%" id="price"  style="color: #a8b6bc !important;">VALUE</th>
                                        <th class="text-center" width="5%" id="status" style="color: #a8b6bc !important;">STATUS</th>
                                        <th class="text-center" width="5%" id="users" style="color: #a8b6bc !important;">USERS</th>
                                        <th class="text-center" width="5%" id="path" style="color: #a8b6bc !important;">PDF</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;" >
                                </tbody>
                            </table>
                        </div>
                        <!-- END tab-pane -->
                        <!-- BEGIN tab-pane -->
                        <div class="tab-pane fade" id="HOURMETER">
                            <P class="text-theme" style="font-weight: bold;">HOUR METER</P>
                            <div class="input-group mb-4">
                                <div class="flex-fill position-relative">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <input type="text" class="form-control ps-35px" id="search_hour" placeholder="Search vehicle.." />
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_hour">
                                <thead style="font-size: 10px;">
                                    <tr>
                                        <th class="text-center" id="id" style="color: #a8b6bc !important;">NO</th>
                                        <th class="text-center" id="vehicle_id" style="color: #a8b6bc !important;">ID</th>
                                        <th class="text-center" id="vehicle_unit" style="color: #a8b6bc !important;">VEHICLE</th>
                                        <th class="text-center" id="model_unit" style="color: #a8b6bc !important;">MODEL</th>
                                        <th class="text-center" id="operator" style="color: #a8b6bc !important;">OPERATOR / DRIVER</th>
                                        <th class="text-center" id="price" style="color: #a8b6bc !important;">VALUE</th>
                                        <th class="text-center" id="status" style="color: #a8b6bc !important;">STATUS</th>
                                        <th class="text-center" id="users" style="color: #a8b6bc !important;">USERS</th>
                                        <th class="text-center" id="path" style="color: #a8b6bc !important;">PDF</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;" >
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="RITASE">
                            <P class="text-theme" style="font-weight: bold;">RITASE</P>
                            <div class="input-group mb-4">
                                <div class="flex-fill position-relative">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <input type="text" class="form-control ps-35px" id="search_ritase" placeholder="Search vehicle.." />
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_ritase">
                                <thead style="font-size: 10px;">
                                    <tr>
                                        <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                        <th class="text-center" width="5%" style="color: #a8b6bc !important;">ID</th>
                                        <th class="text-center" width="20%" style="color: #a8b6bc !important;">VEHICLE</th>
                                        <th class="text-center" width="5%" style="color: #a8b6bc !important;">MODEL</th>
                                        <th class="text-center" width="25%" style="color: #a8b6bc !important;">OPERATOR / DRIVER</th>
                                        <th class="text-center" width="10%" style="color: #a8b6bc !important;">VALUE</th>
                                        <th class="text-center" width="5%" style="color: #a8b6bc !important;">STATUS</th>
                                        <th class="text-center" width="5%" style="color: #a8b6bc !important;">USERS</th>
                                        <th class="text-center" width="5%" style="color: #a8b6bc !important;">PDF</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;" >
                                </tbody>
                            </table>
                        </div>
                        <!-- END tab-pane -->
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


{{-- expired --}}
<script type="text/javascript">
    $(function () {
    var table = $('#tb_expired').DataTable({
    lengthMenu: [ 15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablevehicle_exp",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',
        searchable: false},
        {data: 'vehicle_id', name: 'vehicle_id', class : 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'vehicle_unit', name: 'vehicle_unit', class : 'text-center',
        searchable: true},
        {data: 'model_unit', name: 'model_unit', class : 'text-center text-primary fw-bold',
        searchable: true},
        {data: 'operator', name: 'operator', class : 'text-center',
        searchable: true},
        {data: 'days', name: 'days', class : 'text-center text-warning fw-bold',
        searchable: false},
        {data: 'price',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'price', class : 'text-center fw-bold',
        searchable: false},
        {data: 'status', name: 'status', class: 'text-center fw-bold',
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
        {data: 'users', name: 'users', class : 'text-center fw-bold',
        searchable: false},
        {data: 'path', name: 'path',class : 'text-center text-warning fw-bold',
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
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [6,7] },
      ],
    });
    
    $('#search_expired').on( 'keyup', function () {
        table.search(this.value).draw();
    } );
    });
    // end
</script>
{{-- expired --}}

{{-- hour --}}
<script type="text/javascript">
    $(function () {
    var table_hour = $('#tb_hour').DataTable({
    lengthMenu: [ 15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablevehicle_hour",
    columns: [
        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',  width: '2%',
        searchable: false},
        {data: 'vehicle_id', name: 'vehicle_id', class: 'text-center text-theme fw-bold', width: '40%',
        searchable: true},
        {data: 'vehicle_unit', name: 'vehicle_unit', class: 'text-center', 
        searchable: true},
        {data: 'model_unit', name: 'model_unit', class : 'text-center text-primary fw-bold',
        searchable: true},
        {data: 'operator', name: 'operator', class: 'text-center',
        searchable: true},
        {data: 'price',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'price', class: 'text-center fw-bold', 
        searchable: false},
        {data: 'status', name: 'status', class: 'text-center fw-bold',
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
        {data: 'users', name: 'users', class: 'text-center fw-bold',
        searchable: false},
        {data: 'path', name: 'path', class: 'text-center',
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
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [6,7] }
    ],
    });
    
    $('#search_hour').on( 'keyup', function () {
        table_hour.search(this.value).draw();
    } );
    });
    // end
</script>
{{-- hour --}}

{{-- ritase --}}
<script type="text/javascript">
    $(function () {
    var table_ritase = $('#tb_ritase').DataTable({
    lengthMenu: [ 15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablevehicle_ritase",
    columns: [
        {data: 'DT_RowIndex', name: 'ids', class : 'text-center fw-bold',  width: '2%',
        searchable: false},
        {data: 'vehicle_id', name: 'vehicle_id', class: 'text-center text-theme fw-bold',
        searchable: true},
        {data: 'vehicle_unit', name: 'vehicle_unit', class: 'text-center', 
        searchable: true},
        {data: 'model_unit', name: 'model_unit', class : 'text-center text-primary fw-bold',
        searchable: true},
        {data: 'operator', name: 'operator', class: 'text-center',
        searchable: true},
        {data: 'price',render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'price', class: 'text-center fw-bold', 
        searchable: false},
        {data: 'status', name: 'status', class: 'text-center fw-bold',
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
        {data: 'users', name: 'users', class: 'text-center fw-bold',
        searchable: false},
        {data: 'path', name: 'path', class: 'text-center',
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
        ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        { orderable: false, targets: [6,7] }
    ],
    });
    
    $('#search_ritase').on( 'keyup', function () {
        table_ritase.search(this.value).draw();
    } );
    });
    // end
</script>
{{-- ritase --}}


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection