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

            <form method="post" action="<?= base_url('admin/updateuseraccess'); ?>">


                <div class="form-group">
                    <label for="new_password1">Access</label>
                    <!-- <div class="form-group">
                        
                    </div> -->
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" id="id" value="<?= $user_role['id']; ?>">
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">select Acces</option>
                            <?php foreach ($list_role as $r) : ?>
                                <option value="<?= $r['id'] ?>"> <?= $r['role'] ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </div>
    </div>
    </form>
</div>
<!-- /.container-fluid -->

