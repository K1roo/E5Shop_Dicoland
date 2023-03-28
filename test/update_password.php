<?php
include_once('config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row['password_changed']) {
    // rediriger l'utilisateur vers la page update_password.php s'il n'a pas encore mis à jour son mot de passe
    header("Location: update_password.php");
    exit;
}
else {
    // rediriger l'utilisateur vers la page home.php s'il a déjà mis à jour son mot de passe
    header("Location: home.php");
    exit;
}

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (password_verify($currentPassword, $row['password'])) {
        if ($newPassword == $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = '$hashedPassword' WHERE id = '$userId'";
            mysqli_query($conn, $query);
            $_SESSION['password_changed'] = true;
            $query = "UPDATE users SET password_changed = true WHERE id = '$userId'";
mysqli_query($conn, $query);
 

            // Vérification de la mise à jour du mot de passe
            $query = "SELECT password_changed FROM users WHERE id = '$userId'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            if ($row['password_changed']) {
                header("Location: home.php");
                exit;
            }
        } else {
            $error = "Le nouveau mot de passe et la confirmation ne correspondent pas.";
        }
    } else {
        $error = "Le mot de passe actuel est incorrect.";
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Modifier le mot de passe</title>
   <link rel="stylesheet" href="mdp.css">
</head>
<body>
   <div class="form-container">
       <form method="post" action="">
           <h2>Modifier le mot de passe</h2>
           <?php if (isset($error)): ?>
           <p class="error"><?php echo $error ?></p>
           <?php endif; ?>
           <div class="input-group">
               <label for="currentPassword">Mot de passe actuel</label>
               <input type="password" name="currentPassword" id="currentPassword" required>
           </div>
           <div class="input-group">
               <label for="newPassword">Nouveau mot de passe</label>
               <input type="password" name="newPassword" id="newPassword" required>
           </div>
           <div class="input-group">
               <label for="confirmPassword">Confirmation du nouveau mot de passe</label>
               <input type="password" name="confirmPassword" id="confirmPassword" required>
           </div>
           <input type="submit" name="submit" value="Enregistrer les modifications" class="btn">
       </form>
   </div>
</body>
</html>
