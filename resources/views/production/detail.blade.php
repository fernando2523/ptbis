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
                <li class="breadcrumb-item"><a href="/production/productions">PRODUCTION</a></li>
                <li class="breadcrumb-item active">PRODUCTION PAGE</li>
            </ul>
            
            <h1 class="page-header">
                Detail Sample Mining
            </h1>
            </div>
        </div>
        {{-- <div class="mb-sm-3 mb-2 d-sm-flex">
            <div class="mt-sm-0 mt-2r" style="cursor: pointer;" ><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd" class="text-white text-opacity-75 text-decoration-none"><i class="fas fa-plus-circle fa-fw me-1 text-theme"></i>New Employee</a></div>
        </div> --}}
        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">

                <div class="pos-content">
                    <div class="pos-content-container h-100 p-4" data-scrollbar="false" data-height="100%">
                        <div class="d-md-flex align-items-center mb-4">
                            <div class="flex-1">
                                <div class="flex-fill fw-bold fs-22px text-white">{{ $getpit }}</div>
                                <div class="mb-2 mb-md-0 d-flex">
                                    <div class="d-flex align-items-center me-3">
                                        <div class="flex-fill fw-bold fs-14px  text-white">PRODUCTION : {{ $gettotal* 1.69 }} <small>M/T</small></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div align="right">
                                    <i class="fa fa-flag-checkered fa-fw fa-2x  text-white"></i>
                                </div>
                                <div class="flex-fill fw-bold fs-14px text-white" align="right">TOTAL SM : {{ $getsm }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row gx-4">
                            @foreach ($data as $key=>$datas)
                            <div class="col-xl-2 col-lg-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalPosBooking" class="pos-table-booking card">
                                    <div class="card-body p-1">
                                        <div class="pos-table-booking-container">
                                            <div class="pos-table-booking-header" style="padding-top: 0px;padding-bottom: 0px;padding-left: 0px;padding-right: 0px;">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-12 text-center">
                                                        <div class="fw-bold fs-35px text-white">{{ $datas->code_sample }}</div>
                                                        <span class="text-theme">{{ $datas->date }}</span>
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 0px;margin-bottom: 0px;"></hr>
                                                <div class="d-flex align-items-center">
                                                    <div class="col-12 text-center">
                                                        {{-- @if ($datas->ni === "0")
                                                        <i class="bi bi-hourglass-split text-white fa-4x me-1"></i>
                                                        @elseif (doubleval($datas->ni) >= 2)
                                                        <i  class="bi bi-flag-fill text-lime text-opacity-88 fa-4x me-1"></i>
                                                        @elseif (doubleval($datas->ni) >= 1.8 && doubleval($datas->ni) < 2)
                                                        <i  class="bi bi-flag-fill text-indigo text-opacity-88 fa-4x me-1"></i>
                                                        @elseif (doubleval($datas->ni) < 1.8 && doubleval($datas->ni) >= 1.6)
                                                        <i  class="bi bi-flag-fill text-primary text-opacity-88 fa-4x me-1"></i>
                                                        @elseif (doubleval($datas->ni) < 1.6)
                                                        <i  class="bi bi-flag-fill text-yellow text-opacity-88 fa-4x me-1"></i>
                                                        @endif --}}
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 0px;margin-bottom: 0px;"></hr>
                                                <div class="row text-center mt-1 mb-2" style="margin-left: 1px;margin-right: 1px;padding-top: 5px;">
                                                    <div class="col-6" >
                                                        <div class="text-white fs-12px">{{ $datas->bucket }} Bucket</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="text-white fs-12px">{{ $datas->bucket * 1.69 }} M/T</div>
                                                    </div>
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

