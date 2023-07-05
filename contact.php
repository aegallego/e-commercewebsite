<script>
function timeMsg() {
var t=setTimeout("myFunction1()",1000);
}
</script>

<script>
function myFunction1() {
  alert("Your message has already been sent! Please wait for admin's response.");
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


if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

      $insert_message = $conn->prepare("INSERT INTO `messages` (user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';
      // echo ' <script>
      // window.location.reload();
      // </script>
      // ';

   }




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/contact-style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- <section class="contact">

   <form action="" method="post">
      <h3>get in touch</h3>
      <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <input type="tel" name="number" placeholder="Enter your number" required maxlength="11" class ="box">
      <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section> -->

<div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe
            dolorum adipisci recusandae praesentium dicta!
          </p>

        <div class="info">
          <div class="information">
              <img src="img/location.png" class="icon" alt="" />
              <p>47 C Lincoln St. Brgy. San Antonio, Quezon City</p>
          </div>
        <div class="information">
          <img src="img/email.png" class="icon" alt="" />
              <p>gemstarlink@gmail.com</p>
        </div>
            <div class="information">
              <img src="img/phone.png" class="icon" alt="" />
              <p>8982-0664 | 3415-8769 | 3411-1473</p>
              <p>0995-290-6808 | 0932-259-9409</p>
            </div>
          </div>

            <div class="social-media">
              <p>Connect with us :</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <?php
          if($user_id == ''){
              echo '<p class="empty">please login to see your orders</p>';
          }else{
            $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_users->execute([$user_id]);
            $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

              $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ?");
              $select_messages->execute([$user_id]);
              $fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC);
              
          ?>
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="" method="POST">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" required maxlength="20" value="<?=$fetch_users['name']?> " disabled />
              <label for=""></label>
              <span>Name</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" required maxlength="50" value="<?=$fetch_users['email']?> " disabled/>
              <label for=""></label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="number" class="input"  required maxlength ="11"/>
              <label for="">Number</label>
              <span>Number</span>
            </div>
            <div class="input-container textarea">
              <textarea name="msg" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" name="send" value="Send Message" class="btn-s <?php $count = 0; if($fetch_messages['message'] != ''){ echo 'disabled'; $count += 1; }else{ echo ''; $count = 0; }; ?>"/>
            <?php
          }
               if($count > 0){
                echo'
                <script>
                        timeMsg();
                </script>
                ';
      }
            ?>
          </form>
        </div>
      </div>
    </div>



<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<script src ="js/contact.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>