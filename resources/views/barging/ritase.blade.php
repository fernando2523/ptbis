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
                <li class="breadcrumb-item"><a href="/barging/bargings">BARGING</a></li>
                <li class="breadcrumb-item active">RITASE BARGING</li>
            </ul>
            
            <h1 class="page-header">
                RITASE TO <span class="text-theme">{{ $getnama[0]->loc }}</span>
            </h1>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-sm btn-outline-theme rounded-0" id="daterangepicker">
                    <i class="fa fa-fw fa-calendar"></i> 
                    <span data-id="daterangepicker-date">Today</span> 
                    <i class="fa fa-fw fa-caret-down me-n1"></i> 
                </a>
            </div>
        </div>
        {{-- <div class="mb-sm-3 mb-2 d-sm-flex">
            <div class="mt-sm-0 mt-2r" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd" class="text-white text-opacity-75 text-decoration-none"><i class="fas fa-plus-circle fa-fw me-1 text-theme"></i>New Employee</a></div>
        </div> --}}
       
        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">

                <!-- BEGIN pos-content -->
					<div class="pos-content" >
						<div class="pos-content-container h-100 p-3" data-scrollbar="false" data-height="100%" >
							<div class="row gx-4" >
								
                                @foreach ($dataritase as $key=>$value)

                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
									<a class="pos-table-booking card" >
										<div class="card-body p-1" >
											<div class="pos-table-booking-container" style="height: 468px;">
												<div class="pos-table-booking-header" style="padding-bottom: 5px;padding-top: 5px;">
													<div class="d-flex align-items-center" >
														<div class="flex-1">
															<div class="no">{{ $value->identify }}</div>
															<div class="desc text-white">{{ $value->model_unit }}</div>
															<div class="desc text-success">{{ $value->operator }}</div>
														</div>
														<div class="text-white mt-2">
                                                            <div align="right">
															<i class="fas fa-truck fa-4x text-default"></i>
                                                            </div>
                                                            <?php $count=0; ?>
                                                            <?php $bucket=0; ?>
                                                            @foreach ($getritase as $key=>$value2)
                                                                @if ($value->identify === $value2->identify)
                                                                <?php $count++; ?>
                                                                <?php $bucket = $value2->bucket + $bucket; ?>
                                                                @endif
                                                            @endforeach

                                                                <div class="desc text-default" align="right"><small> TOTAL RIT : </small><span style="margin-left: 15px;" class="text-white">{{ $count }}</span></div>
                                                                <div class="desc text-default" align="right"><small > BUCKET : </small><span style="margin-left: 6px;" class="text-white">{{ $bucket }}</span></div>
														</div>
													</div>
												</div>
												<div class="pos-table-booking-body pos-content" style="overflow-y: scroll;height: 350px;">

                                                    <table class="w-100 small mb-0 table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <td width="3%" class=" text-center fw-bold">
                                                                    #RIT
                                                                </td>
                                                                <td width="8%" class="text-center fw-bold">DEPARTURE</td>
                                                                <td width="20%" class="text-center fw-bold">ARRIVAL</td>
                                                                <td width="5%" class="text-center fw-bold">MATERIAL</td>
                                                                <td width="3%" class="text-center fw-bold">BUCKET</td>
                                                            </tr>
                                                        </thead>
                                                        <?php $i=0; ?>
                                                        @foreach ($dataritase2 as $keys=>$values)
                                                        @if ($values->identify === $value->identify)
                                                        <?php $i++; ?>
                                                                <tbody style="font-size: 10px;">
                                                                    <tr>
                                                                        <td class="text-white text-center fw-bold" width="4%" >
                                                                            #{{ $i }}
                                                                        </td>
                                                                        <td width="8%" class="text-center text-warning">
                                                                            <span class="fw-bold">{{ $values->departure_location }} </span><br>
                                                                            <span class="fw-bold">{{ date_format(date_create($values->departure_ts),"H:i:s") }}</span>
                                                                        </td>
                                                                        <td width="20%" class="text-center text-info">
                                                                            <span class="fw-bold">{{ $values->arrival_location }} </span><br>
                                                                            <span class="fw-bold">{{ date_format(date_create($values->arrival_ts),"H:i:s") }}</span>
                                                                        </td>
                                                                        <td width="5%" class="text-center">
                                                                            <span class="fw-bold text-white">{{ $values->material }} </span><br>
                                                                        </td>
                                                                        <td width="6%" class="text-center">
                                                                            <span class="fw-bold text-white">{{ $values->bucket }} </span><br>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                        @endif
                                                    @endforeach
                                                    </table>
                                                    {{-- <div class="booking" style="padding-left: 0px;padding-right: 0px;">
                                                    </div> --}}
												</div>
											</div>
										</div>
										<div class="card-arrow" >
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
					<!-- END pos-content -->
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

