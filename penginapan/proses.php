<?php
include "../conection.php";

$nama = $_POST['nama'];
$nama  = $_POST['nama']

$sql=mysqli_query($link, "INSERT INTO `fasilitas_hotel`(`nama_fasilitas_hotel`, `nama_fasilitas_kamar`) VALUES ('$nama', '$nama')");

if ($sql) {
    header("location: pages-fasilitas-hotel.php");
} else {
    echo "gagal";
}

?>