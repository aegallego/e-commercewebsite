<script>
function timeMsg() {
var t=setTimeout("myFunction1()",500);
}
</script>

<script>
function myFunction1() {
  alert("Feedback Sent!");
  window.location.href = "home.php";
};
</script>


<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

// random occurence of feedback
$occurance_rate = rand(10,200);

if(isset($_POST['send-btn'])){
   $rating = $_POST['rating'];
   $reason = $_POST['reason'];


   $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_users->execute([$user_id]);
   $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

   $select_messages = $conn->prepare("INSERT INTO `feedback`(`user_id`, `user_email`, `rating`, `reason`) VALUES (?,?,?,?)");
   $select_messages->execute([$user_id,$fetch_users['email'],$rating,$reason]);


   echo "<script>timeMsg();</script>";
 }


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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .feedback{
        position: fixed;
        background-color: rgba(0, 0, 0, 0.605);
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        z-index: 1001;
        padding: 1rem 1rem;
      }
      .feedback .container{
        background-color: white;
        border-radius: 25px;
        display: inherit;
        flex-direction: inherit;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 40%;
      }
      .feedback .container hr{
        height: 2px;
        width: 80%;
        background-color: black;

      }
      .feedback .container h3{
        align-self: flex-start;
        margin-left: 7rem;
        font-weight: light;

      }
      .stars{
        display: inherit;
        flex-direction: row;
        padding: 1rem .5rem;
      }
      .fa-star{
        cursor: pointer;
        color: grey;
        margin-left: .5rem;
      }
      .checked{
        color: orange;
      }
      .unchecked{
        color: grey;
      }
      .feedback .container button{
        padding: 1rem 3rem;
        border-radius: 8px;
        margin-top: 2rem;
        cursor: pointer;
        font-weight: bold;
        background-color: #4b92ff;
        color: white;
      }
      .feedback .container button:hover{
        background-color: #2e61ae;
      }
      
      .feedback-btn{
         display: inherit;
         flex-direction: row;
         column-gap: .5rem;
      }

      .rating{
         visibility: hidden;
      }

      .reason{
         border: 1px solid black;
         width: 50%
      }
   </style>

</head>
<body>

<div class="feedback">
  <form method="POST" class="container">
     <img width="300" height="300" src="images/feedback.png">
     <h1>Give Us A Feedback!</h1>
     <hr>   
     <div class="stars">
         <i class="fa fa-4x fa-star stars-feed" aria-hidden="true"></i>
         <i class="fa fa-4x fa-star stars-feed" aria-hidden="true"></i>
         <i class="fa fa-4x fa-star stars-feed" aria-hidden="true"></i>
         <i class="fa fa-4x fa-star stars-feed" aria-hidden="true"></i>
         <i class="fa fa-4x fa-star stars-feed" aria-hidden="true"></i>
      </div>
      
      <label for="reason">Reason:</label>
      <!-- text area for reason of feedback -->
      <textarea name="reason" id="reason" class="reason" cols="10" rows="30"></textarea>

      <div class="feedback-btn">
         <button type="submit" name="send-btn" class="send-btn">Send</button>
         <button  name="recieved-btn" class="recieved-btn">Remind Later</button>
      </div>
      <input type="number" name="rating" class="rating" value="">
  </form>
</div>

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
      
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>

   </div>

</section>


<?php include 'components/footer.php'; ?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

   const feedback_apperance_rate = "<?php echo $occurance_rate ?>";
   (parseInt(feedback_apperance_rate)  == 12) ? document.querySelector('.feedback').style.display = "flex" : false
   console.log(feedback_apperance_rate);
   const stars = document.querySelectorAll('.stars-feed');

   stars.forEach((star,index)=>{
      star.onclick = () =>{
         for(let i=index; i>=0; i--){
            stars[i].classList.add('checked');
            
         }
         document.querySelector('.rating').value = index+1;
      }
   });

   document.querySelector('.recieved-btn').onclick = () =>{
      document.querySelector('.feedback').style.display = "none"
   }
   document.querySelector('.send-btn').onsubmit = () =>{
      document.querySelector('.feedback').style.display = "none"
   }


var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
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
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   navigation:{
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
   }
});

</script>
<script>
      sessionStorage.clear();
</script>

</body>
</html>
