<?php
include "../conection.php";

$nama = $_POST['nama'];

$sql=mysqli_query($link, "INSERT INTO `fasilitas_hotel`(`nama`) VALUES ('$nama')");

if ($sql) {
    header("location: pages-fasilitas-hotel.php");
} else {
    echo "gagal";
}

?>