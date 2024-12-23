<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container-fluid dashboard-atas">
        <div class="card shadow mb-4">
            <div class="card-header ">
                <h1 class="h3 mb-4 text-primary-800"><?= $title; ?></h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= form_error('menu', '<div class="alert alert-danger" role="danger">', '</div>'); ?>
                        <?= $this->session->flashdata('message'); ?>

					<!-- ============================ Display Only On Desktop Mode ============================ -->
					<div class="d-none d-lg-block">
                        <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#addNewMenu"> Tambah Menu </a>
					</div>

					<!-- ============================ Display Only On Mobile Mode ============================ -->
					<div class="d-lg-none">
                        <a href="" class="btn btn-outline-primary mb-3 form-control" data-toggle="modal" data-target="#addNewMenu"> Add Menu </a>
					</div>

					<div class="table-responsive">
						<!-- <table class="table table-hover table-striped responsive display nowrap" id="SubMenu"> -->
						<table class="table table-striped table-bordered" id="table-menu" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <a type="button" class="btn btn-outline-warning m-2" data-toggle="modal" href="" data-target="#editMenu" data-menu_id="<?= $m['id'] ?>" data-menu_name="<?= $m['menu'] ?>">Edit</a>
                                            <a type="button" class="btn btn-danger m-2" href="<?= base_url('menu/deleteMenu/') . $m['id'] ?>" onclick="return confirm('Delete Menu <?= $m['menu'] ?> ?'  )" class="badge badge-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
					</div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewMenu" tabindex="-1" aria-labelledby="addNewMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMenuLabel">Add Menu </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="type new menu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="editMenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuLabel">Update Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="menu/updateMenu" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control menu" name="menu" id="menu-name">
                        <input type="hidden" class="form-control id" name="id" id="id-name">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Menu</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#editMenu').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var a = $(event.relatedTarget) // Button that triggered the modal
            var menu = button.data('menu_name') // Extract info from data-* attributes
            var id = button.data('menu_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Update ' + menu)
            modal.find('.menu').val(menu)
            modal.find('.id').val(id)
        })

    });
</script>

<script>
	$(document).ready(function() {
		$("#table-menu").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>
