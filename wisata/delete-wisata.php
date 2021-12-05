<?php
include '../conection.php';

if (isset($_POST['delete_images_wisata'])) {

    $uuid_wisata        = $_POST['delete_uuid'];
    $images             = $_POST['delete_images'];

    $query ="DELETE FROM wisata WHERE uuid_wisata='$uuid_wisata'";
    $ex =  mysqli_query($link, $query);

    if ($ex) {
        unlink("uploads/".$images);
        header("location: http://localhost/jelajahin-web/wisata/pages-wisata.php");
    } else {
        echo "Gagal";
        }
}

?>