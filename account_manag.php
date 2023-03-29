<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}

// update user info
if(isset($_POST['update'])){
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $update_user = mysqli_query($conn, "UPDATE `users` SET `name`='$name', `email`='$email', `password`='$hashedPassword' WHERE `id`='$user_id'") or die('query failed');
   if($update_user){
      echo '<script>alert("User info updated successfully!");</script>';
   } else {
      echo '<script>alert("Error: failed to update user info.");</script>';
   }
}

// get user info
$select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$user_id'") or die('query failed');
$fetch_user = mysqli_fetch_assoc($select_user);
$name = $fetch_user['name'];
$email = $fetch_user['email'];
$password = $fetch_user['password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>
   <!-- cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/account_manag.css">
   
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="orders">
   <div class="form-box">
      <h1 class="title">User Profile</h1>
      <form  class="form-box" method="post"> 
         <label>Name:</label>
         <input type="text" name="name" value="<?php echo $name; ?>" required>
         <label>Email:</label>
         <input type="email" name="email" value="<?php echo $email; ?>" required>
         <label>Password:</label>
         <input type="password" name="password" value="<?php echo $password; ?>" required>
         <button type="submit" name="update" class="btn">Update Info</button>
      </form>
   </div>
</section>

<script src="js/script.js"></script>

</body>
</html>
