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
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>Add Fasilitas Penginapan</title>

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
					<h1 class="mb-3"><strong>Tambah Fasilitas Penginapan</strong></h1>

					<form class="container scrollspy-example" action="proses.php" method="post" enctype="multipart/form-data">

					<!-- Nama Kategori -->
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<h3><label for="">Nama Fasilitas Penginapan</label></h3>
								<textarea name="nama" id="" cols="30" rows="1" class="form-control"></textarea>
							</div>
						</div>
					</div>
						<input type="submit" class="btn btn-primary mt-3" value="Simpan" name="simpan" style="background-color: #0ECB0A; border-color:#0ECB0A;">
					</form>
				</div>
				
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>

</body>

</html>