<?php
 
 @include 'connect.php';

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Allotment Letter</title>
    <style>
    .background-image {
        display: flex;
        margin-left: 20%;
        margin-right: 20%;
        height: 50%;
        width: 50%;
        border: 10px solid #555;
    }

    body {
        font: 15px/1.5 'PT Sans', serif;
        margin: 25px;
    }

    a {
        padding-top: 50%;
        padding-right: 50%;
    }

    .tag {
        background: #eee;
        border-radius: 3px 0 0 3px;
        color: black;
        display: inline-block;
        height: 26px;
        line-height: 26px;
        padding: 0 20px 0 23px;
        position: relative;
        /* margin: 0 10px 10px 0; */
        text-decoration: none;
        -webkit-transition: color 0.2s;


    }

    .tag::before {
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        content: '';
        height: 6px;
        left: 10px;
        position: relative;
        width: 6px;
        top: 10px;
    }


    .tag::after {
        background: #fff;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #eee;
        border-top: 13px solid transparent;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
    }

    .tag:hover {
        background-color: crimson;
        color: white;
    }

    .tag:hover::after {
        border-left-color: crimson;
    }

    .example {
        position: relative;
    }

    .overlay-text {
        background-color: rgba(255, 255, 255, 0.5);
        padding: 20px;
        text-align: center;
        position: absolute;
        top: 80%;
        right: 40%;
        transform: translate(50%, -50%);
    }
    </style>
</head>

<body>

    <div>


        <div class="example">
            <img class="background-image" src="images/Allotment.jpg?tr=w-1200,h-300">
            <div class="overlay-text">
                <a href="login.php" class="tag">Click here to visit our Website</a>
            </div>
        </div>




    </div>

</body>

</html>