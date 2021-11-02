<?php
// Include conection file
require_once "conection.php";
 
// Define variables and initialize with empty values
$name = $email = $username = $phone = $jenis_kelamin = $jabatan = $password = $confirm_password = "";
$name_err = $email_err = $username_err = $phone_err = $jenis_kelamin_err = $jabatan_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["uuid_admin"]) && !empty($_POST["uuid_admin"])){
    // Get hidden input value
    $uuid_admin = $_POST["uuid_admin"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($username_err) && empty($phone_err) && empty($jenis_kelamin_err) && 
    empty($jabatan_err) && empty($password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE admin SET name=?, email=?, username=?, phone=?, jenis_kelamin=?, jabatan=?, password=? WHERE uuid_admin=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_name, $param_email, $param_username, $param_phone, $param_jenis_kelamin, $param_jabatan, $param_password, $param_uuid_admin);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_username = $username;
            $param_phone = $phone;
            $param_jenis_kelamin = $jenis_kelamin;
            $param_jabatan = $jabatan;
            $param_uuid_admin = $uuid_admin;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: pages-admin.php");
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["uuid_admin"]) && !empty(trim($_GET["uuid_admin"]))){
        // Get URL parameter
        $uuid_admin =  trim($_GET["uuid_admin"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM admin WHERE uuid_admin = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_uuid_admin);
            
            // Set parameters
            $param_uuid_admin = $uuid_admin;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $email = $row["email"];
                    $phone = $row["phone"];
                    $jabatan = $row["jabatan"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Update Admin</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="row">	
			<!-- start code on the left side of the page -->
				<div class="col-lg-6">
					<div class="form-group">
						<div class="mb-3 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
							<label class=" form-label" style="color: black;"><strong>Full Name</strong></label>
							<input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter your Full name" value="<?php echo $name; ?>">
								<span class="help-block"><?php echo $name_err; ?></span>        
						</div>
                        <div class="mb-3 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?> ">
                            <label class=" form-label" style="color: black;"><strong>Email</strong></label>
                            <input class="form-control form-control-lg" type="Email" name="Email" placeholder="Enter your email" value="<?php echo $email; ?>">
								<span class="help-block"><?php echo $email_err; ?></span>
						</div>
						<div class="mb-3 <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?> ">
							<label class=" form-label" style="color: black;"><strong>No Handphone</strong></label>
							<input class="form-control form-control-lg" type="phone" name="phone" placeholder="Enter your Phone Number" value="<?php echo $phone; ?>">
								<span class="help-block"><?php echo $phone_err; ?></span>
						</div>
						<div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> ">
							<label class=" form-label" style="color: black;"><strong>Username</strong></label>
							<input class="form-control form-control-lg" type="username" name="username" placeholder="Enter your username" value="<?php echo $username; ?>">
								<span class="help-block"><?php echo $username_err; ?></span>
						</div>
					</div>
				</div>
				<!-- left code ends here -->

				<!-- start code on the right side of the page -->
				<div class="col-lg-6">
					<div class=" form-group">
                        <div class="mb-3 <?php echo (!empty($jenis_kelamin_err)) ? 'has-error' : ''; ?>">
                            <label class=" form-label" style="color: black;"><strong>Jenis Kelamin</strong></label>
								<div class="mb-3" >
									<div class="form-control-lg form-control">
										<label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jenis_kelamin == 'laki-laki') ? "checked": "" ?>>
                                                <span class="form-check-label">Laki-Laki</span>
										</label>
										<label class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="jenis_kelamin"  value="perempuan" <?php echo ($jenis_kelamin == 'perempuan') ? "checked": "" ?>>
												<span class="form-check-label">Perempuan</span>
										</label>
									</div>
								</div>
                        </div>
						<div class="mb-3 <?php echo (!empty($jabatan_err)) ? 'has-error' : ''; ?>">
                            <label class=" form-label" style="color: black;"><strong>Jabatan</strong></label>
                            <select name="jabatan" class="form-select mb-3" value="<?php echo $jabatan; ?>">
								<option <?php echo ($jabatan == 'Manager Team') ? "selected": "" ?>>Manager Team</option>
								<option <?php echo ($jabatan == 'Developer') ? "selected": "" ?>>Developer</option>
								<option <?php echo ($jabatan == 'Admin') ? "selected": "" ?>>Admin</option>
								<option <?php echo ($jabatan == 'Admin Manager') ? "selected": "" ?>>Admin Manager</option>
							</select>
							<span class="help-block"><?php echo $jabatan_err; ?></span>
                        </div>
                        <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label class=" form-label" style="color: black;"><strong>Password</strong></label>
                            <input class="form-control form-control-lg" type="Password" name="Password" placeholder="Enter your password" value="<?php echo $password; ?>">
							<span class="help-block"><?php echo $password_err; ?></span>
                        </div>
						<div class="mb-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label class=" form-label" style="color: black;"><strong>Confirm Password</strong></label>
                            <input class="form-control form-control-lg" type="password" name="confirm_password" placeholder="Enter your password again" value="<?php echo $confirm_password; ?>">
							<span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
					</div>
				</div>
				<!-- right code ends here -->
            </div>
            <input type="hidden" name="uuid_admin" value="<?php echo $uuid_admin; ?>"/>
            <input type="submit" class="btn btn-primary mt-3" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
            <a href="pages-admin.php" class="btn btn-danger mt-3">Cancel</a>
        </div>
    </div>
</body>
</html>