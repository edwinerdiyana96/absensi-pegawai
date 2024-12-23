<div class="container-fluid dashboard-atas">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Perhari</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Perbulan</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="year-tab" data-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="false">Pertahun</a>
		</li>
	</ul>



	<!-- INI ADALAH REKAP TERBARU -->
	<div class="card shadow mb-4">
		<!-- rekap -->
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
				<div class="row">
					<!-- Area Chart -->
					<div class="col-xl-12 cold-md-12 col-lg-12">
						<div class="card shadow mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<h6 class="m-0 font-weight-bold text-primary">Rekap Absen Perhari</h6>
							</div>
							<!-- Card Header - Dropdown -->
							<div class="card-body">
								<!-- ============================ Display Only On Desktop Mode ============================ -->
								<div class="d-none d-lg-block">
									<div class="row">
										<div class="col-md-6">
											<!-- <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewUser"> Tambah Pegawai</a> -->
											<form action="<?= base_url('pegawai/rekap/filter_bulanan') ?>" method="POST">
												<div class="input-group mb-6">
													<input type="month" name="filter" class="form-control col-md-3" value="<?= $bulan_sekarang ?>">
													<div class="col-md-6 ">
														<button class="btn btn-primary btn-icon-split">
															<span class="icon text-white-50">
																<i class="fa fa-filter"></i>
															</span>
															<span class="text">Filter Bulan</span>
														</button>
													</div>
												</div>
											</form>
										</div>
										<br><br><br>
										<div class="col-md-6 text-right">
											<button class="btn btn-danger" data-toggle="modal" data-target="#export">
												<span class="icon text-white-50">
													<i class="fas fa-file-excel"></i>
												</span>
												<span class="text">Export To Excel</span>
											</button>
										</div>
									</div>
								</div>


								<!-- ============================ Display Only On Mobile Mode ============================ -->
								<div class="d-lg-none">
									<div class="row">
										<div class="col-md-12">
											<!-- <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewUser"> Tambah Pegawai</a> -->
											<form action="<?= base_url('pegawai/rekap/filter_bulanan') ?>" method="POST">
												<input type="month" name="filter" class="form-control col-md-3" value="<?= $bulan_sekarang ?>">
												<br>
												<button class="btn btn-primary form-control" style="text-align: left;">
													<span class="icon text-white-50">
														<i class="fas fa-filter"></i>
													</span> &ensp;&ensp;
													<span class="text">Filter Bulan</span>
												</button>
											</form>
											<br>

											<button class="btn btn-danger form-control" data-toggle="modal" data-target="#export" style="text-align: left;">
												<span class="icon text-white-50">
													<i class="fas fa-file-excel"></i>
												</span> &ensp;&ensp;
												<span class="text">Export To Excel</span>
											</button>
											<br><br>
										</div>
									</div>
								</div>
								<!-- </div> -->
								<!-- </div> -->
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="rekap-harian" style="width:100%;">
											<thead class="text-primary text-center">
												<tr>
													<th scope="col">No</th>
													<!-- <th scope="col">Nama</th> -->
													<th scope="col">Nama</th>
													<th scope="col">Tanggal</th>
													<th scope="col">Jam Masuk</th>
													<th scope="col">Jam Istirahat</th>
													<th scope="col">Jam Pulang</th>
													<th scope="col">Keterangan</th>
												</tr>
											</thead>
											<!-- <tfoot class="text-primary"></tfoot> -->
											<tbody class="text-center">
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
	var tabel = null;
	var bulan = '<?= $bulan_sekarang ?>';
	$(document).ready(function() {
		tabel = $('#rekap-harian').DataTable({
			"processing": true,
			// "responsive": true,
			"ScrollX": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'asc']
			], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax": {
				"url": "<?= base_url('pegawai/data_rekap_pegawai_perbulan/'); ?>" + bulan, // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
				[10, 50, 100],
				[10, 50, 100]
			], // Combobox Limit
			"columns": [{
					"data": 'attendance_id',
					"sortable": false,
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				// {
				//  "data": "name"
				// }, 
				{
					"data": "name"
				},
				{
					"data": "date"
				},
				{
					"data": "time_in"
				},
				{
					"data": "time_break"
				},
				{
					"data": "time_out"
				},
				{
					"data": "status",
					"render": function(data, type, row, meta) {
						if (data == 0) {
							return '<span class="badge badge-danger">Belum Absen</span>';
						}
						if (data == 1) {
							return '<span class="badge badge-success">Hadir Tepat Waktu</span>';
						}
						if (data == 2) {
							return '<span class="badge badge-warning">Hadir Telat</span>';
						}
						if (data == 3) {
							return '<span class="badge badge-primary">Sakit</span>';
						}
						if (data == 4) {
							return '<span class="badge badge-secondary">Izin</span>';
						}
						if (data == 6) {
							return '<span class="badge badge-info">Hadir Konfirmasi</span>';
						}
					}
				},
			],
		});
	});
</script>
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
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="tableBulan" width="100%" cellspacing="0">
										<thead class="text-primary text-center">
											<tr>
												<th>Tahun</th>
												<th>Bulan</th>
												<th>Nama</th>
												<th>Jabatan</th>
												<th>Hadir</th>
												<th>Sakit</th>
												<th>Izin</th>
												<th>Telat</th>
												<th>Alpha</th>
												<th>Persentase Kehadiran</th>
											</tr>
										</thead>
										<!-- <tfoot>
											<tr>
												<th>Tahun</th>
												<th>Bulan</th>
												<th>Nama</th>
												<th>Jabatan</th>
												<th>Hadir</th>
												<th>Sakit</th>
												<th>Izin</th>
												<th>Telat</th>
												<th>Alpha</th>
												<th>Persentase Kehadiran</th>
											</tr>
										</tfoot> -->
										<tbody class="text-center">
											<?php
											for ($i = 0; $i < 12; $i++) {

												$m = $i + 1;
												$tanggal_awal = date('Y-'.$m.'-01');
												$tanggal_akhir = date('Y-'.$m.'-t',time());

												$hadir = $this->Absensi_model->getHadirBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
												
												$khusus = $this->Absensi_model->getHadirKhususBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$telat = $this->Absensi_model->getTelatBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$sakit = $this->Absensi_model->getSakitBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$izin = $this->Absensi_model->getIzinBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$alpha = $this->Absensi_model->getAlphaBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();

												$semua = $hadir + $telat + $khusus +$sakit + $izin + $alpha;
												if ($semua != 0) {
											?>
													<tr>
														<td><?= date('Y') ?></td>
														<td><?= bulan_indo($m) ?></td>
														<td><?= $user['name'] ?></td>
														<td>Pegawai</td>
														<td class="text-success"><?= $hadir ?></td>
														<td class="text-primary"><?= $sakit ?></td>
														<td class="text-secondary"><?= $izin ?></td>
														<td class="text-warning"><?= $telat ?></td>
														<td class="text-danger"><?= $alpha ?></td>
														<td><?php
															if ($hadir == 0) {
																echo "0%";
															} else {
																echo number_format((($hadir + $khusus + $telat) / ($semua)) * 100) . "%";
															}
															?></td>
													</tr>
											<?php }
											} ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- tab pertahun -->
			<div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab">
				<div class="row">
					<!-- Area Chart -->
					<div class="col-xl-12 cold-md-12 col-lg-12">
						<div class="card shadow mb-4">
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
								<h6 class="m-0 font-weight-bold text-primary">Rekap Absen Pertahun</h6>
							</div>
							<!-- Card Header - Dropdown -->
							<!-- Card Body -->
							<div class="card-body">
								<!-- ============================ Display Only On Desktop Mode ============================ -->
								<div class="d-none d-lg-block">
									<div class="row">
										<br><br><br>
										<div class="col-md-6">
											<button class="btn btn-danger" data-toggle="modal" data-target="#export">
												<span class="icon text-white-50">
													<i class="fas fa-file-excel"></i>
												</span>
												<span class="text">Export To Excel</span>
											</button>
										</div>
									</div>
								</div>


								<!-- ============================ Display Only On Mobile Mode ============================ -->
								<div class="d-lg-none">
									<div class="row">
										<div class="col-md-12">
											<!-- <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewUser"> Tambah Pegawai</a> -->
											<button class="btn btn-danger form-control" data-toggle="modal" data-target="#export" style="text-align: left;">
												<span class="icon text-white-50">
													<i class="fas fa-file-excel"></i>
												</span> &ensp;&ensp;
												<span class="text">Export To Excel</span>
											</button>
											<br><br>
										</div>
									</div>
								</div>
								<!-- </div> -->
								<!-- </div> -->

								<div class="table-responsive">
									<table class="table table-striped table-bordered" id="rekap-tahunan" style="width:100%;">
										<thead class="text-primary text-center">
											<tr>
												<th>Nama</th>
												<th>Sakit</th>
												<th>Izin</th>
												<th>Alpha</th>
												<th>Total Hadir</th>
												<th>Total Tidak Hadir</th>
												<th>Persentase Kehadiran</th>
											</tr>
										</thead>
										<!-- <tfoot>
											<tr>
												<th>Nama</th>
												<th>Sakit</th>
												<th>Izin</th>
												<th>Alpha</th>
												<th>Total Hadir</th>
												<th>Total Tidak Hadir</th>
												<th>Persentase Kehadiran</th>
											</tr>
										</tfoot> -->
										<tbody class="text-center">
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- rekap -->
</div>
<!-- INI ADALAH REKAP TERBARU -->
</div>


<script>
	var tabel = null;
	$(document).ready(function() {
		tabel = $('#rekap-tahunan').DataTable({
			"processing": true,
			// "responsive": true,
			"ScrollX": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'asc']
			], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax": {
				"url": "<?= base_url('pegawai/data_rekap_bulanan/'); ?>", // URL file untuk proses select datanya
				"type": "POST"
			},
			"deferRender": true,
			"aLengthMenu": [
				[10, 50, 100],
				[10, 50, 100]
			], // Combobox Limit
			"columns": [{
					"data": "name"
				},
				// {
				//  "data": "name"
				// }, 
				{
					"data": "view_sakit"
				},
				{
					"data": "view_izin"
				},
				{
					"data": "view_alpha"
				},
				{
					"data": "view_hadir"
				},
				{
					"data": "view_tidak_hadir"
				},
				{
					"data": "view_persentase"
				},

			],
		});
	});
</script>

<!-- Modal Export Rekap Absensi Tahunan -->
<div class="modal fade" id="export" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addRoleModelLabel">Export Laporan Kehadiran Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
			$bulan_sekarang = bulan_indo(date('m')); ?>
			<form action="<?= base_url('pegawai/export') ?>" method="POST">
				<div class="modal-body">
					<div class="row">

						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Pilih Bulan</label>
								<select id="bulan" name="bulan" class="form-control">
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
								</select>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary form-control">Export Laporan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		$('bulan').find('option[value=Januari]').attr('selected', 'selected');
	});
</script>
