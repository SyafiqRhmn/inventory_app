<?php

require_once 'app/koneksi.php';


$ttl = $_POST['tmp_lhr'].', '.$_POST['tgl_lhr'];

$query = "UPDATE karyawan SET no_ktp = '$_POST[no_ktp]', nama_karyawan = '$_POST[nama]', ttl='$ttl', alamat='$_POST[alamat]', email_pribadi='$_POST[email_p]', 
email_kantor='$_POST[email_k]', id_lokasi='$_POST[lokasi]', no_wa= '$_POST[no_wa]' , tgl_masuk_kerja= '$_POST[tgl_msk_krj]', status_karyawan = '$_POST[status_k]' 
WHERE id = '$_POST[id]'";

$hasil = $conn->query($query);

$query = "UPDATE contact_person SET nama = '$_POST[nama_k]', no_hp='$_POST[no_hp]', hub_keluarga='$_POST[hub_k]' WHERE id_karyawan = '$_POST[id]'";

$hasil = $conn->query($query);

if ($hasil) {
  header('Location: data_karyawan.php');
} else {
  die("Gagal mengupdate data karyawan: " . $conn->error);
}
