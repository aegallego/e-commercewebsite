<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $Productline_ID = $_POST['Productline_ID'];
   $Productline_ID = filter_var($Productline_ID, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $product_stock = $_POST['product_stock']; 
   $product_stock = filter_var($product_stock, FILTER_SANITIZE_STRING); 
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);


   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(Productline_ID, name, details, price, product_stock, image_01, image_02, image_03) VALUES(?,?,?,?,?,?,?,?)");
      $insert_products->execute([$Productline_ID, $name, $details, $price, $product_stock, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

$delete_id = $_GET['delete'];
$delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
$delete_product_image->execute([$delete_id]);
$fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
$delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
$delete_product->execute([$delete_id]);
$delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
$delete_cart->execute([$delete_id]);
$delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
$delete_wishlist->execute([$delete_id]);
header('location:product_table.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="../images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
   $('#search_box').keyup(function() {
      var search = $(this).val();
      $.ajax({
         url: 'search_products.php',
         type: 'POST',
         data: {search: search},
         success: function(response) {
            $('.table2').html(response);
         }
      });
   });
});
</script>

</head>

<body>

<?php include '../components/admin_header.php'; ?>

<section class="product_table">

<h1 class="heading" style="display: flex; justify-content: center; align-content: center;">product table<button type="submit" class="fas fa-edit" style="margin:8px 0 0 15px;" name="update_qty" id="myBtnsss"></button></h1>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="search_box" placeholder="search product id, line, or name here..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<table class="table2">
<a href="products.php" class="history" style="text-align: left;">View All Products</a>
      <tr>
         <th>Product ID</th>
         <th>Productline ID</th>
         <th>Product Name</th>
         <th>Stocks</th>
         <th></th>
      </tr>

      <?php
$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
if ($select_products->rowCount() > 0) {
    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>

      <tr>
         <td><?=$fetch_products['id']; ?></td>
         <td><?=$fetch_products['Productline_ID']; ?></td> 
         <td><?=$fetch_products['name']; ?></td>
         <td><?=$fetch_products['product_stock']; ?></td>
         <td>      
            <div class="flex-btn">
               <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
               <a href="product_table.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
            </div>
         </td>
      </tr>

      <?php
            }
         } elseif ($select_products->rowCount() > 0 && $select_product->rowCount() <= 0) {
            echo '</table> <p class="empty">no products found!</p>';
        }
      ?>

      </table>

<div id="myModals" class="modal">
<div class="modal-content">

<section class="add-products">
   <form action="" method="post" enctype="multipart/form-data">
   <h1 class="heading">add product<span class="close" style="font-size: 40px;">&times;</span></h1>
      <div class="flex">
         <div class="inputBox">
         <input type="hidden" name="Productline_ID">
         <span>product line (required)</span>
         <select name="Productline_ID" id="sort-item" class="select" required>
               <?php
                  $select_productline = $conn->prepare("SELECT * FROM `productline`"); 
                  $select_productline->execute();
                  if($select_productline->rowCount() > 0){
                     while($fetch_productline = $select_productline->fetch(PDO::FETCH_ASSOC)){
                  ?>
               <option><?= $fetch_productline['Productline_ID']; ?></option>
         <?php
   }
   }
   ?>
         </select>
         </div>
         <div class="inputBox">
            <span>product name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
         </div>
         <div class="inputBox">
            <span>product price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
         <div class="inputBox">
            <span>Stock Number (required)</span>
            <input type="number" class="box" required max="9999999999" placeholder="enter number of stocks" name="product_stock">
         </div>
        <div class="inputBox">
            <span>image 01 (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 02 (required)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 03 (required)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>product details (required)</span>
            <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>
</div>
</div>
</section>
<script src="js/admin_script.js"></script>
<script>
   // Get the modal
   var modal = document.getElementById("myModals");

   // Get the button that opens the modal
   var btn = document.getElementById("myBtnsss");

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks the button, open the modal 
   btn.onclick = function() {
   modal.style.display = "block";
   }

   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
   modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
   if (event.target == modal) {
      modal.style.display = "none";
   }
   }
</script>

</body>