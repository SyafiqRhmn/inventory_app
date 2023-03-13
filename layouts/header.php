<?php

session_start();

$user = @$_SESSION['user'];
if (!$user) {
  header('Location: login.php');
  die;
}

require_once "./app/helpers.php"

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventaris PT. Primavisi GLobal Indo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <script src="./assets/js/form-modal.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link text-uppercase font-weight-bold" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <!-- <i class="fas fa-th-large"></i> -->
            <?= $user['username'] ?>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #00A8FF;">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link" style="border-bottom: 1px solid #343a40;">
        <img src="assets/img/dsii.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text ">Inventory App</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid #343a40;">
          <div class="image">
            <img src="assets/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $user['username'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="index.php" class="nav-link  <?= activeLink('index') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-home"></i>
                <p class="">
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">DATA MASTER</li>
            <li class="nav-item">
              <a href="data_karyawan.php" class="nav-link <?= activeLink('data_karyawan') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-users"></i>
                <p class="">
                  Data Karyawan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="data_barang.php" class="nav-link <?= activeLink('data_barang') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-building"></i>
                <p class="">
                  Data Inventaris Barang
                </p>
              </a>
            </li> 
            <li class="nav-header">INVENTARIS</li>
            <li class="nav-item">
              <a href="data_inventaris.php?jenis=Terima" class="nav-link <?= activeLink('data_inventaris?jenis=Terima') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-archive"></i>
                <p class="">
                  Investaris Terima
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="data_inventaris.php?jenis=Kembali" class="nav-link <?= activeLink('data_inventaris?jenis=Kembali') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-archive"></i>
                <p class="">
                  Investaris Kembali
                </p>
              </a>
            </li>
            
            <li class="nav-header">MORE</li>
            <li class="nav-item">
              <a href="about.php" class="nav-link <?= activeLink('about') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-exclamation-circle"></i>
                <p class="">
                  About
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p class="">Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid pt-3">