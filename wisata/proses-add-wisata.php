<?php
// Include conection file
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
$uuid_wisata = $name = $description = $ticket_price = $image_url = $provinsi = $kabupaten = $kecamatan = $kelurahan = $address = $latitude = $longitude = "";
$uuid_wisata_err = $name_err = $description_err = $ticket_price_err = $image_url_err = $provinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = $address_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$uuid_wisata = uuid();

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

    // Validate ticket_price
    $input_ticket_price = $_POST["ticket_price"];
    if(empty($input_ticket_price)){
        $ticket_price_err = "Please enter the price range food amount.";
    } else{
        $ticket_price = $input_ticket_price;
    }

	// Validate image 
	$input_image_url = $_FILES["image_url"]["name"];
    if(empty($input_image_url)){
        $image_url_err = "Please input the image_url.";
    } else{
        $image_url = $input_image_url;
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
    if(empty($uuid_wisata_err) && empty($name_err) && empty($description_err) && empty($ticket_price_err) && empty($image_url_err) && empty($provinsi_err) 
	&& empty($kabupaten_err) && empty($kecamatan_err) && empty($kelurahan_err) && empty($address_err) && empty($latitude_err) && empty($longitude_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO wisata (uuid_wisata, name, description, ticket_price, image_url, provinsi_id, kabupaten_id, kecamatan_id, kelurahan_id, address, latitude, longitude) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssbsssssss", $param_uuid_wisata, $param_name, $param_description, $param_ticket_price, $param_image_url, $param_provinsi, 
			$param_kabupaten, $param_kecamatan, $param_kelurahan, $param_address, $param_latitude, $param_longitude);

            // Set parameters
			$param_uuid_wisata		    = $uuid_wisata;
            $param_name					= $name;
            $param_description			= $description;
            $param_ticket_price			= $ticket_price;
			$param_image_url			= $image_url;
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
                header("location: pages-wisata.php");
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