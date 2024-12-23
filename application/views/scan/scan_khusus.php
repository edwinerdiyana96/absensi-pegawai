<!-- <link href="< ?= base_url('assets/'); ?>css/style.css" rel="stylesheet"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/normalize.css" rel="stylesheet"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/milligram.min.css" rel="stylesheet"> -->


<style type="text/css">
	.text-justify {
		text-align: justify;
	}
</style>

<div class="container" id="QR-Code">
	<div class="w-100 d-inline-block">
		<div class="panel panel-info">
			<div class="panel-body text-center">
				<div class="w-100 d-inline-block">
					<div class="w-100 d-inline-block text-center">
						<button class="w-100 d-inline-block text-center btn-success">PILIH CAMERA DIBAWAH INI: </button>
						<!-- <select class="form-control" style="display: inline-block;" id="camera-select"></select> -->
					</div>

				</div>

				<!-- WEBCODECAM CAMERA SELECT -->
				<!-- <div class="well">
					<select class="form-control" style="display: inline-block;" id="camera-select"></select>
					<canvas id="webcodecam-canvas" class="w-100 d-inline-block"></canvas>
				</div> -->

				<!-- ZXING CAMERA SELECT -->
				<div class="well">
					<div>
						<!-- <a class="button" id="startButton">Start</a> -->
						<!-- <a class="button" id="resetButton">Reset</a> -->
					</div>
					<div id="sourceSelectPanel">
						<!-- <label for="sourceSelect">PILIH KAMERA</label> -->
						<select id="sourceSelect" class="form-control" style="display: inline-block; text-align: center; text-align-last: center;">
						</select>
					</div>
					<div>
						<video id="video" class="w-100 d-inline-block"></video>
					</div>
				</div>
				<!-- <div style="display: table">
					<label for="decoding-style"> Decoding Style:</label>
					<select id="decoding-style" size="1">
						<option value="once">Decode once</option>
						<option value="continuously">Decode continuously</option>
					</select>
				</div> -->
				<!-- <label>Result:</label>
				<pre><code id="result"></code></pre> -->

				<div class="alert alert-success" role="alert">
					<h4 class="alert-heading">PERHATIAN!</h4>
					<p class="text-justify" style="text-align: justify; display:inline-block;">

						Silahkan arahkan kamera yang terbuka ke marker atau qr code yang sudah disediakan untuk melakukan absensi.
						Jika kamera tidak terbuka, pastikan hak akses untuk membuka kamera sudah diizinkan ketika pertama kali membuka aplikasi ini.
						Jika tidak muncul notifikasi untuk hak akses kamera, silahkan masuk ke pengaturan handphone -> aplikasi -> buka <i>permission</i> aplikasi / detail pengaturan untuk aplikasi karnas mobile, kemudian ubah menjadi "diizinkan". Pastikan koneksi internet lancar ketika melakukan absensi (proses Scan QR Code) karena data akan langsung dikirim ke server!

					</p>
					<hr>
					<p class="mb-0">Jika Ada Kendala atau Pertanyaan Silahkan Hubungi Administrator!</p>
				</div>

				<form id='form_absen' action="<?= base_url('pegawai/absen_khusus/' . $user['id']) ?>" method="post">
					<input type='hidden' name="user_id" id='user_id' value="<?= $user['id'] ?>">
					<!-- <input type='hidden' name="attendance_id" id='attendance_id' value="< ?= $attendance['attendance_id'] ?>"> -->
					<input type='hidden' id='qr' value='' name='qr'>
					<button hidden type="submit" class="btn btn-primary">Absen</button>
				</form>

			</div>
		</div>

	</div>
</div>

<!-- ZXING -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/index.min.js"></script>
<script type="text/javascript">
	function decodeOnce(codeReader, selectedDeviceId) {
		codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
			var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
			// console.log(result)
			// document.getElementById('result').textContent = result.text
			let audio = new Audio('<?= base_url("/assets/sound/beep2.mp3")?>');
            var text = document.getElementById('qr').textContent = result.text;
            audio.play(), 400;
            $('#qr').val(text);
            document.getElementById("form_absen").submit();
		}).catch((err) => {
			console.error(err)
			// document.getElementById('result').textContent = err
		})
	}

	function decodeContinuously(codeReader, selectedDeviceId) {
		codeReader.decodeFromInputVideoDeviceContinuously(selectedDeviceId, 'video', (result, err) => {
			if (result) {
				// properly decoded qr code
				let audio = new Audio('<?= base_url("/assets/sound/beep2.mp3") ?>');
            	var text = document.getElementById("qr").innerHTML = result.text;
            	audio.play(), 1000;
            	$('#qr').val(text);
            	document.getElementById("form_absen").submit();
				// console.log('Found QR code!', result)
				// document.getElementById('result').textContent = result.text
			}

			if (err) {
				// As long as this error belongs into one of the following categories
				// the code reader is going to continue as excepted. Any other error
				// will stop the decoding loop.
				//
				// Excepted Exceptions:
				//
				//  - NotFoundException
				//  - ChecksumException
				//  - FormatException

				if (err instanceof ZXing.NotFoundException) {
					console.log('No QR code found.')
				}

				if (err instanceof ZXing.ChecksumException) {
					console.log('A code was found, but it\'s read value was not valid.')
				}

				if (err instanceof ZXing.FormatException) {
					console.log('A code was found, but it was in a invalid format.')
				}
			}
		})
	}

	window.addEventListener('load', function() {
		let selectedDeviceId;
		const codeReader = new ZXing.BrowserQRCodeReader()
		console.log('ZXing code reader initialized')
		//document.getElementById('startButton').click()

		codeReader.getVideoInputDevices()
			.then((videoInputDevices) => {
				const sourceSelect = document.getElementById('sourceSelect')
				selectedDeviceId = videoInputDevices[0].deviceId
				if (videoInputDevices.length >= 1) {
					videoInputDevices.forEach((element) => {
						const sourceOption = document.createElement('option')
						sourceOption.text = element.label
						sourceOption.value = element.deviceId
						sourceSelect.appendChild(sourceOption)
					})

					sourceSelect.onchange = () => {
						selectedDeviceId = sourceSelect.value;
						decodeOnce(codeReader, selectedDeviceId);
					};

					const sourceSelectPanel = document.getElementById('sourceSelectPanel')
					sourceSelectPanel.style.display = 'block'
				}

				var delayInMilliseconds = 1000; //1 second
    			setTimeout(function() {
					decodeOnce(codeReader, selectedDeviceId);
    			}, delayInMilliseconds);

				// document.getElementById('startButton').addEventListener('click', () => {
					
				// 	decodeOnce(codeReader, selectedDeviceId);

				// 	const decodingStyle = document.getElementById('decoding-style').value;

				// 	if (decodingStyle == "once") {
				// 		decodeOnce(codeReader, selectedDeviceId);
				// 	} else {
				// 		decodeContinuously(codeReader, selectedDeviceId);
				// 	}

				// 	console.log(`Started decode from camera with id ${selectedDeviceId}`)
				// })

				document.getElementById('resetButton').addEventListener('click', () => {
					codeReader.reset()
					document.getElementById('result').textContent = '';
					console.log('Reset.')
				})

			})
			.catch((err) => {
				console.error(err)
			})
	})
</script>

<!-- <script type="text/javascript">
window.onload = function(){
  document.getElementById('startButton').click();
}
</script> -->

<!-- WEBCODECAM 
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/filereader.js"></script>
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/qrcodelib.js"></script>
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/webcodecamjs.js"></script>
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/main.js"></script> -->
<!-- <script type="text/javascript" src="< ?= base_url('assets/'); ?>js/webcodecamjquery.js"></script>
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/mainjquery.js"></script> 
-->

<!-- WEBCODECAM 
	<script type="text/javascript">
    var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
    var arg = {
        resultFunction: function(result) {
            let audio = new Audio('< ?= base_url('/assets/sound/beep2.mp3') ?>');
            var text = document.getElementById("qr").innerHTML = result.code;
            audio.play(), 400;
            $('#qr').val(text);
            document.getElementById("form_absen").submit();

            // var aChild = document.createElement('li');
            // aChild[txt] = result.format + ': ' + result.code;
            // document.querySelector('body').appendChild(aChild);
        }
    };
    var delayInMilliseconds = 1000; //1 second
    setTimeout(function() {
        var decoder = new WebCodeCamJS("canvas").init(arg).play();
        decoder.buildSelectMenu('#camera-select', 1);
    }, delayInMilliseconds);
</script> -->
