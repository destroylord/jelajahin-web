<?php
// --- koneksi ke database
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
$uuid_menu = $uuid_restaurant = $category = $name = $description = $price = $image_url= "";
$uuid_menu_err = $uuid_restaurant_err = $category_err = $name_err = $description_err = $price_err = $image_url_err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uuid_menu = uuid();
    $uuid_restaurant = 123;

    //validate category
    $input_category = $_POST['category'];
    if(empty($input_category)){
        $category_err = "please select menu category";
    } else{
        $category = $input_category;
    }

    //validate nama
    $input_name = $_POST['name'];
    if(empty($input_name)){
        $name_err = "please enter menu name";
    }else{
        $name = $input_name;
    }

    //validate description menu
    $input_description = $_POST['description'];
    if(empty($input_description)){
        $description_err = "please enter menu description";
    } else{
        $description = $input_description;
    }

    //validate menu price
    $input_price  = $_POST['price'];
    if(empty($input_price)){
        $price_err = "please enter menu price";
    }else{
        $price=$input_price;
    }

    //validate image menu
    $input_image_url = $_FILES['image_url']['name'];
    $temp  = isset($_FILES['image_url']['temp']);
    $folder = "/img/photos/".$input_image_url;
    move_uploaded_file($temp, $folder);
    if(empty($input_image_url)){
        $image_url_err = "please enter menu photo";
    }else{
        $image_url = $input_image_url;
    }

    // Check input errors before inserting in database
    if(empty($uuid_menu_err) && empty($uuid_restaurant_err) && empty($category_err) && empty($name_err) && empty ($description_err) && empty($price_err) && empty($image_url_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO menu (uuid_menu, uuid_restaurant, category, name, description, price, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssb", $param_uuid_menu, $param_uuid_restaurant, $param_category, $param_name, $param_description, $param_price, $param_image_url);

            // Set parameters
            $param_uuid_menu    = $uuid_menu;
            $param_uuid_restaurant = $uuid_restaurant;
            $param_category     = $category;
            $param_name         = $name;
            $param_description  = $description;
            $param_price        = $price;
            $param_image_url    = $image_url;
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
			<?php
				include "../navigation.php";
			?>

    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="mb-3" style="font-weight: bold;">Food Menu In The Restaurant</h1>
        <form class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="row">	
                <!-- start code on the left side of the page -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Category</strong></label>
                            <select name="category" class="form-select">
                                <option >Makanan</option>
                                <option >Minuman</option>
                                <option >Paket Hemat</option>
                                <option >Dessert</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Name</strong></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter food name">      
                        </div>
                        <div class="mb-3 ">
                            <label class=" form-label" style="color: black;"><strong>price</strong></label>
                            <input class="form-control form-control-lg" type="number" name="price" placeholder="Enter food price">
                        </div>
                    </div>
                </div>
                <!-- left code ends here -->

                <!-- start code on the right side of the page -->
                <div class="col-lg-6">
                    <div class=" form-group">
                        <div class="mb-3">
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Description</strong></label>
                                <textarea class="form-control span12" rows="5" name="description" 
                                placeholder="Enter your Food description" ></textarea>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Image</strong></label>
                                <input type="file" class="input-group form-control" name="image_url" >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right code ends here -->
            </div>
            <input type="submit" class="btn btn-primary mt-2" name="submit" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
            <input type="reset" class="btn btn-danger mt-2" name="reset" value="Clear">
        </form>

	<script src="../js/app.js"></script>

</body>

</html>