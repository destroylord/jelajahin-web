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
$uuid_restaurant = $name = $description = $price_range = $food_type = $restaurant_type = $phone = $website = $business_time_open = $business_time_closes = $file = "";
$uuid_restaurant_err = $name_err = $description_err = $price_range_err = $food_type_err = $restaurant_type_err = $phone_err = $website_err = $business_time_open_err = $business_time_closes_err = $file_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$uuid_restaurant = uuid();

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an description.";
    } else{
        $description = $input_description;
    }

    // Validate price_range
    $input_price_range = trim($_POST["price_range"]);
    if(empty($input_price_range)){
        $price_range_err = "Please enter the price range food amount.";
    } elseif(!ctype_digit($input_price_range)){
        $price_range_err = "Please enter a positive integer value.";
    } else{
        $price_range = $input_price_range;
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
	$input_website = trim($_POST["website"]);
    if(empty($input_website)){
        $website_err = "Please enter the website.";
    } else{
        $website = $input_website;
    }

	// Validate Business business_time_open
	$input_business_time = trim($_POST["business_time_open"]);
    if(empty($input_business_time_open)){
        $business_time_open_err = "Please enter the restaurant open.";
    } else{
        $business_time_open = $input_business_time_open;
    }

	// Validate Business business_time_closes
	$input_business_time = trim($_POST["business_time_closes"]);
    if(empty($input_business_time_closes)){
        $business_time_closes_err = "Please enter the restaurant close.";
    } else{
        $business_time_closes = $input_business_time_closes;
    }

	// Validate image 
	$input_file = trim($_POST["file"]);
    if(empty($input_file)){
        $file_err = "Please input the file.";
    } else{
        $file = $input_file;
    }

    // Check input errors before inserting in database
    if(empty($uuid_restaurant_err) && empty($name_err) && empty($description_err) && empty($price_range_err) && empty($food_type_err) && empty($restaurant_type_err) 
	&& empty ($phone_err) && empty($website_err) && empty($business_time_open_err) && empty($business_time_closes_err) && empty($file_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO restaurant (uuid_restaurant, name, description, price_range, food_type, restaurant_type, phone, website, business_time, file ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssssss", $param_uuid_restaurant, $param_name, $param_description, $param_price_range, $param_food_type, $param_restaurant_type, $param_phone, $param_website, $param_business_time_open, $param_business_time_closes, $param_file);

            // Set parameters
			$param_uuid_restaurant		= $uuid_restaurant;
            $param_name					= $name;
            $param_description			= $description;
            $param_price_range			= $price_range;
			$param_food_type			= $food_type;
			$param_restaurant_type 		= $restaurant_type;
			$param_phone				= $phone;
			$param_website				= $website;
			$param_business_time_open	= $business_time_open;
			$param_business_time_closes	= $business_time_closes;
			$param_file					= $file;

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