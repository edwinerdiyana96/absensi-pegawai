<!DOCTYPE html>
<html lang="en">

<head>
<?php
$settings = $this->db->get('settings')->row_array();?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-control max-age=31536000" content="public">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" type="image/x-icon" href="<?= base_url($settings['logo'])?>">

  <title><?= $title ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->

  <!-- Custom styles for this template-->
  <!--<link href="< ?= base_url('assets/css/sb-admin-2.min.css') ?>" rel='stylesheet'>-->
  <link href="<?= base_url('assets/css/styles.css') ?>" rel='stylesheet'>
  <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>