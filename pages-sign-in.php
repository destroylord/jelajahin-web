<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to pages-restaurant page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 
// Include conection file
require_once "conection.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT uuid_admin, username, password FROM admin WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $uuid_admin, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["uuid_admin"] = $uuid_admin;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to pages-restaurant page
                            header("location: restaurant/pages-restaurant.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | JelajahIn</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100" style="background-color: #9ED763;">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="card" style="border-radius: 20px;">
							<div class="text-center" style="background-color: white; margin-top: 30px; margin-bottom: 30px;">
								<img src="img/avatars/JelajahIn.jpg" alt="JelajahIn" class="" width="170" height="39" />
							</div>

							<div class="card-body"style="background-color:rgba(158, 215, 99, 0.19);">
								<div class="m-sm-4">
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
										<div class="mb-3 row <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
											<label class="col-sm-3 col-form-label">Username</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
												<span class="help-block"><?php echo $username_err; ?></span>
											</div>
										</div>
										<div class="mb-3 row <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
											<label class="col-sm-3 col-form-label">Password</label>
											<div class="col-sm-9">
												<input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
												<span class="help-block"><?php echo $password_err; ?></span>
											</div>
										</div>
										<div >
										</div>
										<div class="text-center mt-3">
											<input type="submit" class="btn btn-lg btn btn-primary" 
											style="background-color: #9ED763; border: none; padding-left: 35px; padding-right: 35px;" value="Masuk">
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>