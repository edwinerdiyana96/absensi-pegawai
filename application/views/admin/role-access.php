<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="container-fluid dashboard-atas">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8">
                        <?= $this->session->flashdata('message'); ?>

                        <h5> Role : <span class="badge badge-primary"><?= $role['role'] ?></span></h5>
                        <table class="table table-hover table-striped" id="tableAccess">
                            <thead>
                                <tr>
                                    <th class="text-primary" scope="col">#</th>
                                    <th class="text-primary" scope="col">Menu</th>
                                    <th class="text-primary" scope="col">Access</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
                                            </div>
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