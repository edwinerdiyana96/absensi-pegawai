<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <form method="post" action="<?= base_url('admin/updaterole'); ?>">


                <div class="form-group">
                    <label for="new_password1">Role </label>
                    <input type="hidden" name="id" class="form-control" id="id" value="<?= $role['id']; ?>">
                    <input type="text" name="role" class="form-control" id="role" value="<?= $role['role']; ?>">

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </div>
    </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->