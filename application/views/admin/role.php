<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="container-fluid dashboard-atas">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h1 class="h3 mb-4 text-primary-800"><?= $title; ?></h1>
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-lg-12">
						<?= form_error('role', '<div class="alert alert-danger" role="danger">', '</div>'); ?>
						<?= $this->session->flashdata('message'); ?>
						<a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addRoleModel"> Add role </a>
						<!-- <table class="table table-hover table-striped display nowrap" id="tableRole"> -->
						<table class="table table-hover table-striped" id="table-role" width="100%">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Role</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($role as $r) : ?>
									<tr>
										<th scope="row"><?= $i++; ?></th>
										<td><?= $r['role']; ?></td>
										<td>
											<a type="button" class="btn btn-warning" href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">Acces</a>
											<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#editRole" href="" data-role_name="<?= $r['role'] ?>" data-role_id="<?= $r['id'] ?>">Edit</a>
											<a type="button" class="btn btn-danger" href="<?= base_url('admin/deleterole/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm(' Are you sure want to delete this role ?');">Delete</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->


		<!-- Modal Add Role -->

		<div class="modal fade" id="addRoleModel" tabindex="-1" aria-labelledby="addRoleModelLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addRoleModelLabel">Add New Role </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('admin/addNewrole') ?>" method="POST">
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" id="role" name="role_name" placeholder="type new role">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Role Added</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<!-- edit Role -->


		<div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editRoleLabel">New message</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action='<?= base_url('admin/updaterole'); ?>' method="POST">
							<div class="form-group">
								<label for="role" class="col-form-label">Role</label>
								<input type="text" class="form-control role" name="role" id="role">
								<input type="hidden" class="form-control id" name="id" id="id">
							</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		$('#editRole').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var role = button.data('role_name') // Extract info from data-* attributes
			var id = button.data('role_id') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Update role' + role)
			modal.find('.role').val(role)
			modal.find('.id').val(id)
		})
	});
</script>

<script>
	$(document).ready(function() {
		$("#table-role").DataTable({
			"ScrollX": true,
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
		});
	});
</script>
