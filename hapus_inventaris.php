<?php

require_once 'app/koneksi.php';

$jenis = $_GET['jenis'];

$query = "";
if($jenis == "Kembali"){
  $query = "DELETE FROM inventaris_kembali WHERE id = '$_GET[id]'";
}else{
  $query = "DELETE FROM inventaris_terima WHERE id = '$_GET[id]'";
}

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_inventaris.php?jenis='.$jenis);
} else {
  die('Gagal menghapus data karyawan: ' . $conn->error);
}
