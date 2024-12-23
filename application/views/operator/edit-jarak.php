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

            <form method="post" action="<?= base_url('absensi/updateJarak'); ?>">


                <div class="form-group">
                    <label> Jarak </label>
                    <input type="hidden" name="id" class="form-control" value="<?= $jarak_id['id']; ?>">
                    <input type="number" name="jarak" class="form-control" value="<?= $jarak_id['jarak']; ?>">
                </div>

                <div class="form-group">
                    <label> Status </label>
                    <select class="form-control" name="status">
                        <?php if ($ja['status'] == '1') {
                            echo 'Aktif';
                        } else {
                            echo 'Tidak Aktif';
                        } ?>

                        </option>
                        <option value="1"> Aktif </option>
                        <option value="0"> Non Aktif </option>
                    </select>
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