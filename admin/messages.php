<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];


if(!isset($admin_id)){
   header('location:admin_login.php');
}
if(isset($_POST['update_status'])){
   $update_id = $_POST['update_id'];
   $message_status = $_POST['message_status'];
   $message_status = filter_var($message_status, FILTER_SANITIZE_STRING);
   $update_status = $conn->prepare("UPDATE `messages` SET message_status = ? WHERE id = ?");
   $update_status->execute([$message_status, $update_id]);
   header('location:messages.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}
include '../components/admin_header.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages | Gemstar Cleaning Supplies International</title>

   <link rel="icon" href="../images/logo.png" type="image/x-icon"/>
   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="../js/admin_script.js"></script>
   <script>
      $(document).ready(function() {
         $('#search_box').on('input', function() {
            var searchQuery = $(this).val();
            if (searchQuery.length >= 0) {
               $.ajax({
                  url: 'search_messages.php',
                  method: 'POST',
                  data: { search_query: searchQuery },
                  beforeSend: function() {
                     // Display a loading spinner or any other visual indication of the search in progress
                  },
                  success: function(response) {
                     $('#search_results').html(response);
                  },
                  error: function() {
                     console.log('An error occurred during the search.');
                  }
               });
            } else {
               $('#search_results').empty();
            }
         });
      });
   </script>
</head>
<body>



<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="search_box" placeholder="Search messages" maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>  

<section class="contacts">

<h1 class="heading">messages</h1>

<div class="box-container" id="search_results">

<?php
   $select_message = $conn->prepare("SELECT * FROM `messages`");
   $select_message->execute();
   if ($select_message->rowCount() > 0) {
      while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {
         ?>
   <div class= "overflow">
   <div class="box">
   <p> user id : <span><?= $fetch_message['user_id']; ?></span></p>
   <p> name : <span><?= $fetch_message['name']; ?></span></p>
   <p> email : <span><?= $fetch_message['email']; ?></span></p>
   <p> number : <span><?= $fetch_message['number']; ?></span></p>
   <p> message : <span><?= $fetch_message['message']; ?></span></p>
   <p> date/time: <span><?= $fetch_message['dates']; ?></span></p>
   <form action="" method="post">
   <input type ="hidden" name="update_id" value= "<?= $fetch_message['id'];?>">
   <p> Message Status: 
               <input type="text" id= "status" placeholder="Send a response.." name="message_status" value="<?= $fetch_message['message_status'];?>" class="box" required maxlength="50" style="width: 100%; height: 40%; padding: 12px; font-size: 1.8rem;"/>
   </p>            
   <div class="flex-btn">
      <input type="submit" value="update" class="option-btn" name="update_status">
      <a href="messages.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   </div>
         </div>
         </form>
   <?php
         
      }   
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>

   </div>
   </div>

</section>


<script src="../js/admin_script.js"></script>
   
</body>
</html>