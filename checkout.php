<script>
function timeMsg() {
   var t=setTimeout("myFunction()",1000);
}
</script>

<script>
   function call_checkout() {
      var t=setTimeout("paymongo_checkout",1000);
   }
</script>

<script>
function myFunction() {
  let text = "Order has been placed! Do you want to proceed on Order Page?";
      if (confirm(text) == true) {
      window.location.href = "order_status.php";
  } else {
    text = "You canceled!";
  }
  document.getElementById("demo").innerHTML = text;
};
</script>

<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};


function request_checkout($item,$price,$remarks){
   $url = 'https://gemsstar.pythonanywhere.com/item_checkout';

    //JSON data(not exact, but will be compiled to JSON) file:
    //add as many data as you need (according to prosperworks doc):
    $data = array(
            'amount' => (int)$price,
            'items' => $item,
            'extra_remarks' => $remarks
               );

    //sending request (according to prosperworks documentation):
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );

    //engine:
   $context  = stream_context_create($options);
   $result = file_get_contents($url, false, $context);
   if ($result === FALSE) { /* Handle error */ }
   //compiling to JSON (as wrote above):
   $resultData = json_decode($result, TRUE);
   echo "<script>window.open('".$resultData."')</script>";
}



if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];
   $request = $_POST['request'];
   $request = filter_var($request, FILTER_SANITIZE_STRING);

   $courier_type = $_POST['courier_type'];
   $courier_type = filter_var($courier_type, FILTER_SANITIZE_STRING);

   $ref_num = $_POST['ref_num'];
   $ref_num = filter_var($ref_num, FILTER_SANITIZE_STRING);

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);
   
   if($check_cart->rowCount() > 0){
   
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, ref_num, request, courier_type) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price, $ref_num, $request, $courier_type]);

      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $cart_product_id = $fetch_cart['pid'];
            $cart_product_quantity = $fetch_cart['quantity'];
   
            $product_stock_query = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $product_stock_query->execute([$cart_product_id]);

            $product = $product_stock_query->fetch(PDO::FETCH_ASSOC);

            $productAvailableQuantity = $product['product_stock'];
            $newProductQuantity = $productAvailableQuantity - $cart_product_quantity;

            $update_stock = $conn->prepare("UPDATE `products` SET product_stock = ? WHERE id = ?") ;
            $update_stock->execute([$newProductQuantity, $cart_product_id]);
         }
      }

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      if($method != 'E-Wallet'){
         echo '<script>timeMsg();</script>';
      }else{
         request_checkout("sample_items",$total_price."00",$request);
      }

      
   }else{
      $message[] = 'your cart is empty';
   }
   
   }


function genrate_ref_number($numDigits) {
  $numbers = range(0, 9);
  shuffle($numbers);
  $randNumber = '';
 
  for ($i = 0; $i < $numDigits; $i++) {
    $randNumber .= $numbers[$i];
  }
 
  return $randNumber;
}

?>

<script>
   function paymongo_checkout(){
      alert('hello');
   }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

  <!-- Progress Bar -->
  <div class="row">
                <div class="container-fluid"> 
                        <div class="progress row">
                            <div class="col-lg-12">
                                <div class="progress-bar "></div>
                                <div class="progressbar">
                                    <div class="progress-bars"></div>
                                        <li class="active progress-text-active"><img src="https://i.ibb.co/Kw0K42B/check.png" width="35" height="35" style="margin-left: 3px; margin-top: -53px; position: absolute;" >Shop</li>
                                            <li class="active progress-text-active">Payment Details</li>
                                            <li class="progress-text">Checkout</li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- end of progress bar -->

<section class="checkout-orders">

   <form id="order-form" action="" method="POST">

   <h3>your orders</h3>

      <div class="display-orders">
      <table class="table2">
      <tr>
         <th>Product Name</th>
         <th>Price</th>
         <th>Quantity</th>


      </tr>

      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
               <tr>
                  <td><?= $fetch_cart['name']; ?></td>
                  <td><?= '₱'.$fetch_cart['price']; ?></td> 
                  <td><?=$fetch_cart['quantity']; ?></td>
            </tr>
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>       

         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
         <tr><td><p class="grand-total" style="background-color: transparent;">Grand Total:<p class="grand-total"><span>₱<?= $grand_total; ?></span></p></td></tr>
         </table>
      </div>

      <h3>Payment Details</h3>
      <?php
      $select_address = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_address->execute([$user_id]);
      if($select_address->rowCount() > 0){
         while($fetch_address = $select_address->fetch(PDO::FETCH_ASSOC)){
      ?>

      <div class="flex">
         <div class="inputBox">
            <span>Receipient's Name:</span>
            <input type="text" name="name" placeholder="e.g. Juan Dela Cruz" class="box" maxlength="20" value ="<?= $fetch_address['name']; ?>" required>
         </div>
         <div class="inputBox">
            <span>Mobile Number:</span>
            <input type="number" name="number" placeholder="e.g. 09XXXXXXXXX" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" value ="<?= $fetch_address['number']; ?>" required>
         </div>
         <div class="inputBox">
            <span>Email:</span>
            <input type="email" name="email" placeholder="@gmail.com" class="box" maxlength="50" value ="<?= $fetch_address['email']; ?>" required>
         </div>
         <div class="inputBox">
            <span>Payment Method:</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="E-Wallet">E-Wallet</option>
               <!-- <option value="paytm">paytm</option>
               <option value="paypal">paypal</option> --> -->
            </select>
         </div>
         <div class="inputBox">
            <span>Address Line 1:</span>
            <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" value ="<?= $fetch_address['flat']; ?>" required>
         </div>
         <div class="inputBox">
            <span>Address Line 2 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" placeholder="e.g. Manila" class="box" maxlength="50" value ="<?= $fetch_address['city']; ?>" required>
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" placeholder="e.g. Metro Manila" class="box" maxlength="50" value ="<?= $fetch_address['state']; ?>" required>
         </div>
         <div class="inputBox">
            <span>Additional Request :</span>
            <input type="text" name="request" placeholder="e.g. extra bubble wrap" class="box" maxlength="200">
         </div>
         <!-- <div class="inputBox">
            <span>Pin Code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div> -->
         <div class="inputBox">
            <span>Preferred Courier  :</span>
            <select name="courier_type" class="box" required>
                  <!-- <option selected disabled><?= $fetch_orders['courier_type']; ?></option> -->
                  <option value selected="-" disabled>-</option>
                  <option value="Own">Own</option>
                  <option value="Third-party">Third-party</option>
               </select>
         </div>
         <div class="inputBox">
            <span>Reference No. :</span>
            <input type="telephone" name="ref_num" value="<?php echo genrate_ref_number(5)."-".genrate_ref_number(3)."-".genrate_ref_number(5)  ?>"  class="box" maxlength="20" readonly>
         </div>
         <?php
      }
      }
   ?>

      </div>

      <input type="submit" id="modal-btn" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order"> 

   </form>

</section>


<?php include 'components/footer.php'; ?>

<script>


</script>

<script src="js/script.js"></script>


</body>
</html>