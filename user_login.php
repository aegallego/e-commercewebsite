<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_COOKIE['email']) && isset($_COOKIE['pass'])){
   $id=$_COOKIE['email'];
   $pass=$_COOKIE['pass'];
   }
   else{
      $id='';
      $pass='';
   }

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?"); 
   $select_admin->execute([$email, $pass]);
   $row_1 = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      if(isset($_POST['remember_me'])){
         setcookie('email',$_POST['email'],time() + (60*60*24));
         setcookie('pass',$_POST['pass'],time() + (60*60*24));
      }else{
         setcookie('email','',time() - (60*60*24));
         setcookie('pass','',time() - (60*60*24));
      }
      header('location:home.php');
   }
   elseif($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row_1['id'];
      if(isset($_POST['remember_me'])){
         setcookie('email',$_POST['email'],time() + (60*60*24));
         setcookie('pass',$_POST['pass'],time() + (60*60*24));
      }else{
         setcookie('email','',time() - (60*60*24));
         setcookie('pass','',time() - (60*60*24));
      }
      header('location:admin/dashboard.php');
   }
   else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">
<div class="card">

   <form action="" method="post" class="userlogin">
      <div class="card-0"><img src="./images/GEMSTAR-LOGO.png"></img></div>
      <h3 class="userlogin">Log in</h3>
      <input type="text" name="email" required placeholder="Email" maxlength="30"  class="box email" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Password" maxlength="20"  class="box pass" oninput="this.value = this.value.replace(/\s/g, '')">
      <p><input type="checkbox" name="remember_me" style="vertical-align: center;" >
      <label for="vehicle1" style="padding-bottom: 15px;">Remember me</label>
      <a style="float: right;" href="forget-password.php">Reset Password?</a>
      <input type="submit" value="Login now" class="btn" style="text-align: center; margin-top: 8%;" name="submit">
      <p style="text-align: center; padding-top: 2%; ">Don't have an account?<b><a href="user_register.php"> Register now!</a></b></p>
      </form>
      <div class="card-1">
      <div class="card-2">
        <div class="overlay">
            <div class="card-4">
               <div class="text-1">One Stop Shop for Cleaning Needs</div>
               <a href="shop.php" class="btn" style="width: 50%;"><button type="submit" id="loginBtn" style="background: transparent; color: white;">Order Now</button><br></a>       
</div></div></div></div>                
</section>

<script>
   const form = document.querySelectorAll(".userlogin")[0];
   const email_input = document.querySelector(".email");
   const pass_input = document.querySelector(".pass");

   form.onsubmit = (e) =>{
      sessionStorage.setItem("email_",email_input.value);
      sessionStorage.setItem("pass_",pass_input.value);
   }

   email_input.value = (email_input.value == null)? null : sessionStorage.getItem("email_");
   pass_input.value = (pass_input.value == null)? null : sessionStorage.getItem("pass_");


</script>
</body>
</html>
