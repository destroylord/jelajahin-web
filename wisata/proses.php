<?php

include_once '../conection.php';


// UUID v4
function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uuid = guidv4();

    $image_url      = $_FILES['image_url']['name'];
    $img_tmp        = $_FILES['image_url']['tmp_name'];

    $name 			= $_POST['name'];
    $description 	= $_POST['description'];
    $ticket_price 	= $_POST['ticket_price'];
    $province 		= $_POST['province'];
    $city    		= $_POST['city'];	
    $latitude 		= $_POST['latitude'];
    $longtitude 	= $_POST['longtitude'];
    $address 		= $_POST['address'];

    $dirUpload = "uploads/";

    $terupload = move_uploaded_file($img_tmp, $dirUpload.$image_url);

  
    
        $sql = "INSERT INTO `wisata`(`uuid_wisata`, `name`, `description`, `image_url`, `ticket_price`, `address`, `latitude`, `longtitude`, `rating_avg`, `rating_count`, `province_id`, `province_name`, `city_id`, `city_name`) VALUES ('$uuid' , '$name', '$description', '$image_url', '$ticket_price', '$address', '$latitude', '$longtitude', NULL, NULL, NULL, '$province', NULL, '$city')";

        // $SQL = mysqli_query($link,"INSERT INTO wisata(uuid_wisata, name, description, image_url, ticket_price, address, latitude, longtitude, rating_avg, rating_count, province_id, province_name, city_id, city_name) VALUES('$uuid', '$name', '$description', '$image_url', '$ticket_price', '$address', '$latitude', '$longtitude', NULL, NULL, NULL, '$province', NULL, '$city') ");

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