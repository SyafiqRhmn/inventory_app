<?php

require_once 'app/koneksi.php';

$query = "DELETE FROM karyawan WHERE id = '$_GET[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_karyawan.php');
} else {
  die('Gagal menghapus data karyawan: ' . $conn->error);
}
