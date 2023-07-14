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
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop | Gemstar</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="../js/admin_script.js"></script>
   <script>
      $(document).ready(function() {
         $('#search_box').on('input', function() {
            var searchQuery = $(this).val();
            if (searchQuery.length >= 0) {
               $.ajax({
                  url: 'search.php',
                  method: 'POST',
                  data: { search_query: searchQuery },
                  beforeSend: function() {
                     // Display a loading spinner or any other visual indication of the search in progress
                  },
                  success: function(response) {
                     $('#search_results').html(response);
                  },
                  error: function() {
                     console.log('An error occurred during the search.');
                  }
               });
            } else {
               $('#search_results').empty();
            }
         });
      });
   </script>
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="category">

   <h1 class="heading">shop by category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <?php
     $select_productline = $conn->prepare("SELECT * FROM `productline`"); 
     $select_productline->execute();
     if($select_productline->rowCount() > 0){
      while($fetch_productline = $select_productline->fetch(PDO::FETCH_ASSOC)){  
   ?>

   <a href="category.php?category=<?= $fetch_productline['ProductlineName']; ?>" class="swiper-slide slide">
      <h3><?= $fetch_productline['ProductlineName']; ?></h3>
   </a>
   <?php
   }
   } //else{
   //    echo '<p class="empty">no products found!</p>';
   // }
   ?>

   

   <!--<a href="category.php?category=COVID Prevention" class="swiper-slide slide">
      <h3>COVID Prevention</h3>
   </a>
 
   <a href="category.php?category=Cleaning Chemicals" class="swiper-slide slide">
      <h3>Cleaning Chemicals</h3>
   </a>

   <a href="category.php?category=Dispensers" class="swiper-slide slide">
      <h3>Dispensers</h3>
   </a>

   <a href="category.php?category=Equipments" class="swiper-slide slide">
      <h3>Equipments</h3>
   </a>

   <a href="category.php?category=Floor Polisher Accessories" class="swiper-slide slide">
      <h3>Floor Polisher Accessories</h3>
   </a>

   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Gloves</h3>
   </a>

   <a href="category.php?category=Housekeeping Products" class="swiper-slide slide">
      <h3>Housekeeping Products</h3>
   </a>

   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Mats/Rugs</h3>
   </a>
   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Mop Head & Handles</h3>
   </a>   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Pails & Dipper</h3>
   </a>   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Tissues</h3>
   </a>   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Trash Bags</h3>
   </a>   <a href="category.php?category=washing" class="swiper-slide slide">
      <h3>Trash Bins</h3>
   </a> -->

   <!-- <a href="category.php?category=Other Custodials" class="swiper-slide slide">
      <h3>Other Custodials</h3>
   </a> -->

   </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>

   </div>

</section>
<section class="products">
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="search_box" placeholder="Search products" maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>
<div class="box-container" id="search_results">
   <?php
   $select_prod = $conn->prepare("SELECT * FROM `products`");
   $select_prod->execute();
   if ($select_prod->rowCount() > 0) {
      while ($fetch_product = $select_prod->fetch(PDO::FETCH_ASSOC)) {
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
         <div class="price">₱ <?= $fetch_product['price']; ?> </div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      </div>
      <input type="submit" value="add to cart" class="btn <?= ($fetch_product['product_stock'] > 0)?'':'disabled'; ?>"  name="add_to_cart">
   </form>

   <?php
      }
}
   else{
      echo '<p class="empty">no products found!</p>';
   }

   ?>

</section>
</div>
</div>
</div>
<?php include 'components/footer.php'; ?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   navigation:{
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

// var swiper = new Swiper(".products-slider", {
//    loop:true,
//    spaceBetween: 20,
//    pagination: {
//       el: ".swiper-pagination",
//       clickable:true,
//    },
//    breakpoints: {
//       550: {
//         slidesPerView: 2,
//       },
//       768: {
//         slidesPerView: 2,
//       },
//       1024: {
//         slidesPerView: 3,
//       },
//    },
// });
</script>
</body>
</html>