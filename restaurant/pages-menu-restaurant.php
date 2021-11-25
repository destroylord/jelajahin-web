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

// Define variables and initialize with empty values
$uuid_menu = $uuid_restaurant = $category = $name = $description = $price = "";
$uuid_menu_err =$uuid_restaurant_err = $category_err = $name_err = $description_err = $price_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$uuid_menu = uuid();

	// Validate category
    if(empty(isset($_POST["category"]))){ 
        $category_err = "This category is already taken.";
    } else{
        $category = trim($_POST["category"]);
    }

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

    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price amount.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive integer value.";
    } else{
        $price = $input_price;
    }

	// Validate image 
	$input_image_url = trim($_POST["image_url"]);
    if(empty($input_image_url)){
        $image_url_err = "Please input the image.";
    } else{
        $image_url = $input_image_url;
    }

    // Check input errors before inserting in database
    if(empty($uuid_menu_err) && empty($uuid_restaurant_err) && empty($category_err) && empty($name_err) && empty($description_err) && empty($price_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO menu (uuid_menu, uuid_restaurant, category, name, description, price, image_url ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iisssss", $param_uuid_menu, $param_uuid_restaurant, $param_category, $param_name, $param_description, $param_price, $param_image_url);

            // Set parameters
			$param_uuid_menu = $uuid_menu;
			$param_uuid_restaurant = $uuid_restaurant;
			$param_category = $category;
            $param_name = $name;
            $param_description	= $description;
            $param_price_range	= $price;
			$param_image_url	= $image_url;

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
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Food Menu</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper" >

	<?php
	include "../sidebar.php";
	?>

		<div class="main" style="background-color: #E5E5E5;">
			<nav class="navbar navbar-expand navbar-light navbar-bg" style="background-color: #9ED763;">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>
		<div class="search">
			<input type="text" class="form-control" placeholder="search">
		</div>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
					<?php
						include "../request.php";
						include "../avatar.php"; 
						?>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="mb-3" style="font-weight: bold;">Food Menu In The Restaurant</h1>

					<!-- add menu -->
					<form class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="row">	
							<!-- start code on the left side of the page -->
							<div class="col-lg-6">
								<div class="form-group">
                                    <div class="mb-3 <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                                        <label class=" form-label" style="color: black;"><strong>Food Category</strong></label>
                                        <select name="category" class="form-select" value="<?php echo $category; ?>">
                                            <option <?php echo ($category == 'Makanan') ? "selected": "" ?>>Makanan</option>
                                            <option <?php echo ($category == 'Minuman') ? "selected": "" ?>>Minuman</option>
                                            <option <?php echo ($category == 'Paket Hemat') ? "selected": "" ?>>Paket Hemat</option>
                                            <option <?php echo ($category == 'Dessert') ? "selected": "" ?>>Dessert</option>
                                        </select>
                                        <span class="help-block"><?php echo $category_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                        <label class=" form-label" style="color: black;"><strong>Food Name</strong></label>
                                        <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter food name" value="<?php echo $name; ?>">
                                            <span class="help-block"><?php echo $name_err; ?></span>        
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($price_err)) ? 'has-error' : ''; ?> ">
                                        <label class=" form-label" style="color: black;"><strong>price</strong></label>
                                        <input class="form-control form-control-lg" type="number" name="price" placeholder="Enter food price" value="<?php echo $price; ?>">
                                            <span class="help-block"><?php echo $price_err; ?></span>
                                    </div>
								</div>
							</div>
							<!-- left code ends here -->

							<!-- start code on the right side of the page -->
							<div class="col-lg-6">
								<div class=" form-group">
                                    <div class="mb-3">
                                        <div class="mb-3 <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" style="color: black;"><strong>Food Description</strong></label>
                                            <textarea class="form-control span12" rows="5" name="description" 
                                            placeholder="Enter your Food description" value="<?php echo $description; ?>" ></textarea>
												<span class="help-block"><?php echo $description_err; ?></span>
                                        </div>
                                        <div class="mb-3 <?php echo (!empty($image_url_err)) ? 'has-error' : ''; ?>">
											<label class="form-label" style="color: black;"><strong>Food Image</strong></label>
                                            <input type="file" class="input-group form-control" name="image_url" >
                                        </div>
                                    </div>
								</div>
							</div>
							<!-- right code ends here -->
                        </div>
                       <input type="submit" class="btn btn-primary mt-2" name="submit" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
                       <input type="submit" class="btn btn-danger mt-2" name="submit" value="Clear">
                    </form>


					<!-- list menu -->
					<?php
					include_once "menu-data.php";
					?>
				</div>
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>

</body>

</html>