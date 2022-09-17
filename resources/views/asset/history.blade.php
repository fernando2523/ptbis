@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="/asset">ASSET</a></li>
        <li class="breadcrumb-item active">HISTORY PAGE</li>
    </ul>
    
    <h1 class="page-header">
        History Asset
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
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">HISTORY ASSETS</span>
                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="input-group mb-4">
                        <div class="flex-fill position-relative">
                            <div class="input-group">
                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                    <i class="fa fa-search opacity-5"></i>
                                </div>
                                <input type="text" id="search_history" class="form-control ps-35px" placeholder="Search history.." />
                            </div>
                        </div>
                    </div>
                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_history">
                        <thead style="font-size: 10px;">
                            <tr>
                                <th class="text-center" width="2%">NO</th>
                                <th class="text-center" width="8%">ID TRANSACTION</th>
                                <th class="text-center" width="6%">DATE</th>
                                <th class="text-center" width="20%">MATERIAL</th>
                                <th class="text-center">QTY</th>
                                <th class="text-center" width="5%">UNIT</th>
                                <th class="text-center" width="7%">TYPE ASSET</th>
                                <th class="text-center" width="8%">PRICE</th>
                                <th class="text-center" width="8%">TOTAL PRICE</th>
                                <th class="text-center">SUPPLIER</th>
                                <th class="text-center" width="4%">STOCK</th>
                                <th class="text-center">USER</th>
                                <th class="text-center" width="6%">ACT</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 10px;" >
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
var table = $('#tb_history').DataTable({
lengthMenu: [ 15],
responsive: true,
processing: false,
serverSide: true,
ajax: "/datatablehistory",
columns: [
    {data: 'DT_RowIndex', name: 'id',
    searchable: false},
    {data: 'id_transaction', name: 'id_transaction',
    searchable: true},
    {data: 'date', name: 'date',
    searchable: false},
    {data: 'material', name: 'material',
    searchable: true,
    "render": function (data, type, row) {
     if (row.desc === null) {
        return row.material;
     } else {
        return row.material+' <a class="text-warning" data-toggle="tooltip" data-placement="top" title="See Description.." onclick="openmodaldesc('+"'"+row.id+"'"+','+"'"+row.desc+"'"+')" style="cursor: pointer;"><i class="fas fa-xl fa-eye"></i></a>';
     }
        },
    },
    {data: 'qty', name: 'qty',  
    searchable: false},
    {data: 'unit', name: 'unit',
    searchable: false},
    {data: 'type_asset', name: 'type_asset',
    searchable: false},
    {data: 'price', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'price',
    searchable: false},
    {data: 'total_price', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'total_price',
    searchable: false},
    {data: 'supplier', name: 'supplier',
    searchable: false},
    {data: 'in_out', name: 'in_out',
    searchable: false,
        "render": function (data, type, row) {
        if (row.in_out === "IN") {
            return '<center><span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">'+row.in_out+'</span></center>';
        } else if (row.in_out === "OUT") {
            return '<center><span class="badge d-block bg-warning bg-opacity-75 rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">'+row.in_out+'</span></center>';
        } else if (row.in_out === "EDITED") {
            return '<center><span class="badge d-block bg-primary bg-opacity-75 rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">'+row.in_out+'</span></center>';
        }  else if (row.in_out === "DELETED") {
            return '<center><span class="badge d-block bg-danger bg-opacity-75 rounded-0 pt-5px w-60px" style="min-height: 18px;font-size: 10px;">'+row.in_out+'</span></center>';
        }
        },
    },
    {data: 'users', name: 'users',
    searchable: false},
    {data: 'action', name: 'action',
    "render": function (data, type, row) {
        return '<span><a class="text-danger" style="cursor: pointer;" id="delete_btn"><i class="fas fa-xl fa-times-circle"></i></a></span>';
        },
    },
    ],
dom: 'tip',
// "ordering" : true,
order: [[1, 'desc']],
columnDefs: [
    
    { orderable: false, targets: [8,9,10,11,12] },
    {
        targets: 0,
        className: 'fw-bold'},
    {
        targets: 1,
        className: 'text-theme fw-bold'},
    {
        targets: 2,
        className: 'text-center'},
    {
        targets: 3,
        className: 'text-center'},
    {
        targets: 4,
        className: 'text-center'},
    { "width": "3%", "targets": 4 },
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
    {
        targets: 10,
        className: 'text-center'},
    { "width": "7%", "targets": 10 },
    {
        targets: 11,
        className: 'text-center fw-bold'},
    {
        targets: 12,
        className: 'text-center',
    }


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

$('#search_history').on( 'keyup', function () {
    table.search(this.value).draw();
} );

$('#tb_history tbody').on('click', '#delete_btn',function () {
    var data = table.row( $(this).parents('tr') ).data();
        openmodaldelete(data.id,data.id_stock,data.qty,data.in_out);
});

});
// end
</script>

@include('asset.deletehistory')
@include('asset.edithistory')
@include('asset.desc')
<script>
    // restock
    function openmodaldesc(id,desc) {
        $('#modaldesc').modal('show');
        document.getElementById('d_id').value = id;
        document.getElementById('d_desc').value = desc;
    }

    // delete
    function openmodaldelete(id,id_stock,qty,in_out) {
        $('#modaldelete').modal('show');
        document.getElementById('del_in_out').value = in_out;
        document.getElementById('del_id_stock').value = id_stock;
        document.getElementById('del_qty').value = qty;
        document.getElementById('del_id').value = id;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../destroyhistory/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection