<?php
$hadir_hari_ini = $this->Absensi_model->getAttendanceToday()->num_rows();
$jumlah_pegawai = $this->Admin_model->getPegawai()->num_rows();
?>

<!-- FAB -->
<!--<a id="kirim1" class="kc_fab_wrapper" style="display: flex; justify-content: center;"></a>-->
<div class="d-lg-none">
<!--<a id="kirim1" class="kc_fab_wrapper" style="display: flex; justify-content: center; right: 0px; bottom: 30px;"></a>-->
<!-- <a id="kirim1" class="" style="display: flex; justify-content: center; right: 0px; bottom: 30px;"></a> -->

<a href="<?= base_url('pegawai/scan/') ?>" class="" style="display: flex; justify-content: center; right: 0px; bottom: 30px;"></a>

</div>

<!-- DATA MAPS -->
<!-- <form id='form_maps' action="< ?= base_url('pegawai/scan/') ?>" method="post">
	<input hidden type='text' name="lat" id='lat' value=''>
	<input hidden type='text' name="long" id='long' value=''>
	<button hidden type="submit" class="btn btn-primary">KIRIM DATA MAPS</button>
</form> -->

<!-- Footer -->
<!-- <footer class="fixed-bottom d-none d-sm-block mb-0  bg-white"> -->
<footer class="d-none d-sm-block mb-0 bg-white fixed-bottom">
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
<!--<a class="scroll-to-top rounded" href="#page-top" style="left: 20px;">-->
<!--	<i class="fas fa-angle-up"></i>-->
<!--</a>-->
<a class="scroll-to-top rounded" href="#page-top" style="left: 30px; bottom: 30px;">
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

<!-- JAVA SCRIPT UNTUK DATA MAPS -->
<!-- <script type="text/javascript">
	navigator.geolocation.getCurrentPosition(getLatLon);
	function getLatLon(position) {
		var latitude = position.coords.latitude;
		var longitude = position.coords.longitude;
		console.log("Latitude is " + latitude);
		console.log("Longitude is " + longitude);
		$(document).ready(function() {
			$('#kirim1').click(function() {
				var txtLat = document.getElementById("lat").innerHTML = latitude;
				var txtLong = document.getElementById("long").innerHTML = longitude;
				$('#lat').val(txtLat);
				$('#long').val(txtLong);
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
	}
</script> -->

<!-- Bootstrap core JavaScript-->
<!-- <script defer src="< ?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->
<script defer src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script defer src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script defer src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<!-- <script defer src="< ?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!-- CHART JS -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
<script defer src="<?= base_url('assets/'); ?>js/chart-area.js"></script>
<script defer src="<?= base_url('assets/'); ?>js/chart-pie.js"></script>
<script defer src="<?= base_url('assets/'); ?>js/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

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

<script type="text/javascript">
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	var xValues = ["Hadir", "Tidak hadir"];
	var yValues = [75, 25];
	var barColors = ["#b91d47", "#00aba9"];

	var ctx_riwayat = document.getElementById("grafik_riwayat");
	var ctx = document.getElementById("grafik_perhari");
	var ctx_perbulan = document.getElementById("grafik_perbulan");
	var grafik_perhari = new Chart(ctx, {
		type: "pie",
		data: {
			labels: xValues,
			datasets: [{
				data: [<?= $hadir_hari_ini ?>, <?= $jumlah_pegawai - $hadir_hari_ini ?>],
				backgroundColor: ["#4e73df", "#36b9cc"],
				hoverBackgroundColor: ["#2e59d9", "#2c9faf"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
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



<!--
<script type="text/javascript">
	// Area Chart Example
	var ctx = document.getElementById("PersentasePerbulan");
	var myLineChart = new Chart(ctx, {
		type: "line",
		data: {
			labels: [
				"januari",
				"Februari",
				"Maret",
				"April",
				"Mei",
				"Juni",
				"juli",
				"Agustus",
				"September",
				"Oktober",
				"November",
				"Desember",
			],
			datasets: [{
				label: "Total",
				lineTension: 0.3,
				backgroundColor: "rgba(78, 115, 223, 0.05)",
				borderColor: "rgba(78, 115, 223, 1)",
				pointRadius: 3,
				pointBackgroundColor: "rgba(78, 115, 223, 1)",
				pointBorderColor: "rgba(78, 115, 223, 1)",
				pointHoverRadius: 3,
				pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
				pointHoverBorderColor: "rgba(78, 115, 223, 1)",
				pointHitRadius: 10,
				pointBorderWidth: 1,
				data: [
					< ?php
					for ($i = 1; $i <= 12; $i++) {

						$tanggal_awal = date('Y') . "-" . $i . "-01";
						$tanggal_akhir = date('Y') . "-" . $i . "-31";
						$total_attendance = $this->Absensi_model->getAttendanceByDate($tanggal_awal, $tanggal_akhir)->result_array();
						$actual_attendance = 0;
						$actual_present = 0;
						$actual_absent = 0;
						$actual_late = 0;
						$actual_sick = 0;
						$actual_permission = 0;

						foreach ($total_attendance as $key => $total_attendance) {
							$day = date('D', strtotime($total_attendance['date']));

							if ($day != 'Sun' && $total_attendance['status'] == '0') {
								$actual_absent++;
							}

							if ($total_attendance['status'] == '1') {
								$actual_present++;
							} elseif ($total_attendance['status'] == '2') {
								$actual_late++;
							} elseif ($total_attendance['status'] == '3') {
								$actual_sick++;
							} elseif ($total_attendance['status'] == '4') {
								$actual_permission++;
							}

							$actual_attendance++;
						}

						$all_present = $actual_present + $actual_late;
						if ($all_present == 0) {
							echo "0,";
						} else {
							echo number_format($all_present / $actual_attendance * 100) . ",";
						}
					} ?>
				],
			}, ],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
				padding: {
					left: 10,
					right: 25,
					top: 25,
					bottom: 0,
				},
			},
			scales: {
				xAxes: [{
					time: {
						unit: "date",
					},
					gridLines: {
						display: false,
						drawBorder: false,
					},
					ticks: {
						maxTicksLimit: 12,
					},
				}, ],
				yAxes: [{
					ticks: {
						maxTicksLimit: 5,
						padding: 10,
						// Include a dollar sign in the ticks
						callback: function(value, index, values) {
							return number_format(value) + "%";
						},
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2],
					},
				}, ],
			},
			legend: {
				display: false,
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: "#6e707e",
				titleFontSize: 14,
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: "index",
				caretPadding: 10,
				callbacks: {
					label: function(tooltipItem, chart) {
						var datasetLabel =
							chart.datasets[tooltipItem.datasetIndex].label || "";
						return datasetLabel + ": " + number_format(tooltipItem.yLabel);
					},
				},
			},
		},
	});
</script>
-->




<!-- Start Of Datatables BS4 -->
<!-- <script src="< ?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="< ?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script defer src="< ?= base_url('assets/'); ?>js/datatables.js"></script>
<script defer src="< ?= base_url('assets/'); ?>js/dataTables.responsive.min.js"></script> -->
<!-- End Of Datatables BS4 -->

<!-- DATATABLES BS 4-->
<script defer src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script defer src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script defer src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>


<!-- <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>? -->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js -->
<!-- </script> -->

<script>
	$(document).ready(function() {

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
