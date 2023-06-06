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

<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    include 'connect-reset.php';
     
    $emailId = $_POST['email'];
 
    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='" . $emailId . "'");
 
    $row= mysqli_fetch_array($result);
 
  if($row)
  { 
     
     $token = md5($emailId).rand(10,9999);

     $expFormat = mktime(
     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
     );
 
    $expDate = date("Y-m-d H:i:s",$expFormat);
 
    mysqli_query($conn,"UPDATE users SET reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");
 
    $mail = new PHPMailer(true);
 
    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;                  
    $mail->Username = "otpgemstarcsi@gmail.com";
    $mail->Password = "mkhtvgceruoplufd";
    $mail->SMTPSecure = "ssl";  
    $mail->Port = "465";

    $mail->setFrom("otpgemstarcsi@gmail.com");
    
    $mail->IsHTML(true);

    $mail->AddAddress($_POST['email']);
    
    $mail->Subject =  'Reset Password';
    
    $mail->Body = "<h1>You have requested to reset your password</h1>
    Hello, <br>
    <br>
    We've received a request to reset the password for the Gemstar account.<br>
    <br>
    We cannnot simply send you your old password.<br>
    <br>
    A unique link to reset your password has been generated to you.<br>
    You can reset your password by clicking the link below.<br>
    <br>
    This password reset link is only valid for the next 24 hours.<br>
    <br>
    If you did not request a password reset, ignore this message and please let us know immediately.<br>
    <br>
    You can find answers to most questions and get in touch with us at [link]<br>. 
    <br>
    We're here to help you at any step along the way.<br>
    <br>
-- The Gemstar team
<br>
    <a href='http://localhost/e-commercewebsite/reset-password.php?key=".$emailId."&token=".$token."'>Click To Reset password</a>";
    
    if($mail->Send())
    {
      echo "We have sent a password recover instructions to your email.";
      echo "<br>";
      echo "<br>";
      echo"Did not receive the email? Check your spam filter, or try sending another one.";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "Invalid Email Address. Go back";
  }
}
?>
</body>
</html>