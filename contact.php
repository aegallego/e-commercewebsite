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

  if($user_id !== ''){
    $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_users->execute([$user_id]);
    $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

      $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ?");
      $select_messages->execute([$user_id]);
      $fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC);
  }

  if(isset($_POST['recieved-btn'])){
    $select_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
    $select_messages->execute([$user_id]);
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

<div class="admin-res">
  <form method="POST" class="container">
    <img width="100" height="100" src="https://img.icons8.com/ios-filled/100/0856cf/admin-settings-male.png" alt="admin-settings-male"/>
    <hr>   
    <h3><?php echo $fetch_messages['dates'] ?> | Admin:</h3>
    <h1><?php echo $fetch_messages['message_status'] ?></h1>
    <button type="submit" name="recieved-btn" class="recieved-btn">Received!</button>
  </form>
</div>

<?php include 'components/user_header.php'; ?>
<img src="img/shape.png" class="square" alt="" />
<section class="contact">
<h1 class="heading">contact us</h1>
<div class="container">
<span class="big-circle"></span>
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
          <div class="input-container read">
              <input type="text" name="name" class="input" required maxlength="20" value="<?=$fetch_users['name']?> " />
              <label for=""></label>
              <span>Name</span>
            </div>
            <div class="input-container read">
              <input type="email" name="email" class="input" required maxlength="50" value="<?=$fetch_users['email']?> "/>
              <label for=""></label>
              <span>Email</span>
            </div>
            <div class="input-container read">
              <input type="tel" name="number" class="input"  required maxlength ="11"  value="<?=$fetch_users['number']?>"/>
              <label for=""></label>
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

<!-- FAQs -->
<style>
      .admin-res{
        position: fixed;
        background-color: rgba(0, 0, 0, 0.605);
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        z-index: 1001;
      }
      .admin-res .container{
        background-color: white;
        border-radius: 25px;
        display: inherit;
        flex-direction: inherit;
        row-gap: 2rem;
        height: 70%;
        width: 50%;
      }
      .admin-res .container hr{
        height: 2px;
        width: 80%;
        background-color: black;

      }
      .admin-res .container h3{
        align-self: flex-start;
        margin-left: 7rem;
        font-weight: light;

      }
      .admin-res .container h1{
        padding: 1rem 8rem;
        overflow-y: auto;
      }
      .admin-res .container button{
        padding: 1rem 3rem;
        border-radius: 8px;
        margin-top: 2rem;
        cursor: pointer;
        font-weight: bold;
        background-color: #4b92ff;
        color: white;
      }
      .admin-res .container button:hover{
        background-color: #2e61ae;
      }
 
   </style>
<!-- FAQs -->
<style>
  .containeracc {
  display: flex;
  margin-top: -7%;
  background-color:#1f5c9a;
  justify-content: space-between;
  }

  .columnacc {
    width: 40%;
    margin-left: 5%;
  }

  .column{
    margin-top: 12%;
    width: 40%;
    margin-right: 5%;
  }
.containerFluid {
  width: 30%;
  margin: 0 auto;
  margin-top: -5%;
}

.containerFluid h2 {
  color: #142D55;
  position: relative;
  width: 50rem;
}

.containerFluid h2::after {
  position: absolute;
  content: "";
  bottom: 0;
  right: 12px;
  width: 67px;
  height: 2px;
  background-color: #6db5ff;
}

.faqs, .ans{
color: #ffff;
}

.accordion {
  width: 100%;
  padding: 0 5px;
  border: 2px solid #6db5ff;
  cursor: pointer;
  border-radius: 50px;
  display: flex;
  margin: 10px 0;
  align-items: center;
}

.accordionr{
  width: 100%;
  padding: 0 5px;
  border: 2px solid #6db5ff;
  cursor: pointer;
  border-radius: 50px;
  display: flex;
  margin: 10px 0;
  margin-left: 130%;
  align-items: center;
}
.accordionr .icon {
  margin: 0 10px 0 0;
  width: 30px;
  height: 30px;
  background: url(https://raw.githubusercontent.com/Tusar78/responsive-accordion/main/images/toggle-bg.png)
    no-repeat 8px 7px #6db5ff;
  border-radius: 50%;
  float: left;
  transition: all 0.5s ease-in;
}

.accordionr h5 {
  font-size: 22px;
  margin: 0;
  padding: 3px 0 0 0;
  font-weight: normal;
  color: #1f5c9a;
}
.accordion .icon {
  margin: 0 10px 0 0;
  width: 30px;
  height: 30px;
  background: url(https://raw.githubusercontent.com/Tusar78/responsive-accordion/main/images/toggle-bg.png)
    no-repeat 8px 7px #6db5ff;
  border-radius: 50%;
  float: left;
  transition: all 0.5s ease-in;
}

.accordion h5 {
  font-size: 22px;
  margin: 0;
  padding: 3px 0 0 0;
  font-weight: normal;
  color: #ffff;
}

.active {
  background-color: #6db5ff;
  color: #fff;
}

.active .icon {
  background: url(https://.githubusercontent.com/Tusar78/responsive-accordion/main/images/toggle-bg.png)
    no-repeat 8px -25px #fff;
}

.panel {
  padding: 0 15px;
  border-left: 1px solid #6db5ff;
  margin-left: 25px;
  font-size: 14px;
  text-align: justify;
  overflow: hidden;
  max-height: 0;
  transition: all 0.3s ease-in;
}

</style>

<div class="containeracc">
  <div class="columnacc">
    <h2 class = "faqs">Frequently Asked Questions (FAQs)</h2>
    <div class="accordion">
      <div class="icon"></div>
      <h5>How long does it take for the orders to be received?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
        The delivery time for orders may vary depending on various factors such
        as location and shipping method chosen. Please allow for sufficient time 
        for your order to be received.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>What is the process for ordering?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
        The process for ordering starts with signing up or logging into an account. 
        Once logged in, you can select the desired cleaning supplies from our available 
        products, add them to your cart, provide necessary information, and choose your 
        preferred payment method.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>Who is eligible to order?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
        Eligibility to order is open to all Gemstar's partner companies and anyone who 
        wishes to order our available cleaning supplies.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>How do I place my order?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
        To place your order, please sign up or log in to your account, select the cleaning 
        supplies you need, add them to your cart, proceed to checkout, provide the required 
        information, and select your preferred payment method.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>How can I track my order?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      You can track the status of your order by logging into your account on our website 
      and accessing the order status section. There, you will find real-time updates on 
      the progress and location of your shipment.
      </p>
    </div>

  </div>

  <div class="column">
    <div class="accordion">
      <div class="icon"></div>
      <h5>How do I place my order?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
        To place your order, please sign up or log in to your account, select the cleaning 
        supplies you need, add them to your cart, proceed to checkout, provide the required 
        information, and select your preferred payment method.
      </p>
    </div>
  
    <div class="accordion">
      <div class="icon"></div>
      <h5>What is your return policy?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      Our return policy allows for returns and exchanges within a specified timeframe, typically
      accompanied by certain conditions such as the item being unused and in its original packaging.
      Please refer to our website or contact our customer service for detailed information
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>How secure is my personal information inyour website</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      We prioritize the security of your personal information and employ various measures to protect it,
      including encryption and secure protocols, to ensure the confidentiality and integrity of your data.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>What payment methods do you accept?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      Gemstar only accepts COD (Cash on Delivery) and GCash (E-wallet) as payment methods.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>Do you iffer international shipping?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      Gemstar currently caters to local shipping within the specified region. International 
      shipping is not available at this time.
      </p>
    </div>

    <div class="accordion">
      <div class="icon"></div>
      <h5>What happens if the item I received is either broken or damaged?</h5>
    </div>
    <div class="panel">
      <p class ="ans">
      If the item you received is broken or damaged, please contact our customer service 
      immediately and provide relevant details. We will assist you in resolving the issue,
      which may involve replacement, refund, or other appropriate actions depending on the circumstances.
      </p>
    </div>
  </div>
</div>

<?php include 'components/footer.php'; ?>

<script>
// FAQs
var acc = document.getElementsByClassName("accordion");
var i;
var len = acc.length;
for (i = 0; i < len; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
//FAQs
</script>
<script>
  let response = "<?php echo $fetch_messages['message_status'] ?>";
  
  (response !== "") ? document.querySelector('.admin-res').style.display = "flex" : false

  document.querySelector('.recieved-btn').onsumbit = () =>{
    document.querySelector('.admin-res').style.display = "none"
  }
</script>

<script src="js/script.js"></script>
<script src ="js/contact.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


</body>
</html>