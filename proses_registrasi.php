<?php
session_start();
include 'config.php';

$error = '';
if (isset($_POST['regis'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Isikan Seluruh Bagian";
	} else {

		$username = $_POST['username'];
		$pass = $_POST['password'];
		$nama_lengkap = $_POST['nama_lengkap'];
		$jabatan = $_POST['jabatan'];


		$sql1   = "INSERT INTO users VALUES ('$username', '$pass', '$nama_lengkap', '$jabatan' , now(), '', '2')";
		$query1  = $mysqli->query($sql1) or die(mysqli_error($mysqli));

		if ($query1) {
			$message = "Data Berhasil di Enkripsi";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("location:index.php");
		}
	}
}
