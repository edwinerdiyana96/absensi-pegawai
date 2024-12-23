<?php
$tanggal_now = date('Y-m-d');
$tanggal_awal = date('Y-m-01');
$tanggal_akhir = date('Y-m-t',time());

$hadir = $this->Absensi_model->getHadirBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$telat = $this->Absensi_model->getTelatBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$sakit = $this->Absensi_model->getSakitBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$izin = $this->Absensi_model->getIzinBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();
$alpha = $this->Absensi_model->getAlphaBulanById($user['id'], $tanggal_awal, $tanggal_akhir)->num_rows();


$settings = $this->db->get_where('settings')->row_array();
		
if($settings['maps_enabled'] == 1){ ?>
<!-- FAB -->
<!-- <a id="kirim1" class="kc_fab_wrapper" style="display: flex; justify-content: center; right: 0px; bottom: 30px;">
</a> -->
<form id='form_maps' action="<?= base_url('pegawai/scan/') ?>" method="post">
    <input  type='hidden' name="lat" id='isi_lat' value=''>
    <input  type='hidden' name="long" id='isi_long' value=''>
    <!-- <button hidden type="submit" class="btn btn-primary">KIRIM DATA MAPS</button> -->
    <a type="submit" id="kirim1" class="kc_fab_wrapper" style="display: flex; justify-content: center; right: 0px; bottom: 30px;"></a>
</form>
<?php } else{ ?>
<a href="<?= base_url('pegawai/scan/') ?>" class="kc_fab_wrapper" style="display: flex; justify-content: center; right: 0px; bottom: 30px;">
<?php } ?>

<!-- <input type="text" id="isi_lat"> -->
<!-- Footer -->
<!-- <footer class="fixed-bottom d-none d-sm-block mb-0  bg-white"> -->
<footer class="fixed-bottom d-none d-sm-block mb-0 bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Presented By &copy; <a href="https://www.alterdev.id/">ALTER DEVELOPER INDONESIA</a> - <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" style="left: 20px; bottom: 50px;">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">KONFIRMASI</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin Ingin Keluar Dari Sistem Absensi Ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">TIDAK</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">IYA</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // navigator.geolocation.getCurrentPosition(getLatLon);

    // function getLatLon(position) {
        // var latitude = position.coords.latitude;
        // var longitude = position.coords.longitude;
        // console.log("Latitude is " + latitude);
        // console.log("Longitude is " + longitude);
        $(document).ready(function() {
            $('#kirim1').click(function() {
                // navigator.geolocation.getCurrentPosition(showPosition);
                // var txtLat = document.getElementById("lat").innerHTML = latitude;
                // var txtLong = document.getElementById("long").innerHTML = longitude;
                // $('#lat').val(txtLat);
                // $('#long').val(txtLong);

                // $('#lat').val(position.coords.latitude);
                // $('#long').val(position.coords.longitude);
                document.getElementById("form_maps").submit();
                // $.ajax({
                // url: 'http://localhost/karnas_absen/pegawai/scan',
                // type: 'POST',
                // data: {
                //     latitude: latitude,
                //     longitude: longitude
                // },
                // success: function(data) {
                //     $('#result').html(data);
                // },
                // error: function(XMLHttpRequest, textStatus, errorThrown) {
                //     //case error
                // }

                // });
            });
        });
    // }
</script>

<!-- FAB -->
<script src="<?= base_url('assets/'); ?>js/kc.fab.js"></script>

<script type="text/javascript">
    var links = [{
            "url": "",
            "bgcolor": "#03A9F4",
            "icon": "<i class='fa fa-qrcode' style='display: flex; justify-content: center; align-items: center; margin-top: 2px;'></i>"
        },
        // {
        //   "url":"http://plus.google.com",
        //   "bgcolor":"#DB4A39",
        //   "color":"#fffff",
        //   "icon":"<i class='fa fa-google-plus'></i>",
        //   "target":"_blank"
        // },
        // {
        //   "url":"http://www.facebook.com",
        //   "bgcolor":"#00ACEE",
        //   "color":"#fffff",
        //   "icon":"<i class='fa fa-facebook'></i>",
        //   "target":"_blank"
        // },
        // {
        //   "url":"http://www.facebook.com",
        //   "bgcolor":"#3B5998",
        //   "color":"#fffff",
        //   "icon":"<i class='fa fa-facebook'></i>",
        //   "target":"_blank"
        // },
        // {
        //   "url":"https://www.jqueryscript.net",
        //   "bgcolor":"#263238",
        //   "color":"white",
        //   "icon":"<i class='fa fa-home'></i>"
        // }
    ]

    $('.kc_fab_wrapper').kc_fab(links);
</script>

<!-- Bootstrap core JavaScript-->
<!-- <script defer src="< ?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->
<script defer src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script defer src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!-- Page level custom scripts -->
<script defer src="<?= base_url('assets/'); ?>js/chart-area.js"></script>
<script defer src="<?= base_url('assets/'); ?>js/chart-pie.js"></script>
<!-- <script src="< ?= base_url('assets/'); ?>js/chart.js"></script> -->


<script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    var xValues = ["Hadir", "Izin", "Sakit", "Telat", "Alpha"];
    var yValues = [75, 25];
    var barColors = ["#4e73df", "#36b9cc", "#FFFF00", "#FFA500", "#FF0000"];

    var ctx = document.getElementById("grafik_perhari");
    var grafik_perhari = new Chart(ctx, {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                data: [<?= $hadir ?>, <?= $izin ?>, <?= $sakit ?>, <?= $telat ?>, <?= $alpha ?>],
                backgroundColor: ["#4e73df", "#36b9cc", "#FFFF00", "#FFA500", "#FF0000"],
            }, ],
        },
        options: {
            maintainAspectRatio: false,
            title: {
                display: false,
                // text: "World Wide Wine Production 2018",
            },
        },
    });
</script>

<!-- DATATABLES BS 4-->
<script defer src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script defer src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script defer src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>



<script>
    $(document).ready(function() {
        // function absen_sukses() {

        // }



        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });



        $('.form-check-input').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('admin/changeaccess'); ?>",
                type: 'post',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function() {
                    document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                }
            });

        });
    })
</script>

</body>

</html>






<script>
	$(document).ready(function() { 
		// alert("Hello! I am an alert box!!");
		
		// function distance(lat1, lon1, lat2, lon2, unit) {
		// 	if ((lat1 == lat2) && (lon1 == lon2)) {
		// 		return 0;
		// 	} else {
		// 		var radlat1 = Math.PI * lat1 / 180;
		// 		var radlat2 = Math.PI * lat2 / 180;
		// 		var theta = lon1 - lon2;
		// 		var radtheta = Math.PI * theta / 180;
		// 		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		// 		if (dist > 1) {
		// 			dist = 1;
		// 		}
		// 		dist = Math.acos(dist);
		// 		dist = dist * 180 / Math.PI;
		// 		dist = dist * 60 * 1.1515;
		// 		if (unit == "K") {
		// 			dist = dist * 1.609344
		// 		}
		// 		if (unit == "N") {
		// 			dist = dist * 0.8684
		// 		}
		// 		return dist;
		// 	}
		// }

            setInterval(() => {
                getLocation();
            }, 3);


            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                }
            }

            function showPosition(position) {
                // document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
                // document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
				
				// alert("Latitude : "+position.coords.latitude+" Longitude : "+position.coords.longitude);
				document.getElementById('isi_lat').value= position.coords.latitude;
				document.getElementById('isi_long').value= position.coords.longitude;

            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                        // Swal.fire(
                        //     'Error!',
                        //     'Kamu harus mengizinkan Akses Lokasi!',
                        //     'error'
                        // )
                        break;
                }
            }
	});
</script>
