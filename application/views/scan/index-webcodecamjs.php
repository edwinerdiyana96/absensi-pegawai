<!-- <link href="< ?= base_url('assets/'); ?>css/style.css" rel="stylesheet"> -->
<!-- <link href="< ?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet"> -->

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
                        <!-- <button class="w-100 d-inline-block text-center btn-success">PILIH CAMERA DIBAWAH INI: </button> -->
                        <!-- <select class="form-control" style="display: inline-block;" id="camera-select"></select> -->
                    </div>

                </div>

                <div class="well">
                    <select class="form-control" style="display: inline-block;" id="camera-select"></select>
                    <canvas id="webcodecam-canvas" class="w-100 d-inline-block"></canvas>
                </div>

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

                <form id='form_absen' action="<?= base_url('pegawai/absen/' . $user['id']) ?>" method="post">
                    <input type='hidden' name="user_id" id='user_id' value="<?= $user['id'] ?>">
                    <!-- <input type='hidden' name="attendance_id" id='attendance_id' value="< ?= $attendance['attendance_id'] ?>"> -->
                    <input type='hidden' id='qr' value='' name='qr'>
                    <button hidden type="submit" class="btn btn-primary">Absen</button>
                </form>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/'); ?>js/filereader.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/webcodecamjs.js"></script>
<script type="text/javascript" src="<?= base_url('assets/'); ?>js/main.js"></script>
<!-- <script type="text/javascript" src="< ?= base_url('assets/'); ?>js/webcodecamjquery.js"></script>
<script type="text/javascript" src="< ?= base_url('assets/'); ?>js/mainjquery.js"></script> -->

<script type="text/javascript">
    var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
    var arg = {
        resultFunction: function(result) {
            let audio = new Audio('<?= base_url('/assets/sound/beep2.mp3') ?>');
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
</script>