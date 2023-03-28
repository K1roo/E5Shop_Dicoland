<?php

include 'config.php';
session_start();
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if(password_verify($password, $row['password'])){

         if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');

         }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email']; $_SESSION['password_changed'] = true;
            $_SESSION['user_id'] = $row['id'];
            if (isset($_SESSION['password_changed']) && $_SESSION['password_changed'] == true) {
               // Si le mot de passe a été changé récemment, on affiche le formulaire de changement de mot de passe
               header('location:update_password.php');
            } else {
               header('location:home.php');
            }
         }

      }else{
         $message[] = 'Mot de passe incorrect';
      }

   }else{
      $message[] = 'Email ou mot de passe incorrect';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>se connecter</title>

   <!-- cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>se connecter</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login" class="btn">
      <p> <a href="register.php">Crée un compte</a></p>
      <p> <a href="forgot_password.php">Mot de passe oublié</a></p>
   </form>

</div>

</body>
</html>
