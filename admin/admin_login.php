<?php

include '../components/connect.php';

session_start();
if(isset($_COOKIE['name']) && isset($_COOKIE['pass'])){
$id=$_COOKIE['name'];
$pass=$_COOKIE['pass'];
}
else{
   $id='';
   $pass='';
}
if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      if(isset($_POST['remember_me'])){
         setcookie('name',$_POST['name'],time() + (60*60*24));
         setcookie('pass',$_POST['pass'],time() + (60*60*24));
      }else{
         setcookie('name','',time() - (60*60*24));
         setcookie('pass','',time() - (60*60*24));
      }
      header('location:dashboard.php');
   }else{
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
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

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

   <form action="" method="post" class="adminlogin">
      <div class="card-0"><img src="../images/GEMSTAR-LOGO.png"></img></div>
      <h3 class="adminlogin">Log in</h3>
      <input type="text" name="name" required placeholder="Username" maxlength="30"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <p><input type="checkbox" name="remember_me" style="vertical-align: center;" >
      <label for="vehicle1" style="padding-bottom: 15px;">Remember me</label>
      <a style="float: right;" href="samplelogin.htm">Reset Password?</a>
      <input type="submit" value="Login now" class="btn" style="text-align: center; margin-top: 8%;" name="submit">
      <p style="text-align: center; padding-top: 2%; ">Don't have an account?<b><a href="register_admin.php"> Register now!</a></b></p>
      </form>
      <div class="card-1">
      <div class="card-2">
        <div class="overlay">
            <div class="card-4">
               <div class="text-1">One Stop Shop for Cleaning Needs</div>
               <button type="submit" id="loginBtn" class="btn" style="width: 50%;">Order Now</button><br>       
</div></div></div></div>                
</section>

   
</body>
</html>