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

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>List Kategori</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>
	<div class="wrapper">
	<?php
	include_once "../sidebar.php";
	?>

		<div class="main" style="background-color: #E5E5E5;">
			<?php
				include_once "../navigation.php";
			?>

			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3"><strong>List Kategori</strong></h1>

					<div class="row">
						<div class="col-xl-12">
							<div class="card">
                                <div class="card-body">
                                    <table class="table table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th rospawn="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                            <?php

                                                require_once "../conection.php";

                                                $sql = mysqli_query($link, "SELECT * FROM kategori");

                                                while ($data = mysqli_fetch_array($sql)) { ?>   
                                                    
                                                    <tr>
                                                        <td><?php echo $data['id'] ?></td>
                                                        <td><?php echo $data['nama'] ?></td>
                                                        <td>
															<a href="delete.php?id=<?php echo $data['id']; ?>">Hapus</a>
                                                        </td>
                                                    </tr>

                                            <?php
                                                }

                                            ?>
                                            </tbody>
                                    </table>
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