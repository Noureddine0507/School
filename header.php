<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>

    <body>
        <div class="section-one mb-5">
            <nav class="navBar">
                <div class="brand-title">
                    <a href="index.html" class="brand-title">Brand Name</a>
                </div>
                <a href="#" class="toggle-button">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
                <div class="nav-links">
                    <ul>
                        <li><a href="">ADD</a></li>
                        <li><a href=""><?php echo $_SESSION['name']; ?></a></li>
                        <li><a href="phpFiles/logIn.php"><i class="fa-solid fa-user"></i></a></li>
                        <li><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <script src="js/main.js"></script>