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
   <title>About Us | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">
<h1 class="heading">about us</h1>
   <div class="row">
      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3 style="font-style: italic;">Your One Stop Shop For Cleaning Needs... </h3>
         <p>GEMSTAR CLEANING SUPPLIES INTERNATIONAL was established & registered on January 2011 that provides cleaning and hygiene products. We have more than a decade of experience in marketing, business & product development. We support sales of commercial and industrial cleaning chemicals.
           <br> The mission of GEMSTAR. is to create clean and healthy environment by bearing complete line of cleaning products from custodial, chemical to equipment. Also, to become your trusted cleaning supplier.
            <br>A demand was seen to help customers simplify sourcing products related to cleaning materials. With this act we further reduce cost of time and efforts by simply talking with one supplier that can give competitive prices and also provides solutions on problem related to cleaning.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>
]

   </div>
   <h1 class="heading">our brands</h1>
<section class="reviews">
   

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/3m.jpg" alt="">

      </div>

      <div class="swiper-slide slide">
         <img src="images/bp.jpg" alt="">

      </div>

      <div class="swiper-slide slide">
         <img src="images/diversey.jpg" alt="">

      </div>

      <div class="swiper-slide slide">
         <img src="images/ecolab.jpg" alt="">

      </div>

      <div class="swiper-slide slide">
         <img src="images/indoplas.jpg" alt="">

      </div>

      <div class="swiper-slide slide">
         <img src="images/kc.jpg" alt="">

      </div>
      <div class="swiper-slide slide">
         <img src="images/orocan.jpg" alt="">
</div><div class="swiper-slide slide">
         <img src="images/rubber.jpg" alt="">
</div><div class="swiper-slide slide">
         <img src="images/sani.jpg" alt="">
</div><div class="swiper-slide   slide">
         <img src="images/scjo.jpg" alt="">
</div><div class="swiper-slide slide">
         <img src="images/uni.jpg" alt="">
</div>
<div class="swiper-slide slide">
         <img src="images/wilson.jpg" alt="">
</div>
<div class="swiper-slide slide">
         <img src="images/zim.jpg" alt="">
</div>
   </div>

   <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
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
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>