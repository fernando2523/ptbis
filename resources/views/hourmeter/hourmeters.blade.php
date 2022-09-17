@extends('layouts.main')
@section('container')


<!-- BEGIN #app -->
    <!-- BEGIN #content -->
    <style>
        .pos-content {
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
        scrollbar-width: none;  /* Firefox */
        }
        .pos-content::-webkit-scrollbar { 
            display: none;  /* Safari and Chrome */
        }
    </style>

    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        <div class="d-flex align-items-center mt-3">
            <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/hourmeter/hourmeters">HOUR METER</a></li>
                <li class="breadcrumb-item active">HOUR METER PAGE</li>
            </ul>
            
            <h1 class="page-header">
                Hour Meter
            </h1>
            </div>
            
            <div class="ms-auto">
                <span class="ms-3"><span data-id="prev-date" id="daterangepicker-compare-date"> </span></span>
                <a href="#" class="btn btn-sm btn-outline-theme rounded-0 mb-2" id="daterangepicker">
                    <i class="fa fa-fw fa-calendar"></i> 
                    <span data-id="daterangepicker-date">Today</span> 
                    <i class="fa fa-fw fa-caret-down me-n1"></i> 
                </a>
                <div align="right">
                    <select class="form-select form-select-sm text-theme" id="type_vehicle" name="type_vehicle" required>
                    <option value="" disabled selected>Select PIT</option>
                    <option value="PIT - 1">PIT - 1</option>
                    <option value="PIT - 2">PIT - 2</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">

                <!-- BEGIN pos-content -->
					<div class="pos-content">
						<div class="pos-content-container h-100 p-4" data-scrollbar="false" data-height="100%">
                            <div class="input-group mb-3">
                                <div class="flex-fill position-relative">
                                    <form action="/hourmeter/hourmeters/cari" method="GET">
                                    <div class="input-group">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                            <input type="text" class="form-control ps-35px" name="cari" value="{{ old('cari') }}" placeholder="Search.." />
                                           <a class="btn btn-outline-theme" href="/hourmeter/hourmeters">clear</a>
                                    </div>
                                </form>
                                </div>
                            </div>
							<div class="d-md-flex align-items-center mb-4">
								<div class="flex-1">
									<div class="fs-24px mb-1">Available Excavator ( {{ $countready }} / {{ $countall }} )</div>
									<div class="mb-2 mb-md-0 d-flex">
                                        <div class="d-flex align-items-center me-3 text-success">
											<i class="fa fa-circle fa-fw text-success fs-9px me-1"></i> Working <strong style="padding-left: 5px;" >( {{ $countready }} ) </strong>
										</div>
										<div class="d-flex align-items-center me-3 text-warning">
											<i class="fa fa-circle fa-fw text-warning fs-9px me-1"></i> Stand By <strong style="padding-left: 5px;" >( {{ $countstandby }} ) </strong> 
										</div>
									</div>
								</div>
								<div>
									<div>
										<a href="/hourmeter/hm-report" class="btn btn-outline-theme">
											VIEW REPORT..
                                        </a>
									</div>
								</div>
							</div>
							<div class="row gx-4">
                                @foreach ($datahm as $key=>$hms)
								<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
									<a href="#" data-bs-toggle="modal" data-bs-target="#modalPosBooking" class="pos-table-booking card">
										<div class="card-body p-1">
											<div class="pos-table-booking-container">
												<div class="pos-table-booking-header">
													<div class="d-flex align-items-center">
														<div class="flex-1">
                                                            <div class="desc text-success"><small>#{{ $hms->id_hm }}</small></div>
															<div class="title text-body">{{ $hms->vehicle_unit }} <span class="text-default">| {{ $hms->type_unit }}</span></div>
															<div class="no">{{ $hms->identify }}</div>
															<div class="desc text-success">{{ $hms->operator }}</div>
														</div>
														<div class="pe-1 text-success">
															<i class="bi bi-check2-circle fa-3x"></i>
														</div>
													</div>
                                                    <div class="card-body py-2">
                                                        <div class="d-flex align-items-center">
                                                            <div style="margin-left: -12px;">
                                                                <div><img width="75px;" src="/assets/img/pos/excavator.png"></div>
                                                            </div>
                                                            <div class="flex-1 ps-2">
                                                                <table class="w-100 small mb-0 text-white text-opacity-60">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="w-6px h-6px rounded-pill me-2 bg-success bg-opacity-95"></div> HM START
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-end text-success">{{ $hms->hm_start }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="w-6px h-6px rounded-pill me-2 bg-success bg-opacity-75"></div> HM FINISH
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-end text-success">{{ $hms->hm_finish }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="w-6px h-6px rounded-pill me-2 bg-success bg-opacity-55"></div> HM TOTAL
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-end text-success">{{  number_format($hms->hm_total,-2) }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                {{-- <tfoot>
                                                                    <tr>
                                                                        <td><span class="badge d-block bg-success bg-opacity-75 text-success-900 rounded-0 pt-7px w-150px" style="min-height: 24px;font-size: 12px;"><i class="bi bi-droplet-half"></i> {{ $hms->consumption }} Liter</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <div class="text-center fs-11px text-default" style="padding-top: 5px;">
                                                                               FUEL / HOUR : <span class="text-theme">{!! number_format($fuelhour,-2) !!} L</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot> --}}
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="pos-table-booking-body">
                                                    <div class="booking">
														<div class="time">Location :</div>
														<div class="info text-success fw-bold"> {{ $hms->location }}</div>
													</div>
                                                    <div class="booking">
														<div class="time">Activity :</div>
														<div class="info text-success fw-bold"> {{ $hms->activity }}</div>
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
									</a>
								</div>
                                @endforeach
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
@endsection

