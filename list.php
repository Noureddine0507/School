<?php
require 'connect.php';
session_start();
try {
    $sql = 'SELECT * FROM filiere';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$stagiaires = []; // Initialize an empty array to hold stagiaires
if(isset($_POST['filter'])){
    // if (isset($_POST['filiere'])) {
    $filiere_id = $_POST['filiere'];
    try {
        $sql = 'SELECT *,filiere.filiere_name FROM `stagiaire` JOIN filiere ON stagiaire.id_filiere = filiere.id_filiere
        WHERE filiere.id_filiere = :filiere_id';
        $st = $pdo->prepare($sql);
        $st->bindParam(':filiere_id', $filiere_id, PDO::PARAM_INT); // Bind as an integer
        $st->execute();
        $stagiaires = $st->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
// }


// delete : 
if (isset($_GET['delete'])) {
    $id = $_GET['id_stagiaire'];
    try {
        $sql = "DELETE FROM stagiaire WHERE id_stagiaire = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            header('location : list.php');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



//require 'header.php';
?>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        <script src="js/main.js"></script>
        <form method="POST" class="list-form">
            <!-- Added form element to submit the selection -->
            <select name="filiere" id="" class="form-select mb-1 filiere w-25" aria-label="Default select example">
                <option value="">Select Filiere</option>
                <?php foreach ($filieres as $filiere): ?>
                <option value=" <?php echo $filiere['id_filiere'] ?>"><?php echo $filiere['filiere_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="filter" id="filier" class="btn btn-primary mx-2">Filter</button>
            <!-- Added a submit button to trigger the form submission -->
        </form>
        <div class="table-responsive-md">
            <table class="table  table-hover text-center md" id="table">
                <tr>
                    <td>CNI</td>
                    <td>name</td>
                    <td>Last name</td>
                    <td>Filiere</td>
                    <td>Action</td>
                </tr>
                <?php foreach ($stagiaires as $stagiaire): ?>
                <tr>
                    <td><?php echo $stagiaire['cni'] ?></td>
                    <td><?php echo $stagiaire['stagiaire_name'] ?></td>
                    <td><?php echo $stagiaire['stagiaire_fname'] ?></td>
                    <td><?php echo $stagiaire['filiere_name'] ?></td>
                    <td>
                        <a href="list.php?delete&id_stagiaire=<?php echo $stagiaire['id_stagiaire'] ?>"
                            class=" btn-tabel mx-1">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <a href="update.php?update&id_stagiaire=<?php echo $stagiaire['id_stagiaire'] ?>"
                            class=" btn-tabel">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

        </div>

        <?php require 'footer.php'; ?>