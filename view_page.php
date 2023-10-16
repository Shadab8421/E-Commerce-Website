<?php

@include 'connect.php';

session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_POST['add_to_wishlist'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image_01'];
    
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_wishlist_numbers) > 0){
        $message[] = 'already added to wishlist';
    }elseif(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `tbl_wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
        $message[] = 'product added to wishlist';
    }

}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image_01'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `tbl_cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `tbl_wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `tbl_wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `tbl_cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quick view</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="quick-view">

        <h1 class="title">product details</h1>

        <?php  
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_products = mysqli_query($conn, "SELECT * FROM `tbl_products` WHERE id = '$pid'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
        <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image_01" value="<?php echo $fetch_products['image_01']; ?>">
            <input type="hidden" name="product_offer" value="<?php echo $fetch_products['product_offer']; ?>">
            <div class="row">
                <div class="image-container">
                    <div class="main-image">
                        <img src="uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                    </div>
                    <div class="sub-image">
                        <img src="uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                        <!-- <img src="uploaded_img/ <?= $fetch_products['image_02']; ?>" alt="">
                        <img src="uploaded_img/ <?= $fetch_products['image_03']; ?>" alt=""> -->

                    </div>
                </div>

            </div>
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
            <div class="price"><?php echo $fetch_products['product_offer']; ?>% Off*</div>
            <div class="details"><?php echo $fetch_products['product_details']; ?></div>
            <select class="size">
                <option value="<?php echo $fetch_products['p_size']; ?>"><?php echo $fetch_products['p_size']; ?>
                </option>

            </select>
            <input type="number" name="product_quantity" value="1" min="0" class="qty">





            <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>
        <?php
            }
        }else{
        echo '<p class="empty">no products details available!</p>';
        }
    }
    ?>

        <div class="more-btn">
            <a href="home.php" class="option-btn">go to home page</a>
        </div>

    </section>






    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
<!-- <input type="hidden" name="product_image_01" value="<?php echo $fetch_products['image_01']; ?>"> -->
<!-- <input type=" hidden" name="product_image_02" value="<?php echo $fetch_products['image_02']; ?>"> -->
<!-- <input type=" hidden" name="product_image_03" value="<?php echo $fetch_products['image_03']; ?>"> -->

</html>