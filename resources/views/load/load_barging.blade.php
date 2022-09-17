<div class="row">
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">ORE TOTAL</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ @nomorin($orestock) }} M/T</h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i  style="font-size: 40px;" class="bi bi-triangle-half"></i>
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
    <!-- END -->

    <!-- ASSET TETAP -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">READY BARGING (ON STOCKPILE)</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ @nomorin($orestockready) }} M/T</h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-truck"></i>
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
    <!-- END -->

    <!-- BAHAN BAKU -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">IN PROGRESS</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ @nomorin($inprogress) }} M/T</h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-minecart-loaded"></i>
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
    <!-- END -->

    <!-- VALUE ASSET -->
    <div class="col-xl-3 col-lg-6">
        <div class="card mb-3">
            <div class="card-body" style="padding-bottom: 0px;">
                <div class="d-flex fw-bold small mb-3">
                    <span class="flex-grow-1">FINISHED</span>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="mb-0">{{ $finish }} M/T</h5>
                    </div>
                    <div class="col-4 text-theme">
                        <i style="font-size: 40px;" class="bi bi-check2-square"></i>
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
</div>