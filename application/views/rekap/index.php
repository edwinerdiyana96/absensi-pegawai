<div class="container-fluid dashboard-atas">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Perhari</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Perbulan</a>
		</li>
		<li class="nav-item" role="presentation">
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Rekap Absen Harian</h6>
						</div>

						<!-- Card Body -->
						<div class="card-body">
							<div class="form-group md-2 mb-3">
								<div>
									<?php
									$bulan_sekarang = bulan_indo(date('m')); ?>
									<form action="<?= base_url('absensi/rekap/filter') ?>" method="POST">
										<div class="input-group mb-6">
											<input type="date" name="filter" class="form-control col-md-3" value="<?= $filter ?>">
											<div class="col-md-6 ">
												<button class="btn btn-primary btn-icon-split">
													<span class="icon text-white-50">
														<i class="fa fa-filter"></i>
													</span>
													<span class="text">Filter Tanggal</span>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered display" id="tableTanggal" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Jabatan</th>
											<th>tanggal</th>
											<th>Jam Masuk</th>
											<th>Jam Istirahat</th>
											<th>Jam Pulang</th>
											<th>Keterangan</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Jabatan</th>
											<th>tanggal</th>
											<th>Jam Masuk</th>
											<th>Jam Istirahat</th>
											<th>Jam Pulang</th>
											<th>Keterangan</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										$num = 1;
										foreach ($data_absensi as $ds) : ?>
											<tr>
												<td><?= $num++ ?></td>
												<td><?= $ds['name'] ?></td>
												<td><?= $ds['department'] ?></td>
												<td><?= $ds['date'] ?></td>
												<td><?= $ds['time_in'] ?></td>
												<td><?= $ds['time_break'] ?></td>
												<td><?= $ds['time_out'] ?></td>

												<td>

													<?php if ($ds['status'] == 1) : {
															echo '<span class="badge badge-pill badge-success">Hadir Tepat Waktu</span>';
														}

													elseif ($ds['status'] == 2) : {
															echo '<span class="badge badge-pill badge-secondary">Hadir Telambat</span>';
														}

													elseif ($ds['status'] == 3) : {
															echo '<span class="badge badge-pill badge-primary">Sakit</span>';
														}

													elseif ($ds['status'] == 4) : {
															echo '<span class="badge badge-pill badge-primary">Izin</span>';
														}

													elseif ($ds['status'] == 5) : {
															echo '<span class="badge badge-pill badge-warning">OFF</span>';
														}
													elseif ($ds['status'] == 6) : {
															echo '<span class="badge badge-pill badge-warning">Hadir Konfirmasi</span>';
														}
													elseif ($ds['status'] == 0) : {
															if ($ds['time_in'] < '11:00:00' && $ds['date'] == date('Y-m-d')) {
																echo '<span class="badge badge-pill badge-info">Belum Hadir</span>';
															} else {
																echo '<span class="badge badge-pill badge-danger">Alpha</span>';
															}
														}
													?>
													<?php endif; ?>
													<br>
													Detail: <?= $ds['description'] ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>



				</div>
			</div>
		</div>


		<!-- tab perbulan -->
		<div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Rekap Absen Perbulan</h6>
						</div>



						<!-- Card Body -->
						<div class="card-body">
							<div class="form-group md-2 mb-3">
								<div>
									<?php
									$bulan_sekarang = bulan_indo(date('m')); ?>
									<form action="<?= base_url('operator/export') ?>" method="POST">

										<div class="input-group mb-6">
											<select id="bulan" name="bulan" class="form-control col-md-3">
												<option value=""> Pilih Semua Bulan</option>
												<option value="Januari">Januari</option>
												<option value="Februari">Februari</option>
												<option value="Maret">Maret</option>
												<option value="April">April</option>
												<option value="Mei">Mei</option>
												<option value="Juni">Juni</option>
												<option value="Juli">Juli</option>
												<option value="Agustus">Agustus</option>
												<option value="September">September</option>
												<option value="Oktober">Oktober</option>
												<option value="November">November</option>
												<option value="Desember">Desember</option>


												<!--  < ?php
                                        if ($bulan_sekarang == 'Januari') {
                                            echo "<option value='Januari' selected>Januari</option>";
                                        }else{
                                            echo "<option value='Januari'>Januari</option>";
                                        }
                                        if ($bulan_sekarang == 'Februari') {
                                            echo "<option value='Februari' selected>Februari</option>";
                                        }else{
                                            echo "<option value='Februari'>Februari</option>";
                                        }
                                        if ($bulan_sekarang == 'Maret') {
                                            echo "<option value='Maret' selected>Maret</option>";
                                        }else{
                                            echo "<option value='Maret'>Maret</option>";
                                        }
                                        if ($bulan_sekarang == 'April') {
                                            echo "<option value='April' selected>April</option>";
                                        }else{
                                            echo "<option value='April'>April</option>";
                                        }
                                        if ($bulan_sekarang == 'Mei') {
                                            echo "<option value='Mei' selected>Mei</option>";
                                        }else{
                                            echo "<option value='Mei'>Mei</option>";
                                        }
                                        if ($bulan_sekarang == 'Juni') {
                                            echo "<option value='Juni' selected>Juni</option>";
                                        }else{
                                            echo "<option value='Juni'>Juni</option>";
                                        }
                                        if ($bulan_sekarang == 'Juli') {
                                            echo "<option value='Juli' selected>Juli</option>";
                                        }else{
                                            echo "<option value='Juli'>Juli</option>";
                                        }
                                        if ($bulan_sekarang == 'Agustus') {
                                            echo "<option value='Agustus' selected>Agustus</option>";
                                        }else{
                                            echo "<option value='Agustus'>Agustus</option>";
                                        }
                                        if ($bulan_sekarang == 'September') {
                                            echo "<option value='September' selected>September</option>";
                                        }else{
                                            echo "<option value='September'>September</option>";
                                        }
                                        if ($bulan_sekarang == 'Oktober') {
                                            echo "<option value='Oktober' selected>Oktober</option>";
                                        }else{
                                            echo "<option value='Oktober'>Oktober</option>";
                                        }
                                        if ($bulan_sekarang == 'November') {
                                            echo "<option value='November' selected>November</option>";
                                        }else{
                                            echo "<option value='November'>November</option>";
                                        }
                                        if ($bulan_sekarang == 'Desember') {
                                            echo "<option value='Desember' selected>Desember</option>";
                                        }else{
                                            echo "<option value='Desember'>Desember</option>";
                                        }?> -->
											</select>
											<div class="col-md-6 "> <button class="btn btn-success btn-icon-split">
													<span class="icon text-white-50">
														<i class="fas fa-file-excel"></i>
													</span>
													<span class="text">Export To Excel</span>
												</button></div>
										</div>
									</form>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered" id="tableBulan" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Bulan</th>
											<th>Nama</th>
											<th>Tepat Waktu</th>
											<th>Telat</th>
											<th>Sakit</th>
											<th>Izin</th>
											<!--<th>Hadir Konfirmasi</th>-->
											<th>Alpha</th>
											<th>Total Hadir</th>
											<th>Total Tidak Hadir</th>
											<th>Persentase Kehadiran</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Bulan</th>
											<th>Nama</th>
											<th>Tepat Waktu</th>
											<th>Telat</th>
											<th>Sakit</th>
											<th>Izin</th>
											<th>Alpha</th>
											<th>Total Hadir</th>
											<th>Total Tidak Hadir</th>
											<th>Persentase Kehadiran</th>
										</tr>
									</tfoot>
									<tbody>
										<?php
										foreach ($data_pegawai as $key => $data_pegawai) {
											for ($i = 0; $i < 12; $i++) {

												$m = $i + 1;
												$tanggal_awal = date('Y-m-01');
$tanggal_akhir = date('Y-m-t',time());

												$hadir = $this->Absensi_model->getHadirBulanById($data_pegawai['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$telat = $this->Absensi_model->getTelatBulanById($data_pegawai['id'], $tanggal_awal, $tanggal_akhir)->num_rows();


												$sakit = $this->Absensi_model->getSakitBulanById($data_pegawai['id'], $tanggal_awal, $tanggal_akhir)->num_rows();


												$izin = $this->Absensi_model->getIzinBulanById($data_pegawai['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$alpha = $this->Absensi_model->getAlphaBulanById($data_pegawai['id'], $tanggal_awal, $tanggal_akhir)->result_array();

												$data_alpha = 0;
												foreach ($alpha as $key => $alpha) :
													if ($alpha['date'] < date('Y-m-d')) {
														$data_alpha++;
													}
												endforeach;

												$semua = $hadir + $telat + $sakit + $izin + $data_alpha;
												if ($semua != 0) {
										?>
													<tr>
														<td><?= $bulan[$i] ?></td>
														<td><?= $data_pegawai['name'] ?></td>
														<td class="text-success"><?= $hadir ?></td>
														<td class="text-warning"><?= $telat ?></td>
														<td class="text-primary"><?= $sakit ?></td>
														<td class="text-secondary"><?= $izin ?></td>
														<td class="text-danger"><?= $data_alpha ?></td>
														<td class="text-info"><?= $telat + $hadir ?></td>
														<td class="text-danger"><?= $data_alpha + $izin + $sakit ?></td>
														<td><?php
															if ($hadir == 0) {
																echo "0%";
															} else {
																echo number_format((($hadir + $telat) / ($hadir + $telat + $sakit + $izin + $data_alpha)) * 100) . "%";
															}
															?></td>
													</tr>
										<?php }
											}
										} ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>



				</div>
			</div>

		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('bulan').find('option[value=Maret]').attr('selected', 'selected');
		});
	</script>
</div>
