<?php
require 'connect.php';
session_start();
try{
    $sql = 'SELECT * FROM admin';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo 'error'. $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Latest compiled and minified CSS -->
        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Include Bootstrap JS (jQuery is required) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="css/style.css">

        <title>Document</title>
    </head>

    <body>
        <div class="section-one mb-5">
            <nav class="navBar">
                <div class="brand-title">
                    <a href="list.php" class="brand-title">ISTA</a>
                </div>
                <a href="#" class="toggle-button">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </a>
                <div class="nav-links">
                    <ul>
                        <li><a href="List.php">List</a></li>
                        <li><a href="add.php">ADD</a></li>
                        <li class="dropdown">
                            <img class="dropbtn" src="images/<?php echo $admin['photo'] ?>" alt="
                                photo">
                            <div class="dropdown-content">
                                <a href="profile.php">Profile</a>
                                <a href="#">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <?php echo $admin['admin_name'] ?>
        <img src="images/<?php echo $admin['photo'] ?>" alt="">
        <script src="js/main.js"></script>
    </body>

</html>