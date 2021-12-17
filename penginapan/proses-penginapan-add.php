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
$uuid_penginapan = $name = $description = $price_min = $price_max =  $hotel_facility = $phone = $website =  $image = $language = $provinsi = $kabupaten = $kecamatan = $kelurahan = $address = $latitude = $longitude = "";
$uuid_penginapan_err = $name_err = $description_err = $price_min_err = $price_max_err =  $hotel_facility_err = $phone_err = $website_err = $image_err = $language_err = $provinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = $address_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$uuid_penginapan = uuid();

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
        $price_min_err = "Please enter the price min hotel room.";
    } else{
        $price_min = $input_price_min;
    }

    // Validate price_range
    $input_price_max = $_POST["price_max"];
    if(empty($input_price_max)){
        $price_max_err = "Please enter the price max hotel room.";
    } else{
        $price_max = $input_price_max;
    }

	// Validate restaurant type
	$input_hotel_facility = $_POST["hotel_facility"];
    if(empty($input_hotel_facility)){
        $hotel_facility_err = "Please select your hotel facility.";
    } else{
        $hotel_facility = $input_hotel_facility;
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

    //validate language
    $input_language = $_POST["language"];
    if(empty($input_language)){
        $language_err = "Please enter the language.";
    } else{
        $language = $input_language;
    }

	// Validate image 
    $image	= $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "./uploads/".$image);

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
    if(empty($uuid_penginapan_err) && empty($name_err) && empty($description_err) && empty($price_min_err) && empty($price_max_err) && empty($hotel_facility_err) 
	&& empty ($phone_err) && empty($website_err) && empty($image_err) && empty($language_err) && empty($provinsi_err) && empty($kabupaten_err) && empty($kecamatan_err) && empty($kelurahan_err) && empty($address_err) && empty($latitude_err) && empty($longitude_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO penginapan (uuid_penginapan, name, description, price_min, price_max, hotel_facility, phone, website, image, language, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longitude) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, '$image', ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $param_uuid_penginapan, $param_name, $param_description, $param_price_min, $param_price_max, $param_hotel_facility, $param_phone, 
            $param_website,  $param_laguage, $param_provinsi, $param_kabupaten, $param_kecamatan, $param_kelurahan, $param_address, $param_latitude, $param_longitude);

            // Set parameters
			$param_uuid_penginapan	= $uuid_penginapan;
            $param_name				= $name;
            $param_description		= $description;
            $param_price_min		= $price_min;
            $param_price_max        = $price_max;
			$param_hotel_facility	= $hotel_facility;
			$param_phone			= $phone;
			$param_website			= $website;
			// $param_image			= $image;
            $param_laguage          = $language;
			$param_provinsi			= $provinsi;
			$param_kabupaten		= $kabupaten;
			$param_kecamatan		= $kecamatan;
			$param_kelurahan		= $kelurahan;
			$param_address			= $address;
			$param_latitude			= $latitude;
			$param_longitude		= $longitude;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: pages-penginapan.php");
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