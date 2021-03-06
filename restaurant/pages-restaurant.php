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

	<title>Restaurant Page</title>

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
					<h1 class="mb-3"><strong>Restaurant In Bondowoso</strong></h1>
					<a href="pages-restaurant-add.php" class="btn btn-success mb-1" style="">Add Restaurant</a>
					<div class="row">
						<div class="col-12">
							<div class="card" data-bs-spy="scroll">
								<div class="card-body">
								<?php
									// Include config file
									require_once "../conection.php";

									// Attempt select query execution
									$sql = "SELECT * FROM restaurant";
									if($result = mysqli_query($link, $sql)){
										if(mysqli_num_rows($result) > 0){
										echo "<table class='table table-hover my-0'>";
											echo "<thead>";
												echo "<tr style='color: #388E3C;'>";
												echo"<th>Photo</th>";
												echo"<th class='d-none d-xl-table-cell'>Name</th>";
												echo"<th class='d-none d-xl-table-cell'>Address</th>";
												echo"<th>Price Range</th>";
												echo"<th>Menu</th>";
												echo"<th class='d-none d-md-table-cell'>Action</th>";
												echo "</tr>";
											echo "</thead>";
											echo"<tbody>";
											?>
											<?php
												while ($row = mysqli_fetch_array($result)){ ?>
												<tr>
													<td>
														<?php echo "<img src='../img/photos/$row[image]' width='100' height='100' />";?>
													</td>
													<td><?php echo $row['name'] ?></td>
													<td><?php echo $row['address'] ?></td>
													<?php
													echo "<td>" . $row['price_min'] .- $row['price_max'] . "</td>";
													?>
													<td>
														<?php
														echo "<a href='pages-menu-restaurant.php?uuid_restaurant=". $row['uuid_restaurant'] ."' title='Food Menu' data-toggle='tooltip'><span class='align-middle mx-2' data-feather='book' style='color: black;'></span></a>"; ?>
													</td>
													<td>
														<?php
														echo "<a href='update-restaurant.php?uuid_restaurant=". $row['uuid_restaurant'] ."' title='Update Record' data-toggle='tooltip'><span class='align-middle mx-2 ' data-feather='edit-3' style='color: black;'></span></a>";
														echo "<a href='delete-restaurant.php?uuid_restaurant=". $row['uuid_restaurant'] ."' title='Delete Record' data-toggle='tooltip'><span class='align-middle mx-auto' data-feather='trash' style='color: black;'></span></a>";
														?>
													</td>
												</tr>
												<?php
                                                }
                                            ?>
											</tbody>
										</table>
										<?php
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