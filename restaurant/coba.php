<?php
// Include conection file
require_once "../conection.php";
session_start();

// Define variables and initialize with empty values
$propinsi = $kabupaten =  $kecamatan = $kelurahan = "";
$propinsi_err = $kabupaten_err = $kecamatan_err = $kelurahan_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate propinsi
	$input_propinsi = $_POST["propinsi"];
    if(empty($input_propinsi)){
        $propinsi_err = "Please select your restaurant propinsi.";
    } else{
        $propinsi = $input_propinsi;
    }

    // Validate kabupaten
	$input_kabupaten = $_POST["kabupaten"];
    if(empty($input_kabupaten)){
        $kabupaten_err = "Please select your restaurant kabupaten.";
    } else{
        $kabupaten = $input_kabupaten;
    }

    // Validate kecamatan
	$input_kecamatan = $_POST["kecamatan"];
    if(empty($input_kecamatan)){
        $kecamatan_err = "Please select your restaurant kecamatan.";
    } else{
        $kecamatan = $input_kecamatan;
    }

    // Validate kelurahan
	$input_kelurahan = $_POST["kelurahan"];
    if(empty($input_kelurahan)){
        $kelurahan_err = "Please select your restaurant kelurahan.";
    } else{
        $kelurahan = $input_kelurahan;
    }

    // Check input errors before inserting in database
    if(empty ($propinsi_err) && empty($kabupaten_err) && empty($kabupaten_err) && empty($kelurahan_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO restaurant (propinsi, kabupaten, kabupaten, kelurahan ) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_propinsi, $param_kabupaten, $param_kabupaten, $param_kelurahan);

            // Set parameters
			$param_propinsi		= $propinsi;
			$param_kabupaten	= $kabupaten;
			$param_kabupaten    = $kabupaten;
			$param_kelurahan	= $kelurahan;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: pages-menu-restaurant.php");
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
}
?>
<html dir="ltr" lang="en">
<head>
  <title>Contoh Penggunaan Request API Wilayah menggunakan ajax</title>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127341144-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127341144-1');
</script>

</head>
<body >
 <div class="container">
  <div class="row">

  <div class="col-sm-6 mb-3">
   <div class="form-group">
     <label for="form_sex">Provinsi</label>
        <select class="form-control m-b" name="provinsi" id="propinsi">
         <option selected value="">-- Pilih Provinsi --</option>
       </select>
    </select>
   </div>
  </div>
  <div class="col-sm-6 mb-3">
   <div class="form-group">
     <label for="form_post">Kab / Kota </label>
            <select class="form-control m-b" name="kabupaten" id="kabupaten">
           <option selected value="">-- Pilih Kabupaten --</option>
       </select>
    </div>
  </div>
  </div>
  <div class="row">
  <div class="col-sm-6 mb-3">
   <div class="form-group">
     <label for="form_sex">Kecamatan </label>
        <select class="form-control m-b" name="kecamatan" id="kecamatan">
       <option selected value="">-- Pilih Kecamatan --</option>
     </select>
      </div>
  </div>
  <div class="col-sm-6">
   <div class="form-group">
     <label for="form_post">Kelurahan / Desa </label>
      <select class="form-control m-b" name="kelurahan" id="kelurahan">
       <option selected value="">-- Pilih Kelurahan --</option>
     </select>
     </div>
  </div>
  </div>
</div>
  <!-- external javascripts -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




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

</body>
</html>

