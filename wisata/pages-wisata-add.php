<?php
include "proses-add-wisata.php";
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
	<link rel="shortcut icon" href="../img/icons/icon-48X48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>page add wisata</title>
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

					<form class="container scrollspy-example" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
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
										<textarea class="form-control span12" rows="5" name="description" type="text"
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
								<a href="pages-wisata.php" class="btn btn-danger mt-3">Cancel</a>
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