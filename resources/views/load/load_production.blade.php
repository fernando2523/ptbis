<div class="row">
    <div class="col-xl-12 col-lg-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($dataproduction as $keys=>$value)
                    <div class="col-12 col-md-6 col-xl-3 mb-1">
                        {{-- <a href="{{ url('/production/detail/'.$value->location) }}" style="text-decoration:none;"> --}}
                            <div class="card">
                                <div class="card-header fw-bold text-theme text-center fs-24px">{{ $value->location }}</div>
                                <div class="card-body" style="padding-bottom: 0px;padding-top: 5px;">
                                    <div class="row">
                                        <div class="col-12 mt-2" align="center">
                                            <span class="text-theme fw-bold">PRODUCTION RESULTS</span>
                                        </div>
                                        <div class="col-12">
                                            @if ($value->volumes===null)
                                            <h3 class="card-title text-center mb-3">± 0 <small>M/T</small></h3>
                                            @else
                                            <h3 class="card-title text-center mb-3">± {{ $value->volumes }} <small>M/T</small></h3>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="text-center col-12 mb-0">
                                            <span class="mb-3 fw-bold">PERIODE</span>
                                            <p class="mb-3 text-theme fw-bold ">{{ $start.' - '.$end }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr style="margin-top: 0px;margin-bottom: 0px;"></hr>
                                    <div class="row text-center mt-1 mb-2" style="margin-left: 1px;margin-right: 1px;padding-top: 5px;">
                                        {{-- @foreach ($getbucket as $key=>$data) --}}
                                            {{-- @if ($data->location === $value->location) --}}
                                            <div class="col-6" >
                                                <div class="text-theme fw-bold fs-13px">{{ $value->bucks }} Bucket</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-theme fw-bold fs-13px">{{ $value->domss }} Inc</div>
                                            </div>
                                            {{-- @endif --}}
                                        {{-- @endforeach --}}
                                    </div>
                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                            </div>
                        {{-- </a> --}}
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
            <!-- END card-arrow -->
        </div>
    </div>
</div>