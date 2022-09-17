@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/hauling/haulings">HAULING</a></li>
            <li class="breadcrumb-item active">HAULING PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Hauling
        </h1>
        </div>
        {{-- <div class="ms-auto">
            <span class="ms-3">compared to <span data-id="prev-date" id="daterangepicker-compare-date"> </span></span>
            <a href="#" class="btn btn-sm btn-outline-theme rounded-0" id="daterangepicker">
                <i class="fa fa-fw fa-calendar"></i> 
                <span data-id="daterangepicker-date">Today</span> 
                <i class="fa fa-fw fa-caret-down me-n1"></i> 
            </a>
        </div> --}}
    </div>
    <div class="mb-sm-3 mb-2 d-sm-flex">
        <div class="mt-sm-0 mt-2" style="cursor: pointer;" ><a class="btn btn-outline-warning" href="/hauling/detail"><i class="fa fa-database fa-fw me-1"></i> Detail Report Hauling</a></div>

        <div class="ms-sm-3 mt-sm-0 mt-2"><a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a></div>

        <div id="reportrange" class="btn btn-outline-theme d-flex align-items-center ms-sm-3 mt-sm-0 mt-2">
            <span class="text-truncate">&nbsp;</span>
            <i class="fa fa-caret-down ms-2"></i>
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

    <style>
        .pos-content {
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
        scrollbar-width: none;  /* Firefox */
        }
        .pos-content::-webkit-scrollbar { 
            display: none;  /* Safari and Chrome */
        }
    </style>


    <div id="data_hauling"></div>
    <!-- END -->
    <div class="row mb-3">
        @foreach ($getdata as $keys=>$values)
        
        @if ($values->arrival_location === "")
        @else
        <div class="col-xl-6 col-lg-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-fill fw-bold fs-20px">{{ $values->arrival_location }}</div>
                        {{-- <a href="{{ url('/hauling/ritase/'.$values->arrival_location.'/'.date_format(date_create($values->created_at),'Y-m-d').'/'.date_format(date_create($values->created_at),'Y-m-d')) }}" class="btn btn-outline-theme"> --}}
                            <a href="{{ url('/hauling/ritase/'.$values->arrival_location) }}" class="btn btn-outline-theme">
                            View Ritase
                        </a>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div>
                                <div class="fs-12px fw-bold mb-2 text-white text-opacity-50">ARRIVAL</div>
                                @foreach ($getdata2 as $keys=>$values2)
                                    @if ($values2->arrival_location === $values->arrival_location)
                                        <div class="row mb-2 fw-bold">
                                            <div class="col-3">
                                                <div>{{ $values2->departure_location }}</div>
                                            </div>
                                            <div class="col-3">
                                            <div class="small text-white">{{ $values2->counts }} Ritase</div>
                                            </div>
                                            <div class="col-3 text-center">{{ $values2->bucket }} Bucket</div>
                                            <?php $mtbucket = $values2->bucket * 1.4; ?>
                                            <div class="col-3 text-center">{{ $mtbucket }} M/T</div>

                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 mt-2">
                                                    <div class="card mb-2">
                                                        <div class="card-body">
                                                            <div class="row align-items-center mb-2">
                                                                <div class="col-12">
                                                                    <h5 class="mb-0 text-default fs-12px">ORIGIN</h5>
                                                                </div>
                                                            </div>
                                                            <div class="text-white text-opacity-90 fs-12px">
                                                                @foreach ($origin as $key=> $origins)
                                                                @if ($values2->arrival_location === $origins->arrival_location)
                                                                <hr style="margin-top: 5px;margin-bottom: 5px;">
                                                                <i class="fa fa-chevron-up fa-fw me-1"></i> {{ $origins->origin }} <br>
                                                                <span class="text-success" style="padding-left: 22px;">{{ $origins->bucket * 1.4 }} <small>M/T</small></span><br>
                                                                <span class="text-default" style="padding-left: 22px;">{{ $origins->bucket }} Bucket | {{ $origins->countritase }} Ritase </span>
                                                                @endif
                                                                @endforeach
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
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                        </div>
                    </div>
                </div>
                <!-- END card-body -->
                
                <!-- BEGIN card-arrow -->
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
                <!-- END card-arrow -->
            </div>
        </div>
        @endif
        @endforeach
    </div>

</div>

  <!-- ================== BEGIN page-js ================== -->
    <script src="{{ URL::asset('../assets/plugins/masonry-layout/dist/masonry.pkgd.min.js'); }}"></script>
    <script src="{{ URL::asset('../assets/plugins/chart.js/dist/chart.min.js'); }}"></script>
    <script src="{{ URL::asset('../assets/plugins/moment/min/moment.min.js'); }}"></script>
    <script src="{{ URL::asset('../assets/plugins/bootstrap-daterangepicker/daterangepicker.js'); }}"></script>
    <script src="{{ URL::asset('../assets/js/demo/analytics.demo.js'); }}"></script>
<!-- ================== END page-js ================== --> 

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
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				'This Year': [moment().startOf('year'), moment().endOf('year')],
				'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
			}
		}, cb);

		cb(start, end);

	});

	function load_data(start, end){
		$.ajax({
			type:'POST',
			url:"{{URL::to('/load_hauling')}}",
			data:{
				start: start,
				end: end,
			},
			success:function(data){
				$('#data_hauling').html(data);
			}
		});
	}

</script>


<script src="{{ URL::asset('assets/daterangepicker/moment.min.js'); }}"></script>
<script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js'); }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css'); }}"/>
@endsection
