<!DOCTYPE html>
<html>
<head>
	<title>slider in Javascript</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  
  <section class="home">
     <div class="slider">
        <div class="slide active" style="background-image: url('images/s1.jpg')">
            <div class="container">
                <div class="caption">
                    <h1>1. Winter Collection 2023</h1>
                    <p>Upto 20% off on Winter Collection.</p>
                    <a href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/banner2.jpg')">
            <div class="container">
                <div class="caption">
                    <h1>2. Winter Collection 2023</h1>
                    <p>Upto 20% off on Winter Collection.</p>
                    <a href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
         <div class="slide" style="background-image: url('images/s3.jpg')">
            <div class="container">
                <div class="caption">
                    <h1>3. Winter Collection 2023</h1>
                    <p>Upto 20% off on Winter Collection.</p>
                    <a href="shop.php">Shop Now</a>
                </div>
            </div>
        </div>
     </div>
   
    <!-- controls  -->
    <div class="controls">
        <div class="prev"><</div>
        <div class="next">></div>
    </div>

    <!-- indicators -->
    <div class="indicator">
    </div>

  </section>

 
 <script src="js/slide-script.js"></script>

</body>
</html>



