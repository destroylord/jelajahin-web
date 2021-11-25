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

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../img/icons/logo.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>menu page Restaurant</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	</head>

<body>

	<div class="wrapper" >
	<?php
	include "../sidebar.php";
	?>

		<div class="main mx-auto" style="background-color: #E5E5E5;">
			<?php
				include "../navigation.php";
				
			?>

			<main class="content">
				<div class="container-fluid p-0" >
					<h1 class="mb-3"><strong>Add Data Restaurant</strong></h1>

					<form class="container scrollspy-example" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="row">	
							<!-- start code on the left side of the page -->
							<div class="col-lg-6">
								<div class="form-group">
									<label class=" form-label" style="color: black;"><strong>Restaurant Name</strong></label>
										<div class="mb-3 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?> ">
											<input type="text" class="form-control form-control-lg" name="name" id="name" 
											placeholder="Enter your restaurant name" value="<?php echo $name; ?>">
												<span class="help-block"><?php echo $name_err; ?></span>        
										</div>
                                        <div class="mb-3 <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" style="color: black;"><strong>Restaurant Description</strong></label>
                                            <textarea class="form-control span12" rows="6" name="description" 
                                            placeholder="Enter your restaurant description" value="<?php echo $description; ?>" ></textarea>
												<span class="help-block"><?php echo $description_err; ?></span>
                                        </div>
										<div class="mb-3 <?php echo (!empty($price_range_err)) ? 'has-error' : ''; ?>">
											<label class=" form-label"style="color: black;"><strong>Range Price</strong></label>
											<div class="mb-3 row">
												<label class="col-sm-1 col-form-label" style="color: black;">Rp</label>
												<div class="col-sm-11">
													<input class="form-control" type="text" name="price_range" placeholder="Enter your range price" value="<?php echo $price_range; ?>">
													<span class="help-block"><?php echo $price_range_err; ?></span>
												</div>
											</div>
										</div>
										<div class="input-group mb-3 <?php echo (!empty($file_err)) ? 'has-error' : ''; ?>">
											<input type="file" class="form-control" name="file">
											<label class="input-group-text" for="file">Upload</label>
										</div>
								</div>
							</div>
							<!-- left code ends here -->

							<!-- start code on the right side of the page -->
							<div class="col-lg-6">
								<div class=" form-group">
                                        <div class="mb-3 <?php echo (!empty($food_type_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label"style="color: black;"><strong>Food Type</strong></label>
                                            <select name="food_type" class="form-select mb-3" value="<?php echo $food_type; ?>">
												<option <?php echo ($food_type == 'Chinnes Food') ? "selected": "" ?>>Chinnes Food</option>
												<option <?php echo ($food_type == 'Western Food') ? "selected": "" ?>>Western Food</option>
												<option <?php echo ($food_type == 'Java Food') ? "selected": "" ?>>Java Food</option>
												<option <?php echo ($food_type == 'Maduran Food') ? "selected": "" ?>>Maduran Food</option>
											</select>
											<span class="help-block"><?php echo $food_type_err; ?></span>
                                        </div>
                                        <div class="mb-3 <?php echo (!empty($restaurant_type_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label"style="color: black;"><strong>Restaurant Type</strong></label>
                                            <select name="restaurant_type" class="form-select mb-3" value="<?php echo $restaurant_type; ?>">
												<option <?php echo ($restaurant_type == 'Cafe') ? "selected": "" ?>>Cafe</option>
												<option <?php echo ($restaurant_type == 'Fine Dining') ? "selected": "" ?>>Fine Dining</option>
												<option <?php echo ($restaurant_type == 'Fast Food') ? "selected": "" ?>>Fast Food</option>
												<option <?php echo ($restaurant_type == 'Prasmanan') ? "selected": "" ?>>Prasmanan</option>
												<option <?php echo ($restaurant_type == 'Family Restaurant') ? "selected": "" ?>>Family Restaurant</option>
												<option <?php echo ($restaurant_type == 'Steakhouse') ? "selected": "" ?>>Steakhouse</option>
											</select>
											<span class="help-block"><?php echo $restaurant_type_err; ?></span>
                                        </div>
										<div class="mb-3 <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label"style="color: black;"><strong>Phone Number</strong></label>
                                            <input class="form-control form-control-lg" type="phone" name="phone" placeholder="Enter your restaurant phone number" value="<?php echo $phone; ?>">
												<span class="help-block"><?php echo $phone_err; ?></span>
                                        </div>
										<div class="form-group">
											<div class="mb-3 <?php echo (!empty($website_err)) ? 'has-error' : ''; ?>">
												<label class="form-label"style="color: black;"><strong>Url Website</strong></label>
												<input class="form-control form-control-lg" type="url" name="website" placeholder="Enter your restaurant website" value="<?php echo $website; ?>">
													<span class="help-block"><?php echo $website_err; ?></span>
											</div>
											<div class="mb-3">
												<label class="form-label"style="color: black;"><strong>Business Time</strong></label>
												<div class="row ">
													<div class="col-lg-6 <?php echo (!empty($business_time_open_err)) ? 'has-error' : ''; ?> ">
														<input class="form-control form-control-lg" type="time" name="business_time_open" placeholder="Enter your restaurant business business_time" value="<?php echo $business_time; ?>">
														<span class="help-block"><?php echo $business_time_open_err; ?></span>
													</div>
													<div class="col-lg-6 <?php echo (!empty($business_time_closes_err)) ? 'has-error' : ''; ?>">
														<input class="form-control form-control-lg " type="time" name="business_time_closes" placeholder="Enter your restaurant business business_time" value="<?php echo $business_time; ?>">
														<span class="help-block"><?php echo $business_time_closes_err; ?></span>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>
							<!-- right code ends here -->

							<div class="col-12">
								<div class="row mb-3 mt-3">
									<div class="col-lg-10 ">
										<h5 class="title "><strong>Restaurant Address</strong></h5>
									</div>
								</div>

								<div class="row">
									<?php
									include "coba.php";
									?>
								</div>


								<div class="row">
								<?php
									include "maps-coba.php";
									?>
								</div>
								<input type="submit" class="btn btn-primary mt-3" value="Submit" name="submit" style="background-color: #9ED763; border-color:#9ED763;">
								<a href="pages-restaurant.php" class="btn btn-danger mt-3">Cancel</a>
							</div>
					</form>
				</div>
				
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>
</body>

</html>