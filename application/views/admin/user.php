<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="card shadow mb-4">

		<div class="card-header py3">
			<h1>
				<?= form_error('user', '<div class="alert alert-danger" role="danger">', '</div>'); ?>
				<?= $this->session->flashdata('message'); ?>

			</h1>

<!-- ============================ Display Only On Desktop Mode ============================ -->
<div class="d-none d-lg-block">
	<div class="row">
		<div class="col-md-8">
			<button class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#addNewUser">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Tambah Pegawai</span>
			</button>
			<button class="btn btn-warning btn-icon-split ml-2" data-toggle="modal" data-target="#importExcelModal">
				<span class="icon text-white-50">
					<i class="fas fa-file-import"></i>
				</span>
				<span class="text">Import dari Excel</span>
			</button>
			<button class="btn btn-danger btn-icon-split ml-2" data-toggle="modal" data-target="#deleteAllModal">
				<span class="icon text-white-50">
					<i class="fas fa-trash"></i>
				</span>
				<span class="text">DELETE ALL</span>
			</button>
		</div>
	
		<div class="col-md-4 text-right">
			<button class="btn btn-success btn-icon-split" onclick="window.location.href='<?= base_url('admin/export_user') ?>'">
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
			<button class="btn btn-info form-control mb-2" data-toggle="modal" data-target="#addNewUser">
				<span class="icon text-white-50">
					<i class="fas fa-plus"></i>
				</span>
				<span class="text">Tambah Pegawai</span>
			</button>
			<button class="btn btn-warning form-control mb-2" data-toggle="modal" data-target="#importExcelModal">
				<span class="icon text-white-50">
					<i class="fas fa-file-import"></i>
				</span>
				<span class="text">Import dari Excel</span>
			</button>
			<button class="btn btn-danger form-control mb-2" data-toggle="modal" data-target="#deleteAllModal">
				<span class="icon text-white-50">
					<i class="fas fa-trash"></i>
				</span>
				<span class="text">DELETE ALL</span>
			</button>
		</div>
	</div>
</div>

<br>

<div class="d-lg-none">
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-success form-control" onclick="window.location.href='<?= base_url('admin/export_user') ?>'">
				<span class="icon text-white-50">
					<i class="fas fa-file-excel"></i>
				</span>
				<span class="text">Export To Excel</span>
			</button>
		</div>
	</div>
</div>

<!-- Modal untuk Import Excel -->
<div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="importExcelLabel">Import Data dari Excel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('Admin/importExcelUsers') ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="fileExcel">Upload File Excel (.xls, .xlsx)</label>
						<input type="file" name="fileExcel" id="fileExcel" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Import</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
// Pemanggilan data settings dari tabel 'settings'
$settings = $this->db->get('settings')->row_array();
?>

<!-- ============================ Modal DELETE ALL ============================ -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllModalLabel">Konfirmasi Penghapusan Semua Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Untuk melanjutkan penghapusan semua data, harap ketikkan <strong><?= $settings['name']; ?></strong></p>
                <input type="text" class="form-control" id="schoolName" placeholder="Nama Sekolah">
                <div class="text-danger mt-2" id="errorMessage" style="display: none;">Nama sekolah tidak sesuai!</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form method="post" id="deleteForm" action="<?= base_url('admin/delete_all_data_users') ?>">
                    <input type="hidden" name="school_name" id="schoolNameInput">
                    <button type="submit" class="btn btn-danger" id="deleteBtn" disabled>Hapus Semua</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk memeriksa nama sekolah dan mengaktifkan tombol "Hapus Semua"
    document.getElementById('schoolName').addEventListener('input', function() {
        var schoolName = this.value.trim();
        var correctName = '<?= $settings['name']; ?>'; // Nama sekolah yang diambil dari pengaturan di controller

        if (schoolName === correctName) {
            // Jika nama sekolah sesuai, aktifkan tombol "Hapus Semua"
            document.getElementById('deleteBtn').disabled = false;
            document.getElementById('errorMessage').style.display = 'none';
        } else {
            // Jika nama sekolah tidak sesuai, nonaktifkan tombol "Hapus Semua" dan tampilkan pesan kesalahan
            document.getElementById('deleteBtn').disabled = true;
            document.getElementById('errorMessage').style.display = 'block';
        }
    });
</script>


		</div>

		<div class="card-body">
			<div class="table-responsive">
				<!-- <table class="table table-bordered display nowrap responsive" id="tableUser" style="width:100%;">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Email</th>
							<th scope="col">Nomor Hp</th>
							<th scope="col">Jenis Kelamin</th>
							<th scope="col">Foto</th>
							<th scope="col">Status Absen</th>
							<th scope="col">action</th>
						</tr>
					</thead>

					<tbody>
						< ?php $i = 1; ?>
						< ?php foreach ($list_user as $ls) : ?>
							<tr>
								<th scope="row">< ?= $i++; ?></th>
								<td>< ?= $ls['name']; ?></td>
								<td>< ?= $ls['department']; ?></td>
								<td>< ?= $ls['email']; ?></td>
								<td>< ?= $ls['phone']; ?></td>

								<td>
									< ?php if ($ls['gender'] == 'L') : ?>
										< ?php echo 'Laki-Laki'; ?>
									< ?php else :  echo 'Perempuan' ?>
									< ?php endif ?>
								</td>

								<td><img src="< ?= base_url('assets/img/profile/') . $ls['image'] ?>" class="img-thumbnail rounded-circle zoom" style="width:100px;height:100px"> </td>

								<td>< ?php if ($ls['is_flexible'] == '1') : ?>
										< ?php echo 'Flexible'; ?>
									< ?php else :  echo 'Full Time' ?>
									< ?php endif ?></td>

								<td>
									<a href="< ?= base_url('admin/editUserProfile/') . $ls['id'] . '/status' ?>" class="btn btn-outline-primary mt-2" onclick=" return confirm('apakah anda yakin ingin merubah status < ?= $ls['name'] ?>?');"> Rubah Status</a>

									<a href="< ?= base_url('admin/editUserProfile/') . $ls['id']; ?>" class="btn btn-info mt-2">Update User </a>

									< ?php if ($user['id'] == 1) : ?>
										<a href="< ?= base_url('admin/editUserAccess/') . $ls['id']; ?>" class="btn btn-primary mt-2">Akses Menu</a>
									< ?php else : ?>
										<a href="< ?= base_url('admin/editUserAccess/') . $ls['id']; ?>" class="btn btn-primary mt-2" hidden>Akses Menu</a>
									< ?php endif; ?>

									<a href="< ?= base_url('admin/deleteuser/') . $ls['id']; ?>" class="btn btn-danger mt-2" onclick=" return confirm('Are you sure want to delete this user ?');">Delete</a>
								</td>
							</tr>
						< ?php endforeach; ?>
					</tbody>
				</table> -->
				<table class="table table-striped table-bordered table-hover" id="table-guru" style="width:100%;">
					<thead class="text-primary">
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Email</th>
							<th scope="col">Nomor HP</th>
							<th scope="col">Jenis Kelamin</th>
							<th scope="col">Status Absen</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>

					<tbody>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>
</div>

</div>
<!-- /.container-fluid -->


<script>
	var tabel = null;
	$(document).ready(function () {
		tabel = $('#table-guru').DataTable({
			"processing": true,
			"ScrollX": true,
			// "responsive": true,
			"serverSide": true,
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'asc']
			], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			"ajax": {
				"url": "<?= base_url('user/data_guru'); ?>", // URL file untuk proses select datanya
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
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{
				"data": "name"
			}, // Tampilkan kategori
			{
				"data": "department"
			},
			{
				"data": "email"
			}, // Tampilkan nama sub kategori
			{
				"data": "phone"
			},
			{
				"data": "gender",
				"render": function (data, type, row, meta) {
					if (data == 'L') {
						return 'Laki-laki';
					} else {
						if (data == 'P') {
							return 'Perempuan';
						} else {
							return '-';
						}
					}
				}
			},
			{
				"data": "is_flexible",
				"render": function (data, type, row, meta) {
					if (data == '1') {
						return 'Flexible';
					} else {
						return 'Full Time';
					}
				}
			},
			{
				"data": "id",
				"render": function (data, type, row, meta) {
					// return '<a href="show/' + data + '">Show</a>';
					var konfirmasi = "confirm('apakah anda yakin ingin merubah status User ?')";
					var konfirmasi2 = "confirm('apakah anda yakin ingin menghapusnya ?')";
					if (data == '1') {
						return '<a href="<?= base_url('admin/editUserProfile/') ?>' + data + '/status" class="btn btn-outline-primary mt-2" onclick=" return ' + konfirmasi + '"> Rubah Status</a>' +
							' ' +
							'<a href="<?= base_url('admin/editUserProfile/') ?>' + data + '" class="btn btn-info mt-2">Update User </a>' +
							' ' +
							'<a href="<?= base_url('admin/deleteuser/') ?>' + data + '" class="btn btn-danger mt-2" onclick=" return ' + konfirmasi2 + '">Delete</a>';
					} else {
						return '<a href="<?= base_url('admin/editUserProfile/') ?>' + data + '/status" class="btn btn-outline-primary mt-2" onclick=" return ' + konfirmasi + '"> Rubah Status</a>' +
							' ' +
							'<a href="<?= base_url('admin/editUserProfile/') ?>' + data + '" class="btn btn-info mt-2">Update User </a>' +
							' ' +
							'<a href="<?= base_url('admin/deleteuser/') ?>' + data + '" class="btn btn-danger mt-2" onclick=" return ' + konfirmasi2 + '">Delete</a>' +
							' ' +
							'<a href="<?= base_url('admin/editUserAccess/') ?>' + data + '" class="btn btn-primary mt-2">Akses Menu</a>';
					}
				}
			},
			],
		});
	});
</script>
</div>
<!-- End of Main Content -->


<!-- Modal Add Role -->

<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addRoleModelLabel">Tambah Pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/addNewUser') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap">
					</div>
					<div class="form-group">
						<select class="form-control" name="gender">
							<!-- <Option value="">Silakan Pilih Jenis Kelamin</Option> -->
							<Option value="L">Laki - Laki</Option>
							<Option value="P">Perempuan</Option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" name="department">
							<!-- <Option value="">Silakan Pilih Jenis Kelamin</Option> -->
							<Option value=""> Pilih Jabatan</Option>
							<?php foreach ($role as $r): ?>
								<Option value="<?= $r['id'] ?>"> <?= $r['role'] ?></Option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" id="email" name="email" placeholder="email">
					</div>
					<div class="form-group">
						<input type="number" class="form-control" id="no_hp" name="phone" placeholder="Nomor Telpon">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password" name="password"
							placeholder="password">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>