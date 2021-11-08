<?php
// Include conection file
require_once "../conection.php";
 
// Define variables and initialize with empty values
$uuid_admin = $name = $email = $username = $phone = $jenis_kelamin = $jabatan = $password = $confirm_password = "";
$uuid_admin_err = $name_err = $email_err = $username_err = $phone_err = $jenis_kelamin_err = $jabatan_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["uuid_admin"]) && !empty($_POST["uuid_admin"])){
    // Get hidden input value
    $uuid_admin = $_POST["uuid_admin"];
    
    /// Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
    // Prepare a select statement
    $sql = "SELECT uuid_admin FROM admin WHERE name = ?";
            
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
                
            // Set parameters
            $param_name = trim($_POST["name"]);
                
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                    
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $name_err = "This name is already taken.";
                } else{
                    $name = trim($_POST["name"]);
                }
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
    // Prepare a select statement
    $sql = "SELECT uuid_admin FROM admin WHERE email = ?";
            
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
                
            // Set parameters
            $param_email = trim($_POST["email"]);
                
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                    
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone.";
    } else{
    // Prepare a select statement
    $sql = "SELECT uuid_admin FROM admin WHERE phone = ?";
            
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
                
            // Set parameters
            $param_phone = trim($_POST["phone"]);
                
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                    
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $phone_err = "This phone is already taken.";
                } else{
                    $phone = trim($_POST["phone"]);
                }
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uuid_admin FROM admin WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate gender
    if(empty(isset($_POST["gender"]))){
        $gender_err = "Please enter your jenis kelamin.";
    } else{
        $gender = trim($_POST["gender"]);
    }

    // Validate jabatan
    if(empty(trim($_POST["jabatan"]))){ 
        $jabatan_err = "This jabatan is already taken.";
    } else{
        $jabatan = trim($_POST["jabatan"]);
    }
            

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
    // Prepare a select statement
    $sql = "SELECT uuid_admin FROM admin WHERE password = ?";
            
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_password);
                
            // Set parameters
            $param_password = trim($_POST["password"]);
                
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                    
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $password_err = "Please enter your password.";     
                } elseif(strlen(trim($_POST["password"])) < 6){
                    $password_err = "Password must have atleast 6 characters.";
                } else{
                    $password = trim($_POST["password"]);
                }
            
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate confirm_password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($username_err) && empty($phone_err) && empty($jenis_kelamin_err) && 
    empty($jabatan_err) && empty($password_err) && empty($confirm_password_err) && empty($uuid_admin_err)){
        // Prepare an update statement
        $sql = "UPDATE admin SET name=?, email=?, username=?, phone=?, jenis_kelamin=?, jabatan=?, password=? WHERE uuid_admin=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_email, $param_username, $param_phone, $param_jenis_kelamin, $param_jabatan, $param_password, $param_uuid_admin);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_username = $username;
            $param_phone = $phone;
            $param_jenis_kelamin = $jenis_kelamin;
            $param_jabatan = $jabatan;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
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
    if(isset($_GET["id_admin"]) && !empty(trim($_GET["id_admin"]))){
        // Get URL parameter
        $id_admin =  trim($_GET["id_admin"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM admin WHERE id_admin = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id_admin);
            
            // Set parameters
            $param_id_admin = $id_admin;
            
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
            <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>"/>
            <input type="submit" class="btn btn-primary mt-3" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
            <a href="pages-admin.php" class="btn btn-danger mt-3">Cancel</a>
        </div>
    </div>
</body>
</html>