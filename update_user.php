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
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $flat = $_POST['flat'];
   $flat = filter_var($flat, FILTER_SANITIZE_STRING);
   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);
   $state = $_POST['state'];
   $state = filter_var($state, FILTER_SANITIZE_STRING);
   $number = ($_POST['number']);
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ?, flat = ?, city = ?, state = ?, number = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $flat, $city, $state, $number, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'changes submitted!';
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
   <title>My Profile | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/update_user.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>my profile</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" value="<?= $fetch_profile["name"]; ?>" placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '','[!@#$%^&*_=+-]')">
      <input type="email" name="email" value="<?= $fetch_profile["email"]; ?>"placeholder="enter your email" maxlength="30"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="flat"value="<?= $fetch_profile["flat"]; ?>" placeholder="enter your home address" maxlength="40"  class="box">
      <div class="flex-btn">
         <input type="text" name="city" value="<?= $fetch_profile["city"]; ?>"placeholder="enter your city" maxlength="40"  class="box">
         <input type="text" name="state" value="<?= $fetch_profile["state"]; ?>"placeholder="enter your state" maxlength="40"  class="box">
      </div>
         <input type="tel" name="number" value="<?= $fetch_profile["number"]; ?>" placeholder="enter your number (e.g. 09XXXXXXXXX)" maxlength="11" pattern="09[0-9]{9}"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="Current Password" maxlength="20"  class="box"  title="Must contain 8-12 characters with a number, symbol, and an upper and lower case"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="New Password" maxlength="20"  class="box"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="Confirm New Password" maxlength="20"  class="box"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Update Now" class="btn" name="submit">
   </form>

</section>














<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>