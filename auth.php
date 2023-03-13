<?php

session_start();

require_once 'app/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$users = $conn->query("SELECT * FROM admin WHERE username = '$username' && password=md5('$password')");

// cek apakah ada username
if ($users->num_rows > 0) {
  $user = $users->fetch_assoc();

  // cek password

  if (md5($password) === $user['password']) {
    $_SESSION['user'] = $user;
    header("Location: index.php");
  } else {
    $_SESSION['err_message'] = "Username atau password salah!";
    header("Location: login.php");
  }
} else {
  $_SESSION['err_message'] = "Username atau password salah!";
  header("Location: login.php");
}
