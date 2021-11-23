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

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
	<?php
	include "sidebar.php";
	?>

		<div class="main" style="background-color: #E5E5E5;">
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
									<h3>Makanan</h3>
									<div class="d-flex justify-content-between">
										<p>
											Tempat makanan, minum dan berpesta yang tidak boleh ditawarkan
										</p>
										<a href="javascript:void(0)">Lihat Lainnya</a>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
											<div class="col-md-4">
												<div class="card">
													<img src="img/photos/makanan1.png" class="card-img-top" alt="makanan">
													<div class="card-body">
														<h5 class="card-title">Card title</h5>
														<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
														<a href="#" class="btn btn-primary">Go somewhere</a>
													</div>
												</div>
											</div>
										<div class="col-md-4">
											<div class="card">
												<img src="img/photos/makanan2.png" class="card-img-top" alt="makanan">
												<div class="card-body">
													<h5 class="card-title">Card title</h5>
													<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
													<a href="#" class="btn btn-primary">Go somewhere</a>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="card">
												<img src="img/photos/makanan1.png" class="card-img-top" alt="makanan">
												<div class="card-body">
													<h5 class="card-title">Card title</h5>
													<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
													<a href="#" class="btn btn-primary">Go somewhere</a>
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