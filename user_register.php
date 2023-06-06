<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $flat = $_POST['flat'];
   $flat = filter_var($flat, FILTER_SANITIZE_STRING);
   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);
   $state = $_POST['state'];
   $state = filter_var($state, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
         $select_user->execute([$name]);

         if($select_user->rowCount() > 0){
            $message[] = 'username already exists!';
         }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, flat, city, state, number) VALUES(?,?,?,?,?,?,?)");
         $insert_user->execute([$name, $email, $cpass, $flat, $city, $state, $number]);
         $message[] = 'registered successfully, login now please!';
      }
   }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="./css/style.css">

</head>

<body>

<?php include './components/user_header.php'; ?>

<section class="form-containers">
<div class="container_signup">
<div class="card_signup" style="background-color: #4b92ff">
   <div class="card-1signup">
   <div class="overlay_signup">
                    <div class="card-0signup"><img src="./images/GEMSTAR-LOGO.png" class="one"></img></div>
                    <div class="text-1signup">“Gemstar has always been a great medium in helping us serve our purpose to array of our customers”</div>
                    <div class="text-2signup">ECOLAB PH<br>-<br>
                        <div class="text-3signup">Water, Hygiene and Infection Prevention Solutions and Services Company Supplier</div>
                    </div>
                    <div class="arrows" style="display:none;">
                        <img src="./images/left.png"></img>
                        <img src="./images/right.png"></imgx>
                     </div>
   </div>
   </div>
   <form action="" id="hello" method="post" style="padding: 3rem; min-height: 80%; display: flex; flex-direction: column; justify-content: center; align-content: center; box-shadow: 0 .5rem 1rem rgba(0,0,0,.5);">
   <div class="access">
   <h3 style="margin-bottom: 0px;">Sign Up</h3>
   </div>
   <br>
   <input type="text" name="name" required placeholder="Username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '','[!@#$%^&*_=+-]')">
   <input type="email" name="email" required placeholder="Email" maxlength="30"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="pass" required placeholder="Password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="cpass" required placeholder="Password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="text" name="flat" required placeholder="Home Address" maxlength="40"  class="box">
   <div class="flex-btn">
      <input type="text" name="city" required placeholder="City" maxlength="40"  class="box">
      <input type="text" name="state" required placeholder="State" maxlength="40"  class="box">
   </div>
   <input type="tel" name="number" required placeholder="Mobile Number (e.g. 09XXXXXXXXX)" maxlength="11" pattern="09[0-9]{9}" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="submit" value="register now" class="btn" name="submit">
   <p style="text-align: center; padding-top: 10%; ">Already have an account?<b><a href="user_login.php"> Log in!</a></b></p>
   </form>
   </div>            
   </div>

</div>
</section>


<script src="js/script.js"></script>

</body>
</html>