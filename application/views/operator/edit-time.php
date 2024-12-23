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

            <form method="post" action="<?= base_url('absensi/updateTime'); ?>">


                <div class="form-group">
                    <label> Keterangan </label>
                    <input type="hidden" name="id" class="form-control" value="<?= $jam_absen_id['id']; ?>">
                    <input type="text" name="time_schedule" class="form-control" value="<?= $jam_absen_id['time_schedule']; ?>">
                </div>

                <div class="form-group">
                    <label> Jam Masuk </label>
                    <input type="time" step="1" name="time_start" class="form-control" value="<?= $jam_absen_id['time_start']; ?>">
                </div>

                <div class="form-group">
                    <label> Jam Tutup </label>
                    <input type="time" step="1" name="time_end" class="form-control" value="<?= $jam_absen_id['time_end']; ?>">
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