<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Purchase History | Gemstar</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'Completed' AND order_tracking = 'Completed'");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class ="overflow">
   <div class="box">
   <center id="top">
      <div class="logo"></div>
    </center>
   <table class="table1" style="width: 100%;
  border-collapse: collapse;">
      <tr>
         <td><p>placed on </p></td>
         <td><span> <?= $fetch_orders['placed_on']; ?></span></td>
      </tr>
      <tr>
         <td><p>name </p></td>
         <td><span> <?= $fetch_orders['name'];?></span></td>
      </tr>
      <tr>
         <td><p>email </p></td>
         <td><span> <?= $fetch_orders['email']; ?></span></td>
      </tr>
      <tr>
         <td><p>number </p></td>
         <td><span> <?= $fetch_orders['number']; ?></span></td>
      </tr>
      <tr>
         <td><p>payment method </p></td>
         <td><span> <?= $fetch_orders['method']; ?></span></td>
      </tr>
      <tr style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">your orders</p></td>
      </tr>
      <tr style="text-align: center; padding: 1rem; align-content: justify;">
         <td colspan="2"style="padding: 1rem;"><span><?= $fetch_orders['total_products']; ?></span></td>
      </tr>
      <tr style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">total price:<span class="prices pricing">P<?= $fetch_orders['total_price'];?></span></p></td>
      </tr>
      <tr>
         <td><p>payment status </p></td>
         <td><span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"> <?= $fetch_orders['payment_status']; ?></span></td>
      </tr>
      <tr>
         <td><p>reference number </p></td>
         <td><span> <?= $fetch_orders['ref_num']; ?></span></td>
      </tr>
      <tr>
         <td><p>request </p></td>
         <td><span> <?= $fetch_orders['request']; ?></span></td>
      </tr>
      <tr>
         <td><p>order status </p></td>
         <td><span> <?= $fetch_orders['order_tracking']; ?></span></td>
      </tr>
      <tr>
         <td><p>courier type </p></td>
         <td><span> <?= $fetch_orders['courier_type']; ?></span></td>
      </tr>
   </table>
   </div>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>