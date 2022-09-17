@extends('layouts.main')
@section('container')

<div id="content" class="app-content">
	<div style="overflow:hidden;">
		<h3 class="" align="left">
			Daily Report
		</h3>

		<div class="row align-items-end mb-2">

			<div class="col-xl-4 col-lg-4 col-12 mb-3">
				{{-- <label>Select Date</label> --}}
				<div id="reportrange" class="btn btn-outline-theme d-flex align-items-center mt-2">
					<span class="text-truncate">&nbsp;</span>
					<i class="fa fa-caret-down ms-auto"></i>
				</div>
			</div>

			<div class="col-xl-8 col-lg-8 col-12" align="right">
				<h6 class="fw-normal text-theme">Last Update, 27 August 2022</h6>
			</div>
		</div>

		<div id="data_load">
		</div>

		{{-- <div id="data_load_barging">
		</div> --}}
		<div class="row mb-2">
			<div class="col-12">
				<div class="card mb-3">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="d-flex fw-bold small mb-3">
							<span class="flex-grow-1">BARGING OVERVIEW</span>
						</div>
		
						<div class="mb-3" style="padding-left:5px;padding-right: 5px;">
							<input type="text" readonly  class="form-control form-control-sm fw-bold" id="getbulan" required autocomplete="OFF" placeholder="Select Month" />
						</div>
						<!-- END title -->
						<!-- BEGIN table -->
						<div id="data_load_barging">
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
		</div>
		<br><br><br><br><br>
	</div>
</div>


<script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js'); }}"></script>
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var start = moment().startOf('month');
		var end = moment().endOf('month');

		document.getElementById('getbulan').value= start.format('YYYY-MMMM');
		var bulan = document.getElementById('getbulan').value;

		function cb(start, end) {
			$('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
			load_data(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
			// load_data_barging(bulan.format('yyyy-MM'));
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

		$('#getbulan').datepicker({
			format: "yyyy-MM",
			startView: "year", 
			minViewMode: "months",
			autoclose: true
		});

		cb(start, end);
		load_data_barging(bulan)

		$( "#getbulan" ).change(function() {
			load_data_barging(this.value)
		});

	});

	function load_data(start, end){
		$.ajax({
			type:'POST',
			url:"{{URL::to('/load_data')}}",
			data:{
				start: start,
				end: end,
			},
			success:function(data){
				$('#data_load').html(data);
			}
		});
	}

	function load_data_barging(bulan){
		$.ajax({
			type:'POST',
			url:"{{URL::to('/load_data_barging')}}",
			data:{
				bulan: bulan,
			},
			success:function(data){
				$('#data_load_barging').html(data);
			}
		});
	}
</script>


<script src="{{ URL::asset('assets/daterangepicker/moment.min.js'); }}"></script>
<script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js'); }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css'); }}"/>

@endsection