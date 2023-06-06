<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $contact = $_POST['contact'];
   $contact = filter_var($contact, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password, contact) VALUES(?,?,?)");
         $insert_admin->execute([$name, $cpass, $contact]);
         $message[] = 'new admin registered successfully!';
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
   <title>register admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-containers">
<div class="container_signup">
<div class="card_signup" style="background-color: #4b92ff">
   <div class="card-1signup">
   <div class="overlay_signup">
                    <div class="card-0signup"><img src="../images/GEMSTAR-LOGO.png" class="one"></img></div>
                    <div class="text-1signup">“Gemstar has always been a great medium in helping us serve our purpose to array of our customers”</div>
                    <div class="text-2signup">ECOLAB PH<br>-<br>
                        <div class="text-3signup">Water, Hygiene and Infection Prevention Solutions and Services Company Supplier</div>
                    </div>
                    <div class="arrows">
                        <img src="../images/left.png"></img>
                        <img src="../images/right.png"></img>
   </div>
   </div>
   </div class="forms">
   <form action="" method="post" style="padding: 3rem; min-height: 80%; display: flex; flex-direction: column; justify-content: center; align-content: center; box-shadow: 0 .5rem 1rem rgba(0,0,0,.5);">
   <h3 style="margin-bottom: 0px;">Sign Up</h3>
   <br>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="tel" name="contact" required placeholder="enter your number (e.g. 09XXXXXXXXX)" maxlength="11" pattern="09[0-9]{9}" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p style="text-align: center; padding-top: 10%; ">Already have an account?<b><a href="admin_login.php"> Login now!</a></b></p>
   </form>
   </div>            
   </div>

</div>
</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>