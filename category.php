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

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Category | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">


   <h1 class="heading">Category</h1>

  <ul class="breadcrumbs">
    <li><a href="home.php">Home</a></li>
    <li><a href="shop.php">Shop</a></li>
    <li>Category</li>
  </ul>

<style>
   .breadcrumbs {
   list-style: none;
   padding: 0;
   margin: 0;
   font-size: 1rem;
   padding-left: 5%;
   padding-bottom: 1%;
 }
 
 .breadcrumbs li {
   display: inline;
   font-size: 1.5rem;
 }
 
 .breadcrumbs li:not(:last-child):after {
   content: "›";
   margin: 0 5px;
   color: #999;
 }
 
 .breadcrumbs li:last-child {
   font-weight: bold;
   color: #333;
 }

 </style>
 
   <div class="box-container">

   <?php
     $category = $_GET['category'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE Productline_ID LIKE '%{$category}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="boxes">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt=""></div>
      <div class="overflow">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span> </span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      </div>
      <input type="submit" value="add to cart" class="btn <?= ($fetch_product['product_stock'] > 0)?'':'disabled'; ?>"  name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>