<?php
// Include conection
require_once "../conection.php";
session_start();

function uuid($data  =  null) {
    $data  =  $data  ??  random_bytes ( 16 );
    //menegaskan ( strlen ( $data )  ==  16 );

    // Setel versi ke 0100
    $data [ 6 ]  =  chr ( ord ( $data [ 6 ])  &  0x0f  |  0x40 );
    // Atur bit 6-7 hingga 10
    $data [ 8 ]  =  chr ( ord ( $data [ 8 ])  &  0x3f  |  0x80 );

    // Keluarkan 36 karakter UUID.
    return  vsprintf ( '%s%s-%s-%s-%s-%s%s%s' ,  str_split ( bin2hex ( $data ),  4 ));
}

// Define variables and initialize with empty values
$uuid_restaurant = $name = $description = $price_min = $price_max = $food_type = $restaurant_type = $phone = $website = $business_time_open = 
$business_time_closes = $image = $provinsi = $kabupaten = $kecamatan = $kelurahan = $address = $latitude = $longitude = "";

$uuid_restaurant_err = $name_err = $description_err = $price_min_err = $price_max_err = $food_type_err = $restaurant_type_err = $phone_err = $website_err = 
$business_time_open_err = $business_time_closes_err = $image_err = $provinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = $address_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uuid_restaurant = uuid();

    // Validate name
    $input_name = $_POST["name"];
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }

    // Validate description
    $input_description = $_POST["description"];
    if(empty($input_description)){
        $description_err = "Please enter an description.";
    } else{
        $description = $input_description;
    }

    // Validate price_range
    $input_price_min = $_POST["price_min"];
    if(empty($input_price_min)){
        $price_min_err = "Please enter the price min food amount.";
    } else{
        $price_min = $input_price_min;
    }

    // Check input errors before inserting in database
    // if(empty($uuid_restaurant_err) && empty($name_err) && empty($description_err) && empty($price_min_err) && empty($price_max_err) && empty($food_type_err) && empty($restaurant_type_err) 
	// && empty ($phone_err) && empty($website_err) && empty($business_time_open_err) && empty($business_time_closes_err) && empty($image_err) && empty($provinsi_err) 
	// && empty($kabupaten_err) && empty($kecamatan_err) && empty($kelurahan_err) && empty($address_err) && empty($latitude_err) && empty($longitude_err)){

        // Query Builder
        // $sql = "INSERT INTO restaurant (uuid_restaurant, name, description, price_min, price_max, food_type, restaurant_type, phone, website, business_time_open, business_time_closes, image, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longtitude)
        //  VALUES ( '$uuid_restaurant', 
        //             '$name', 
        //             '$description', 
        //             '$price_min', 
        //             '$price_max', 
        //             '$food_type', 
        //             '$restaurant_type', 
        //             '$phone', 
        //             '$website', 
        //             '$business_time_open', 
        //             '$business_time_closes', 
        //             '$image', 
        //             '$provinsi', 
        //             '$kabupaten', 
        //             '$kecamatan', 
        //             '$kelurahan', 
        //             '$address', 
        //             '$latitude', 
        //             '$longitude')";
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

?>