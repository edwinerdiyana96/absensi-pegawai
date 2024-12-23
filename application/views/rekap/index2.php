<div class="container-fluid dashboard-atas">

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<?php
			if ($sortir == 'Filter Bulanan') { ?>
				<a class="nav-link" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Perhari</a>
			<?php } else { ?>
				<a class="nav-link active" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true">Perhari</a>
			<?php } ?>

		</li>
		<li class="nav-item" role="presentation">
			<?php
			if ($sortir == 'Filter Bulanan') { ?>
				<a class="nav-link active" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Perbulan</a>
			<?php } else { ?>
				<a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">Perbulan</a>
			<?php } ?>

		</li>
		<li class="nav-item" role="presentation">
		</li>
	</ul>

	<div class="tab-content" id="myTabContent">
		<?php
		if ($sortir == 'Filter Bulanan') { ?>
			<div class="tab-pane fade show " id="today" role="tabpanel" aria-labelledby="today-tab">
			<?php } else { ?>
			<div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
				<?php } ?>

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
									<!-- <div> -->
									<!-- ============================ Display Only On Desktop Mode ============================ -->
									<div class="d-none d-lg-block">
										<div class="row">
											<div class="col-md-6">
												<!-- <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewUser"> Tambah Pegawai</a> -->
												<form action="<?= base_url('absensi/rekap/filter_harian') ?>" method="POST">
													<div class="input-group mb-6">
														<input type="date" name="filter" class="form-control col-md-3" value="<?= $tanggal_sekarang ?>">
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
											<br><br><br>
											<div class="col-md-6 text-right">
												<button class="btn btn-danger" data-toggle="modal" data-target="#export_harian">
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
												<form action="<?= base_url('absensi/rekap/filter_harian') ?>" method="POST">
													<input type="date" name="filter" class="form-control col-md-3" value="<?= $tanggal_sekarang ?>">
													<br>
													<button class="btn btn-primary form-control" style="text-align: left;">
														<span class="icon text-white-50">
															<i class="fas fa-filter"></i>
														</span> &ensp;&ensp;
														<span class="text">Filter Tanggal</span>
													</button>
												</form>
												<br>

												<button class="btn btn-danger form-control" data-toggle="modal" data-target="#export_harian" style="text-align: left;">
													<span class="icon text-white-50">
														<i class="fas fa-file-excel"></i>
													</span> &ensp;&ensp;
													<span class="text">Export To Excel</span>
												</button><br><br>
											</div>
										</div>
									</div>

									<!-- </div> -->
									<!-- </div> -->

									<div class="table-responsive">
										<table class="table table-striped table-bordered text-nowrap" id="rekap-harian" style="width:100%;">
											<thead class="text-primary">
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
											<tbody>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

				<!-- DataTable Content -->
				<script>
					var tabel = null;
					var tanggal = '<?= $tanggal_sekarang ?>';
					$(document).ready(function() {
						tabel = $('#rekap-harian').DataTable({
							"ScrollX": true,
							"processing": true,
							// "responsive": true,
							"serverSide": true,
							"ordering": true, // Set true agar bisa di sorting
							"order": [
								[0, 'asc']
							], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
							"ajax": {
								"url": "<?= base_url('absensi/data_rekap_harian/'); ?>" + tanggal, // URL file untuk proses select datanya
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
										}else if(data == 1) {
											return '<span class="badge badge-success">Hadir Tepat Waktu</span>';
										}
										else if (data == 2) {
											return '<span class="badge badge-warning">Hadir Telat</span>';
										}
										else if (data == 3) {
											return '<span class="badge badge-primary">Sakit</span>';
										}
										else if (data == 4) {
											return '<span class="badge badge-secondary">Izin</span>';
										}
										else if (data == 5) {
											return '<span class="badge badge-danger">OFF</span>';
										}
										else if (data == 6) {
											return '<span class="badge badge-warning">Hadir Konfirmasi</span>';
										}
										else{
											return '<span class="badge badge-info">Tidak Diketahui</span>';
										}
									}
								},
							],
						});
					});
				</script>

				<!-- tab perbulan -->
				<?php
				if ($sortir == 'Filter Bulanan') { ?>
					<div class="tab-pane fade show active" id="month" role="tabpanel" aria-labelledby="month-tab">
					<?php } else { ?>
						<div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab">
						<?php } ?>

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
										<!-- ============================ Display Only On Desktop Mode ============================ -->
										<div class="d-none d-lg-block">
											<div class="row">
												<div class="col-md-6">
													<!-- <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewUser"> Tambah Pegawai</a> -->
													<form action="<?= base_url('absensi/rekap/filter_bulanan') ?>" method="POST">
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
													<form action="<?= base_url('absensi/rekap/filter_bulanan') ?>" method="POST">
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

										<div class="table-responsive">
											<table class="table table-striped table-bordered" id="rekap-bulanan" style="width:100%;">
												<thead class="text-primary">
													<tr>
														<th scope="col">Nama</th>
														<th scope="col">Tepat Waktu</th>
														<th scope="col">Telat</th>
														<th scope="col">Sakit</th>
														<th scope="col">Izin</th>
														<th scope="col">Alpha</th>
														<th scope="col">Absensi Khusus</th>
														<th scope="col">Total Hadir</th>
														<th scope="col">Total Tidak Hadir</th>
														<th scope="col">Persentase Kehadiran</th>
														<th scope="col">Persentase Datang Telat</th>
														<th scope="col">Persentase Tepat Waktu</th>
													</tr>
												</thead>
												<!-- <tfoot></tfoot> -->
												<tbody>
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

			<script>
				var tabel = null;
				var bulan = '<?= $bulan_sekarang ?>';
				$(document).ready(function() {
					tabel = $('#rekap-bulanan').DataTable({
						"ScrollX": true,
						"processing": true,
						// "responsive": true,
						"serverSide": true,
						"ordering": true, // Set true agar bisa di sorting
						"order": [
							[0, 'asc']
						], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
						"ajax": {
							"url": "<?= base_url('absensi/data_rekap_bulanan/'); ?>" + bulan, // URL file untuk proses select datanya
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
								"data": "view_tepat_waktu"
							},
							{
								"data": "view_telat"
							},
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
								"data": "view_khusus"
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
							{
								"data": "view_persentase_telat"
							},
							{
								"data": "view_persentase_tepat_waktu"
							},

						],
					});
				});
			</script>





			<!-- Modal Harian -->
			<div class="modal fade" id="export_harian" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addRoleModelLabel">Export Laporan Kehadiran Pegawai Harian</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						$bulan_sekarang = bulan_indo(date('m')); ?>
						<form action="<?= base_url('operator/export_harian') ?>" method="POST">
							<div class="modal-body">
								<div class="row">

									<div class="col-sm-6">
										<div class="form-group form-group-default">
											<label>Tanggal Awal</label>
											<input type="date" class="form-control" name="awal" value="<?= date('Y-m-d')?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group form-group-default">
											<label>Tanggal Akhir</label>
											<input type="date" class="form-control" name="akhir" value="<?= date('Y-m-d')?>">
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group form-group-default">
											<label>Pilih Status</label>
											<select id="bulan" name="status" class="form-control">
												<option value="">Semua Status</option>
												<option value="1">Hadir Tepat Waktu</option>
												<option value="2">Hadir Telat</option>
												<option value="4">Status Izin</option>
												<option value="3">Status Sakit</option>
												<option value="5">Status Off</option>
												<option value="6">Hadir Konfirmasi</option>
												<option value="0">Belum / Tidak Scan QR</option>
											</select>
										</div>
									</div>

									<div class="col-md-12 mb-3" id="pg">
											<label>Pilih Tanda Tangan</label>
										<div class="row clearfix" id="field_wrapper2">
											<div class="col-md-6 col-sm-6 col-xs-6 mb-2">
												<input type="text" class="form-control border" name="jabatan[]" id="jabatan[]" required placeholder="Input Jabatan" style="padding-left: 10px;">
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 mb-2">
												<input type="text" class="form-control border" name="nama[]" id="nama[]" required placeholder="Input Nama" style="padding-left: 10px;">
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 mb-4">
												<button type="button" name="add_order2" id="add_order2" class="btn btn-success waves-effect waves-float form-control"><i class="fa fa-plus" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>

									<script>
										var maxField2 = 3; //Input fields increment limitation
										var addButton2 = $('#add_order2'); //Add button selector
										var wrapper2 = $('#field_wrapper2'); //Input field wrapper
										var fieldHTML2 = ''+
												'<div class="col-md-12">'+
													'<div class="row clearfix">'+
														'<div class="col-md-6 col-sm-6 col-xs-6 mb-2">'+
															'<input type="text" class="form-control border" name="jabatan[]" id="jabatan[]" required placeholder="Input Jabatan" style="padding-left: 10px;">'+
														'</div>'+
														'<div class="col-md-4 col-sm-4 col-xs-4 mb-2">'+
															'<input type="text" class="form-control border" name="nama[]" id="nama[]" required placeholder="Input Nama" style="padding-left: 10px;">'+
														'</div>'+
														'<div class="col-md-2 col-sm-2 col-xs-2 mb-4">'+
															'<button type="button" name="add_order2" id="clear_order2" class="btn form-control btn-danger waves-effect waves-float"><i class="fa fa-times" aria-hidden="true"></i></button>'+
														'</div>'+
													'</div>'+
												'</div>'; //New input field html 
										var y = 1; //Initial field counter is 1

										//Once add button is clicked
										$(addButton2).click(function() {
											//Check maximum number of input fields
											if (y < maxField2) {
												y++; //Increment field counter
												$(wrapper2).append(fieldHTML2); //Add field html
											}
										});

										//Once remove button is clicked
										$(wrapper2).on('click', '#clear_order2', function(e) {
											e.preventDefault();
											$(this).parent().parent().parent().remove(); //Remove field html
											y--; //Decrement field counter
										});

										// END Add Order
									</script>

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
					$('bulan').find('option[value=Maret]').attr('selected', 'selected');
				});
			</script>



			
			<!-- Modal Bulanan -->
			<div class="modal fade" id="export" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addRoleModelLabel">Export Laporan Kehadiran Pegawai Bulanan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php
						$bulan_sekarang = bulan_indo(date('m')); ?>
						<form action="<?= base_url('operator/export') ?>" method="POST">
							<div class="modal-body">
								<div class="row">

									<div class="col-sm-12">
										<div class="form-group form-group-default">
										    <label>Tahun</label>
										    <input type="number" name="tahun" class="form-control">
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

									<div class="col-md-12 mb-3" id="pg">
											<label>Pilih Tanda Tangan</label>
										<div class="row clearfix" id="field_wrapper">
											<div class="col-md-6 col-sm-6 col-xs-6 mb-2">
												<input type="text" class="form-control border" name="jabatan[]" id="jabatan[]" required placeholder="Input Jabatan" style="padding-left: 10px;">
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 mb-2">
												<input type="text" class="form-control border" name="nama[]" id="nama[]" required placeholder="Input Nama" style="padding-left: 10px;">
											</div>
											<div class="col-md-2 col-sm-2 col-xs-2 mb-4">
												<button type="button" name="add_order" id="add_order" class="btn btn-success waves-effect waves-float form-control"><i class="fa fa-plus" aria-hidden="true"></i></button>
											</div>
										</div>
									</div>

									<script>
										var maxField = 3; //Input fields increment limitation
										var addButton = $('#add_order'); //Add button selector
										var wrapper = $('#field_wrapper'); //Input field wrapper
										var fieldHTML = ''+
												'<div class="col-md-12">'+
													'<div class="row clearfix">'+
														'<div class="col-md-6 col-sm-6 col-xs-6 mb-2">'+
															'<input type="text" class="form-control border" name="jabatan[]" id="jabatan[]" required placeholder="Input Jabatan" style="padding-left: 10px;">'+
														'</div>'+
														'<div class="col-md-4 col-sm-4 col-xs-4 mb-2">'+
															'<input type="text" class="form-control border" name="nama[]" id="nama[]" required placeholder="Input Nama" style="padding-left: 10px;">'+
														'</div>'+
														'<div class="col-md-2 col-sm-2 col-xs-2 mb-4">'+
															'<button type="button" name="add_order" id="clear_order" class="btn form-control btn-danger waves-effect waves-float"><i class="fa fa-times" aria-hidden="true"></i></button>'+
														'</div>'+
													'</div>'+
												'</div>'; //New input field html 
										var x = 1; //Initial field counter is 1

										//Once add button is clicked
										$(addButton).click(function() {
											//Check maximum number of input fields
											if (x < maxField) {
												x++; //Increment field counter
												$(wrapper).append(fieldHTML); //Add field html
											}
										});

										//Once remove button is clicked
										$(wrapper).on('click', '#clear_order', function(e) {
											e.preventDefault();
											$(this).parent().parent().parent().remove(); //Remove field html
											x--; //Decrement field counter
										});

										// END Add Order
									</script>

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
					$('bulan').find('option[value=Maret]').attr('selected', 'selected');
				});
			</script>
