@extends('layouts.main')

@section('container')





<!-- BEGIN #app -->

<!-- BEGIN #content -->

<style>
    .pos-content {

        -ms-overflow-style: none;
        /* Internet Explorer 10+ */

        scrollbar-width: none;
        /* Firefox */

    }

    .pos-content::-webkit-scrollbar {

        display: none;
        /* Safari and Chrome */

    }
</style>



<div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">

    <div class="d-flex align-items-center mt-3">

        <div>

            <ul class="breadcrumb">

                <li class="breadcrumb-item"><a href="/production/productions">PRODUCTION</a></li>

                <li class="breadcrumb-item active">PRODUCTION PAGE</li>

            </ul>



            <h1 class="page-header">

                Production

            </h1>

        </div>

    </div>

    {{-- <div class="mb-sm-3 mb-2 d-sm-flex">

            <div class="mt-sm-0 mt-2r" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd" class="text-white text-opacity-75 text-decoration-none"><i class="fas fa-plus-circle fa-fw me-1 text-theme"></i>New Employee</a></div>

        </div> --}}



    <div class="row">

        <div class="col-xl-3 col-lg-6">

            <div class="card mb-3">

                <div class="card-body" style="padding-bottom: 0px;height: 236px;">

                    <div>

                        <div class="d-flex fw-bold small mb-3 mt-4">

                            <span class="flex-grow-1 text-center text-white fs-20px mt-4">PRODUCTION TODAY</span>

                        </div>

                        <div class="d-flex fw-bold smallrow align-items-center">

                            <div class="col-6">

                                <h5 class="mb-0 text-center fs-24px"> {{ $gettotal * 1.69 }} <small>M/T</small></h5>

                            </div>

                            <div class="col-6 text-white" align="center">

                                <i style="font-size: 60px;" class="bi bi-triangle-half"></i>

                            </div>

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

            <div class="card mb-3">

                <div class="card-body" style="height: 236px;">

                    <div class="d-flex fw-bold small mb-3">

                        <span class="flex-grow-1">ACTIVITY PRODUCTION LOG</span>

                        <a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped table-borderless mb-2px small text-nowrap">

                            <tbody>

                                @foreach ($datahistories as $keys=>$values)

                                <tr>

                                    <td width="30%">

                                        <span class="d-flex align-items-center" style="font-size: 11px;font-weight: bold;">

                                            <i class="bi bi-circle-fill fs-6px text-theme me-2"></i>

                                            {{ $values->location }}

                                        </span>

                                    </td>

                                    <td width="20%">

                                        <span class="d-flex align-items-center]" style="font-size: 11px;font-weight: bold;">
                                            {{ $values->code_sample }} &nbsp; : &nbsp;{{ $values->bucket }} Bucket ( {{$values->bucket * 1.69}} M/T )
                                        </span>

                                    </td>

                                    <td width="20%">



                                    </td>

                                    <td width="20%" class="text-theme" align="center" style="font-weight: bold;"><small>{{ Carbon\Carbon::parse($values->created_at)->diffForHumans()}}</small></td>

                                    <!-- <td align="right" width="20%">

                                        <span class="badge d-block bg-theme bg-opacity-75 rounded-0 pt-5px w-55px" style="min-height: 18px;font-size: 10px;">INC : </span>

                                    </td> -->

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


    <div class="col-xl-4 col-lg-4 col-12 mb-4">
        <div id="reportrange" class="btn btn-outline-theme d-flex align-items-center mt-2">
            <span class="text-truncate">&nbsp;</span>
            <i class="fa fa-caret-down ms-auto"></i>
        </div>
    </div>

    <div id="data_production"></div>
    

    <br><br><br><br><br>
</div>


<script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js'); }}"></script>
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var start = moment().startOf('month');
		var end = moment().endOf('month');

		function cb(start, end) {
			$('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
			load_data(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
		}

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		cb(start, end);

	});

	function load_data(start, end){
		$.ajax({
			type:'POST',
			url:"{{URL::to('/load_production')}}",
			data:{
				start: start,
				end: end,
			},
			success:function(data){
				$('#data_production').html(data);
			}
		});
	}

</script>


<script src="{{ URL::asset('assets/daterangepicker/moment.min.js'); }}"></script>
<script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js'); }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css'); }}"/>

@endsection