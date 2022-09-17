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
                <li class="breadcrumb-item"><a href="/stockore/stockores">STOCK CARGO</a></li>
                <li class="breadcrumb-item active">STOCK CARGO PAGE</li>
            </ul>
            
            <h1 class="page-header">
                Stock Cargo
            </h1>
            </div>
            <div class="ms-auto">
                <a class="btn btn-outline-theme" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Cargo</a>
            </div>
        </div>

        <div class="modal fade" id="modaladd" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD CARGO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/stockore/stockores/store') }}">
                        @csrf
                    <div class="modal-body">
                        <div>
                        <input type="hidden" class="validate" name="users" value="{{ auth::user()->name; }}">
                        </div>

                        <div class="row form-group">
                            <div class="col-12 form-group position-relative mb-3">
                                <label class="form-label">Ketegori Cargo</label>
                                <select class="form-select text-theme form-select-sm" id="category"  name="category" required onchange="statuscargo()">
                                    <option value="" disabled selected>Pilih Aktivitas</option>
                                    <option value="CARGO PRODUCTION">CARGO PRODUCTION</option>
                                    <option value="CARGO BUYING">CARGO BUYING</option>    
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Jenis Cargo.
                                </div>
                            </div>
                            
                            <div class="col-3 form-group position-relative mb-3 mt-3" id="production_lokasi" style="display:none;">
                                <label class="form-label">Lokasi</label>
                                <select class="form-select form-select-sm text-theme"  name="id_location_production">
                                    <option value="" disabled selected>Pilih Lokasi</option>
                                    @foreach ($getlocation as $loc)
                                    <option value="{{ $loc->id_location }}">{{ $loc->location }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan pilih lokasi.
                                </div>
                            </div>
                            <div class="col-3 form-group position-relative mb-3 mt-3" id="production_bucket" style="display:none;">
                                <label class="form-label">Bucket</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="in_bucket" value="0" required placeholder="Bucket" autocomplete="OFF">
                            </div>
                            <div class="col-3 form-group position-relative mb-3 mt-3" id="production_ritase" style="display:none;">
                                <label class="form-label">Ritase</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="in_ritase" value="0" required placeholder="Ritase" autocomplete="OFF">
                            </div>
                            <div class="col-3 form-group position-relative mb-3 mt-3" id="production_volume" style="display:none;">
                                <label class="form-label">Volume M/T</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="in_volume_bucket" value="0" required placeholder="Volume M/T" autocomplete="OFF">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6 form-group position-relative mb-3 mt-3" id="buying_lokasi" style="display:none;">
                                <label class="form-label">Lokasi</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="id_location_buying" placeholder="Masukan Lokasi Pembelian Cargo.." autocomplete="OFF">
                            </div>
                            <div class="col-6 form-group position-relative mb-3 mt-3" id="buying_estimasi" style="display:none;">
                                <label class="form-label">Estimasi Volume M/T</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="number" name="estimated" value="0" placeholder="Bucket" autocomplete="OFF">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-3 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Status PSI</label>
                                <select class="form-select text-theme form-select-sm" name="status" required>
                                    <option value="" disabled selected>Pilih Aktivitas</option>
                                    <option value="READY">READY</option>
                                    <option value="PENDING">PENDING</option>    
                                </select>
                                <div class="invalid-tooltip">
                                    Silahkan Pilih Jenis Cargo.
                                </div>
                            </div>
                            <div class="col-9 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Nama Dome</label>
                                <input class="form-control form-control-sm text-theme is-invalid" type="text" name="dome" required placeholder="Silahkan masukan nama dome" autocomplete="OFF">
                            </div>
                            <div class="col-12 form-group position-relative mb-3 mt-3">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control  form-control-sm text-theme is-invalid" type="text" name="desc" rows="2" placeholder="Keterangan.." autocomplete="OFF"></textarea>
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
            function statuscargo() {
                var select = document.getElementById('category');
                var value = select.options[select.selectedIndex].value;

                if (value == 'CARGO PRODUCTION') {
                    document.getElementById("production_lokasi").style.display = 'block';
                    document.getElementById("production_bucket").style.display = 'block';
                    document.getElementById("production_ritase").style.display = 'block';
                    document.getElementById("production_volume").style.display = 'block';
                    document.getElementById("buying_lokasi").style.display = 'none';
                    document.getElementById("buying_estimasi").style.display = 'none';
                } else if (value == 'CARGO BUYING') {
                    document.getElementById("buying_lokasi").style.display = 'block';
                    document.getElementById("buying_estimasi").style.display = 'block';
                    document.getElementById("production_lokasi").style.display = 'none';
                    document.getElementById("production_bucket").style.display = 'none';
                    document.getElementById("production_ritase").style.display = 'none';
                    document.getElementById("production_volume").style.display = 'none';
                }
            }
        </script>

                <div class="card" style="min-height: 70vh;height:auto;">
                    <div class="card-body">
                        <div class="input-group mb-4 mt-2">
                            <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0" style="z-index: 1020;">
                                <i class="fa fa-search opacity-5"></i>
                            </div>
                                <input type="text" class="form-control ps-35px" name="" value="" placeholder="Search.." style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;" autocomplete="off">
                               <a class="btn btn-outline-theme" href="/hourmeter/hourmeters">X</a>
                        </div>

                        <div class="row">
                            @foreach ($stock as $keys=>$values)
                            <div class="col-12 col-md-6 col-xl-3 mb-4">
                                <div class="card">
                                    <div class="card-header fw-bold small text-center text-theme fs-18px">{{ $values->dome }}
                                        <p class="fs-10px mb-0 text-default">({{ $values->desc }})</p>
                                    </div>
                                    <div class="card-body">
                                        @if ($values->in_bucket==='0')
                                        <h3 class="card-title text-center mb-2">± {{ number_format($values->estimated, 2, ',', '') }} M/T</h3>
                                        <p class="card-text mb-0 text-center" style="font-size: 13px;">ESTIMATED M/T</p>
                                        @else
                                        <h3 class="card-title text-center mb-2">± {{ number_format($values->in_bucket* $values->in_volume_bucket, 2, ',', '') }} S/T</h3>
                                        <p class="card-text mb-0 text-center" style="font-size: 13px;">{{ $values->in_bucket.' BUCKET - '.$values->in_ritase.' RITASE' }}</p>
                                        @endif
                                       
                                        <p class="card-text mb-0 text-center" style="font-size: 13px;">LOCATION : {{ $values->loc }}</p>
                                    
                                    </div>
                                    <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                    </div>
                                </div>
                            </div>
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
@endsection

