<!-- BEGIN row -->
<div class="row">
	<div class="col-xl-12 col-lg-12 col-sm-12">
		<div class="row">
			<!-- Production -->
			<div class="col-xl-3 col-sm-12">
				<!-- BEGIN card -->
				<div class="card mb-3" style="min-height:178px;">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="fw-bold small mb-2">
							<span class="flex-grow-1 fs-18px text-white">Production</span><br>
							<span class="fs-10px text-theme fw-normal">Periode {{ $start }} - {{ $end }}</span>
						</div>
						<!-- END title -->
						<!-- BEGIN stat-lg -->
						<div class="row align-items-center mb-2">
							<div class="col-7">
								<h3 class="mb-0">{{ $production }} M/T</h3>
							</div>
							<div class="col-5">
							</div>
						</div>
						<!-- END stat-lg -->
						<!-- BEGIN stat-sm -->
						<div class="small text-white text-opacity-50 text-truncate">
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i> Result from: {{ $countproduction }} PIT<br />
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i> Unit Kerja: {{ $countunit }} Exca<br />
						</div>
						<!-- END stat-sm -->
						{{-- <hr style="margin:13% 0 4% 0;">
						<div align="center">
							<a href="#" class="fs-12px card-link fw-bold">View Details ></a>
						</div> --}}
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
				<!-- END card -->
			</div>
			<!-- End Production -->

			<!-- Fuel Used -->
			<div class="col-xl-3 col-sm-12">
				<!-- BEGIN card -->
				<div class="card mb-3" style="min-height:178px;">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="fw-bold small mb-2">
							<span class="flex-grow-1 fs-18px text-white">Fuel Used</span><br>
							<span class="fs-10px text-theme fw-normal">Periode {{ $start }} - {{ $end }}</span>
						</div>
						<!-- END title -->
						<!-- BEGIN stat-lg -->
						<div class="row align-items-center mb-2">
							<div class="col-7">
								<h3 class="mb-0">{{ @nomorin($fuel_used['0']->qty) }} Liter</h3>
							</div>
							<div class="col-5">
							</div>
						</div>
						<!-- END stat-lg -->
						<!-- BEGIN stat-sm -->
						<div class="small text-white text-opacity-50 text-truncate">
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>Dump Truck Used: {{ $sumrefill_DT }} Liter<br />
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>Excavator Used: {{ $sumrefill_EX }} Liter<br />
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>LV Used: {{ $sumrefill_LV }} Liter<br />
						</div>
						<!-- END stat-sm -->
						{{-- <hr style="margin:6.3% 0 4% 0;">
						<div align="center">
							<a href="#" class="fs-12px card-link fw-bold">View Details ></a>
						</div> --}}
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
				<!-- END card -->
			</div>
			<!-- End Fuel Used -->

			<!-- Hour Meters -->
			<div class="col-xl-3 col-sm-12">
				<!-- BEGIN card -->
				<div class="card mb-3" style="min-height:178px;">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="fw-bold small mb-2">
							<span class="flex-grow-1 fs-18px text-white">Hour Meters</span><br>
							<span class="fs-10px text-theme fw-normal">Periode {{ $start }} - {{ $end }}</span>
						</div>
						<!-- END title -->
						<!-- BEGIN stat-lg -->
						<div class="row align-items-center mb-2">
							<div class="col-7">
								<h3 class="mb-0">{{ @nomorin($hour_meter['0']->hm_total) }} Hours</h3>
							</div>
							<div class="col-5">
							</div>
						</div>
						<!-- END stat-lg -->
						<!-- BEGIN stat-sm -->
						<div class="small text-white text-opacity-50 text-truncate">
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>Unit Kerja: {{ $countunit_hm }} Exca<br />
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>AVG Fuel: {{ intval($total_avg) }} Liter / Hours<br />
						</div> 
						<!-- END stat-sm -->
						{{-- <hr style="margin:13% 0 4% 0;">
						<div align="center">
							<a href="#" class="fs-12px card-link fw-bold">View Details ></a>
						</div> --}}
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
				<!-- END card -->
			</div>
			<!-- End Hour Meters -->

			<!-- Ritase -->
			<div class="col-xl-3 col-sm-12">
				<!-- BEGIN card -->
				<div class="card mb-3" style="min-height:178px;">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="fw-bold small mb-2">
							<span class="flex-grow-1 fs-18px text-white">Ritase</span><br>
							<span class="fs-10px text-theme fw-normal">Periode {{ $start }} - {{ $end }}</span>
						</div>
						<!-- END title -->
						<!-- BEGIN stat-lg -->
						<div class="row align-items-center mb-2">
							<div class="col-12">
								<h3 class="mb-0">H : {{ @nomorin($hauling['0']->total) }} Rit | B : {{ @nomorin($barging['0']->total) }} Rit</h3>
							</div>
						</div>
						<!-- END stat-lg -->
						<!-- BEGIN stat-sm -->
						<div class="small text-white text-opacity-50 text-truncate">
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>Unit Kerja: {{ $countunit_DT }} Dump Truck<br />
							<i class="fa fa-chevron-right fa-fw me-1 text-theme"></i>AVG Fuel: {{ intval($total_avg_DT) }} Liter / Rit<br />
						</div>
						<!-- END stat-sm -->
						{{-- <hr style="margin:13% 0 4% 0;">
						<div align="center">
							<a href="#" class="fs-12px card-link fw-bold">View Details ></a>
						</div> --}}
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
				<!-- END card -->
			</div>
			<!-- End Ritase -->

		</div>
	</div>

	<div class="col-xl-7 col-lg-7">
		<div class="row">
			<!-- BEGIN col-6 -->
			<div class="col-xl-12">
				<!-- BEGIN card -->
				<div class="card mb-3">
					<!-- BEGIN card-body -->
					<div class="card-body">
						<!-- BEGIN title -->
						<div class="d-flex fw-bold small mb-3">
							<span class="flex-grow-1">PRODUCTION By DATE</span>
						</div>
						<!-- END title -->
						<div id="chartss"></div>

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
				<!-- END card -->
			</div>
			<!-- END col-6 -->
		</div>
	</div>

	<div class="col-xl-5 col-lg-5">
		<div class="card mb-3">
			<!-- BEGIN card-body -->
			<div class="card-body">
				<!-- BEGIN title -->
				<div class="d-flex fw-bold small mb-3">
					<span class="flex-grow-1">DAILY ACTIVITY LOG</span>
				</div>
				<!-- END title -->
				<!-- BEGIN table -->
				<style>
					.daily_act {
						-ms-overflow-style: none;  /* Internet Explorer 10+ */
						scrollbar-width: none;  /* Firefox */
					}
					.daily_act::-webkit-scrollbar { 
						display: none;  /* Safari and Chrome */
					}
				</style>
				<div class="daily_act" style="height: 345px;overflow: scroll;">
					@if ($activity_count === 0)
					<table class="table table-striped table-borderless mb-2px small text-nowrap">
						<tbody>
							<tr>
								<td width="100%" align="center" style="height: 330px;">
									<div class="fw-bold fs-24px text-success" style="padding-top: 30%;">DATA KOSONG</div>
								</td>
							</tr>
						</tbody>
					</table>
					@endif

					<table class="table table-striped table-borderless mb-2px small text-nowrap">
						<tbody>
							@foreach($activity as $key => $act)
							<tr align="center">
								
								@if ($act->activity === "STAND BY")
								<td class="fw-bold">
									<span class="d-flex align-items-center">
										<i class="bi bi-circle-fill fs-6px text-danger me-2"></i>
										{{$act->date}}
									</span>
								</td>
								<td class="fw-bold text-danger">{{$act->activity}}</td>
								<td class="fw-bold text-danger">{{$act->desc}}</td>
								@elseif ($act->activity === "WORKING")
								<td class="fw-bold">
									<span class="d-flex align-items-center">
										<i class="bi bi-circle-fill fs-6px text-success me-2"></i>
										{{$act->date}}
									</span>
								</td>
								<td class="fw-bold text-success">{{$act->activity}}</td>	
								@elseif ($act->activity === "LIBUR")
								<td class="fw-bold">
									<span class="d-flex align-items-center">
										<i class="bi bi-circle-fill fs-6px text-warning me-2"></i>
										{{$act->date}}
									</span>
								</td>
								<td class="fw-bold text-warning">{{$act->activity}}</td>
								@elseif ($act->activity === "LIBUR NASIONAL")
								<td class="fw-bold">
									<span class="d-flex align-items-center">
										<i class="bi bi-circle-fill fs-6px text-warning me-2"></i>
										{{$act->date}}
									</span>
								</td>
								<td class="fw-bold text-warning">{{$act->activity}}</td>
								@endif
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- END table -->
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
<!-- END row -->

<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
<script src="{{ URL::asset('assets/plugins/apexcharts/dist/apexcharts.min.js'); }}"></script>

<script type="text/javascript">
	var options = {
		colors: ['#1ECC33','#1ECC33','#1ECC33'],
		theme: {
			mode: 'dark', 
		},
		series: [{
          name: {{ $label1 }},
          data: {!! json_encode($data1) !!}
        }, {
          name: {{ $label2 }},
          data: {!! json_encode($data2) !!}
        }, {
          name: {{ $label3 }},
          data: {!! json_encode($data3) !!}
        }],
		chart: {
			type: 'bar',
			height: 330,
			background:['transparent']
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '75%',
				endingShape: 'rounded'
			},
		},
		dataLabels: {
			enabled: false,
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		xaxis: {
			categories:{!! json_encode($category) !!},
		},
		yaxis: {
			show: false,
		},
		fill: {
			opacity: 1
		},

		tooltip: {
			y: {
				formatter: function (val) {
					return val + " M/T"
				}
			}
		}
	};

	var chart = new ApexCharts(document.querySelector("#chartss"), options);
	chart.render();
</script>

