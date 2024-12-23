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
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="danger">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?= $this->session->flashdata('message'); ?>

					<!-- ============================ Display Only On Desktop Mode ============================ -->
					<div class="d-none d-lg-block">
                        <a href="" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#Add"> Tambah Submenu </a>
					</div>

					<!-- ============================ Display Only On Mobile Mode ============================ -->
					<div class="d-lg-none">
                        <a href="" class="btn btn-outline-primary mb-3 form-control" data-toggle="modal" data-target="#Add"> Tambah Submenu </a>
					</div>

					<div class="table-responsive">
                        <!-- <table class="table table-hover table-striped responsive display nowrap" id="tableSubMenu"> -->
						<table class="table table-striped table-bordered" id="table-sub_menu" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">url</th>
                                    <th scope="col">icon</th>
                                    <th scope="col">status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subMenu as $sm) :

                                ?>


                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td> <?php $sm['is_active'];
                                                if ($sm['is_active'] == '1') {
                                                    echo "Active";
                                                } else {
                                                    echo "Not Active";
                                                }
                                                ?></td>
                                        <td>
                                            <a href="" type="button" class="btn btn-warning m-2 p-2" data-toggle="modal" data-target="#edit" data-sm_id="<?= $sm['id']; ?>" data-sm_menu_id="<?= $sm['menu_id']; ?>" data-sm_title="<?= $sm['title']; ?>" data-sm_menu="<?= $sm['menu']; ?>" data-sm_url="<?= $sm['url']; ?>" data-sm_icon='<?= $sm['icon']; ?>' data-active="<?= $sm['is_active']; ?>">Edit</a>
                                            <a href="<?= base_url('menu/deletesubmenu/') . $sm['id'] ?>" class="btn btn-danger m-2 p-2" onclick="return confirm('are you sure wan to delete <?= $sm['title']; ?> ?')">Delete</a>
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
    <!-- End of Main Content -->

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="Add" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddLabel"> Add Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/submenu') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="icon">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="is_active" checked type="checkbox" value="1">
                                <label class="form-check-label" for="is_active">
                                    Active ?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- edit -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="AddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddLabel">Edit Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/editsubmenu') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">

                            <input type="hidden" class="form-control" id="id" name="id" placeholder="Submenu Title">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="url">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="icon">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="is_active" checked type="checkbox" value="1">
                                <label class="form-check-label" for="is_active">
                                    Active ?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Submenu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit -->
    <script>
        $(document).ready(function() {
            $('#edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var title = button.data('sm_title')
                var menu_id = button.data('sm_menu_id')
                var menu = button.data('sm_menu')
                var url = button.data('sm_url')
                var icon = button.data('sm_icon')
                var active = button.data('sm_active')
                var id = button.data('sm_id')

                var modal = $(this)
                modal.find('#title').text('Update' + title)
                modal.find('#title').val(title)
                modal.find('#menu_id').val(menu_id)
                modal.find('#menu').val(menu)
                modal.find('#url').val(url)
                modal.find('#icon').val(icon)
                modal.find('#id').val(id)

            })

        });
    </script>

<script>
	$(document).ready(function() {
		$("#table-sub_menu").DataTable({
			rowReorder: {
				selector: "td:nth-child(2)",
			},
			// responsive: true,
			"ScrollX": true,
		});
	});
</script>
