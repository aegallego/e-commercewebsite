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
   <title>Home | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<div class="home-bg">
<main style="text-align: center;">
<section class="sec1">
      <h2>Gemstar Cleaning Supplies International</h2>
      <div class ="tagline"><b>One Stop Shop for Cleaning Needs</b></div>
      <div class ="tagline1"><p>Bulk orders? we got you...</p></div>    </section>
</main>
<!-- <section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-1.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest smartphones</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest watches</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-3.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>latest headsets</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div> -->

<!-- <section class="category">

   <h1 class="heading">shop by category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=Broom" class="swiper-slide slide">
      <h3>Branded Products</h3>
   </a>

   <a href="category.php?category=COVID Prevention" class="swiper-slide slide">
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
   </a>

   <a href="category.php?category=Other Custodials" class="swiper-slide slide">
      <h3>Other Custodials</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section> -->

<section class="home-products">

   <h1 class="heading">latest products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="boxes">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt=""></div>
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>₱</span><?= $fetch_product['price']; ?><span> </span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









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

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>
<script>
      sessionStorage.clear();
</script>

</body>
</html>
