<?php

include_once '../conection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama 			= $_POST['nama'];
    
    
        $sql = "INSERT INTO `wisata`(`nama`) VALUES ('$nama')";

        $ex = mysqli_query($link, $sql);
        

        // echo "<pre>";
        // var_dump($sql);
        // echo "</pre>";exit;

        if ($ex) {
            echo "berhasil";exit;
        } else {
            echo "gagal";exit;
        }
        


        
    } 
?>