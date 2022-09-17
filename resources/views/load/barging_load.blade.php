				<div class="fs-12px">
					<div class="row mb-3">
						<div class="col-xl-6 col-sm-12">
							<div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
								<div class="flex-fill">
									<div class="mb-1">Total Tonase Barging</div>
									<h3 class="text-theme">{{ number_format($tonase_barg,2,",",".") }} M/T</h3>
									<div>Data of {{ $bulan." ".$tahun }}</div>
								</div>
								<div class="opacity-5">
									<i class="fas fa-chart-line fa-3x"></i>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-sm-12">
							<div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
								<div class="flex-fill">
									<div class="mb-1">Total Pengapalan</div>
									<h3 class="text-theme">{{ $tongkang }} Tongkang</h3>
									<div>Data of {{ $bulan." ".$tahun }}</div>
								</div>
								<div class="opacity-5">
									<i class="fas fa-ship fa-3x"></i>
								</div>
							</div>
						</div>
						<table class="w-100 mb-0 small align-middle table table-hover">
							<tbody>
								@if ($tongkang === 0)
								<tr>
									<td width="100%" align="center">
										<div class="fw-bold fs-24px text-success">DATA KOSONG</div>
									</td>
								</tr>
								@else
								@foreach ($barg as $key=>$barg)
								<tr>
									<div class="row mt-3" style="margin-left: 0px;">
										<div class="col-xl-5">
												<div class="flex-1">
													<div class="mb-1"><small class="fs-9px lh-1 d-inline-block rounded-0 badge bg-white bg-opacity-25 text-theme text-opacity-75 pt-5px fw-bold">ID : {{ $barg->id_barg }}</small></div>
													<div class="fw-700 text-white">Periode <br> {{ date('d M', strtotime($barg->start)) }} - {{ date('d M', strtotime($barg->finish)) }}</div>
													Capacity {{ @nomorin($barg->capacity) }} M/T
												</div>
										</div>
										<div class="col-xl-4 mt-3">
											<div>
												<span class="text-white text-opacity-75 fw-500">RITASE : {{ @nomorin($barg->ritase) }}</span><br>
												<span class="text-white text-opacity-75 fw-500">BUCKET : {{ @nomorin($barg->bucket) }}</span><br>
												<span class="text-white text-opacity-75 fw-500">STATUS : <span class="fw-bold text-danger">CLOSED</span></span>
											</div>
										</div>
										<div class="col-xl-3 mt-3">
											<div>
												<span class="text-white text-opacity-75 fw-500">TON/RIT : {{ number_format($barg->tonase / $barg->ritase,2,",",".") }} M/T</span><br>
												<span class="text-white text-opacity-75 fw-500">TON/BUCKET : {{ number_format($barg->tonase / $barg->bucket,2,",",".") }} M/T</span><br>
												<span class="text-white text-opacity-75 fw-500">FINAL TONASE : {{ number_format($barg->tonase,2,",",".") }} M/T</span>
											</div>
										</div>
									</div>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
						
				</div>