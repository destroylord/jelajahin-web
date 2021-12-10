<?php
 include("../conection.php"); // untuk memanggil file koneksi.php
$id=$_GET['id'];
//query untuk delete data
$sql=mysqli_query($link, "DELETE FROM kategori WHERE id='$id'");
//setelah data dihapus redirect ke halaman tampil.php
header("Location:pages-kategori.php");
?>