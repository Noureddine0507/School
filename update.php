<?php
require 'connect.php';
session_start();

$id_stagiaire = $_GET['id_stagiaire'];
$name = '';
$fname = '';
$cni = '';
$id_filiere = ''; 

try {
    $sql = 'SELECT * FROM stagiaire WHERE id_stagiaire = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_stagiaire);
    $stmt->execute();
    $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stagiaire) {
        $name = $stagiaire['stagiaire_name'];
        $fname = $stagiaire['stagiaire_fname'];
        $cni = $stagiaire['cni'];
        $id_filiere = $stagiaire['id_filiere']; 
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

try {
    $sql = 'SELECT * FROM filiere';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $filieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Update
if (isset($_POST['update'])) {
    $stagiaire_name = $_POST['name'];
    $stagiaire_fname = $_POST['last_name']; // Change to 'last_name'
    $stagiaire_cni = $_POST['cni'];
    $selected_filiere = $_POST['filiere']; // Get selected filiere

    try {
        $sql = 'UPDATE stagiaire SET stagiaire_name = :name, stagiaire_fname = :fname, cni = :cni, id_filiere = :id_filiere WHERE id_stagiaire = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $stagiaire_name);
        $stmt->bindParam(':fname', $stagiaire_fname); // Correct parameter name
        $stmt->bindParam(':cni', $stagiaire_cni);
        $stmt->bindParam(':id_filiere', $selected_filiere); 
        $stmt->bindParam(':id', $id_stagiaire);
        
        if ($stmt->execute()) {
            echo 'Update done';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
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
                            <img class="dropbtn" src="images/admin.jpg" alt=" photo">
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
                <input required="" placeholder="Name" type="text" name="name" value="<?php echo $name; ?>">
                <input name="last_name" required="" placeholder="Last Name" type="text" value="<?php echo $fname; ?>">
                <input name="cni" required="" placeholder="CNI" type="text" value="<?php echo $cni; ?>">
                <select name="filiere" id="Filieres" class="form-select mb-1 filiere"
                    aria-label="Default select example">
                    <option value="">Select Filiere</option>
                    <?php foreach ($filieres as $filiere): ?>
                    <option value="<?php echo $filiere['id_filiere'] ?>"
                        <?php echo ($id_filiere == $filiere['id_filiere']) ? 'selected' : ''; ?>>
                        <?php echo $filiere['filiere_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="button_submit" type="submit" name="update">Update</button>
            </form>
        </section>
        <script src="js/main.js"></script>
    </body>

</html>