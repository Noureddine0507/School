<?php
session_start();
require 'connect.php';

$error = '';

if (isset($_POST['add'])) {
    if (empty($_POST['name']) || empty($_POST['last_name']) || empty($_POST['cni']) || empty($_POST['filiere'])) {
        $error = '<small>All fields are required</small>';
    } else {
        $name = $_POST['name'];
        $lname = $_POST['last_name'];
        $cni = $_POST['cni'];
        $selectedFiliere = $_POST['filiere']; 

        try {
            $sql = 'INSERT INTO stagiaire(stagiaire_name, stagiaire_fname, cni, id_filiere) VALUES(:name, :lname, :cni, :id_filiere)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':cni', $cni);
            $stmt->bindParam(':id_filiere', $selectedFiliere); // Bind the selected filiere
            $status = $stmt->execute();
            if ($status) {
                echo 'Data added';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

try {
    $sql = 'SELECT * FROM filiere';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <!-- Include Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Include Bootstrap JS (jQuery is required) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>

    <body style="background-color: #e8e8e8;">
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
                            <img class="dropbtn" src="images/admin.jpg" alt="
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

        <section class="section_form">
            <form id="consultation-form" class="feed-form" action="" method="post">
                <label for="">ADD</label>
                <h3><?php echo $error; ?></h3>
                <input required="" placeholder="Name" type="text" name="name">
                <input name="last_name" required="" placeholder="Last Name" type="text">
                <input name="cni" required="" placeholder="CNI" type="text">
                <select name="filiere" id="Filieres" class="form-select mb-1 filiere"
                    aria-label="Default select example">
                    <option value="">Select Filiere</option>
                    <?php foreach ($filieres as $filiere): ?>
                    <option value="<?php echo $filiere['id_filiere'] ?>"><?php echo $filiere['filiere_name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button class="button_submit" type="submit" name="add">ADD</button>
            </form>
        </section>
        <script src="js/main.js"></script>
    </body>

</html>