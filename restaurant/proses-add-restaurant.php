<?php
// Include conection
require_once "../conection.php";
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
session_start();

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

    // Validate price_range
    $input_price_max = $_POST["price_max"];
    if(empty($input_price_max)){
        $price_max_err = "Please enter the price max food amount.";
    } else{
        $price_max = $input_price_max;
    }

	// Validate food_type
	$input_food_type = $_POST["food_type"];
    if(empty($input_food_type)){
        $food_type_err = "Please select your restaurant food_type.";
    } else{
        $food_type = $input_food_type;
    }

	// Validate restaurant type
	$input_restaurant_type = $_POST["restaurant_type"];
    if(empty($input_restaurant_type)){
        $restaurant_type_err = "Please select your restaurant restaurant_type.";
    } else{
        $restaurant_type = $input_restaurant_type;
    }

	// Validate restaurant phone
	$input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter the restaurant phone number.";
    } elseif(!ctype_digit($input_phone)){
        $phone_err = "Please enter a positive integer value.";
    } else{
        $phone = $input_phone;
    }

	// Validate Website url
	$input_website = $_POST["website"];
    if(empty($input_website)){
        $website_err = "Please enter the website.";
    } else{
        $website = $input_website;
    }

	// Validate Business business_time_open
	$input_business_time_open = $_POST["business_time_open"];
    if(empty($input_business_time_open)){
        $business_time_open_err = "Please enter the restaurant open.";
    } else{
        $business_time_open = $input_business_time_open;
    }

	// Validate Business business_time_closes
	$input_business_time_closes = $_POST["business_time_closes"];
    if(empty($input_business_time_closes)){
        $business_time_closes_err = "Please enter the restaurant close.";
    } else{
        $business_time_closes = $input_business_time_closes;
    }

	// Validate image 
    if(empty($_FILES['image']['name'])){
        $image_err = "Please enter restaurant image";
    } else{
        $image = $_FILES['image']['name'];
        $temp  = $_FILES['image']['temp_name'];
        $folder = "/img/photos/".$image;
        move_uploaded_file($temp, $folder);
    }

	//validate provinsi
	$input_provinsi = $_POST["propinsi"];
	if(empty($input_provinsi)){
		$provinsi_err = "please select the province";
	} else {
		$provinsi = $input_provinsi;
	}

	//validate kabupaten
	$input_kabupaten = $_POST["kabupaten"];
	if(empty($input_kabupaten)){
		$kabupaten_err = "please select the district";
	} else {
		$kabupaten = $input_kabupaten;
	}

	//validate kecamatan
	$input_kecamatan = $_POST["kecamatan"];
	if(empty($input_kecamatan)){
		$kecamatan_err = "please select the sub district";
	} else {
		$kecamatan = $input_kecamatan;
	}

	//validate kelurahan
	$input_kelurahan = $_POST["kelurahan"];
	if(empty($input_kelurahan)){
		$kelurahan_err = "please select the rayon";
	} else {
		$kelurahan = $input_kelurahan;
	}

	//validate address
	$input_address = trim($_POST["address"]);
	if(empty($input_address)){
		$address_err = "please select the address";
	} else {
		$address = $input_address;
	}

	//validate latitude
	$input_latitude = $_POST["lat"];
	if(empty($input_latitude)){
		$latitude_err = "please select the latitude";
	} else {
		$latitude = $input_latitude;
	}

	//validate longitude
	$input_longitude = $_POST["lng"];
	if(empty($input_longitude)){
		$longitude_err = "please select the longitude";
	} else {
		$longitude = $input_longitude;
	}

    // Check input errors before inserting in database
    if(empty($uuid_restaurant_err) && empty($name_err) && empty($description_err) && empty($price_min_err) && empty($price_max_err) && empty($food_type_err) && empty($restaurant_type_err) 
	&& empty ($phone_err) && empty($website_err) && empty($business_time_open_err) && empty($business_time_closes_err) && empty($image_err) && empty($provinsi_err) 
	&& empty($kabupaten_err) && empty($kecamatan_err) && empty($kelurahan_err) && empty($address_err) && empty($latitude_err) && empty($longitude_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO restaurant (uuid_restaurant, name, description, price_min, price_max, food_type, restaurant_type, phone, website, business_time_open, 
		business_time_closes, image, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longtitude) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '$image', ?, ?, ?, ?, ?, ?, ?)";

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
                header("location: pages-menu-restaurant.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>