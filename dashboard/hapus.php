<?php
session_start();
include "../config.php";

$id_file = $_GET['id_file'];
$query = mysqli_query($mysqli, "DELETE FROM enkripsi WHERE id_enkripsi='$id_file'");

if ($query) {
       echo ("<script language='javascript'>
       window.open('hapus.php', '_blank');
       window.location.href='dekripsi.php';
       window.alert('Berhasil Menghapus File.');
       </script>
       ");
       header('location: dekripsi.php');
} else {
       echo ("<script language='javascript'>
       window.open('hapus.php', '_blank');
       window.location.href='dekripsi.php';
       window.alert('Gagal Menghapus File.');
       </script>
       ");
       header('location: dekripsi.php');
}
