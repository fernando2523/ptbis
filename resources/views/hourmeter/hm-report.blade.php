@extends('layouts.main')

@section('container')

<div id="content" class="app-content">

    <div class="d-flex align-items-center">

        <div>

        <ul class="breadcrumb">

            <li class="breadcrumb-item"><a href="/hourmeter/hourmeters">HOUR METER</a></li>

            <li class="breadcrumb-item active">REPORT PAGE</li>

        </ul>

        

        <h1 class="page-header">

            Hour Meter Report

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

   



    <div class="row">

        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body" style="padding-bottom: 0px;">

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">HM TOTAL</span>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-8">

                            <h5 class="mb-0">{{ $gettotalhm }}</h5>

                        </div>

                        <div class="col-4 text-theme">

                            <i  style="font-size: 40px;" class="bi bi-clipboard-data-fill"></i>

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

                        <span class="flex-grow-1">WORKING EXCAVATOR</span>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-8">

                            <h5 class="mb-0">13 <small>Unit</small></h5>

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



        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body" style="padding-bottom: 0px;">

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">SOLAR-USED</span>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-8">

                            <h5 class="mb-0"><small>Liter</small></h5>

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



            <div class="card mb-3">

                <div class="card-body" style="padding-bottom: 0px;">

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">STAND BY EXCAVATOR</span>

                    </div>

                    <div class="row align-items-center">

                        <div class="col-8">

                            <h5 class="mb-0">8 <small>Unit</small></h5>

                        </div>

                        <div class="col-4 text-theme">

                            <i style="font-size: 40px;" class="bi bi-dash-circle fa-3x"></i>

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



        <div class="col-xl-6 col-lg-6">

            <div class="card mb-3" >

                <div class="card-body" style="height: 236px;">

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">ACTIVITY EXCAVATOR LOG</span>

                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped table-borderless mb-2px small text-nowrap">

                            <tbody>

                                @foreach ($datahistories as $keys=>$values)

                                <tr>

                                    <td width="50%">

                                        <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">

                                            <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>

                                            {{ $values->vehicle_unit }} - {{ $values->type_unit }}

                                        </span>

                                    </td>

    

                                    <td width="20%" class="text-theme" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>

                                    

                                    <td align="right" width="25%">

                                        <span class="badge d-block bg-theme bg-opacity-75 rounded-0 pt-5px w-300px" style="min-height: 18px;font-size: 10px;">{{ $values->activity }}</span>

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

                    <!-- BEGIN input-group -->

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">REPORT HOUR METER</span>

                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>

                    </div>

                    <div class="input-group mb-4">

                        <div class="flex-fill position-relative">

                            <div class="input-group">

                                <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">

                                    <i class="fa fa-search opacity-5"></i>

                                </div>

                                <input type="text" class="form-control ps-35px" id="search_hm" placeholder="Search data.." />

                            </div>

                        </div>

                    </div>

                    <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_hm">

                        <thead style="font-size: 10px;">

                            <tr>

                                <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>

                                <th class="text-center"  width="6%" style="color: #a8b6bc !important;">ID</th>

                                <th class="text-center"  width="6%" style="color: #a8b6bc !important;">DATE</th>
                                <th class="text-center" width="10%" style="color: #a8b6bc !important;">OPERATOR</th>

                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">VEHICLE</th>
                                <th class="text-center" width="6%" style="color: #a8b6bc !important;">IDENTIFY</th>

                                

                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">TYPE UNIT</th>

                                <th class="text-center"  width="5%" style="color: #a8b6bc !important;">HM STAR</th>

                                <th class="text-center"  width="5%" style="color: #a8b6bc !important;">HM FINISH</th>

                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">TOTAL</th>

                                <th class="text-center" width="7%" style="color: #a8b6bc !important;">ACTIVITY</th>

                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">LOCATION</th>

                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">USER</th>

                                <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT</th>

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

    var table = $('#tb_hm').DataTable({

    lengthMenu: [10],

    responsive: true,

    processing: false,

    serverSide: true,

    ajax: "/datatablehourmeter",

    columns: [

        {data: 'DT_RowIndex', name: 'id', class : 'text-center fw-bold',

        searchable: false},



        {data: 'id_hm', name: 'id_hm', class : 'text-center text-theme fw-bold',

        searchable: true},



        {data: 'date', name: 'date', class : 'text-center',

        searchable: true},

        {data: 'operator', name: 'operator', class : 'text-center',

        searchable: true},


        {data: 'vehicle_unit', name: 'vehicle_unit', class : 'text-center',

        searchable: true},
        {data: 'identify', name: 'identify', class : 'text-center fw-bold text-theme',

        searchable: true},



        {data: 'type_unit', name: 'type_unit', class : 'text-center',

        searchable: true},



        {data: 'hm_start', name: 'hm_start', class : 'text-center text-warning fw-bold',

        searchable: true},



        {data: 'hm_finish', name: 'hm_finish', class : 'text-center text-primary fw-bold',

        searchable: true},



        {data: 'hm_total', name: 'hm_total', class : 'text-center fw-bold',

        searchable: true},



        {data: 'activity', name: 'activity', class : 'text-center',

        searchable: true},



        {data: 'location', name: 'location', class : 'text-center fw-bold',

        searchable: true},



        {data: 'server', name: 'server', class : 'text-center fw-bold',

        searchable: true,

            "render": function (data, type, row) {

                if (row.server === "ONLINE") {

                    return '<span class="text-center text-success">'+row.server+'</span>';

                } else if (row.server === "OFFLINE") {

                return '<span class="text-center text-danger">'+row.server+'</span>';

                }

            },

        },

        {data: 'action', name: 'action', class : 'text-center',

            "render": function (data, type, row) {

            return '<span><a class="text-primary" style="cursor: pointer;"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" ><i class="fas fa-xl fa-times-circle"></i></a></span>';

                },

            },

        ],



    dom: 'tip',

    order: [[1, 'desc']],

    columnDefs: [

        { orderable: false, targets: [13] },

],

    });

    

    $('#search_hm').on( 'keyup', function () {

        table.search(this.value).draw();

    } );



    });

</script>





@endsection