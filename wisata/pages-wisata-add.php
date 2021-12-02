<?php
// Include conection file
require_once "../conection.php";

session_start();
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
	<link rel="shortcut icon" href="../img/icons/logo.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Wisata Add</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

</head>

<body>

	<div class="wrapper" >
	<?php
	include "../sidebar.php";
	?>

		<div class="main mx-auto" style="background-color: #E5E5E5;">
			<?php
				include "../navigation.php";
				
			?>

			<main class="content">
				<div class="container-fluid p-0" >
					<h1 class="mb-3"><strong>Add Data Wisata</strong></h1>

					<form class="container scrollspy-example" action="proses.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="h3">General</div>
						</div>
					</div>
					<hr>
					<!-- form general -->
						<div class="row">	
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Foto</label>
									<input type="file" accept="image/*" name="image_url" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Deskripsi Wisata</label>
									<textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label for="">Nama</label>
									<input type="text" name="name" id="" class="form-control">
								</div>
								<div class="form-group">
									<label for="">Harga Tiket</label>
									<input type="number" name="ticket_price" id="" class="form-control">
								</div>
							</div>
						</div>
					<div class="row mt-4">
						<div class="col-md-12">
							<div class="h3">Location</div>
						</div>
					</div>
					<hr>

					<!-- Form Location -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Provinsi</label>
								<select name="province" id="" class="form-control">
									<option value="Jawa Timur">Jawa Timur</option>
									<option value="Jawa Barat">Jawa Barat</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Kota</label>
								<select name="city" id="" class="form-control">
									<option value="bondowooso">bondowooso</option>
									<option value="malang">malang</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">latitude</label>
								<input type="number" name="latitude" id="" class="form-control">
							</div>
							<div class="form-group">
								<label for="">longtitude</label>
								<input type="number" name="longtitude" id="" class="form-control">
							</div>
						</div>
					</div>

					<div class="container">

					<b>Coordinates</b>
					<form>
						<p>latitude<input type="text" name="lat" id="lat" size=12 value=""></p>
						<p>longtitude<input type="text" name="lon" id="lon" size=12 value=""></p>
					</form>

					<!-- Alamat -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Alamat Lengkap</label>
								<textarea name="address" id="" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>
					</div>
						<input type="submit" class="btn btn-primary mt-3" value="Submit" name="submit" style="background-color: #9ED763; border-color:#9ED763;">
					</form>
				</div>
				
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

	<script>
	</script>
</body>

</html>