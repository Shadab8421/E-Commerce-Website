<?php

include 'connect.php';

session_start();
error_reporting(0);
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $size = mysqli_real_escape_string($conn, $_POST['p_size']);

   $product_offer = mysqli_real_escape_string($conn, $_POST['product_offer']);
   $image_01 = $_FILES['image_01']['name'];
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folter_01 = 'uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folter_02 = 'uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folter_03 = 'uploaded_img/'.$image_03; 

   $select_product_name = mysqli_query($conn, "SELECT name FROM `tbl_products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `tbl_products`(name, product_details, p_size, price, product_offer, image_01,image_02,image_03) VALUES('$name', '$details','$size ', '$price','$product_offer', '$image_01','$image_02','$image_03')") or die('query failed');

      if($insert_product){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folter_01);
            move_uploaded_file($image_tmp_name_02, $image_folter_02);
            move_uploaded_file($image_tmp_name_03, $image_folter_03); 
            $message[] = 'product added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image_01 FROM `tbl_products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image_01']);
   mysqli_query($conn, "DELETE FROM `tbl_products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `tbl_wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `tbl_cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<script src="js/choices.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- select size css link  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">



</head>

<body>

    <?php @include 'admin_header.php'; ?>

    <section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>add new product</h3>
            <input type="text" class="box" required placeholder="enter product name" name="name">
            <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
            <input type="number" min="0" class="box" required placeholder="enter product offer" name="product_offer">
            <textarea name="details" class="box" required placeholder="enter product details" cols="30"
                rows="10"></textarea>
            <input type="text" class="box" required placeholder="enter product size" name="p_size">
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image_01">
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image_02">
            <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image_03">
            <input type="submit" value="add product" name="add_product" class="btn">
        </form>

    </section>

    <section class="show-products">

        <div class="box-container">

            <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `tbl_products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
            <div class="box">
                <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
                <div class="offer">Offer <?php echo $fetch_products['product_offer']; ?>% Off*</div>
                <img class="image" src="uploaded_img/<?php echo $fetch_products['image_01']; ?>" alt="">

                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="details"><?php echo $fetch_products['product_details']; ?></div>
                <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>"
                    class="option-btn">update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                    onclick="return confirm('delete this product?');">delete</a>
            </div>
            <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </div>


    </section>












    <script src="js/admin_script.js"></script>




</body>

</html>