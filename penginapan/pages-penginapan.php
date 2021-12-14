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
<<<<<<< HEAD
	<link rel="shortcut icon" href="../img/icons/icon-48X48.png" />
=======
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />
>>>>>>> 49fd68e9338d59fb6da8c9c62773e0c47385e02a

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Hotel Page</title>

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
				<div class="container-fluid p-0" >
					<h1 class="mb-3"><strong>Penginapan In Bondowoso</strong></h1>
					<a href="pages-penginapan-add.php" class="btn btn-success mb-1" style="">Add penginapan</a>
					<div class="row">
						<div class="col-12">
							<div class="card" data-bs-spy="scroll">
								<div class="card-body">
								<?php
									// Include config file
									require_once "../conection.php";

									// Attempt select query execution
									$sql = "SELECT * FROM penginapan";
									if($result = mysqli_query($link, $sql)){
										if(mysqli_num_rows($result) > 0){
										echo "<table class='table table-hover my-0'>";
											echo "<thead>";
												echo "<tr style='color: #388E3C;'>";
												echo"<th>Photo</th>";
												echo"<th class='d-none d-xl-table-cell'>Name</th>";
												echo"<th class='d-none d-xl-table-cell'>Address</th>";
												echo"<th>Price Range</th>";
												echo"<th>Facility</th>";
												echo"<th class='d-none d-md-table-cell'>Action</th>";
												echo "</tr>";
											echo "</thead>";
											echo"<tbody>";
												while ($row = mysqli_fetch_array($result)){
												echo "<tr>";
													echo "<td>" . $row['image'] . "</td>";
													echo "<td>" . $row['nama'] . "</td>";
													echo "<td>" . $row['alamat'] . "</td>";
													echo "<td>" . $row['price_range'] . "</td>";
													echo "<td>";
														echo "<a href='pages-facility-penginapan.php? id=". $row['uuid_penginapan'] ."' title='Food Menu' data-toggle='tooltip'><span class='align-middle mx-2' data-feather='book' style='color: black;'></span></a>";
													echo "</td>";
													echo "<td>";
														echo "<a href='update-penginapan.php? id=". $row['uuid_penginapan'] ."' title='Update Record' data-toggle='tooltip'><span class='align-middle mx-1 ' data-feather='edit-3' style='color: black;'></span></a>";
														echo "<a href='delete-penginapan.php? id=". $row['uuid_penginapan'] ."' title='Delete Record' data-toggle='tooltip'><span class='align-middle mx-auto' data-feather='trash' style='color: black;'></span></a>";
													echo "</td>";
												echo "</tr>";
												}
											echo"</tbody>";
										echo"</table>";
										// Free result set
										mysqli_free_result($result);
									} else{
										echo "<p class='lead'><em>No records were found.</em></p>";
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