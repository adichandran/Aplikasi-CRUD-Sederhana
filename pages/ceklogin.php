<?php
// menangkap data yang dikirim dari form login
$username = $_POST['user'];
$password = $_POST['pass'];

// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../connect/koneksi.php';

$login = mysqli_query($koneksi,"select * from users where username='$username' and pass='$password'");
$row = mysqli_fetch_array($login);
$cek = mysqli_num_rows($login);
if($cek > 0){
	if ($row['username'] == $username && $row['pass'] == $password) {
		header("location:main.php");
	}
}
else
{
	header("location:./index.php?pesan=gagal");
} 
?>