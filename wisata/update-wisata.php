<?php
// Include conection file
require_once "../conection.php";

// Define variables and initialize with empty values
$uuid_wisata = $name = $description = $ticket_price = $image_url = $provinsi = $kabupaten = $kecamatan = $kelurahan = $address = $latitude = $longitude = "";
$uuid_wisata_err = $name_err = $description_err = $ticket_price_err = $image_url_err = $provinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = $address_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if(isset($_POST["uuid_wisata"]) && !empty($_POST["uuid_wisata"])){
    // Get hidden input value
    $uuid_wisata = $_POST["uuid_wisata"];

    // Validate name
    $input_name = $_POST["name"];
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }

    // Validate description
    $input_description = $_POST["description"];
    if(empty($input_description)){
        $description_err = "Please enter an description.";
    } else{
        $description = $input_description;
    }

    // Validate ticket_price
    $input_ticket_price = $_POST["ticket_price"];
    if(empty($input_ticket_price)){
        $ticket_price_err = "Please enter the price range food amount.";
    } else{
        $ticket_price = $input_ticket_price;
    }

	// Validate image 
	$input_image_url = $_POST["image_url"];
    if(empty($input_image_url)){
        $image_url_err = "Please input the image_url.";
    } else{
        $image_url = $input_image_url;
    }

	//validate provinsi
	$input_provinsi = $_POST["propinsi"];
	if(empty($input_provinsi)){
		$provinsi_err = "please select the province";
	} else {
		$provinsi = $input_provinsi;
	}

	//validate kabupaten
	$input_kabupaten = $_POST["kabupaten"];
	if(empty($input_kabupaten)){
		$kabupaten_err = "please select the district";
	} else {
		$kabupaten = $input_kabupaten;
	}

	//validate kecamatan
	$input_kecamatan = $_POST["kecamatan"];
	if(empty($input_kecamatan)){
		$kecamatan_err = "please select the sub district";
	} else {
		$kecamatan = $input_kecamatan;
	}

	//validate kelurahan
	$input_kelurahan = $_POST["kelurahan"];
	if(empty($input_kelurahan)){
		$kelurahan_err = "please select the rayon";
	} else {
		$kelurahan = $input_kelurahan;
	}

	//validate address
	$input_address = trim($_POST["address"]);
	if(empty($input_address)){
		$address_err = "please select the address";
	} else {
		$address = $input_address;
	}

	//validate latitude
	$input_latitude = $_POST["lat"];
	if(empty($input_latitude)){
		$latitude_err = "please select the latitude";
	} else {
		$latitude = $input_latitude;
	}

	//validate longitude
	$input_longitude = $_POST["lng"];
	if(empty($input_longitude)){
		$longitude_err = "please select the longitude";
	} else {
		$longitude = $input_longitude;
	}

    // Check input errors before inserting in database
    if(empty($uuid_wisata_err) && empty($name_err) && empty($description_err) && empty($ticket_price_err) && empty($image_url_err) && empty($provinsi_err) 
	&& empty($kabupaten_err) && empty($kecamatan_err) && empty($kelurahan_err) && empty($address_err) && empty($latitude_err) && empty($longitude_err)){
        // Prepare an insert statement
        $sql = "UPDATE wisata SET name=?, description=?, ticket_price=?, image_url=?, provinsi_id=?, kabupaten_id=?, kecamatan_id=?, kelurahan_id=?, address=?, latitude=?, longitude=? WHERE uuid_wisata=?"; 

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_uuid_wisata, $param_name, $param_description, $param_ticket_price, $param_image_url, $param_provinsi, 
			$param_kabupaten, $param_kecamatan, $param_kelurahan, $param_address, $param_latitude, $param_longitude);

            // Set parameters
			$param_uuid_wisata		    = $uuid_wisata;
            $param_name					= $name;
            $param_description			= $description;
            $param_ticket_price			= $ticket_price;
			$param_image_url			= $image_url;
			$param_provinsi				= $provinsi;
			$param_kabupaten			= $kabupaten;
			$param_kecamatan			= $kecamatan;
			$param_kelurahan			= $kelurahan;
			$param_address				= $address;
			$param_latitude				= $latitude;
			$param_longitude			= $longitude;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: pages-wisata.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}else{

    // Check existence of id parameter before processing further
    if(isset($_GET["uuid_wisata"]) && !empty(trim($_GET["uuid_wisata"]))){
        // Get URL parameter
        $uuid_wisata =  trim($_GET["uuid_wisata"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM wisata WHERE uuid_wisata = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_uuid_wisata);
            
            // Set parameters
            $param_uuid_wisata = $uuid_wisata;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $description = $row["description"];
                    $ticket_price = $row["ticket_price"];
                    $image_url = $row["image_url"];
                    $provinsi = $row["provinsi_id"];
                    $kabupaten = $row["kabupaten_id"];
                    $kecamatan = $row["kecamatan_id"];
                    $kelurahan = $row["kelurahan_id"];
                    $address = $row["address"];
                    $latitude = $row["latitude"];
                    $longitude = $row["longitude"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
	<link rel="shortcut icon" href="../img/icons/logo.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>menu page Restaurant</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127341144-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-127341144-1');
	</script>

	<link rel="canonical" href="https://www.latlong.net/convert-address-to-lat-long.html" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
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

					<form class="container scrollspy-example" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="row">	
							<!-- start code on the left side of the page -->
							<div class="col-lg-6">
								<div class="form-group">
									<div class="mb-3 <?php echo (!empty($name_err)) ? 'has-error' : ''; ?> ">
                                        <label class=" form-label" style="color: black;"><strong>Wisata Name</strong></label>
										<input type="text" class="form-control form-control-lg" name="name" id="name" 
										placeholder="Enter your Wisata name" value="<?php echo $name; ?>">
											<span class="help-block"><?php echo $name_err; ?></span>        
									</div>
									<div class="mb-3 <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
										<label class="form-label" style="color: black;"><strong>Wisata Description</strong></label>
										<textarea class="form-control span12" rows="6" name="description" type="text"
										placeholder="Enter your Wisata description" value="<?php echo $description; ?>" ></textarea>
											<span class="help-block"><?php echo $description_err; ?></span>
									</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
									<div class="mb-3 <?php echo (!empty($ticket_price_err)) ? 'has-error' : ''; ?>">
										<label class=" form-label"style="color: black;"><strong>Range Price</strong></label>
										<div class="mb-3 row">
											<label class="col-sm-1 col-form-label" style="color: black;">Rp</label>
											<div class="col-sm-11">
												<input class="form-control" type="text" name="ticket_price" placeholder="Enter your range price" value="<?php echo $ticket_price; ?>">
												<span class="help-block"><?php echo $ticket_price_err; ?></span>
											</div>
										</div>
									</div>
									<div class="mb-3 <?php echo (!empty($image_url_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" style="color: black;"><strong>Wisata Image</strong></label>
										<input type="file" class="input-group form-control" name="image_url" value="<?php echo $image_url; ?>">
										<span class="help-block"><?php echo $image_url_err; ?></span>
									</div>
								</div>
							</div>
							<!-- left code ends here -->

							<!-- start code on the right side of the page -->
							<div class="col-12">
								<div class="row mb-3 mt-3">
									<div class="col-lg-10 ">
										<h5 class="title "><strong>Restaurant Address</strong></h5>
									</div>
								</div>

								<div class="row">
								<div class="container">
									<div class="row">
										<div class="col-sm-6 mb-3 <?php echo (!empty($provinsi_err)) ? 'has-error' : ''; ?>">
											<div class="form-group">
												<label for="form_sex">Provinsi</label>
												<select class="form-control m-b" name="propinsi" id="propinsi" value="<?php echo $provinsi; ?>">
													<option selected value="">-- Pilih Provinsi --</option>
												</select>
												<span class="help-block"><?php echo $provinsi_err; ?></span>
											</div>
										</div>
										<div class="col-sm-6 mb-3 <?php echo (!empty($kabupaten_err)) ? 'has-error' : ''; ?>">
											<div class="form-group">
												<label for="form_post">Kab / Kota </label>
												<select class="form-control m-b" name="kabupaten" id="kabupaten" value="<?php echo $kabupaten; ?>">
													<option selected value="">-- Pilih Kabupaten --</option>
												</select>
												<span class="help-block"><?php echo $kabupaten_err; ?></span>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 mb-3 <?php echo (!empty($kecamatan_err)) ? 'has-error' : ''; ?>">
											<div class="form-group">
												<label for="form_sex">Kecamatan </label>
												<select class="form-control m-b" name="kecamatan" id="kecamatan" value="<?php echo $kecamatan; ?>">
													<option selected value="">-- Pilih Kecamatan --</option>
												</select>
												<span class="help-block"><?php echo $kecamatan_err; ?></span>
											</div>
										</div>
										<div class="col-sm-6 <?php echo (!empty($kelurahan_err)) ? 'has-error' : ''; ?>">
											<div class="form-group">
												<label for="form_post">Kelurahan / Desa </label>
												<select class="form-control m-b" name="kelurahan" id="kelurahan" value="<?php echo $kelurahan; ?>">
													<option selected value="">-- Pilih Kelurahan --</option>
												</select>
												<span class="help-block"><?php echo $kelurahan_err; ?></span>
											</div>
										</div>
									</div>
								</div>
								</div>

								<div class="row">
									<div class="form-group col-lg-9">
									<div class="mb-3 <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
										<label class="form-label">Full Address</label>
										<textarea class="form-control span12" rows="5" name="address" id="address"
										placeholder="Enter your restaurant address" value="<?php echo $address; ?>" ></textarea>
										<span class="help-block"><?php echo $address_err; ?></span>
									</div>
								</div>
								<div class="form-group col-lg-3">
									<div class="mb-3 <?php echo (!empty($latitude_err)) ? 'has-error' : ''; ?>">
										<label class="form-label" for="lat">Latitude</label>
										<input class="form-control form-control-lg" type="text" name="lat" id="lat" placeholder="lat coordinate"value="<?php echo $latitude; ?>" />
										<span class="help-block"><?php echo $latitude_err; ?></span>
									</div>
									<div class="mb-3 <?php echo (!empty($longitude_err)) ? 'has-error' : ''; ?>">
										<label class="form-label" for="lng">Longitude</label>
										<input class="form-control form-control-lg" type="text" name="lng" id="lng" placeholder="long coordinate"value="<?php echo $longitude; ?>" />
										<span class="help-block"><?php echo $longitude_err; ?></span>
									</div>
									
								</div>
								
								<div id="latlongmap" style="width:100%;height:400px;" class="shadow"></div>
								</div>
								<!-- left code ends here -->

								<input type="submit" class="btn btn-primary mt-3" value="Submit" name="submit" style="background-color: #9ED763; border-color:#9ED763;">
								<a href="pages-restaurant.php" class="btn btn-danger mt-3">Cancel</a>
							</div>
						</div>
					</form>
				</div>
				
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- select province, etc -->
	<script type = "text/javascript" >
		var return_first = function() {
			var tmp = null;
			$.ajax({
				'async': false,
				'type': "get",
				'global': false,
				'dataType': 'json',
				'url': 'https://x.rajaapi.com/poe',
				'success': function(data) {
					tmp = data.token;
				}
			});
			return tmp;
		}();
	$(document).ready(function() {
		$.ajax({
			url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/provinsi',
			type: 'GET',
			dataType: 'json',
			success: function(json) {
				if (json.code == 200) {
					for (i = 0; i < Object.keys(json.data).length; i++) {
						$('#propinsi').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
					}
				} else {
					$('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
				}
			}
		});
		$("#propinsi").change(function() {
			var propinsi = $("#propinsi").val();
			$.ajax({
				url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kabupaten',
				data: "idpropinsi=" + propinsi,
				type: 'GET',
				cache: false,
				dataType: 'json',
				success: function(json) {
					$("#kabupaten").html('');
					if (json.code == 200) {
						for (i = 0; i < Object.keys(json.data).length; i++) {
							$('#kabupaten').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
						}
						$('#kecamatan').html($('<option>').text('-- Pilih Kecamatan --').attr('value', '-- Pilih Kecamatan --'));
						$('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));

					} else {
						$('#kabupaten').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
					}
				}
			});
		});
		$("#kabupaten").change(function() {
			var kabupaten = $("#kabupaten").val();
			$.ajax({
				url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kecamatan',
				data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
				type: 'GET',
				cache: false,
				dataType: 'json',
				success: function(json) {
					$("#kecamatan").html('');
					if (json.code == 200) {
						for (i = 0; i < Object.keys(json.data).length; i++) {
							$('#kecamatan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
						}
						$('#kelurahan').html($('<option>').text('-- Pilih Kelurahan --').attr('value', '-- Pilih Kelurahan --'));
						
					} else {
						$('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
					}
				}
			});
		});
		$("#kecamatan").change(function() {
			var kecamatan = $("#kecamatan").val();
			$.ajax({
				url: 'https://x.rajaapi.com/MeP7c5ne' + window.return_first + '/m/wilayah/kelurahan',
				data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
				type: 'GET',
				dataType: 'json',
				cache: false,
				success: function(json) {
					$("#kelurahan").html('');
					if (json.code == 200) {
						for (i = 0; i < Object.keys(json.data).length; i++) {
							$('#kelurahan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].id));
						}
					} else {
						$('#kelurahan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
					}
				}
			});
		});
	});
	</script>

	<!-- maps -->
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" crossorigin=""></script>
	<script type="text/javascript">
		var mymap = L.map('latlongmap');
		var mmr = L.marker([0,0]);
		mmr.bindPopup('0,0');
		mmr.addTo(mymap);
		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {foo: 'bar',
		attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(mymap);
		sm(-7.913402,113.822800,16);
		mymap.on('click', onMapClick);

		if (frmplace.attachEvent) {
			frmplace.attachEvent("submit", getp);
		} else {
			frmplace.addEventListener("submit", getp);
		}

		function onMapClick(e) {
			mmr.setLatLng(e.latlng);
			setui(e.latlng.lat,e.latlng.lng,mymap.getZoom());
		}


		function sm(lt,ln,zm) {
			setui(lt,ln,zm);
			mmr.setLatLng(L.latLng(lt,ln));
			mymap.setView([lt,ln], zm);
		}

		function setui(lt,ln,zm) {
			lt = Number(lt).toFixed(6);
			ln = Number(ln).toFixed(6);
			document.getElementById("lat").value=lt;
			document.getElementById("lng").value=ln;
		}
	</script>

</body>

</html>