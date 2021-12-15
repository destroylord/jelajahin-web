<?php


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
    $input_images = $_FILES['image']['name'];
    if(empty($input_images)){
        $image_err = "Please enter restaurant image";
    } else{
        $image = $input_images;
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