<?php
if (empty($_GET['bulan'])) {
	$bulan = "Semua";
} else{
	$bulan = $_GET['bulan'];
}

echo $bulan;