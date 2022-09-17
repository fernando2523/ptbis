@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/fuel">FUEL</a></li>
            <li class="breadcrumb-item active">FUEL REFILL PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Fuel Refill
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

    <div class="mb-sm-3 mb-2 d-sm-flex">
        <div class="mt-sm-0 mt-2 button-hover"><a href="#" class="text-white text-opacity-75 text-decoration-none"><i class="fa fa-upload fa-fw me-1 text-theme"></i> Export CSV</a></div>
    </div>

<div class="row">
    <!-- DATA ASSSET -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body p-3">
                    <!-- BEGIN input-group -->
                    <div class="d-flex fw-bold small mb-2">
                        <span class="flex-grow-1">FUEL REFILL</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="search_refill" class="form-control ps-35px" placeholder="Search refill.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_refill">
                        <thead style="font-size: 11px;">
                            <tr>
                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">ID ACT</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">DATE</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">FUEL</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">VEHICLE</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">OPERATOR</th>
                                <th class="text-center" width="3%" style="color: #a8b6bc !important;">QTY</th>
                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">UNIT</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">LOCATION</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">PIC</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">USERS</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">HOUR</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">DEVICE</th>
                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">SERVER</th>
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
{{-- refill --}}
<script type="text/javascript">
    $(function () {
        
    var table = $('#tb_refill').DataTable({
    lengthMenu: [15],
    responsive: true,
    processing: false,
    serverSide: true,
    ajax: "/datatablefuel_refill",
    columns: [
        {data: 'DT_RowIndex', name: 'id',
        searchable: false},
        {data: 'id_activity', name: 'id_activity',
        searchable: true},
        {data: 'date', name: 'date',
        searchable: true},
        {data: 'material', name: 'material',
        searchable: false},
        {data: 'vehicle_unit', name: 'vehicle_unit',
        searchable: true},
        {data: 'operator', name: 'operator',
        searchable: true},
        {data: 'qty', name: 'qty',  
        searchable: false},
        {data: 'unit', name: 'unit',
        searchable: false},
        {data: 'location', name: 'location',
        searchable: true},
        {data: 'pic', name: 'pic',
        searchable: true},
        {data: 'users', name: 'users',
        searchable: true},
        {data: 'hour', name: 'hour',
        searchable: false},
        {data: 'device', name: 'device',
        searchable: false},
        {data: 'server', name: 'server',
        searchable: true,
        "render": function (data, type, row) {
            if (row.server === "ONLINE") {
                return '<span class="text-center text-success">'+row.server+'</span>';
            } else if (row.server === "OFFLINE") {
                return '<span class="text-center text-danger">'+row.server+'</span>';
            }
            },
        },
        {data: 'action', name: 'action',
        "render": function (data, type, row) {
                return '<span><a class="text-danger" style="cursor: pointer;" id="delete_btn" onclick="openmodaldelete('+"'"+row.id+"'"+')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
            },
        },
        
    ],
    dom: 'tip',
    // "ordering" : true,
    order: [[1, 'desc']],
    columnDefs: [
        
        { orderable: false, targets: [6,7,8,9,10,11,12,13,14] 
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
            className: 'text-center text-warning fw-bold'},
        {
            targets: 8,
            className: 'text-center text-primary fw-bold'},
        {
            targets: 9,
            className: 'text-center'},
        {
            targets: 10,
            className: 'text-center'},
        {
            targets: 11,
            className: 'text-center'},
        {
            targets: 12,
            className: 'text-center'},
        {
            targets: 13,
            className: 'text-center fw-bold'},
        {
            targets: 14,
            className: 'text-center'},
    ],
    });

    $(document).ready(function() {
    var isAdmin = "{{ (auth::user()->role) }}";
    if (isAdmin === "SUPER-ADMIN") {
        table.column(14).visible(true);
    } else {
        table.column(14).visible(false);
    }
});
    
    $('#search_refill').on( 'keyup', function () {
        table.search(this.value).draw();
    } );

    $('#tb_refill tbody').on('click', '#delete_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaldelete(data.id);
    });
    
    });
    // end
    </script>
{{-- end refill --}}

@include('fuelrefill.delete')
<script>
    // delete
    function openmodaldelete(id) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../fuel-refill/destroy/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection