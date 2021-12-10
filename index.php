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
	<link rel="shortcut icon" href="img/icons/logo.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>JelajahIn</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	
</head>

<body>
	<div class="wrapper">
	<?php
	include "sidebar.php";
	?>

		<div class="main mx-auto" style="background-color: #E5E5E5;">
			<?php
				include_once "navigation.php";
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<!-- <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1> -->

					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header">
									<h2><strong>Dashboard</strong></h2>
									<div class="d-flex justify-content-between">
										<p>
											Menuju Page Admin
										</p>
										<a href="http://localhost/jelajahin-web/admin/pages-admin.php">Klik Disini</a>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
											<div class="col-md-4">
												<div class="card">
													<a href="http://localhost/jelajahin-web/wisata/pages-wisata.php">
													<img src="img/photos/kawah ijen.jpg" class="card-img-top" alt="wisata ijen"> </a>
													<div class="card-body">
														<h5 class="card-title">Page Wisata</h5>
														<p class="card-text">Lokawisata, tempat wisata atau objek wisata adalah sebuah tempat rekreasi/tempat berwisata. Objek wisata dapat berupa objek wisata alam seperti gunung, danau, sungai, pantai, laut, atau berupa objek wisata bangunan seperti museum, benteng, situs peninggalan sejarah, dll.</p>
														<a href="http://localhost/jelajahin-web/wisata/pages-wisata.php" class="btn btn-primary" style="background-color: #9ED763; border-color:#9ED763;">Klik Disini Menuju Page Wisata</a>
													</div>
												</div>
											</div>
										<div class="col-md-4">
											<div class="card">
												<a href="http://localhost/jelajahin-web/restaurant/pages-restaurant.php">
												<img src="img/photos/makanan2.png" class="card-img-top" alt="makanan"> </a>
												<div class="card-body">
													<h5 class="card-title">Page Restaurant</h5>
													<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
													<a href="http://localhost/jelajahin-web/restaurant/pages-restaurant.php" class="btn btn-primary" style="background-color: #9ED763; border-color:#9ED763;">Klik Disini Menuju Page Restaurant</a>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="card">
												<a href="http://localhost/jelajahin-web/penginapan/pages-penginapan.php">
												<img src="img/photos/hotel.jpg" class="card-img-top" alt="hotel"> </a>
												<div class="card-body">
													<h5 class="card-title">Page Penginapan</h5>
													<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
													<a href="http://localhost/jelajahin-web/penginapan/pages-penginapan.php" class="btn btn-primary" style="background-color: #9ED763; border-color:#9ED763;">Klik Disini Menuju Page Penginapan</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>