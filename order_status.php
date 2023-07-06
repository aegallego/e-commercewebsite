<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<?php include 'components/user_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Purchases | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/order_status-style.css">
</head>
<body>
   
<section class="order-status">
<div class="container">
      <h3 class="purchase">My Purchases</h3>
      <a class="history" href="orders.php">View Purchase History</a>
      <!-- <a href="home.php"> <i class="fas fa-angle-right"></i>View Purchase History</a> -->
</div>

<div class="box-container">
<div class = "status">
<div class ="icons">
      <button class="pay" id="toggleButton1">
         <i class="fa-solid fa-wallet"></i>
         <span class ="names">To Pay</span>
      </button>
      <button class="ship" id="toggleButton2">
         <i class="fa-solid fa-truck-fast"></i>
         <span class ="names">To Ship</span>
      </button>
      <button class="receive" id="toggleButton3">
         <i class="fa-solid fa-boxes-stacked"></i>
         <span class ="names">To Receive</span>
      </button>
      <!-- <button class="rate" id="">
         <i class="fa-solid fa-star"></i>
         <span class ="names">To Rate</span>
      </button> -->
</div> 
</div>
</div>
<div class="receipts" id="myDiv1">
<?php
   if($user_id == ''){
      echo '<p class="empty">please login to see your orders</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND (payment_status = 'pending' OR payment_status = 'Pending')");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
   <div class="overflow">
   <div class="actualreceipts">
   <center id="top">
      <div class="logo"></div>
    </center>

   <table style="width: 100%;
  border-collapse: collapse;">
      <tr>
         <td><p>order id </p></td>
         <td><span> <?= $fetch_orders['id']; ?></span></td>
      </tr>
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
      <tr width: 100%; style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">your orders</p></td>
      </tr>
      <tr width: 100%; style="text-align: center; padding: 1rem; align-content: justify;">
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


<div class="receipts" id="myDiv2">
<?php
   if($user_id == ''){
      echo '<p class="empty">please login to see your orders</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'Completed' AND (order_tracking = 'Packed' OR order_tracking = 'To Ship')");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
   <div class ="overflow">
   <div class="actualreceipts">
   <center id="top">
      <div class="logo"></div>
    </center>
   <table style="width: 100%;
  border-collapse: collapse;">
      <tr>
         <td><p>order id </p></td>
         <td><span> <?= $fetch_orders['id']; ?></span></td>
      </tr>
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
      <tr width: 100%; style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">your orders</p></td>
      </tr>
      <tr width: 100%; style="text-align: center; padding: 1rem; align-content: justify;">
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


<div class="receipts" id="myDiv3">
<?php
   if($user_id == ''){
      echo '<p class="empty">please login to see your orders</p>';
   }else{
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? AND payment_status = 'Completed' AND (order_tracking = 'To Receive' OR order_tracking = 'Picked-up')");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?>
   <div class="overflow">
   <div class="actualreceipts">
   <center id="top">
      <div class="logo"></div>
    </center>
   <table style="width: 100%;
  border-collapse: collapse;">
      <tr>
         <td><p>order id </p></td>
         <td><span> <?= $fetch_orders['id']; ?></span></td>
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
      <tr width: 100%; style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">your orders</p></td>
      </tr>
      <tr width: 100%; style="text-align: center; padding: 1rem; align-content: justify;">
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

</div>
</section>
<script src="js/script.js"></script>
<?php include 'components/footer.php'; ?>

</body>
</html>
