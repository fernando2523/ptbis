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
        
        .datepicker.datepicker-dropdown {
            z-index: 200000!important;
        }
    </style>

    <div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
        <div class="d-flex align-items-center mt-3">
            <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/vendor/vendors">VENDOR</a></li>
                <li class="breadcrumb-item active">VENDOR PAGE</li>
            </ul>
            
            <h1 class="page-header">
                Vehicle
            </h1>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export CSV</a>
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#selectaddvendor"><i class="fa fa-plus-circle fa-fw me-1"></i> New Vendor</a></div>
            
        </div>

        <div class="modal fade" id="selectaddvendor" data-bs-backdrop="static" style="padding-top: 13%;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        @if ($hitung === 0)
                        <div class="form-group mt-2 mb-2" align="center">
                            <button class="btn btn-lime fw-bold" data-bs-toggle="modal" data-bs-target="#modaladd">VENDOR BARU</button>
                        </div>
                        @elseIF ($hitung > 0)
                        <div class="form-group mt-2 mb-2" align="center">
                            <button class="btn btn-lime fw-bold" data-bs-toggle="modal" data-bs-target="#modaladd">VENDOR BARU</button>
                        </div>
                        <div class="form-group mt-2 mb-2" align="center">
                            <button class="btn btn-theme fw-bold" data-bs-toggle="modal" data-bs-target="#modalextend">PERPANJANG KONTRAK VENDOR</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modaladd" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">VENDOR BARU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data" action="{{ url('/vendor/vendors/store') }}">
                        @csrf
                    <div class="modal-body">
                        <div>
                        <input type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                        <input type="hidden" class="validate" name="id_vendor" value="{{ $idven }}">
                        <input type="hidden" class="validate" name="tipe_add" value="new">
                        </div>
                        <div class="row form-group">
                            <div class="col-8 form-group position-relative mb-3">
                                <label class="form-label">Vendor (PT/CV)</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="vendor" required placeholder="Please provide a name vendor" autocomplete="OFF">
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-4 form-group position-relative mb-3">
                                <label class="form-label">Penanggung Jawab Vendor</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="pic_vendor"  placeholder="PIC Vendor" autocomplete="OFF" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-12 form-group position-relative mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" name="address" rows="2" required placeholder="Alamat.." autocomplete="OFF"></textarea>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-5 form-group mb-2">
                                <label class="form-label">Nama (Kendaraan/Alat-Berat/Lahan)</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="name_product" placeholder="Nama (Kendaraan/Alat-Berat/Lahan)" autocomplete="OFF" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-4 form-group position-relative mb-3">
                                <label class="form-label">Jasa Vendor</label>
                                <select class="form-select text-theme form-select-sm" name="type_vendor" required>
                                    <option value="" disabled selected>Pilih Jasa Vendor</option>
                                    <option disabled>_________________</option>
                                    <option value="MOBIL">MOBIL</option>
                                    <option value="MOTOR">MOTOR</option>
                                    <option value="DUMP TRUCK">DUMP TRUCK</option>
                                    <option value="EXCAVATOR">EXCAVATOR</option>
                                    <option value="BULLDOZER">BULLDOZER</option>
                                    <option value="DUMP TRUCK EXTERNAL">DUMP TRUCK EXTERNAL</option>
                                    <option disabled>_________________</option>
                                    <option class="fw-bold text-success" value="OWNED LAND">OWNED LAND</option>
                                    <option class="fw-bold text-danger" value="ROYALTY LAND">ROYALTY LAND</option>
                                    <option class="fw-bold text-primary" value="RENTAL LAND">RENTAL LAND</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Jasa Vendor yang Sesuai.
                                </div>
                            </div>
                            <div class="col-3 form-group position-relative mb-3">
                                <label class="form-label">Contract</label>
                                <select class="form-select text-theme form-select-sm" name="contract" id="contract" required onchange="statuscontract()">
                                    <option value="" disabled selected>Tipe Contract</option>
                                    <option value="RITASE">RITASE</option>
                                    <option value="HOUR METER">HOUR METER</option>
                                    <option value="EXPIRED DAYS">EXPIRED DAYS</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Tipe Contract yang Sesuai.
                                </div>
                            </div>
                            <div id="isidiv1" style="display:none;">
                                <div class="col-12 form-group position-relative mb-3 mt-3">
                                    <label class="form-label">Contract Agreement</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="contract_agreement"  placeholder="Contract Agreement" autocomplete="OFF">
                                </div>
                            </div>

                            <div id="isidiv3" style="display:none;">
                                <div class="col-4 form-group position-relative mb-3 mt-2">
                                    <label class="form-label">Hours Agreement</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="hours"  placeholder="Total Hours Agreement" autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div id="isidiv2" style="display:none;">
                                <div  class="col-2 form-group position-relative mb-3 mt-1">
                                    <label class="form-label">Qty Units</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="qty" placeholder="Qty" autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="col-3 form-group position-relative mb-3 mt-3">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="amount"  placeholder="Amount" autocomplete="OFF" required>
                                    <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-3 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Start Days</label>
                                
                                <input type="text" name="start"  class="form-control form-control-sm" id="datepicker" required autocomplete="OFF" placeholder="dd/mm/yyyy" />
                                
                            </div>
                            <div class="col-2 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Days</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="days"  placeholder="Days" autocomplete="OFF" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-4 form-group position-relative mb-3 mt-3" >
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

        <div class="modal fade" id="modalextend" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">PERPANJANG KONTRAK VENDOR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data" action="{{ url('/vendor/vendors/store') }}">
                        @csrf
                    <div class="modal-body">
                        <div>
                        <input type="hidden" class="validate" name="ext_users" value="{{ auth::user()->name; }}">
                        <input type="hidden" class="validate" name="tipe_add" value="extend">
                        </div>
                        <div class="row form-group">
                            <div class="col-7 form-group position-relative mb-3">
                                <label class="form-label">Vendor</label>
                                <select class="form-select form-select-sm text-theme" name="get_id_vendor" required>
                                    <option value="" disabled selected>Pilih Vendor</option>
                                    @foreach ($datavendor as $gets)
                                    <option value="{{ $gets->id_vendor }}">{{ $gets->vendor }} = {{ $gets->vendor }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan pilih vendor yang tepat.
                                </div>
                            </div>
                         
                            <div class="col-5 form-group position-relative mb-3">
                                <label class="form-label">Penanggung Jawab Vendor</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="ext_pic_vendor"  placeholder="PIC Vendor" autocomplete="OFF" required>
                            </div>
                           
                            <div class="col-12 form-group mb-2 mt-3">
                                <label class="form-label">Nama (Kendaraan/Alat-Berat/Lahan)</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="ext_name_product" placeholder="Nama (Kendaraan/Alat-Berat/Lahan)" autocomplete="OFF" required>
                            </div>
                            <div class="col-6 form-group position-relative mb-3 mt-2">
                                <label class="form-label">Jasa Vendor</label>
                                <select class="form-select text-theme form-select-sm" name="ext_type_vendor" required>
                                    <option value="" disabled selected>Jasa Vendor</option>
                                    <option disabled>_________________</option>
                                    <option value="MOBIL">MOBIL</option>
                                    <option value="MOTOR">MOTOR</option>
                                    <option value="DUMP TRUCK">DUMP TRUCK</option>
                                    <option value="EXCAVATOR">EXCAVATOR</option>
                                    <option value="BULLDOZER">BULLDOZER</option>
                                    <option value="DUMP TRUCK EXTERNAL">DUMP TRUCK EXTERNAL</option>
                                    <option disabled>_________________</option>
                                    <option class="fw-bold text-success" value="OWNED LAND">OWNED LAND</option>
                                    <option class="fw-bold text-danger" value="ROYALTY LAND">ROYALTY LAND</option>
                                    <option class="fw-bold text-primary" value="RENTAL LAND">RENTAL LAND</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Jasa Vendor yang Sesuai.
                                </div>
                            </div>
                            <div class="col-6 form-group position-relative mt-2 mb-3">
                                <label class="form-label">Contract</label>
                                <select class="form-select text-theme form-select-sm" name="ext_contract" id="ext_contract" required onchange="statuscontract2()">
                                    <option value="" disabled selected>Tipe Contract</option>
                                    <option value="RITASE">RITASE</option>
                                    <option value="HOUR METER">HOUR METER</option>
                                    <option value="EXPIRED DAYS">EXPIRED DAYS</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Tipe Contract yang Sesuai.
                                </div>
                            </div>

                            <div id="isidiv_new1" style="display:none;">
                                <div class="col-12 form-group position-relative mb-3 mt-3">
                                    <label class="form-label">Contract Agreement</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text" name="ext_contract_agreement"  placeholder="Perjanjian Kontrak" autocomplete="OFF">
                                </div>
                            </div>

                            <div id="isidiv_new3" style="display:none;">
                                <div class="col-4 form-group position-relative mb-2 mt-2">
                                    <label class="form-label">Hours Agreement</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="ext_hours"  placeholder="Total Hours Agreement" autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div id="isidiv_new2" style="display:none;">
                                <div  class="col-2 form-group position-relative mb-2 mt-1">
                                    <label class="form-label">Qty Units</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="ext_qty" placeholder="Qty" autocomplete="OFF">
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>

                            <div class="col-3 form-group position-relative mb-3 mt-3">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number" name="ext_amount"  placeholder="Amount" autocomplete="OFF" required>
                                    <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-3 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Start Days</label>
                                
                                <input type="text" name="ext_start" class="form-control form-control-sm" id="datepicker2" required autocomplete="OFF" placeholder="dd/mm/yyyy" />
                                
                            </div>
                            <div class="col-2 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Days</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="ext_days"  placeholder="Days" autocomplete="OFF" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                            <div class="col-4 form-group position-relative mb-3 mt-3" >
                                <label class="form-label">File Contract Upload <small class="text-warning">optional</small></label>
                                <input type="file" class="form-control form-control-sm" name="ext_file">
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

        <script>
            function statuscontract() {
                var select = document.getElementById('contract');
                var value = select.options[select.selectedIndex].value;
    
                if (value == 'EXPIRED DAYS') {
                    document.getElementById("isidiv1").style.display = 'block';
                    document.getElementById("isidiv2").style.display = 'none';
                    document.getElementById("isidiv3").style.display = 'none';
                } else if (value == 'HOUR METER') {
                    document.getElementById("isidiv1").style.display = 'none';
                    document.getElementById("isidiv2").style.display = 'block';
                    document.getElementById("isidiv3").style.display = 'block';
                } else if (value == 'RITASE') {
                    document.getElementById("isidiv1").style.display = 'block';
                    document.getElementById("isidiv2").style.display = 'block';
                    document.getElementById("isidiv3").style.display = 'none';
                }
            }

            function statuscontract2() {
                var select2 = document.getElementById('ext_contract');
                var value2 = select2.options[select2.selectedIndex].value;
    
                if (value2 == 'EXPIRED DAYS') {
                    document.getElementById("isidiv_new1").style.display = 'block';
                    document.getElementById("isidiv_new2").style.display = 'none';
                    document.getElementById("isidiv_new3").style.display = 'none';
                } else if (value2 == 'HOUR METER') {
                    document.getElementById("isidiv_new1").style.display = 'none';
                    document.getElementById("isidiv_new2").style.display = 'block';
                    document.getElementById("isidiv_new3").style.display = 'block';
                } else if (value2 == 'RITASE') {
                    document.getElementById("isidiv_new1").style.display = 'block';
                    document.getElementById("isidiv_new2").style.display = 'block';
                    document.getElementById("isidiv_new3").style.display = 'none';
                }
            }
        </script>

        {{-- <div class="input-group mb-3">
            <div class="flex-fill position-relative">
                <form action="/employee/employees/cari" method="GET">
                <div class="input-group">
                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                        <i class="fa fa-search opacity-5"></i>
                    </div>
                        <input type="text" class="form-control ps-35px" name="cari" value="{{ old('cari') }}" placeholder="Search by vendor.." />
                       <a class="btn btn-outline-default" href="/vendor/vendors">clear</a>
                </div>
            </form>
            </div>
        </div> --}}

        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">
                <div class="pos-content">
                    <div class="pos-content-container h-100 p-3" data-height="100%">
                        <div class="row gx-3">
                            @foreach ($datavendor as $key=>$vendor)

                                @foreach ($datacontract as $key=>$cont)

                                    @if ($cont->id_vendor === $vendor->id_vendor)
                                        @if ($cont->contract === "HOUR METER")
                                            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 pb-3" style="height: 530px;">
                                                                <div class="card h-100">
                                                                    <div class="card-body h-100 p-1">
                                                                        <div class="pos-product">
                                                                            <div class="info">
                                                                                    <div class="col-12">
                                                                                    @if ($cont->status === "ACTIVE")
                                                                                    <span class="btn btn-success btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                                    @else
                                                                                    <span class="btn btn-danger btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                                    @endif
                                                                                    </div>
                                                                                
                                                                                    <div class="info" style="padding-bottom: 5px;padding-top: 8px;max-height: 50px;">
                                                                                        <div class="title text-truncate text-theme text-center" style="font-size: 12px;">{{ $vendor->vendor }}</div>
                                                                                        <div class="desc text-white text-center" style="font-size: 10px;margin-bottom: 2px;">{{ $vendor->address }}</div>
                                                                                    </div>

                                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">
                                                                                <div class="col-12" align="left">
                                                                                    <span class="title text-default fs-12px">#{{ $cont->no_contract }}</span>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-8">
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">Mr / Mrs : <span class="fw-bold text-white">{{ $cont->pic_vendor }}</span></div>
                                                                                        <p class="desc fs-10px" style="margin-bottom: 2px;margin-top: 10px;">Menyewakan,</p>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">UNIT : <span class="fw-bold text-white">{{ $cont->type_vendor }} {{ $cont->qty }} Unit</span></div>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">MODEL : <span class="fw-bold text-white">{{ $cont->name_product }}</span></div>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">CONTRACT : <span class="fw-bold text-white">{{ $cont->contract }}</span></div>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AGREEMENT : <span class="fw-bold text-white">{{ $cont->contract_agreement }} Hours</span></div>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AMOUNT / UNIT : <span class="fw-bold text-white">{{  currency_IDR($cont->amount) }}</span></div>
                                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">TOTAL AMOUNT : <span class="fw-bold text-white">{{  currency_IDR($cont->total_amount) }}</span></div>
                                                                                    </div>

                                                                                    <div class="col-4" align="right" style="margin-top: 5px;">
                                                                                        <span class="fs-25px" class="fw-bold text-warning"><a class="text-lime" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-file-pdf fa-xl"> </i></a></span><br>
                                                                                        <span class="fs-8px fw-bold" class="fw-bold text-warning">open file..</a></span>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="row mt-2">
                                                                                <div class="col-6 text-left desc" style="font-size: 12px;margin-bottom: 2px;">START : <span class="fw-bold text-theme">{{ $cont->start_days }}</span></div>
                                                                                <div class="col-6 desc" align="right" style="font-size: 12px;margin-bottom: 2px;">END &nbsp;&nbsp;&nbsp;: <span class="fw-bold text-warning">{{ $cont->end_days }}</span></div>
                                                                                </div>
                                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">
                                                                             
                                                                                        <table class="table table-hover mb-0 table-sm">
                                                                                            <thead>
                                                                                                <tr class="fs-10px">
                                                                                                    <th class="text-center" width="2px;" scope="col">#</th>
                                                                                                    <th class="text-center" scope="col">VEHICLE</th>
                                                                                                    <th class="text-center" scope="col">IDENTIFY</th>
                                                                                                    <th class="text-center" scope="col">HM TOTAL</th>
                                                                                                    <th class="text-center" scope="col">REMAINING</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody class="fs-10px">
                                                                                                    @foreach ($gethm as $key=>$hm)
                                                                                                    <?php $key++; ?>
                                                                                                        @if ($hm->no_contract === $cont->no_contract)
                                                                                                            <tr class="text-center text-white">
                                                                                                                <th scope="row">{{ $key }}</th>
                                                                                                                <td>{{ $hm->vehicle_unit }}</td>
                                                                                                                <td class="fw-bold  text-lime">{{ $hm->identify }}</td>
                                                                                                                <td class="fw-bold">{{ $hm->totals }} Hours</td>
                                                                                                                <?php $hasil = $cont->contract_agreement - $hm->totals; ?>
                                                                                                                <td class="fw-bold text-warning">{{ $hasil }} Hours</td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                {{-- <div class="mb-2" align="right">
                                                                                <span class="text-center"><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-edit"> </i></a><a class="text-default" style="font-weight: bold;"></a>  <a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteaccount('')"><i class="fas fa-times-circle"></i></a></span>
                                                                                </div> --}}
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
                                        @elseif ($cont->contract === "RITASE")
                                            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 pb-3" style="height: 530px;">
                                                <div class="card h-100">
                                                    <div class="card-body h-100 p-1">
                                                        <div class="pos-product">
                    
                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                    @if ($cont->status === "ACTIVE")
                                                                    <span class="btn btn-success btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                    @else
                                                                    <span class="btn btn-danger btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                    <div class="info" style="padding-bottom: 5px;padding-top: 8px;max-height: 50px;">
                                                                    <div class="title text-truncate text-theme text-center" style="font-size: 12px;">{{ $vendor->vendor }}</div>
                                                                    <div class="desc text-white text-center" style="font-size: 10px;margin-bottom: 2px;">{{ $vendor->address }}</div>
                                                            </div>

                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">
                                                                <div class="col-12" align="left">
                                                                    <span class="title text-default fs-12px">#{{ $cont->no_contract }}</span>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">Mr / Mrs : <span class="fw-bold text-white">{{ $cont->pic_vendor }}</span></div>
                                                                        <p class="desc fs-10px" style="margin-bottom: 2px;margin-top: 10px;">Menyewakan,</p>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">UNIT : <span class="fw-bold text-white">{{ $cont->type_vendor }} {{ $cont->qty }} Unit</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">MODEL : <span class="fw-bold text-white">{{ $cont->name_product }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">CONTRACT : <span class="fw-bold text-white">{{ $cont->contract }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AGREEMENT : <span class="fw-bold text-white">{{ $cont->contract_agreement }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AMOUNT / UNIT : <span class="fw-bold text-white">{{  currency_IDR($cont->amount) }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">TOTAL AMOUNT : <span class="fw-bold text-white">{{  currency_IDR($cont->total_amount) }}</span></div>
                                                                        {{-- @foreach ($totalritase as $key=>$total)
                                                                        @if ($total->id_vendor === $vendor->id_vendor) --}}
                                                                        @foreach ($totalritase as $keyss=>$totalrit)
                                                                            @if ($totalrit->no_contract === $cont->no_contract)
                                                                            <div class="desc" style="font-size: 12px;margin-bottom: 2px;">TOTAL RITASE &nbsp;&nbsp;&nbsp;: <span class="fw-bold text-success"> {{ $totalrit->totals_ritase }} Ritase</span>
                                                                            </div>
                                                                            @endif
                                                                        @endforeach
                                                                        {{-- @endif
                                                                        @endforeach --}}
                                                                    </div>

                                                                    <div class="col-4" align="right" style="margin-top: 5px;">
                                                                        <span class="fs-30px" class="fw-bold text-warning"><a class="text-lime" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-file-pdf fa-xl"> </i></a></span><br>
                                                                        <span class="fs-8px fw-bold" class="fw-bold text-warning">open file..</a></span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row mt-2">
                                                                <div class="col-6 text-left desc" style="font-size: 12px;margin-bottom: 2px;">START : <span class="fw-bold text-theme">{{ $cont->start_days }}</span></div>
                                                                <div class="col-6 desc" align="right" style="font-size: 12px;margin-bottom: 2px;">END : <span class="fw-bold text-warning">{{ $cont->end_days }}</span></div>
                                                                </div>
                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">

                                                                <table class="table table-hover mb-0 table-sm">
                                                                    <thead>
                                                                        <tr class="fs-10px">
                                                                            <th class="text-center" width="2px;" scope="col">#</th>
                                                                            <th class="text-center" scope="col">VEHICLE</th>
                                                                            <th class="text-center" scope="col">IDENTIFY</th>
                                                                            <th class="text-center" scope="col">TOTAL RITASE</th>
                                                                        </tr>
                                                                    </thead>
                                                                    
                                                                    @foreach ($getritase as $key=>$rit)
                                                                    <?php $key++; ?>
                                                                    @if ($rit->no_contract === $cont->no_contract)
                                                                    <tbody class="fs-10px">
                                                                        <tr class="text-center text-white">
                                                                            <th scope="row">{{ $key}}</th>
                                                                            <td>{{ $rit->model_unit }}</td>
                                                                            <td class="fw-bold  text-lime">{{ $rit->identify }}</td>
                                                                            <td class="fw-bold">{{ $rit->totals }} Ritase</td>
                                                                        </tr>
                                                                    @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                                {{-- <div class="mb-2" align="right">
                                                                <span class="text-center"><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-edit"> </i></a><a class="text-default" style="font-weight: bold;"></a>  <a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteaccount('')"><i class="fas fa-times-circle"></i></a></span>
                                                                </div> --}}
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
                                        @endif
                                    @endif

                                @endforeach
                            @endforeach
                            {{-- {{ $datauser->links(0) }} --}}
                            {{-- <ul class="pagination mb-0">
                                @if ($datauser->onFirstPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @endif

                                <?php 
                                $i= 1;
                                $now = $datauser->lastPage();
                                ?>
                                @while ($i <= $now)
                                <?php
                                    if ($datauser->currentPage() === $i) {
                                       $status="active";
                                    } else{
                                        $status="";
                                    }
                                ?>
                                @if($i >= $datauser->currentPage() - 2 && $i <= $datauser->currentPage() + 2)
                                <li class="page-item {{ $status }}"><a class="page-link" href="<?php echo $datauser->url( $i ) ?>">{{  $i  }}</a></li>
                                @endif
                                <?php $i++; ?>
                                @endwhile

                                @if ($datauser->onLastPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @endif
                            </ul> --}}
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

        <div class="d-flex align-items-center mt-3">
            <div>
            <h1 class="page-header">
                Land Owner
            </h1>
            </div>
        </div>

        <div class="pos pos-vertical card" id="pos">
            <div class="pos-container card-body">
                <div class="pos-content">
                    <div class="pos-content-container h-100 p-3" data-height="100%">
                        <div class="row gx-3">
                            @foreach ($datavendor as $key=>$vendor)

                                @foreach ($datacontract as $key=>$cont)

                                    @if ($cont->id_vendor === $vendor->id_vendor)
                                        @if ($cont->contract === "EXPIRED DAYS")
                                            <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 pb-3" style="height: 400px;">
                                                <div class="card h-100">
                                                    <div class="card-body h-100 p-1">
                                                        <div class="pos-product">
                    
                                                            <div class="info">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                    @if ($cont->status === "ACTIVE")
                                                                    <span class="btn btn-success btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                    @else
                                                                    <span class="btn btn-danger btn-sm d-block fw-bold text-white" style="margin-bottom: 15px;">{{ $cont->status }}</span>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                    <div class="info" style="padding-bottom: 5px;padding-top: 8px;max-height: 50px;">
                                                                    <div class="title text-truncate text-theme text-center" style="font-size: 12px;">{{ $vendor->vendor }}</div>
                                                                    <div class="desc text-white text-center" style="font-size: 10px;margin-bottom: 2px;">{{ $vendor->address }}</div>
                                                            </div>

                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">
                                                                <div class="col-12" align="left">
                                                                    <span class="title text-default fs-12px">#{{ $cont->no_contract }}</span>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">Mr / Mrs : <span class="fw-bold text-white">{{ $cont->pic_vendor }}</span></div>
                                                                        <p class="desc fs-10px" style="margin-bottom: 2px;margin-top: 10px;">Menyewakan,</p>
                                                                        @if ($cont->type_vendor != "RENTAL LAND")
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">UNIT : <span class="fw-bold text-white">{{ $cont->type_vendor }} {{ $cont->qty }}</span></div>
                                                                        @else
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">UNIT : <span class="fw-bold text-lime">{{ $cont->type_vendor }} {{ $cont->qty }}</span></div>
                                                                        @endif

                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">NAME : <span class="fw-bold text-white">{{ $cont->name_product }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">CONTRACT : <span class="fw-bold text-white">{{ $cont->contract }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AGREEMENT : <span class="fw-bold text-white">{{ $cont->contract_agreement }}</span></div>
                                                                        <div class="desc" style="font-size: 12px;margin-bottom: 2px;">AMOUNT / UNIT : <span class="fw-bold text-white">{{  currency_IDR($cont->amount) }}</span></div>
                                                                        {{-- <div class="desc" style="font-size: 12px;margin-bottom: 2px;">TOTAL AMOUNT : <span class="fw-bold text-white">{{  currency_IDR($vendor->total_amount) }}</span></div> --}}
                                                                    </div>

                                                                    <div class="col-4" align="right" style="margin-top: 5px;">
                                                                        <span class="fs-30px" class="fw-bold text-warning"><a class="text-lime" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-file-pdf fa-xl"> </i></a></span><br>
                                                                        <span class="fs-8px fw-bold" class="fw-bold text-warning">open file..</a></span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row mt-2">
                                                                <div class="col-6 text-left desc" style="font-size: 12px;margin-bottom: 2px;">START : <span class="fw-bold text-theme">{{ $cont->start_days }}</span></div>
                                                                <div class="col-6 desc" align="right" style="font-size: 12px;margin-bottom: 2px;">END &nbsp;&nbsp;&nbsp;: <span class="fw-bold text-warning">{{ $cont->end_days }}</span></div>
                                                                </div>
                                                                <hr style="margin-top: 0px;margin-bottom: 5px;">

                                                                @if ($cont->type_vendor != "RENTAL LAND")
                                                                <table class="table table-hover mb-0 table-sm">
                                                                    <thead>
                                                                        <tr class="fs-10px">
                                                                            <th class="text-center" width="2px;" scope="col">#</th>
                                                                            <th class="text-center" scope="col">BARG</th>
                                                                            <th class="text-center" scope="col">RITASE</th>
                                                                            <th class="text-center" scope="col">BUCKET</th>
                                                                            <th class="text-center" scope="col">TONASE</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fs-10px">
                                                                        @foreach ($getbarg as $key=>$barg)
                                                                        <?php $key++; ?>
                                                                            @if ($barg->no_contract === $cont->no_contract)
                                                                            <tr class="text-center text-white">
                                                                                <th scope="row">{{ $key }}</th>
                                                                                <td>{{ $barg->id_barg }}</td>
                                                                                <td>{{ $barg->ritase }} Ritase</td>
                                                                                <td>{{ $barg->bucket }}</td>
                                                                                <td class="fw-bold">{{ $barg->tonase }} M/T</td>
                                                                            </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                @else
                                                                <div class="title text-truncate text-lime text-center" style="font-size: 36Px;margin-bottom: 2px;">RENTAL LAND</div>
                                                                @endif
                                                                {{-- <div class="mb-2" align="right">
                                                                <span class="text-center"><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit('')"><i class="fas fa-edit"> </i></a><a class="text-default" style="font-weight: bold;"></a>  <a class="text-danger" style="cursor: pointer;" onclick="openmodaldeleteaccount('')"><i class="fas fa-times-circle"></i></a></span>
                                                                </div> --}}
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
                                        @endif
                                    @endif

                                @endforeach
                            @endforeach
                            {{-- {{ $datauser->links(0) }} --}}
                            {{-- <ul class="pagination mb-0">
                                @if ($datauser->onFirstPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->previousPageUrl() }}">Previous</a></li>
                                @endif

                                <?php 
                                $i= 1;
                                $now = $datauser->lastPage();
                                ?>
                                @while ($i <= $now)
                                <?php
                                    if ($datauser->currentPage() === $i) {
                                       $status="active";
                                    } else{
                                        $status="";
                                    }
                                ?>
                                @if($i >= $datauser->currentPage() - 2 && $i <= $datauser->currentPage() + 2)
                                <li class="page-item {{ $status }}"><a class="page-link" href="<?php echo $datauser->url( $i ) ?>">{{  $i  }}</a></li>
                                @endif
                                <?php $i++; ?>
                                @endwhile

                                @if ($datauser->onLastPage())
                                <li class="page-item disabled"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @else
                                <li class="page-item"><a class="page-link" href="{{ $datauser->nextPageUrl() }}">Next</a></li>
                                @endif
                            </ul> --}}
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
<!-- ================== END page-js ================== -->
{{-- @include('employee.delete')
@include('employee.delete_account')
@include('employee.create')
@include('employee.edit') --}}



<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); }}" rel="stylesheet" />
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); }}"></script>
<script>
    $('#datepicker').datepicker({
    // format: "yyyy/mm",
    // startView: "year", 
    // minViewMode: "months"
    autoclose: true
    });
    $('#datepicker2').datepicker({
    autoclose: true
    });
</script>


<script>
    // edit
    // function openmodalcreate(id,nik,name,role,img) {
    //     $('#modalcreate').modal('show');
    //     document.getElementById('id').value = id;
    //     document.getElementById('email').value = nik;
    //     document.getElementById('name').value = name;
    //     document.getElementById('roles').value = role;
    //     document.getElementById('imgs').value = img;
    // }

    // function submitformcreate() {
    //     document.getElementById('form_create').action = "/register";
    //     document.getElementById("form_create").submit();
    // }

    // function openmodaledit(id,name,tlp,domisili,gender,img) {
    //     $('#modaledit').modal('show');
    //     document.getElementById('e_id').value = id;
    //     document.getElementById('e_name').value = name;
    //     document.getElementById('e_tlp').value = tlp;
    //     document.getElementById('e_domisili').value = domisili;

    //     if (img == "") {
    //         document.getElementById("e_img").src = '../../user/male.png';
    //     } else {
    //         document.getElementById("e_img").src = '../../user/' + img;
    //     }

    //     document.getElementById("e_genderdefault").innerHTML = "DEFAULT : " + gender;
    //     document.getElementById("e_genderdefault").value = gender;
    // }

    // function submitformedit() {
    //     var value = document.getElementById('e_id').value;
    //     document.getElementById('form_edit').action = "../employees/editact/"+value;
    //     document.getElementById("form_edit").submit();
    // }

    //   // delete
    //   function openmodaldeleteaccount(id,nik) {
    //     $('#modaldeleteaccount').modal('show');
    //     document.getElementById('delacc_id').value = id;
    //     document.getElementById('delacc_nik').value = nik;
    // }

    // function submitformdeleteaccount() {
    //     var value = document.getElementById('delacc_id').value;
    //     document.getElementById('form_deleteaccount').action = "../employees/destroy_employee/"+value;
    //     document.getElementById("form_deleteaccount").submit();
    // }

    //  // delete
    // function openmodaldelete(id,nik) {
    //     $('#modaldelete').modal('show');
    //     document.getElementById('del_id').value = id;
    //     document.getElementById('del_nik').value = nik;
    // }

    // function submitformdelete() {
    //     var value = document.getElementById('del_id').value;
    //     document.getElementById('form_delete').action = "../employees/destroy/"+value;
    //     document.getElementById("form_delete").submit();
    // }
</script>


@endsection

