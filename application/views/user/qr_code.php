<div class="container-fluid">
	<div class="row text-center mt-2">
		<div class="col-md-12">
			<?= $this->session->flashdata('message_absen'); ?>
		</div>
	</div>
    <br>
<center>
	<a href="<?= base_url('assets/qr/'.$user['id'].'.png') ?>" download>
		<bbutton class="btn btn-primary">Cetak QR Code</bbutton>
	</a>
	<br><br><br>
    <img src="<?= base_url('assets/qr/'.$user['id'].'.png') ?>" width="80%">
	<br><br><br>
</center>

</div>

