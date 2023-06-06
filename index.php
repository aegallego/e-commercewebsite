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
   <title>Initial | Gemstar</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/order_status-style.css">


</head>
<body>

<div class="container">
<section class="index">
<h3 class="purchase" style="text-align: center;">Login as?</h3>
<div class = "status">
<a class="history" href="admin/admin_login.php">
    <button class="pay" id="">
    <i class="fa-solid fa-user-tie"></i>    
    <span class ="names">Admin</span>
    </button>
</a>
<a class="history" href="user_login.php">
    <button class="ship" id="">
    <i class="fa-sharp fa-solid fa-users"></i>    
    <span class ="names">User</span>
    </button>
</a>
</div>
</div>
</section>

</body>
</html>