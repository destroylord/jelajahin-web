<?php
    include_once '../conection.php';


    if (isset($_POST['updated'])) {

        $root = $_SERVER['DOCUMENT_ROOT'];
       

        $uuid = guidv4();

        $image_url      = $_FILES['image_url']['name'];
        $img_tmp        = $_FILES['image_url']['tmp_name'];

        $name 			= $_POST['name'];
        $description 	= $_POST['description'];
        $ticket_price 	= $_POST['ticket_price'];
        $province 		= $_POST['province'];
        $city    		= $_POST['city'];	
        $latitude 		= $_POST['latitude'];
        $longtitude 	= $_POST['longtitude'];
        $address 		= $_POST['address'];

    $dirUpload = "uploads/";

    $terupload = move_uploaded_file($img_tmp, $dirUpload.$image_url);

        if ($new_img != '') {
            $update_filename = $new_img;

            move_uploaded_file($tmp_img, $root."/public/uploads/".$update_filename);
            unlink($root."/public/uploads/".$old_img);
            
            echo "<script>alert('images updated')</script>";

        } else {
            $update_filename = $old_img;
            echo "<script>alert('images updated old images')</script>";
        }
            
        // Execute
        $sql = "UPDATE furnitures SET name = '$name' , images = '$update_filename',  price = '$price' , descriptions = '$desc', id_category_furniture = '$category', updated_at = '$time' WHERE id = '$id'";

        $ex = mysqli_query($conn, $sql);
        if ($sql) {
            echo "success updated";
        } else {
            echo "failed updated";
        }
        
        
    }

?>