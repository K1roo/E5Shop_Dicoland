<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:user_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

   <!-- cdn et CSS link ** il faut avoir les 2 css files pour l'affichage correct des fnc dans cette page -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">
   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="orders">

   <h1 class="title">Les commandes en cours</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` where user_id = $user_id AND payment_status ='PENDING'") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> User id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Commande passée le : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> Commande id : <span><?php echo $fetch_orders['id']; ?></span> </p>
         <p> Nom : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Numero : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Adresse de livraison  : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Produits commandé : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Prix total : <span><?php echo $fetch_orders['total_price']; ?>€</span> </p>
         <p> Mode de paiement : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <a href="user_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Voulez vous supprimer la commande ?');" class="delete-btn">Supprimer</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">pas de commande en cours :/</p>';
      }
      ?>
   </div>

</section>


<script src="js/script.js"></script>

</body>
</html>