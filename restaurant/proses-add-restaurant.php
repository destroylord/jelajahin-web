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


// // Define variables and initialize with empty values
//  $uuid_restaurant = $name = $description = $price_min = $price_max = $food_type = $restaurant_type = $phone = $website = $business_time_open = 
// $business_time_closes = $image = $provinsi = $kabupaten = $kecamatan = $kelurahan = $address = $latitude = $longitude = "";

// $uuid_restaurant_err = $name_err = $description_err = $price_min_err = $price_max_err = $food_type_err = $restaurant_type_err = $phone_err = $website_err = 
// $business_time_open_err = $business_time_closes_err = $image_err = $provinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = $address_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // images
    $image               = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "./uploads/".$image);

	$uuid_restaurant = uuid();

    $name                = $_POST['name'];
    $description         = $_POST['description'];
    $price_min           = $_POST['price_min'];
    $price_max           = $_POST['price_max'];
    $food_type           = $_POST['food_type'];
    $restaurant_type     = $_POST['restaurant_type'];
    $phone               = $_POST['phone'];
    $website             = $_POST['website'];
    $business_time_open  = $_POST['business_time_open'];
    $business_time_closes = $_POST['business_time_closes'];
    $propinsi            = $_POST['propinsi'];
    $kabupaten           = $_POST['kabupaten'];
    $kecamatan           = $_POST['kecamatan'];
    $kelurahan           = $_POST['kelurahan'];
    $address             = $_POST['address'];
    $lat                 = $_POST['lat'];
    $lng                 = $_POST['lng'];


    $sql = "INSERT INTO `restaurant`(`uuid_restaurant`, `name`, `description`, `address`, `price_min`, `price_max`, `food_type`, `restaurant_type`, `phone`, `website`, `business_time_open`, `business_time_closes`, `image`, `provinsi_id`, `kabupaten_id`, `kecamatan_id`, `kelurahan_id`, `latitude`, `longtitude`) VALUES ('$uuid_restaurant','$name','$description','$address','$price_min','$price_max','$food_type','$restaurant_type','$phone','$website','$business_time_open','$business_time_closes', '$image' , '$propinsi','$kabupaten','$kecamatan','$kelurahan','$lat','$lng')";

   
    $execute = mysqli_query($link, $sql);

    if ($execute) {
        echo "berhasil";
    } else {
        echo "Gagal";
    }
    

    // Validation
    // include_once 'partials/validation.php';
    

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
        

        // Prepare an insert statement
<<<<<<< HEAD
        $sql = "INSERT INTO restaurant (uuid_restaurant, name, description, price_min, price_max, food_type, restaurant_type, phone, website, business_time_open, 
		business_time_closes, image, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longtitude) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssbsssssss", $param_uuid_restaurant, $param_name, $param_description, $param_price_min, $param_price_max, $param_food_type, 
			$param_restaurant_type, $param_phone, $param_website, $param_business_time_open, $param_business_time_closes, $param_image, $param_provinsi, 
			$param_kabupaten, $param_kecamatan, $param_kelurahan, $param_address, $param_latitude, $param_longitude);

            // Set parameters
			$param_uuid_restaurant		= $uuid_restaurant;
            $param_name					= $name;
            $param_description			= $description;
            $param_price_min			= $price_min;
            $param_price_max            = $price_max;
			$param_food_type			= $food_type;
			$param_restaurant_type 		= $restaurant_type;
			$param_phone				= $phone;
			$param_website				= $website;
			$param_business_time_open	= $business_time_open;
			$param_business_time_closes	= $business_time_closes;
			$param_image				= $image;
			$param_provinsi				= $provinsi;
			$param_kabupaten			= $kabupaten;
			$param_kecamatan			= $kecamatan;
			$param_kelurahan			= $kelurahan;
			$param_address				= $address;
			$param_latitude				= $latitude;
			$param_longitude			= $longitude;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: pages-menu-restaurant.php?uuid_restaurant=". $uuid_restaurant ."");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
=======
        // $sql = "INSERT INTO restaurant (uuid_restaurant, name, description, price_min, price_max, food_type, restaurant_type, phone, website, business_time_open, 
		// business_time_closes, image, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longtitude) 
		// VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?)";


        // if($stmt = mysqli_prepare($link, $sql)){
        //     // Bind variables to the prepared statement as parameters
        //     mysqli_stmt_bind_param($stmt, "sssssssssssbsssssss", $param_uuid_restaurant, $param_name, $param_description, $param_price_min, $param_price_max, $param_food_type, 
		// 	$param_restaurant_type, $param_phone, $param_website, $param_business_time_open, $param_business_time_closes, $param_image, $param_provinsi, 
		// 	$param_kabupaten, $param_kecamatan, $param_kelurahan, $param_address, $param_latitude, $param_longitude);

        //     // Set parameters
		// 	$param_uuid_restaurant		= $uuid_restaurant;
        //     $param_name					= $name;
        //     $param_description			= $description;
        //     $param_price_min			= $price_min;
        //     $param_price_max            = $price_max;
		// 	$param_food_type			= $food_type;
		// 	$param_restaurant_type 		= $restaurant_type;
		// 	$param_phone				= $phone;
		// 	$param_website				= $website;
		// 	$param_business_time_open	= $business_time_open;
		// 	$param_business_time_closes	= $business_time_closes;
		// 	$param_image				= $image;
		// 	$param_provinsi				= $provinsi;
		// 	$param_kabupaten			= $kabupaten;
		// 	$param_kecamatan			= $kecamatan;
		// 	$param_kelurahan			= $kelurahan;
		// 	$param_address				= $address;
		// 	$param_latitude				= $latitude;
		// 	$param_longitude			= $longitude;

        //     // Attempt to execute the prepared statement
        //     if(mysqli_stmt_execute($stmt)){
        //         // Records created successfully. Redirect to landing page
        //         // header("location: pages-menu-restaurant.php");
        //         // exit();
        //         echo "success create data restaurant";
        //     } else{
        //         echo "Something went wrong. Please try again later.";
        //     }
        // }
>>>>>>> 4bd0921580c79253ad0129fb55a850ab92aa3892

        // Close statement
        // mysqli_stmt_close($stmt);
    }
    // mysqli_close($link);
?>