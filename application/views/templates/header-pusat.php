<!DOCTYPE html>
<html lang="en">

<?php
$settings = $this->db->get('settings')->row_array(); ?>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Cache-control max-age=31536000" content="public">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Absensi SMK Karya Nasional">
	<meta name="author" content="">

	<link rel="icon" type="image/x-icon" href="<?= base_url($settings['logo']) ?>">

	<title>
		<?= $title; ?>
	</title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<!-- <script src="< ?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
	
	<!-- <link href="< ?= base_url('assets/'); ?>css/styles.css" rel="stylesheet"> -->

	<!-- <link href="< ?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

	<!-- BOOTSTRAP 4-->
	<link defer rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link defer href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- DATATABLES BS 4-->
	<link defer rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
	<link defer rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />
	<!-- jQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



	<!-- FAB -->
	<link href="<?= base_url('assets/'); ?>css/kc.fab.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link defer rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
	<script src="<?= base_url('assets/js/sweetalert.min.js') ?>"></script>

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">