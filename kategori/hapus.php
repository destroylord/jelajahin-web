<?php
extract ($_POST);
extract ($_GET);
include = "conection.php";
$hapus_data="DELETE FROM kategori WHERE id ='$id'";
$jalan_hapus=mysql_query($hapus_data);
header("location: pages-kategori.php");
?