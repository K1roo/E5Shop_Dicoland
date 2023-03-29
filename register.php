<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = password_hash(mysqli_real_escape_string($conn, $_POST['cpassword']), PASSWORD_DEFAULT);
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'L_adresse email existe déjà!';
   }else{
      if($pass != $cpass){
         $message[] = 'Le mot de passe ne correspond pas';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = ' successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>S'inscrire </title>

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
      <h3>S'inscrire maintenant</h3>
      <input type="text" name="name" placeholder="nom" required class="box">
      <input type="email" name="email" placeholder="email" required class="box">
      <input type="password" name="password" placeholder="password" required class="box">
      <input type="password" name="cpassword" placeholder="password" required class="box">
      <select name="user_type" class="box">
         <option value="user">user</option>
      </select>
      <input type="submit" name="submit" value="S'inscrire maintenant" class="btn">
      <p>
Vous avez déjà un compte? <a href="login.php">login</a></p>
   </form>

</div>

</body>
</html>

   <!-- a faire : create page de creation de compte pour l'admin  -> dashboard -> vue admin -> create -> BDD -> login  -->
