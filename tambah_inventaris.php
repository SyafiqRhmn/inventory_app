<?php

require_once 'app/koneksi.php';

var_dump($_POST);
var_dump($_GET);
$jenis = $_GET['jenis'];

$query = "";
if($jenis == "Kembali"){
  $query = "INSERT INTO inventaris_kembali (id_inventaris_terima, tgl_kembali, kondisi_kembali) VALUES ('$_POST[id]', '$_POST[tgl]', '$_POST[kondisi]')";
}else{
  $query = "INSERT INTO inventaris_terima (id_karyawan, id_barang, tgl_terima, kondisi_terima) VALUES ('$_POST[id]', '$_POST[lokasi]', '$_POST[tgl]',
  '$_POST[kondisi]')";
}

$hasil = $conn->query($query);


if ($hasil) {
  header('Location: data_inventaris.php?jenis='.$jenis);
} else {
  die('Gagal menambah data karyawan: ' . $conn->error);
}
