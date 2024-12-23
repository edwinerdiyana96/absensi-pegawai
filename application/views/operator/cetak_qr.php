<!-- <style type="text/css">
	.center {
		display: flex;
		margin-left: auto;
		margin-right: auto;
		width: 50%;
	}

	.bg-image {
		position: relative;
		/* left: 50%;
		top: 50%; */
		display: block;
		text-align: center;
		max-width: 100%;
		height: auto;
	}

	.plus-image {
		left: 17%;
		top: 19%;
		position: absolute;
		margin-top: 0%;
		margin-left: 0%;
		/* display: block; */
		max-width: 100%;
		height: auto;
	}

	.responsive {
		max-width: 100%;
		height: auto;
	}

	.first {
		width: 25%;
		display: inline-block;
		background-color: green;
	}

	.second {
		width: 25%;
		display: inline-block;
		background-color: blue;
	}

	.third {
		width: 25%;
		display: inline-block;
		background-color: yellow;
	}

	@media screen and (max-width: 500px) {

		.first,
		.second,
		.third {
			width: 70%;
		}
	}
</style> -->

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
	* {
		box-sizing: border-box;
	}

	.row {
		position: relative;
		width: 100%;
		max-width: 800px;
	}

	.image1 {
		/* display: block; */
		width: 100%;
		height: auto;
	}

	.image2 {
		display: block;
		width: 123%;
		height: auto;

	}

	.overlay {
		position: absolute;
		top: 0;
		margin-top: 11%;
		margin-left: 14%;
		/* background: rgb(255, 255, 255);
		background: rgba(255, 255, 255, 0.5); */
		/* Black see-through */
		/* color: #f1f1f1; */
		width: 60%;
		/* transition: .5s ease; */
		opacity: 1;
		/* color: white; */
		font-size: 20px;
		padding: 20px;
		text-align: center;
	}

	/* .container:hover .overlay {
		opacity: 1;
	} */

   
		.pembungkus{
			position: relative;
		}
		h2{
            position: absolute;
		    /* margin-left: 10%;
		    margin-right: 10%; */
            bottom: 3.9%;
            text-align: center;
			color: red;
            /* margin: auto; */
            width: 100%;
            font-family: 'Poppins';
            font-weight: bold;
            letter-spacing: 0.15em;
            font-size: 20px;
		}
</style>

<!-- <div class="container-fluid"> -->
<!-- <div class="row text-center mt-2">
		<div class="col-md-12">
			< ?= $this->session->flashdata('message_absen'); ?>
		</div>
	</div>
	<br> -->

<center>
	<br>

	<form action="<?= base_url('operator/qr/ganti/') ?>" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<!-- <input type="file" class="" id="exampleFormControlFile1" name="upload">
			<button type="submit" class="btn btn-warning">GANTI BACKGROUND</button> -->
			<a href="#" class="btn btn-primary btn-Convert-Html2Image">
				<ion-icon name="save-outline"></ion-icon> CETAK QR CODE
			</a>
		</div>
	</form>

	<div id="previewImage" class="d-none"></div>

	<br><?php $settings = $this->db->get('settings')->row_array(); ?>
    
	<div class="row" id="divToPrint">
        <div class="pembungkus">
		<img src="<?= base_url($settings['bg_qrcode'])?>" alt="TEMPLATE-QR" class="image1">
		<div class="overlay">
            <img src="<?= base_url('assets/qr/ruangan/'.$data_ruangan['qr_token']) ?>.png" alt="QR-CODE" class="image2">
        </div>
        <h2 style="color: white;"><?= $data_ruangan['description'] ?></h2>
        </div>
	</div>

	<!-- <div class="row text-center" id="divToPrint">
			<div class="col-xs-12 text-center" style="text-align:center; background-color:none; margin-top:10px;">
				<div class="text-center" style="text-align:center;">
					<img style="display: block; margin-left: auto; margin-right: auto; max-width: 800px; max-height: 1000px; width: 100%;" src="<?= base_url('assets/images/QR-TEMPLATE.png') ?>" class='bg-image'>
					<img style="display: block; margin-left: auto; margin-right: auto; max-width: 512px; max-height: 512px; width: 100%;" src="<?= base_url('assets/qr/' . $cetak_qr['qr_token'] . '.png') ?>" alt="QR CODE" class='plus-image'>
				</div>
			</div>
		</div> -->

</center>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script type="text/javascript">
	/* ---------- Save Id Card ----------*/
	var element = $("#divToPrint"); // global variable
	var getCanvas; // global variable
	html2canvas(element, {
		onrendered: function(canvas) {
			$("#previewImage").append(canvas);
			getCanvas = canvas;
		}
	});

	$(".btn-Convert-Html2Image").on('click', function() {
		var imgageData = getCanvas.toDataURL("image/png");
		// Now browser starts downloading it instead of just showing it
		var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
		$(".btn-Convert-Html2Image").attr("download", "<?= $data_ruangan['description'] . '.jpg' ?>").attr("href", newData);
	});
</script>
<!-- </div> -->