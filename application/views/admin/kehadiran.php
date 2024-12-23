<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">
	<!-- Page Heading -->
	<h1 class="h3 mb-4  text-gray-800"><?= $title ?></h1>
	<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								HADIR</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_hadir_hari_ini; ?> Orang</div>
						</div>
						<div class="col-auto">
							<span style="color: Mediumslateblue;">
								<i class="fas fa-user-graduate fa-3x"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								TIDAK HADIR</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_tidak_hadir_hari_ini; ?> Orang</div>
						</div>
						<div class="col-auto">
							<span style="color: Mediumslateblue;">
								<i class="fas fa-user-ninja fa-3x"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>



		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								TERLAMBAT</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"> <?= $total_terlambat; ?> Orang</div>
						</div>
						<div class="col-auto">
							<span style="color: Mediumslateblue;">
								<i class="fas fa-user-ninja fa-3x"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
								PERSENTASE</div>
							<div class="h5 font-weight-bold text-gray-800"><?= number_format($total_hadir_hari_ini / $total_pegawai * 100) ?>%</div>
							<div class="progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: <?= number_format($total_hadir_hari_ini / $total_pegawai * 100) ?>%"></div>
							</div>
						</div>
						<div class="col-auto">
							<span style="color: Mediumslateblue;">
								<i class="fas fa-chart-pie fa-3x "></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<a href="<?= base_url('telegram/sendRekapTelegram/'); ?>" class="btn btn-info form-control">KIRIM FULL REKAP KE TELEGRAM</a>
	<br>
	<br>
	<a href="<?= base_url('telegram/sendTerlambatTelegram/'); ?>" class="btn btn-info form-control">KIRIM DATA TERLAMBAT KE TELEGRAM</a>
	<br>
	<br>
	<!-- <a href="< ?= base_url('telegram/sendTerlambatTelegram/'); ?>" class="btn btn-info form-control">KIRIM DATA TEPAT WAKTU KE TELEGRAM</a> -->
	<!-- <br>
	<br> -->
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="sakit-tab" data-toggle="tab" href="#sakit" role="tab" aria-controls="sakit" aria-selected="false">SAKIT</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="izin-tab" data-toggle="tab" href="#izin" role="tab" aria-controls="izin" aria-selected="false">IZIN</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link active" id="alpa-tab" data-toggle="tab" href="#alpa" role="tab" aria-controls="alpa" aria-selected="true">BELUM HADIR/SCAN</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="terlambat-tab" data-toggle="tab" href="#terlambat" role="tab" aria-controls="terlambat" aria-selected="false">TERLAMBAT</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link" id="off-tab" data-toggle="tab" href="#off" role="tab" aria-controls="off" aria-selected="false">OFF</a>
		</li>
	</ul>

</div>

	<div class="tab-content" id="myTabContent">

		<!-- tab sakit -->
		<div class="tab-pane fade" id="sakit" role="tabpanel" aria-labelledby="sakit-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">DATA PEGAWAI YANG SAKIT (<?= date('d-m-Y') ?>)</h6>
						</div>
						<!-- Card Body -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="table-data_sakit" style="width:100%;">
											<thead class="text-primary text-center">
												<tr>
													<th>No.</th>
													<th>Nama</th>
													<th>Keterangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
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


		<!-- DataTable Content Sakit -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-data_sakit').DataTable({
					"processing": true,
					// "responsive": true,
					"ScrollX": true,
					"serverSide": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('operator/data_sakit'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						},
						{
							"data": "description"
						},
						{
							"data": "phone",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								var no = data.substr(1);
								var nomor = "62"+no;
								return '' +
									'<a type="button" class="btn btn-primary" href="https://wa.me/'+nomor+'">HUBUNGI</a>';
							}
						},
					],
				});
			});
		</script>


		<!-- tab izin -->
		<div class="tab-pane fade" id="izin" role="tabpanel" aria-labelledby="izin-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">DATA PEGAWAI YANG IZIN (<?= date('d-m-Y') ?>)</h6>
							<!-- <button onclick="sendRekapTelegram()" class="btn btn-info">KIRIM KE TELEGRAM</button> -->
						</div>
						<!-- Card Body -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="table-data_izin" style="width:100%;">
											<thead class="text-primary text-center">
												<tr>
													<th>No.</th>
													<th>Nama</th>
													<th>Keterangan</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody class="text-center"></tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- DataTable Content Izin -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-data_izin').DataTable({
					"processing": true,
					// "responsive": true,
					"ScrollX": true,
					"serverSide": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('operator/data_izin'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						},
						{
							"data": "description"
						},
						{
							"data": "phone",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								var no = data.substr(1);
								var nomor = "62"+no;
								return '' +
									'<a type="button" class="btn btn-primary" href="https://wa.me/'+nomor+'">HUBUNGI</a>';
							}
						},
					],
				});
			});
		</script>

		<!-- tab alpa -->
		<div class="tab-pane fade  show active" id="alpa" role="tabpanel" aria-labelledby="alpa-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">DATA PEGAWAI YANG BELUM HADIR (<?= date('d-m-Y') ?>)</h6>
							<!-- <button onclick="sendRekapTelegram()" class="btn btn-info">KIRIM KE TELEGRAM</button> -->
						</div>
						<!-- Card Body -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="table-data_belum_hadir" style="width:100%;">
											<thead class="text-primary text-center">
												<tr>
													<th>No.</th>
													<th>Nama</th>
													<th>Kehadiran</th>
													<th>Aksi</th>
												</tr>
											</thead>

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

		<!-- DataTable Content Izin -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-data_belum_hadir').DataTable({
					"processing": true,
					// "responsive": true,
					"ScrollX": true,
					"serverSide": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('operator/data_belum_hadir'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						},
						{
							"data": "attendance_id",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								return '' +
									'<a type="button" class="btn btn-primary" onclick="return '+konfirmasi+'" href="<?= base_url('admin/hadirkan/')?>'+data+'">HADIRKAN</a>';
							}
						},
						{
							"data": "phone",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								var no = data.substr(1);
								var nomor = "62"+no;
								return '' +
									'<a type="button" class="btn btn-primary" href="https://wa.me/'+nomor+'">HUBUNGI</a>';
							}
						},
					],
				});
			});
		</script>

		<!-- tab terlambat -->
		<div class="tab-pane fade" id="terlambat" role="tabpanel" aria-labelledby="terlambat-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">DATA PEGAWAI YANG TERLAMBAT (<?= date('d-m-Y') ?>)</h6>
							<!-- <button onclick="sendRekapTelegram()" class="btn btn-info">KIRIM KE TELEGRAM</button> -->
						</div>
						<!-- Card Body -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="table-data_terlambat" width="100%">
											<thead class="text-primary text-center">
												<tr>
													<th>No.</th>
													<th>Nama</th>
													<th>Jam Hadir</th>
													<th>Aksi</th>
												</tr>
											</thead>
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

		<!-- DataTable Content Terlambat -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-data_terlambat').DataTable({
					"processing": true,
					// "responsive": true,
					"ScrollX": true,
					"serverSide": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('operator/data_terlambat'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						},
						{
							"data": "time_in"
						},
						{
							"data": "phone",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								var no = data.substr(1);
								var nomor = "62"+no;
								return '' +
									'<a type="button" class="btn btn-primary" href="https://wa.me/'+nomor+'">HUBUNGI</a>';
							}
						},
					],
				});
			});
		</script>

		<!-- tab off -->
		<div class="tab-pane fade" id="off" role="tabpanel" aria-labelledby="off-tab">
			<div class="row">
				<!-- Area Chart -->
				<div class="col-xl-12 cold-md-12 col-lg-12">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">DATA PEGAWAI YANG OFF (<?= date('d-m-Y') ?>)</h6>
							<!-- <button onclick="sendRekapTelegram()" class="btn btn-info">KIRIM KE TELEGRAM</button> -->
						</div>
						<!-- Card Body -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="table-responsive">
										<table class="table table-striped table-bordered" id="table-data_off" style="width:100%;">
											<thead class="text-primary text-center">
												<tr>
													<th>No.</th>
													<th>Nama</th>
													<th>Aksi</th>
												</tr>
											</thead>
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

		<!-- DataTable Content Terlambat -->
		<script>
			var tabel = null;
			$(document).ready(function() {
				tabel = $('#table-data_off').DataTable({
					"processing": true,
					// "responsive": true,
					"serverSide": true,
					"ScrollX": true,
					"ordering": true, // Set true agar bisa di sorting
					"order": [
						[0, 'asc']
					], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
					"ajax": {
						"url": "<?= base_url('operator/data_off'); ?>", // URL file untuk proses select datanya
						"type": "POST"
					},
					"deferRender": true,
					"aLengthMenu": [
						[10, 50, 100],
						[10, 50, 100]
					], // Combobox Limit
					"columns": [{
							"data": 'id',
							"sortable": false,
							render: function(data, type, row, meta) {
								return meta.row + meta.settings._iDisplayStart + 1;
							}
						},
						{
							"data": "name"
						},
						{
							"data": "phone",
							"render": function(data, type, row, meta) {
								var konfirmasi = "confirm('Apakah anda Yakin?')";
								var no = data.substr(1);
								var nomor = "62"+no;
								return '' +
									'<a type="button" class="btn btn-primary" href="https://wa.me/'+nomor+'">HUBUNGI</a>';
							}
						},
					],
				});
			});
		</script>
	</div>
</div>
<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Main Content -->

<!-- <script>
	function sendSakit() {
		< ?php
		$link = base_url();
		$api = $link + "telegram/sendSakitTelegram/";

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);

		var_dump($api);
		?>
	}

	function sendIzin() {
		< ?php
		$link = base_url();
		$api = $link + "telegram/sendIzinTelegram/";

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);

		var_dump($api);
		?>
	}

	function sendBelumHadir() {
		< ?php
		$link = base_url();
		$api = $link + "telegram/sendBelumHadirTelegram/";

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);

		var_dump($api);
		?>
	}

	function sendTerlambat() {
		< ?php
		$link = base_url();
		$api = $link + "telegram/sendTerlambatTelegram/";

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);

		var_dump($api);
		?>
	}

	function sendRekapTelegram() {
		< ?php
		$link = base_url();
		$api = $link + "telegram/sendRekapTelegram/";

		$ch = curl_init($api);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($time));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);

		var_dump($api);
		?>
	}
</script> -->
