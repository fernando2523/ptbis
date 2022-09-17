@extends('layouts.main')

@section('container')

<div id="content" class="app-content">
    <div class="d-flex align-items-center mt-3">
        <div>
            <ul class="breadcrumb">

                <li class="breadcrumb-item"><a href="/preparation/preparations">PREPARATION</a></li>

                <li class="breadcrumb-item active">PREPARATION PAGE</li>

            </ul>
        
        <h1 class="page-header">
            Preparation
        </h1>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Data Analysis</a>
        </div>
    </div>
    

    <style>
        .button-hover {

            padding: 0.5%;

            border-radius: 5px;

        }



        .button-hover:hover {

            background-color: rgba(255, 255, 255, .15);

        }

        .datepicker.datepicker-dropdown {
            z-index: 200000!important;
        }
    </style>




    <div class="modal fade" id="modaladd" data-bs-backdrop="static">

		<div class="modal-dialog modal-lg">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title text-theme">NEW DATA ANALYSIS</h5>

					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

				</div>

                <form class="was-validated" enctype="multipart/form-data" method="POST" action="{{ url('/preparation/store') }}">

        @csrf

        <div class="modal-body">

            <div>
                <input type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
            </div>

            <div class="row form-group">
                <div class="col-2 form-group mb-3">
                    <label class="form-label">Laboratorium</label>
                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="lab" maxlength="3" style="text-transform: uppercase" required placeholder="Lab" autocomplete="OFF">
                </div>

                <div class="col-4 form-group mb-3">
                    <label class="form-label">Date</label>
                    <input type="text" name="date"  class="form-control form-control-sm" id="datepicker" required autocomplete="OFF" placeholder="Pilih Tanggal Pengiriman" />
                </div>

                <div class="col-6 form-group mb-3">
                    <label class="form-label">Code Sample Final</label>
                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="code_sample_final" required placeholder="Silahkan masukan final code sample" autocomplete="OFF">
                </div>

                <div class="col-4 form-group mb-3">
                    <label class="form-label">Ni</label>
                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="ni" required placeholder="Ni" autocomplete="OFF">
                </div>
                <div class="col-4 form-group mb-3">
                    <label class="form-label">Fe</label>
                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="fe" required placeholder="Fe" autocomplete="OFF">
                </div>
                <div class="col-4 form-group mb-3">
                    <label class="form-label">Inc</label>
                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="increment" required placeholder="Fe" autocomplete="OFF">
                </div>
                <div class="col-12 form-group mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" name="desc" rows="2" placeholder="Optional.." autocomplete="OFF"></textarea>
                </div>

                <div class="col-12 form-group position-relative mb-3 mt-3" >
                    <label class="form-label">File Contract Upload <small class="text-warning">optional</small></label>
                    <input type="file" class="form-control form-control-sm" id="file" name="file">
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
    <div class="col-xl-12 mb-3">

        <div class="card">

            <div class="card-body p-3" style="height: 380px;;">

                <!-- BEGIN input-group -->

                <div class="d-flex fw-bold small mb-3">

                    <span class="flex-grow-1">DATA ANALYSIS</span>

                    <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>

                </div>

                <div class="input-group mb-4">

                    <div class="flex-fill position-relative">

                        <div class="input-group">

                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">

                                <i class="fa fa-search opacity-5"></i>

                            </div>

                            <input type="text" class="form-control ps-35px" id="search_preparation_analysis" placeholder="Search analysis.." />

                        </div>

                    </div>

                </div>

                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_preparation_analysis">

                    <thead style="font-size: 10px;">

                        <tr>

                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>

                            <th class="text-center" width="8%" style="color: #a8b6bc !important;">ID</th>

                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">DATE</th>

                            <th class="text-center" width="30%" style="color: #a8b6bc !important;">CODE SAMPLE FINAL</th>

                            <th class="text-center" width="3%" style="color: #a8b6bc !important;">Ni</th>

                            <th class="text-center" width="3%" style="color: #a8b6bc !important;">Fe</th>

                            <th class="text-center" width="4%" style="color: #a8b6bc !important;">INC</th>

                            <th class="text-center" width="13%" style="color: #a8b6bc !important;">DESC</th>

                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">USER</th>

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

    <div class="col-xl-9">

        <div class="card">

            <div class="card-body p-3" style="height: auto;">

                <!-- BEGIN input-group -->

                <div class="d-flex fw-bold small mb-3">

                    <span class="flex-grow-1">DATA PREPARATION</span>

                    <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>

                </div>

                <div class="input-group mb-4">

                    <div class="flex-fill position-relative">

                        <div class="input-group">

                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">

                                <i class="fa fa-search opacity-5"></i>

                            </div>

                            <input type="text" class="form-control ps-35px" id="search_preparation" placeholder="Search preparation.." />

                        </div>

                    </div>

                </div>

                <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_preparation">

                    <thead style="font-size: 10px;">

                        <tr>

                            <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO</th>

                            <th class="text-center" width="6%" style="color: #a8b6bc !important;">ID</th>

                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">DATE</th>

                            <th class="text-center" width="8%" style="color: #a8b6bc !important;">LOC</th>

                            <th class="text-center" width="8%" style="color: #a8b6bc !important;">DOME</th>

                            <th class="text-center" width="8%" style="color: #a8b6bc !important;">SAMPLE</th>

                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">Ni</th>

                            <th class="text-center" width="5%" style="color: #a8b6bc !important;">Fe</th>

                            <th class="text-center" width="12%" style="color: #a8b6bc !important;">CODE ANALYSIS</th>

                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">STATUS</th>

                            <th class="text-center" width="10%" style="color: #a8b6bc !important;">USER</th>

                            <th class="text-center" width="6%" style="color: #a8b6bc !important;">ACT</th>

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



    <!-- DATA HISTORY -->

    <div class="col-xl-3">

        <div class="card mb-3">

            <div class="card-body" style="height: 400px;">

                <div class="d-flex fw-bold small mb-3">

                    <span class="flex-grow-1">ACTIVITY PREPARATION LOG</span>

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

                                        {{ $values->code_sample }}

                                    </span>

                                </td>
                                <td>
                                    {{ $values->location }}
                                </td>


                                <td width="20%" class="text-theme" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>



                                <td align="right" width="25%">

                                    @if ($values->status === "FINISH")

                                    <span class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-50px" style="min-height: 18px;font-size: 7px;">{{ $values->status }}</span>

                                    @else

                                    <span class="badge d-block bg-danger rounded-0 pt-5px w-50px" style="min-height: 18px;font-size: 7px;">{{ $values->status }}</span>

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
    $(function() {

        var table = $('#tb_preparation').DataTable({

            lengthMenu: [10],

            responsive: true,

            processing: false,

            serverSide: true,

            ajax: "/datatablepreparation",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'id',
                    class: 'text-center fw-bold',

                    searchable: false
                },

                {
                    data: 'id_prepp',
                    name: 'id_prepp',
                    class: 'text-center text-theme fw-bold',

                    searchable: true
                },

                {
                    data: 'date',
                    name: 'date',
                    class: 'text-center fw-bold',

                    searchable: true
                },

                {
                    data: 'location',
                    name: 'location',
                    class: 'text-center',

                    searchable: true
                },

                {
                    data: 'id_dome',
                    name: 'id_dome',
                    class: 'text-center',

                    searchable: true
                },

                {
                    data: 'code_sample',
                    name: 'code_sample',
                    class: 'text-center',

                    searchable: true
                },


                {
                    data: 'ni',
                    name: 'ni',
                    class: 'text-center fw-bold',

                    searchable: true,

                    "render": function(data, type, row) {

                        if (row.ni === null) {

                            return '<span class="text-center text-white">-</span>';

                        } else {

                            return '<span class="text-center text-primary">' + row.ni + '</span>';

                        }

                    },

                },

                {
                    data: 'fe',
                    name: 'fe',
                    class: 'text-center fw-bold',

                    searchable: true,

                    "render": function(data, type, row) {

                        if (row.fe === null) {

                            return '<span class="text-center text-white">-</span>';

                        } else {

                            return '<span class="text-center text-warning">' + row.fe + '</span>';

                        }

                    },

                },

                
                {
                    data: 'id_analysis',
                    name: 'id_analysis',
                    class: 'text-center',

                    searchable: true,

                    "render": function(data, type, row) {

                    if (row.id_analysis === null) {

                        return '<span class="text-center text-white">-</span>';

                    } else {

                        return '<span class="text-center text-warning fw-bold">' + row.id_analysis + '</span>';

                    }

                    },

                  
                },

                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center text-white fw-bold',

                    searchable: true,

                    "render": function(data, type, row) {

                        if (row.status === "FINISH") {

                            return '<span class="text-center text-success">' + row.status + '</span>';

                        } else if (row.status === "PROGRESS") {

                            return '<span class="text-center text-danger">' + row.status + ' </span><span><a class="text-white" style="cursor: pointer;" onclick="openmodalstatus(' + "'" + row.id + "'" + ',' + "'" + row.location + "'" + ',' + "'" + row.code_sample + "'" + ',' + "'" + row.date + "'" + ')"><i class="fas fa-xl fa-check-square"></i></a></span>';

                        }

                    },

                },

                {
                    data: 'users',
                    name: 'users',
                    class: 'text-center',

                    searchable: true
                },

                {
                    data: 'action',
                    name: 'action',
                    class: 'text-center',

                    "render": function(data, type, row) {

                        return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' + "'" + row.id + "'" + ',' + "'" + row.location + "'" + ',' + "'" + row.code_sample + "'" + ',' + "'" + row.increment + "'" + ',' + "'" + row.ni + "'" + ',' + "'" + row.fe + "'" + ',' + "'" + row.status + "'" + ')"><i class="fas fa-xl fa-edit"></i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' + "'" + row.id + "'" + ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';

                    },

                },

            ],


            dom: 'tip',

            order: [
                [1, 'desc']
            ],

            columnDefs: [

                {
                    orderable: false,
                    targets: [10, 11]
                },

            ],

        });



        $('#search_preparation').on('keyup', function() {

            table.search(this.value).draw();

        });



    });




    // end
</script>

<script type="text/javascript">
    $(function() {

        var table = $('#tb_preparation_analysis').DataTable({

            lengthMenu: [10],

            responsive: true,

            processing: false,

            serverSide: true,

            ajax: "/datatablepreparationanalysis",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'id',
                    class: 'text-center fw-bold',

                    searchable: false
                },
                {
                    data: 'id_analysis',
                    name: 'id_analysis',
                    class: 'text-center fw-bold text-theme',

                    searchable: true
                },
                {
                    data: 'date',
                    name: 'date',
                    class: 'text-center fw-bold',

                    searchable: true
                },
                {
                    data: 'code_sample_final',
                    name: 'code_sample_final',
                    class: 'text-center text-warning fw-bold',

                    searchable: true
                },
                {
                    data: 'ni',
                    name: 'ni',
                    class: 'text-center',

                    searchable: true
                },
                {
                    data: 'fe',
                    name: 'fe',
                    class: 'text-center',

                    searchable: true
                },
                {
                    data: 'increment',
                    name: 'increment',
                    class: 'text-center',

                    searchable: true
                },
                {
                    data: 'desc',
                    name: 'desc',
                    class: 'text-center',

                    searchable: true,
                    "render": function(data, type, row) {
                        if (row.desc === null) {
                            return '<span class="text-center">-</span>';
                        } else {
                            return '<span class="text-center">' + row.desc + '</span>';
                        }
                    },
                },
                {
                    data: 'users',
                    name: 'users',
                    class: 'text-center fw-bold',

                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-center',

                    "render": function(data, type, row) {

                        return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaleditanalysis(' + "'" + row.id + "'" + ',' + "'" + row.id_analysis + "'" + ',' + "'" + row.date + "'" + ',' + "'" + row.code_sample_final + "'" + ',' + "'" + row.ni + "'" + ',' + "'" + row.fe + "'" + ',' + "'" + row.increment + "'" + ',' + "'" + row.desc + "'" + ')"><i class="fas fa-xl fa-edit"></i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteanalysis(' + "'" + row.id + "'" + ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                    },
                },
            ],



            dom: 'tip',

            order: [
                [1, 'desc']
            ],

            columnDefs: [

                {
                    orderable: false,
                    targets: [7]
                },

            ],

        });



        $('#search_preparation_analysis').on('keyup', function() {

            table.search(this.value).draw();

        });



    });
    // end
</script>



@include('preparation.status')

@include('preparation.edit')

@include('preparation.edit_analysis')

@include('preparation.delete')

@include('preparation.delete_analysis')

<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); }}"></script>
<script>
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });

    $('#ea_date').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });
</script>

<script>
    // status

    function openmodalstatus(id, location, code_sample, date) {

        $('#modalstatus').modal('show');

        document.getElementById('st_id').value = id;

        document.getElementById('st_location').value = location;

        document.getElementById('st_code_sample').value = code_sample;

        document.getElementById('st_date').value = date;

    }

    function submitformstatus() {

        var value = document.getElementById('st_id').value;

        document.getElementById('form_status').action = "../preparation/statusact/" + value;

        document.getElementById("form_status").submit();

    }



    // edit

    function openmodaledit(id, location, sample_mining, increment, ni, fe, status) {

        $('#modaledit').modal('show');

        document.getElementById('e_id').value = id;

        document.getElementById('e_sample_mining').value = sample_mining;

        document.getElementById('e_increment').value = increment;

        document.getElementById('e_ni').value = ni;

        document.getElementById('e_fe').value = fe;



        document.getElementById("e_location_default").innerHTML = location;

        document.getElementById("e_status_default").innerHTML = status;

    }

    function submitformedit() {

        if (document.forms["form_edit"]["e_ni"].value == "") {

            alert("Masukan Kadar Nickel (Ni)");

            document.forms["form_edit"]["e_ni"].focus();

            return false;

        }



        if (document.forms["form_edit"]["e_fe"].value == "") {

            alert("Masukan Kadar Iron (Fe)");

            document.forms["form_edit"]["e_fe"].focus();

            return false;

        }



        if (document.forms["form_edit"]["e_location"].value == "") {

            alert("Location Cannot be Empty");

            document.forms["form_edit"]["e_location"].focus();

            return false;

        }



        if (document.forms["form_edit"]["e_sample_mining"].value == "") {

            alert("Sample Mining Cannot be Empty");

            document.forms["form_edit"]["e_sample_mining"].focus();

            return false;

        }



        if (document.forms["form_edit"]["e_increment"].value == "") {

            alert("Increment Cannot be Empty");

            document.forms["form_edit"]["e_increment"].focus();

            return false;

        }



        var value = document.getElementById('e_id').value;

        document.getElementById('form_edit').action = "../preparation/editact/" + value;

        document.getElementById("form_edit").submit();

    }

    function openmodaleditanalysis(id, id_analysis, date, code_sample_final,ni,fe,increment,desc) {

        $('#modaleditanalysis').modal('show');

        document.getElementById('ea_id').value = id;
        document.getElementById('ea_id_analysis').value = id_analysis;
        document.getElementById('ea_date').value = date;
        document.getElementById('ea_code_sample_final').value = code_sample_final;
        document.getElementById('ea_ni').value = ni;
        document.getElementById('ea_fe').value = fe;
        document.getElementById('ea_increment').value = increment;
        document.getElementById('ea_desc').value = desc;
        }

        function submitformeditanalysis() {

        var value = document.getElementById('ea_id').value;

        document.getElementById('form_edit_analysis').action = "../preparation/edit_analysis_act/" + value;

        document.getElementById("form_edit_analysis").submit();

    }



    // delete

    function openmodaldelete(id) {

        $('#modaldelete').modal('show');

        document.getElementById('del_id').value = id;

    }



    function submitformdelete() {

        var value = document.getElementById('del_id').value;

        document.getElementById('form_delete').action = "../preparation/destroy/" + value;

        document.getElementById("form_delete").submit();

    }


    function openmodaldeleteanalysis(id) {

        $('#modaldeleteanalysis').modal('show');

        document.getElementById('del_id_analysis').value = id;
    }



    function submitformdeleteanalysis() {

        var value = document.getElementById('del_id_analysis').value;

        document.getElementById('form_delete_analysis').action = "../preparation/destroyanalysis/" + value;

        document.getElementById("form_delete_analysis").submit();

    }
</script>

@endsection