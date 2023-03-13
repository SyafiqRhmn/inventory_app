<?php

require_once 'app/koneksi.php';

var_dump($_POST);
$aset = $conn->query("SELECT * FROM tipe_barang where id = '$_POST[tipe]'");
$data = $aset->fetch_array();
$form_value = $data['form_input_barang'];

if($form_value != null){
  $detail_barang = [];
  $arrLength = count(json_decode($form_value));
  $data2 = json_decode($form_value);

  for ($x = 0; $x < $arrLength; $x++) {
    $detail_barang[$data2[$x]->value] = $_POST[$data2[$x]->key];
  }

  $detail = json_encode($detail_barang);
  $merk = "";
  $kondisi = "";
  if($_POST['tipe'] == "1"){
    $merk = $_POST['merk'];
    $kondisi = $_POST['kondisi'];
  }else{
    $merk = $_POST['merk_h'];
    $kondisi = $_POST['kondisi_h'];
  }
  $query = "INSERT INTO barang (id_tipe, merk, detail_barang, kondisi_barang) VALUES ('$_POST[tipe]', '$merk', '$detail', '$kondisi')";

  $hasil = $conn->query($query);


  if ($hasil) {
    header('Location: data_barang.php');
  } else {
    die('Gagal menambah data barang: ' . $conn->error);
  }
}else {
  die('Gagal menambah data barang: ' . $conn->error);
}
