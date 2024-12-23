<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<div class="container fluid mb-2 text-center">
    <div class="row ">
        <div class="btn-group btn-group-toggle justify-content-center" data-toggle="buttons">
            <label class="btn btn-primary">
                <input type="radio" name="options" value="1" autocomplete="off"> Depan
            </label>
            <label class="btn btn-info">
                <input type="radio" name="options" name="options" value="2" autocomplete="off"> Belakang
            </label>
        </div>

        <form id='form_absen' action="<?= base_url('pegawai/absen/' . $user['id']) ?>" method="post">

            <input type='hidden' name="user_id" id='user_id' value="<?= $user['id'] ?>">

            <input type='hidden' name="attendance_id" id='attendance_id' value="<?= $attendance['attendance_id'] ?>">

            <input type='hidden' id='qr' value="" name="qr">

            <button type="submit" hidden class="btn btn-primary">Absen</button>
        </form>
    </div>
</div>
<!-- <button onClick="play()" class="btn btn-primary" class="btn btn-primary">Absen</button> -->

<div class="col-md-12 col-sm-12">
    <!-- <video class='pr-2 ' style="width:640px;height:640px;" id="preview"> </video> -->
    <video class="active" style="width:fit-content; height:fit-scontent; margin:10;" id="preview" autoplay="autoplay"> </video>
</div>

<script type="text/javascript">
    // navigator.geolocation.getCurrentPosition(getLatLon);

    // function getLatLon(position) {
    //     var latitude = position.coords.latitude;
    //     var longitude = position.coords.longitude;
    //     console.log("Latitude is " + latitude);
    //     console.log("Longitude is " + longitude);

        // if (latitude == "-6.954714" && longitude == "108.4694458") {
        //     // x.innerHTML = "Kamu Sedang di SMK KARNAS KUNINGAN";
        //     alert("Kamu Sedang di SMK KARNAS KUNINGAN");
        // } else {
        //     // x.innerHTML = "Kamu Tidak Sedang di SMK KARNAS KUNINGAN";
        //     Swal.fire({
        //         title: 'Lokasi Anda',
        //         text: "Sepertinya anda sedang jauh dari SMK KARNAS KUNINGAN Lokasi saat ini  laitude"+latitude+" dan longitude"+longitude,
        //         icon: 'warning',
        //         // showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Kembali Ke Beranda'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //            window.location.href= "<?=base_url('user')?>";
        //         }
        //     })


        // }
       // }



        $(document).ready(function() {
            let audio = new Audio('<?= base_url('/assets/sound/beep2.mp3') ?>');
            // let audio = new Audio('<?= base_url('/assets/sound/sukses.mp3') ?>');
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });


            scanner.addListener('scan', function(content) {
                audio.play(), 400;
                $('#qr').val(content);
                document.getElementById("form_absen").submit();

            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    $('[name="options"]').on('change', function() {
                        if ($(this).val() == 1) {
                            if (cameras[0] != "") {
                                scanner.start(cameras[0]);
                            } else {
                                alert('No Front camera found!');
                            }
                        } else if ($(this).val() == 2) {
                            if (cameras[1] != "") {
                                scanner.start(cameras[1]);
                            } else {
                                alert('No Back camera found!');
                            }
                        }
                    });
                } else {
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
                alert(e);
            });



        })
</script>