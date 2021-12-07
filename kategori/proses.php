<?php
include "../conection.php";

$nama = $_POST['nama'];

$sql=mysqli_query($link, "INSERT INTO `kategori`(`nama`) VALUES ('$nama')");

if ($sql) {
    header("location: pages-kategori.php");
} else {
    echo "gagal";
}

?>