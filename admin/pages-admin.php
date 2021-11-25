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

	<title>Admin page</title>

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

					<h1 class="mb-3" style="font-weight: bold;">Admin In JelajahIn</h1>
					<a href="pages-admin-add.php" class="btn btn-success mb-1" style="">Add Admin</a>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
								<?php
									// Include config file
									require_once "../conection.php";

									// Attempt select query execution
									$sql = "SELECT * FROM admin";
									if($result = mysqli_query($link, $sql)){
										if(mysqli_num_rows($result) > 0){
										echo "<table class='table table-hover my-0'>";
											echo "<thead>";
												echo "<tr style='color: #388E3C;'>";
													echo "<th>Nama</th>";
													echo "<th class='d-none d-xl-table-cell'>Email</th>";
													echo "<th class='d-none d-xl-table-cell'>No Handphone</th>";
													echo "<th>Jabatan</th>";
													echo "<th class='d-none d-md-table-cell'>Action</th>";
												echo "</tr>";
											echo "</thead>";
											echo"<tbody>";
												while ($row = mysqli_fetch_array($result)){
												echo "<tr>";
													echo "<td>" . $row['name'] . "</td>";
													echo "<td>" . $row['email'] . "</td>";
													echo "<td>" . $row['phone'] . "</td>";
													echo "<td>" . $row['jabatan'] . "</td>";
													echo "<td >";
														echo "<a href='update-admin.php?uuid_admin=". $row['uuid_admin'] ."' title='Update Record' data-toggle='tooltip'><span class='align-middle' data-feather='edit-3' style='color: black;'></span></a>";
														echo "<a href='delete-admin.php?uuid_admin=". $row['uuid_admin'] ."' title='Delete Record' data-toggle='tooltip'><span class='align-middle mx-2' data-feather='trash' style='color: black;'></span></a>";
													echo "</td>";
												echo "</tr>";
												}
											echo"</tbody>";
										echo "</table>";
										// Free result set
										mysqli_free_result($result);
									} else{
										echo "<p class='align'><em>No records were found.</em></p>";
										}
									} else{
										echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
										}

									// Close connection
									mysqli_close($link);
								?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>

</body>

</html>