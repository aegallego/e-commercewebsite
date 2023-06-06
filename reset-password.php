<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Reset Password | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="images/logo.png" type="image/x-icon"/>
<!-- CSS -->
<link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="card-body">
<?php
if($_GET['key'] && $_GET['token'])
{
include 'connect-reset.php';
$email = $_GET['key'];
$token = $_GET['token'];
$query = mysqli_query($conn,
"SELECT * FROM `users` WHERE `reset_link_token`='".$token."' and `email`='".$email."';"
);
$curDate = date("Y-m-d H:i:s");
if (mysqli_num_rows($query) > 0) {
$row= mysqli_fetch_array($query);
if($row['exp_date'] >= $curDate){ ?>

<section class="form-container">
<!-- <a style="float: left;" href="forget-password.php">Back to Log In</a> -->

<div class="card">
   <form action="password-reset-token.php" method="post" class="userlogin">
      <div class="card-0"><img src="./images/GEMSTAR-LOGO.png"></img></div>
      <h3 class="userlogin">Reset Password</h3>
      <p class = "ins">Your new password must be different from previous used passwords.<br></p>
      <input type="password" name="pass" required placeholder="New Password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
   <input type="password" name="cpass" required placeholder="Confirm Password" maxlength="20"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}" title="Must contain 8-12 characters with a number, symbol, and an upper and lower case" required class="box" oninput="this.value = this.value.replace(/\s/g, '')">
<input type="submit" name="password-reset-token" value="Reset Password" class="btn btn-primary">
        </form>
      <div class="card-1">
      <div class="card-2">

<!-- <form action="update-forget-password.php" method="post">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name='password' class="form-control">
</div>                
<div class="form-group">
<label for="exampleInputEmail1">Confirm Password</label>
<input type="password" name='cpassword' class="form-control">
</div>
<input type="submit" name="new-password" class="btn btn-primary"> -->
</form>

<?php } } else{
echo "<p>This forget password link has been expired</p>";
}
}
?>
</div>
</div>
</div>
</body>
</html>