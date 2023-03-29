<?php
include_once('config.php');
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 1){
        $newPassword = bin2hex(random_bytes(6)); // generate new random password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
        // After successfully updating the user's password
        $_SESSION['password_changed'] = true;

        mysqli_query($conn,$query);
        echo "Your new password is: " . $newPassword; // display the new password

    } else {
        echo "Invalid email address.";
    }
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mot de passe oublié</title>


<link rel="stylesheet" href="css/mdp.css">

</head>
<body>
<div class="form-container">
    <form method="post" action="">
        <label>Réinitialisation de votre mot de passe </label>
        <input type="email" name="email" placeholder="Entrez votre email" required class="box">
        <input type="submit" name="submit" value="Changer mon mot de passe" class="btn">
        <a href="login.php" class="btn">Se connecter</a> 
        <p> <a href="register.php">Crée un compte</a></p>
    </form>
</div>
</div>

</body>
</html>