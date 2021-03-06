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

	<title>Food Menu</title>

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
        <div class="container-fluid p-0">
            <h1 class="mb-3" style="font-weight: bold;">Food Menu In The Restaurant</h1>
					
<?php
// --- koneksi ke database
require_once "../conection.php";
function uuid($data  =  null) {
    $data  =  $data  ??  random_bytes ( 16 );
    //menegaskan ( strlen ( $data )  ==  16 );

    // Setel versi ke 0100
    $data [ 6 ]  =  chr ( ord ( $data [ 6 ])  &  0x0f  |  0x40 );
    // Atur bit 6-7 hingga 10
    $data [ 8 ]  =  chr ( ord ( $data [ 8 ])  &  0x3f  |  0x80 );

    // Keluarkan 36 karakter UUID.
    return  vsprintf ( '%s%s-%s-%s-%s-%s%s%s' ,  str_split ( bin2hex ( $data ),  4 ));}
    
// --- Fngsi tambah data (Create)
function tambah($link){
    
    if (isset($_POST['aksi'])){
        $uuid_menu = uuid();
        $category = $_POST['category'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price  = $_POST['price'];
        $image_url = $_POST['image_url'];
        
        if(!empty($category) && !empty($name) && !empty($description) && !empty($price) && !empty($image_url)){
            $sql = "INSERT INTO menu (uuid_menu, category, name, description, price, image_url) VALUES(".$uuid_menu.",'".$category."','".$name."','".$description."','".$price."','".$image_url."')";
            $simpan = mysqli_query($link, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: pages-menu-restaurant.php');
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?> 
        <form class="container" action="" method="post">
            <div class="row">	
                <!-- start code on the left side of the page -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Category</strong></label>
                            <select name="category" class="form-select">
                                <option >Makanan</option>
                                <option >Minuman</option>
                                <option >Paket Hemat</option>
                                <option >Dessert</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Name</strong></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter food name">      
                        </div>
                        <div class="mb-3 ">
                            <label class=" form-label" style="color: black;"><strong>price</strong></label>
                            <input class="form-control form-control-lg" type="number" name="price" placeholder="Enter food price">
                        </div>
                    </div>
                </div>
                <!-- left code ends here -->

                <!-- start code on the right side of the page -->
                <div class="col-lg-6">
                    <div class=" form-group">
                        <div class="mb-3">
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Description</strong></label>
                                <textarea class="form-control span12" rows="5" name="description" 
                                placeholder="Enter your Food description" ></textarea>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Image</strong></label>
                                <input type="file" class="input-group form-control" name="image_url" >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right code ends here -->
            </div>
            <input type="submit" class="btn btn-primary mt-2" name="aksi" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
            <input type="reset" class="btn btn-danger mt-2" name="reset" value="Clear">
        </form>
    <?php
}
// --- Tutup Fngsi tambah data


// --- Fungsi Baca Data (Read)
function tampil_data($link){
    echo "<div class='row mt-5'>";
        echo "<div class='col-12'>";
            echo "<div class='card'>";
                echo "<div class='card-body'>";
                    $sql = "SELECT * FROM menu";
                    $query = mysqli_query($link, $sql);
                    
                    echo "<table class='table table-hover my-0'>";
                        echo "<thead>";
                            echo "<tr style='color: #388E3C;'>";
                                echo "<th>photo</th>";
                                echo "<th>Nama</th>";
                                echo "<th class='d-none d-xl-table-cell'>description</th>";
                                echo "<th class='d-none d-xl-table-cell'>price</th>";
                                echo "<th>category</th>";
                                echo "<th class='d-none d-md-table-cell'>Action</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo"<tbody>";
                            while($data = mysqli_fetch_array($query)){
                            ?>
                                <tr>
                                    <td><?php echo $data['image_url']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['description']; ?> Kg</td>
                                    <td><?php echo $data['price']; ?> bulan</td>
                                    <td><?php echo $data['category']; ?></td>
                                    <td>
                                        <a href="pages-menu-restaurant.php?aksi=update&uuid_menu=<?php echo $data['uuid_menu']; ?>&name=<?php echo $data['name']; ?>&description=<?php echo $data['description']; ?>&price=<?php echo $data['price']; ?>&category=<?php echo $data['category']; ?>&image_url=<?php echo $data['image_url']; ?>">Ubah</a> |
                                        <a href="pages-menu-restaurant.php?aksi=delete&uuid_menu=<?php echo $data['uuid_menu']; ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
            echo "</div>";
        echo "</div>";    
    echo "</div>";        
}
// --- Tutup Fungsi Baca Data (Read)


// --- Fungsi Ubah Data (Update)
function ubah($link){
    // ubah data
    if(isset($_POST['btn_ubah'])){
        $uuid_menu = $_POST['uuid_menu'];
        $category = $_POST['category'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price  = $_POST['price'];
        $image_url = $_POST['image_url'];
        
        if(!empty($category) && !empty($name) && !empty($description) && !empty($price) && !empty($image_url)){
            $perubahan = "name='".$name."',description=".$description.", category=".$category.", price=".$price.",image_url='".$image_url."'";
            $sql_update = "UPDATE menu SET ".$perubahan." WHERE uuid_menu=$uuid_menu";
            $update = mysqli_query($link, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    header('location: pages-menu-restaurant.php');
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['uuid_menu'])){
        ?>
            <a href="pages-menu-restaurant.php"> &laquo; Home</a> | 
            <a href="pages-menu-restaurant.php?aksi=create"> (+) Tambah Data</a>
            <hr>
            
            <form class="container" action="" method="post">
            <div class="row">	
                <!-- start code on the left side of the page -->
                <input type="hidden" name="uuid_menu" value="<?php echo $_GET['uuid_menu'] ?>"/>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Category</strong></label>
                            <select name="category" class="form-select" value="<?php echo $_GET['category'] ?>">
                                <option <?php echo ($category == 'Makanan') ? "selected": "" ?>>Makanan</option>
                                <option <?php echo ($category == 'Minuman') ? "selected": "" ?>>Minuman</option>
                                <option <?php echo ($category == 'Paket Hemat') ? "selected": "" ?>>Paket Hemat</option>
                                <option <?php echo ($category == 'Dessert') ? "selected": "" ?>>Dessert</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class=" form-label" style="color: black;"><strong>Food Name</strong></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter food name" value="<?php echo $_GET['name'] ?>">      
                        </div>
                        <div class="mb-3 ">
                            <label class=" form-label" style="color: black;"><strong>price</strong></label>
                            <input class="form-control form-control-lg" type="number" name="price" placeholder="Enter food price" value="<?php echo $_GET['price'] ?>">
                        </div>
                    </div>
                </div>
                <!-- left code ends here -->

                <!-- start code on the right side of the page -->
                <div class="col-lg-6">
                    <div class=" form-group">
                        <div class="mb-3">
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Description</strong></label>
                                <textarea class="form-control span12" rows="5" name="description" 
                                placeholder="Enter your Food description" value="<?php echo $_GET['description'] ?>" ></textarea>
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label" style="color: black;"><strong>Food Image</strong></label>
                                <input type="file" class="input-group form-control" name="image_url" value="<?php echo $_GET['image_url'] ?>"  >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right code ends here -->
            </div>
            <input type="submit" class="btn btn-primary mt-2" name="btn_ubah" value="Submit" style="background-color: #9ED763; border-color:#9ED763;">
            <input type="reset" class="btn btn-danger mt-2" name="reset" value="Clear">
        </form>
        <?php
    }
    
}
// --- Tutup Fungsi Update


// --- Fungsi Delete
function hapus($link){
    if(isset($_GET['uuid_menu']) && isset($_GET['aksi'])){
        $uuid_menu = $_GET['uuid_menu'];
        $sql_hapus = "DELETE FROM menu WHERE uuid_menu=" . $uuid_menu;
        $hapus = mysqli_query($link, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                header('location: pages-menu-restaurant.php');
            }
        }
    }
    
}
// --- Tutup Fungsi Hapus


// ===================================================================
// --- Program Utama
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="pages-menu-restaurant.php"> &laquo; Home</a>';
            tambah($link);
            break;
        case "read":
            tampil_data($link);
            break;
        case "update":
            ubah($link);
            tampil_data($link);
            break;
        case "delete":
            hapus($link);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidak ada!</h3>";
            tambah($link);
            tampil_data($link);
    }
} else {
    tambah($link);
    tampil_data($link);
}
?>
				</div>
			</main>
		</div>
	</div>

	<script src="../js/app.js"></script>

</body>

</html>