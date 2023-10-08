<?php
session_start();
require 'connect.php';

$message = '';

if (isset($_POST['logIn'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = '<label>All fields are required</label>';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Use a prepared statement with placeholders to prevent SQL injection
        try {
            $sql = 'SELECT * FROM admin WHERE email = :email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results && $password === $results['password']) {
                $_SESSION['name'] = $results['admin_name'];
                $_SESSION['photo'] = $results['photo'];
                header('Location: list.php');
                exit(); // Terminate script execution after the redirect
            } else {
                $message = '<label>Email or password incorrect</label>';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        if (isset($_POST['remamber'])) { // Corrected checkbox name
            setcookie('remember_email', $email, time() + 30 * 24 * 60 * 60, '/');
            setcookie('remember_pass', $password, time() + 30 * 24 * 60 * 60, '/');
        }

    }
}
// Check if the cookies exist and if the user is not already logged in
if (isset($_COOKIE['remember_email']) && isset($_COOKIE['remember_pass']) && !isset($_SESSION['remember_email'])) {
    $rememberedEmail = $_COOKIE['remember_email'];
    $rememberedPassword = $_COOKIE['remember_pass'];
} else {
    $rememberedEmail = '';
    $rememberedPassword = '';
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Document</title>
    </head>

    <body style="background-color: #e8e8e8;">
        <div class="center-div">
            <form class="form" method="post">
                <span class="signup">Log In</span>
                <?php echo $message ?>
                <input type="email" placeholder="Email address" class="form--input" name="email"
                    value="<?php echo $rememberedEmail; ?>">
                <input type="password" placeholder="Password" class="form--input" name="password"
                    value="<?php echo $rememberedPassword ;?>">
                <div class="form--marketing">
                    <input id="okayToEmail" type="checkbox" name="remamber"> <!-- Corrected name attribute -->
                    <label for="okayToEmail" class="checkbox">
                        Remamber Me
                    </label>
                </div>
                <button class="form--submit" type="submit" name="logIn">
                    Sign up
                </button>
            </form>
        </div>
    </body>

</html>