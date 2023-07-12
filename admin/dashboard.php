<?php
   include '../components/connect.php';
   
   session_start();
   
   $admin_id = $_SESSION['admin_id'];
   
   if(!isset($admin_id)){
      header('location:admin_login.php');
      exit();
   }

      $checkyear = '';
      $statement = $conn->prepare("SELECT * FROM orders WHERE order_tracking='Completed' order by placed_on");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
      $windowSize = 0; // Adjust the window size as desired
      $date = array();
      $amount = array();
      $movingAverage = array();

      $combinedDates = array();
      $combinedAmounts = array();

      foreach ($result as $row) 
      {
         $year = date('Y', strtotime($row['placed_on']));

         if (strpos($checkyear, $year) !== false)
         {
            $date[] = '';
            $combinedDates[] = '';
         }
         else
         {
            $date[] = $year;
            $combinedDates[] = $year;
            $checkyear = $checkyear . ' : ' . $year;
         }
         $windowSize++;
         $amount[] = $row['total_price'];  
         $combinedAmounts[] = $row['total_price'];
      }
      $date [] = 'End';

      // Calculate the moving average
      $totalAmount = count($combinedAmounts);
      for ($i = 0; $i < $totalAmount - $windowSize + 1; $i++) 
      {
          $sum = array_sum(array_slice($combinedAmounts, $i, $windowSize));
          $average = $sum / $windowSize;
          $movingAverage[] = round($average, 2); // Round the average to 2 decimal places if needed
      }

      $combinedAmounts[] = round($average, 2);
      $combinedDates[] = 'Forecast';
 

   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dashboard | Gemstar Cleaning Supplies International</title>
      <link rel="stylesheet" href="../css/admin_style.css">
      <link rel="icon"  href="../images/logo.png" type="image/x-icon"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <script src="//code.jquery.com/jquery-1.9.1.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
   </head>
   <body>
      <?php include '../components/admin_header.php'; ?>
      <section class="dashboard">
         <h1 class="heading">dashboard</h1>
         <div class="box-container">
            <div class="box">
               <h3>welcome!</h3>
               <p><?= $fetch_profile['name']; ?></p>
               <a href="update_profile.php" class="btn">Update Profile</a>
            </div>
            <div class="box">
               <?php
                  $total_pendings = 0;
                  $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE order_tracking != 'Completed'");
                  $select_pendings->execute([]);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
                  ?>
               <h3><span>₱ </span><?= number_format($total_pendings,2); ?><span> </span></h3>
               <p>Total Pending Payments</p>
               <a href="placed_orders.php?method" class="btn">see orders</a>
            </div>
            <div class="box">
               <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE order_tracking = ?");
                  $select_completes->execute(['Completed']);
                  if($select_completes->rowCount() > 0){
                     while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                        $total_completes += $fetch_completes['total_price'];
                     }
                  }
                  ?>
               <h3><span>₱ </span><?= number_format($total_completes,2); ?><span> </span></h3>
               <p>Total Completed Payments</p>
               <a href="placed_orders.php?method=Completed" class="btn">see orders</a>
               <!-- <a href="placed_orders.php" class="btn">see orders</a> -->
            </div>
            <div class="box">
               <?php
                  $select_orders = $conn->prepare("SELECT * FROM `orders`");
                  $select_orders->execute();
                  $number_of_orders = $select_orders->rowCount()
                  ?>
               <h3><?= $number_of_orders; ?></h3>
               <p>Orders Placed</p>
               <a href="placed_orders.php" class="btn">see orders</a>
            </div>
            <div class="box">
               <?php
                  $select_products = $conn->prepare("SELECT * FROM `products`");
                  $select_products->execute();
                  $number_of_products = $select_products->rowCount()
                  ?>
               <h3><?= $number_of_products; ?></h3>
               <p>Products Added</p>
               <a href="products.php" class="btn">see products</a>
            </div>
            <div class="box">
               <?php
                  $select_users = $conn->prepare("SELECT * FROM `users`");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount()
                  ?>
               <h3><?= $number_of_users; ?></h3>
               <p>Normal Users</p>
               <a href="users_accounts.php" class="btn">see users</a>
            </div>
            <div class="box">
               <?php
                  $select_admins = $conn->prepare("SELECT * FROM `admins`");
                  $select_admins->execute();
                  $number_of_admins = $select_admins->rowCount()
                  ?>
               <h3><?= $number_of_admins; ?></h3>
               <p>Admin Users</p>
               <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
            <div class="box">
               <?php
                  $select_messages = $conn->prepare("SELECT * FROM `messages`");
                  $select_messages->execute();
                  $number_of_messages = $select_messages->rowCount()
                  ?>
               <h3><?= $number_of_messages; ?></h3>
               <p>New Messages</p>
               <a href="messages.php" class="btn">see messages</a>
            </div>
         </div>

         <div style="width: 100%; height: 500px; background-color: white; border-radius: 0.4vh; margin-top: 1vh; display: flex; justify-content: center; align-items: center; padding: 10px;">
           <div style="width: 50%; height: 90%; text-align: center;">
             <h2 class="page-header" style="padding-top:1vh; font-size:2.5vh;">Actual Sales Report</h2>
             <canvas id="chartjs_bar2" style="width: 100%; height: 100%; padding:2vh;"></canvas>
           </div>
           <div style="width: 50%; height: 90%; text-align: center;">
             <h2 class="page-header" style="padding-top:1vh; font-size:2.5vh;">Forecasted Sales Report</h2>
             <canvas id="chartjs_bar3" style="width: 100%; height: 100%; padding:1vh;"></canvas>
           </div>
         </div>
      </section>

         <script type="text/javascript">
            var ctx = document.getElementById("chartjs_bar2").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:<?php echo json_encode($date); ?>,
                    datasets: [
                    {
                        backgroundColor: "#5969ff",
                        label: 'Actual Sales ',
                        data:<?php echo json_encode($amount); ?>,
                        borderWidth: 3,
                        fill: false,
                        borderColor: 'green',
                        pointBackgroundColor: "rgb(192,192,192)",   
                    }
                    ]
                },
                options: {
                    legend: {
                    display: false,
                    position: 'bottom',
                    labels: {
                        fontColor: '#71748d',
                        fontFamily: 'Circular Std Book',
                        fontSize: 22,
                    }
                },
              }
            });
         </script>
         <script type="text/javascript">
         var ctx = document.getElementById("chartjs_bar3").getContext('2d');
         var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:<?php echo json_encode($combinedDates); ?>,
                    datasets: [
                    {
                        backgroundColor: "#5969ff",
                        label: 'Sales Forecast',
                        data:<?php echo json_encode($combinedAmounts); ?>,
                        borderWidth: 3,
                        fill: false,
                        borderColor: 'blue',  
                        pointBackgroundColor: "rgb(192,192,192)",                  
                    }
                    ]
                },
                options: {
                    legend: {
                    display: false,
                    position: 'top',
                    labels: {
                        fontColor: '#71748d',
                        fontFamily: 'Circular Std Book',
                        fontSize: 22,
                    }
                },
              }
            });
         </script>
      <script src="../js/admin_script.js"></script>
   </body>
</html>