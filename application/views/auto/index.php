<div class="container-fluid dashboard-atas">

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary "><?= $title ?></h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>

			<!-- ============================ Display Only On Desktop Mode ============================ -->
			<div class="d-none d-lg-block">
				<div class="row">
					<div class="col-md-4 mb-2">
						<a href='<?= base_url('auto/insertdataattendance/'); ?>'>
							<button class="btn btn-info  btn-icon-split" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">INSERT</span>
							</button>
						</a>
					</div>
				</div>
			</div>

			<!-- ============================ Display Only On Mobile Mode ============================ -->
			<div class="d-lg-none">
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href="<?= base_url('auto/insertdataattendance/'); ?>">
							<button class="btn btn-info form-control" data-toggle="modal" data-target="#addNewUser">
								<span class="icon text-white-50">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">INSERT</span>
							</button>
						</a>
					</div>
				</div>
			</div>

			<br>

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table-autoinsert" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th>No.</th>
							<th>Nama</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- DataTable Content -->
	<script>
		var tabel = null;
		$(document).ready(function() {
			tabel = $('#table-autoinsert').DataTable({
				"processing": true,
				// "responsive": true,
				"ScrollX": true,
				"serverSide": true,
				"ordering": true, // Set true agar bisa di sorting
				"order": [
					[0, 'asc']
				], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
				"ajax": {
					"url": "<?= base_url('auto/data_attendance'); ?>", // URL file untuk proses select datanya
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
						"data": "aksi"
					},
					// {	"data": "id",
					// 	"render": function(data, type, row, meta) {
					// 		var konfirmasi = "confirm('Apakah anda Yakin?')";
					// 		return '' +
					// 			'<a type="button" class="btn btn-primary" onclick="return '+confirm+'" href="<?= base_url('auto/manual/')?>'+data+'">Auto Isert</a>';
					// 	}
					// },
				],
			});
		});
	</script>