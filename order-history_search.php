<?php
include 'components/connect.php';

session_start(); // Start the session if not already started

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];

   if(isset($_POST['search_query'])) {
      $searchQuery = $_POST['search_query'];

      // Prepare the SQL statement with a LIKE condition to match the search query and filter by user_id
      $search_O = $conn->prepare("SELECT * FROM `orders` WHERE user_id = :user_id AND payment_status = 'Completed' AND order_tracking = 'Completed' AND (id LIKE :searchQuery OR total_products LIKE :searchQuery)");
      $search_O->execute(array('user_id' => $user_id, 'searchQuery' => "%$searchQuery%"));

      if($search_O->rowCount() > 0) {
         while($fetchO = $search_O->fetch(PDO::FETCH_ASSOC)) {
            // Display the search results
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
         <td><span> <?= $fetchO['placed_on']; ?></span></td>
      </tr>
      <tr>
         <td><p>name </p></td>
         <td><span> <?= $fetchO['name'];?></span></td>
      </tr>
      <tr>
         <td><p>email </p></td>
         <td><span> <?= $fetchO['email']; ?></span></td>
      </tr>
      <tr>
         <td><p>number </p></td>
         <td><span> <?= $fetchO['number']; ?></span></td>
      </tr>
      <tr>
         <td><p>payment method </p></td>
         <td><span> <?= $fetchO['method']; ?></span></td>
      </tr>
      <tr style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">your orders</p></td>
      </tr>
      <tr style="text-align: center; padding: 1rem; align-content: justify;">
         <td colspan="2"style="padding: 1rem;"><span><?= $fetchO['total_products']; ?></span></td>
      </tr>
      <tr style="text-align: center; background-color: #B7E3FF;">
         <td colspan="2"><p style="text-align: center; width: 100%;">total price:<span class="prices pricing">P<?= $fetchO['total_price'];?></span></p></td>
      </tr>
      <tr>
         <td><p>payment status </p></td>
         <td><span style="color:<?php if($fetchO['payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"> <?= $fetchO['payment_status']; ?></span></td>
      </tr>
      <tr>
         <td><p>reference number </p></td>
         <td><span> <?= $fetchO['ref_num']; ?></span></td>
      </tr>
      <tr>
         <td><p>request </p></td>
         <td><span> <?= $fetchO['request']; ?></span></td>
      </tr>
      <tr>
         <td><p>order status </p></td>
         <td><span> <?= $fetchO['order_tracking']; ?></span></td>
      </tr>
      <tr>
         <td><p>courier type </p></td>
         <td><span> <?= $fetchO['courier_type']; ?></span></td>
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
   }
   ?>

   </div>

</section>
