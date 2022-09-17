@extends('layouts.main')
@section('container')
<div id="content" class="app-content">
    <div class="d-flex align-items-center">
        <div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/barging/bargings">BARGING</a></li>
            <li class="breadcrumb-item active">BARGING PAGE</li>
        </ul>
        
        <h1 class="page-header">
            Barging
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
        <div class="mt-sm-0 mt-2" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Barg</a></div>

        <div class="ms-sm-3 mt-sm-0 mt-2" style="cursor: pointer;" ><a class="btn btn-outline-warning" href="/barging/detail"><i class="fa fa-database fa-fw me-1"></i> Detail Report Barging</a></div>

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

    <div class="modal fade" id="modaladd" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">NEW BARGING</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="was-validated"  method="POST" action="{{ url('/barging/bargings/store') }}">
                    @csrf
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-6 form-group position-relative mb-3">
                            <label class="form-label">NAME JETTY</label>
                            <select class="form-select text-theme" id="loc" name="loc" required>
                                <option value="" disabled selected>Choose Land</option>
                                @foreach ($getlocation as $keyloc)
                                <option value="{{ $keyloc->location }}">{{ $keyloc->location }}</option>  
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Unit.
                            </div>
                        </div>
                        <div class="col-6 form-group mb-3">
                            <label class="form-label">BARGE CAPACITY</label>
                            <input class="form-control formm-control-sm text-theme is-invalid" type="number" name="capacity" id="capacity" required placeholder="Please provide a name vehicle" autocomplete="OFF">
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

    <div id="data_barging"></div>
   
    <div class="row mb-3">
        @foreach($getdata as $key=>$value)
        <div class="col-xl-6 col-lg-6 mb-3" >
            <div class="card">
                <!-- BEGIN card-body -->
                <div class="card-body" style="min-height: 392px;">
                    <div class="d-flex align-items-center">
                        <div class="flex-fill fw-bold fs-16px text-indigo">{{ $value->id_barg }}</div>
                        <div class="flex-fill fw-bold fs-16px">{{ $value->loc }} 
                            @if (auth::user()->role === "SUPER-ADMIN")
                            <a style="cursor: pointer;"  onclick="openmodaldeletebarg('{{ $value->id }}','{{ $value->id_barg }}')"><i class="fa fa-times-circle fa-fw me-1 text-danger"></i></a>
                            @endif
                        </div>
                        @if ($value->status === "FINISHED")
                        <span class="badge d-block bg-success bg-opacity-80 rounded-5 pt-5px w-120px" style="min-height: 18px;"><i class="fa fa-flag-checkered fa-fw me-1"></i>{{ $value->status }}</span>
                        @else
                        <a type="button" onclick="openmodalstatus('{{ $value->id }}','{{ $value->id_barg }}')" class="badge d-block bg-warning bg-opacity-80 rounded-5 pt-5px w-120px text-white" style="min-height: 18px;text-decoration:none;"><i class="fa fa-clock fa-fw me-1"></i>{{ $value->status }}</a>
                        @endif
                       
                    </div>
                    <div class="row mb-2 mt-2">
                        <div class="col-6">
                            <div class="flex-fill fw-bold fs-14px text-indigo">CAPACITY : {{ @nomorin($value->capacity) }} <small>M/T</small></div>
                        </div>
                        <div class="col-6">
                            @if ($value->status === "FINISHED")
                            <div class="flex-fill fw-bold fs-14px text-success" align="right">COMPLETED : {{ @nomorin($tonaseavg) }} <small>M/T</small></div>
                            @else
                            <div class="flex-fill fw-bold fs-14px text-warning" align="right">FILLED : {{ @nomorin($tonaseavg) }} <small>M/T</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <hr style="margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-12">
                                            <h5 class="mb-0 text-default">ORIGIN</h5>
                                        </div>
                                    </div>
                                    <div class="text-white text-opacity-90 fs-12px">
                                        @foreach ($origin as $key=> $origins)
                                        @if ($value->id_barg === $origins->id_barg)
                                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ $origins->origin }} = {{ $origins->bucket * 1.689 }} <small>M/T</small><br />
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

                            <div class="card mb-1">
                                <div class="card-body">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-12">
                                            <h5 class="mb-0 text-default">DEPARTURE</h5>
                                        </div>
                                    </div>
                                    <div class="text-white text-opacity-90 fs-12px">
                                        @foreach ($departure as $key=> $departures)
                                        @if ($value->id_barg === $departures->id_barg)
                                        <i class="fa fa-chevron-up fa-fw me-1"></i> {{ $departures->departure_location }} = {{ @nomorin($departures->bucket * 1.689) }} <small>M/T</small><br />
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
                        <div class="col-xl-1 col-lg-1">
                        </div>

                        <div class="col-xl-5 col-lg-6 mb-3">
                            <canvas id="doughnutCharts"></canvas>
                        </div>
                        

                        <div class="col-xl-12 col-lg-12 text-center mb-1 mt-3">
                            <hr style="margin-top: 0px;">
                            <i class="fa fa-square text-warning-400 me-2"></i> 
                            <span class="fs-12px me-2 fw-bold text-warning-400" >STARTED : {{ date('d M Y', strtotime($value->start)) }}</span>

                            @if ($value->status != "FINISHED")
                            <i class="fa fa-square text-theme me-2"></i> 
                            <span class="fs-12px me-2 fw-bold text-success-400">ESTIMATED : {{ date('d M Y', strtotime($value->start. ' +10 day')) }}</span>
                            @else
                            <i class="fa fa-square text-theme me-2"></i> 
                            <span class="fs-12px me-2 fw-bold text-success-400">FINISHED : {{ date('d M Y', strtotime($value->finish)) }}</span>
                            @endif

                            

                        </div>
                        <div class="col-xl-12 col-lg-12 mb-1">
                            <div class="progress">
                                <?php $progress = ($value->stock/$value->capacity)*100;  ?>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{ $progress }}%">{{ $progress }}%</div>
                            </div>
                        </div>
                        {{-- <div class="col-xl-12 col-lg-12 text-center">
                        @foreach ($getdata2 as $key=>$gets)
                            @if ($gets->id_barg === $value->id_barg)
                                
                            @endif
                        @endforeach
                        @empty($gets->id_barg)
                            <a class="text-decoration-none text-warning text-opacity-80 fw-bold" >RITASE NOT FOUND !!</a>
                        @else
                            @if ($gets->id_barg === $value->id_barg)
                            <a href="{{ url('/barging/ritase/'.$value->id_barg) }}" class="text-decoration-none text-success text-opacity-80 fw-bold">VIEW RITASE...</a>
                            @else
                            <a class="text-decoration-none text-warning text-opacity-80 fw-bold" >RITASE NOT FOUND !!</a>
                            @endif
                        @endempty
                        </div> --}}
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
        @endforeach
    </div>

</div>

    <script src="{{ URL::asset('../assets/plugins/chart.js/dist/chart.min.js'); }}"></script>
    <script>
        var ctx6 = document.getElementById('doughnutCharts');
        var doughnutChart = new Chart(ctx6, {
          type: 'doughnut',
          data: {
            labels: ['FILLED', 'EMPTY'],
            datasets: [{
              data: [{{ $tonaseavg }}, 7500-{{ $tonaseavg }}],
              backgroundColor: [app.color.theme, app.color.orange],
              hoverBackgroundColor: [app.color.theme, app.color.gray900],
              borderWidth: 0
            }]
          }
        });
      </script>
    {{-- <script>
        var ctx6 = document.getElementById('doughnutCharts2');
        var doughnutChart = new Chart(ctx6, {
          type: 'doughnut',
          data: {
            labels: ['Progress', '7.500 M/T'],
            datasets: [{
              data: [4323, 7500],
              backgroundColor: [app.color.theme, app.color.orange],
              hoverBackgroundColor: [app.color.theme, app.color.gray900],
              borderWidth: 0
            }]
          }
        });
      </script> --}}
<!-- ================== END page-js ================== --> 

@include('barging.status')
@include('barging.deletebarg')

<script>
    // edit
    function openmodalstatus(id,id_barg) {
        $('#modalstatus').modal('show');
        document.getElementById('st_id').value = id;
        document.getElementById('st_id_barg').innerHTML = id_barg;
    }

    function submitformstatus() {
        var value = document.getElementById('st_id').value;
        document.getElementById('form_status').action = "../barging/statusact/"+value;
        document.getElementById("form_status").submit();
    }

     // delete
    function openmodaldeletebarg(id,id_barg) {
        $('#modaldelete').modal('show');
        document.getElementById('del_id').value = id;
        document.getElementById('del_id_barg').value = id_barg;
    }

    function submitformdelete() {
        var value = document.getElementById('del_id').value;
        document.getElementById('form_delete').action = "../barging/destroybarg/"+value;
        document.getElementById("form_delete").submit();
    }
</script>

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
			url:"{{URL::to('/load_barging')}}",
			data:{
				start: start,
				end: end,
			},
			success:function(data){
				$('#data_barging').html(data);
			}
		});
	}

</script>


<script src="{{ URL::asset('assets/daterangepicker/moment.min.js'); }}"></script>
<script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js'); }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css'); }}"/>
@endsection
