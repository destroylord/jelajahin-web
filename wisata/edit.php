<?php

require_once "conection.php";

$uuid               = $_POST['uuid_wisata']
$image_url          = $_POST['image_url'];
$name               = $_POST['name'];
$description        = $_POST['description'];
$ticket_price       = $_POST['ticket_price'];
$province           = $_POST['province_name'];
$city               = $_POST['city_name'];

mysql_query("UPDATE wisata SET image_url='$image_url', name='$name', description='$description', ticket_price='$ticket_price',
             province='$province_name', city='$city_name' WHERE uuid=uuid_wisata");

header("location:error.php?pesan=update");
?>