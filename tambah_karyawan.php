<?php

require_once 'app/koneksi.php';

$cek_query = "SELECT id from karyawan where no_ktp = '$_POST[no_ktp]'";
$cek_query1 = $conn->query($cek_query);
$id = $cek_query1->fetch_assoc();
$hasil = false;
if(empty($id)){
  $ttl = $_POST['tmp_lhr'].', '.$_POST['tgl_lhr'];
  $query = "INSERT INTO karyawan (no_ktp, nama_karyawan, ttl, alamat, email_pribadi, email_kantor, id_lokasi, no_wa, tgl_masuk_kerja, status_karyawan) VALUES ('$_POST[no_ktp]', 
  '$_POST[nama]', '$ttl', '$_POST[alamat]', '$_POST[email_p]', '$_POST[email_k]', '$_POST[lokasi]', '$_POST[no_wa]', '$_POST[tgl_msk_krj]', '$_POST[status_k]')";
  $conn->query($query);

  $cek_query2 = "SELECT id from karyawan where no_ktp = '$_POST[no_ktp]'";
  $cek_query3 = $conn->query($cek_query2);
  $id1 = $cek_query3->fetch_assoc();

  $query_hub = "INSERT INTO contact_person (id_karyawan, nama, no_hp, hub_keluarga) VALUES ('$id1[id]', '$_POST[nama_k]', '$_POST[no_hp]', '$_POST[hub_k]')";
  $hasil_hub = $conn->query($query_hub);

  $hasil = $hasil_hub;
}


if ($hasil) {
  header('Location: data_karyawan.php');
} else {
  die('Gagal menambah data karyawan: ' . $conn->error);
}
