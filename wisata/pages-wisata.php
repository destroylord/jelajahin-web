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

	<title>Wisata</title>

	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
					<h1 class="mb-3"><strong>Data Wisata</strong></h1>
                    <a href="pages-wisata-add.php" class="btn btn-success mb-1" style="">Add Wisata</a>
					<div class="row">
						<div class="col-xl-12">
							<div class="card">
                                <div class="card-body">
                                    <table class="table table-hover my-0">
                                        <thead class="thead-light">
                                            <tr style="color: #388E3C">
                                            <th scope="col">Photo</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Harga Ticket</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php

                                            require_once "../conection.php";

                                            $sql = mysqli_query($link, "SELECT * FROM wisata");

                                            while ($data = mysqli_fetch_array($sql)) { ?>   
                                                
                                                <tr>
                                                    <td>
                                                        <img src="uploads/<?php echo $data['image_url'] ?>" alt="" width="100" height="100">
                                                    </td>
                                                    <td><?php echo $data['name'] ?></td>
                                                    <td><?php echo $data['address'] ?></td>
                                                    <td><?php echo $data['ticket_price'] ?></td>
                                                    <td>
                                                    <a href='update-wisata.php? uuid_wisata=". $row['uuid_wisata'] ."' title='Update Record' data-toggle='tooltip'><span class='align-middle mx-1 ' data-feather='edit-3' style='color: black;'></span></a>
                                                    <a href='delete-wisata.php? uuid_wisata=". $row['uuid_wisata'] ."' title='Delete Record' data-toggle='tooltip'><span class='align-middle mx-auto' data-feather='trash' style='color: black;'></span></a>
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