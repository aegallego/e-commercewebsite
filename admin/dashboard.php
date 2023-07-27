<?php
   include '../components/connect.php';
   
   session_start();
   
   $admin_id = $_SESSION['admin_id'];
   
   if(!isset($admin_id)){
      header('location:admin_login.php');
      exit();
   }

      $checkyear = '';
      $statement = $conn->prepare("SELECT * FROM orders WHERE payment_status='Completed' order by placed_on");
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
 
      // chatgpt
      function generateMonthlySalesData($ordersData, $selectedYear)
      {
          // Initialize arrays to store monthly data
          $monthlyDates = array();
          $monthlyAmounts = array();
      
          // Loop through each month (1 to 12) in the given year
          for ($month = 1; $month <= 12; $month++) {
              // Format the date to match the database date format (assuming day 01 of the month)
              $startDate = date("Y-m-d", strtotime("$selectedYear-$month-01"));
              $endDate = date("Y-m-t", strtotime("$selectedYear-$month-01"));
      
              $monthlyDates[] = date("F Y", strtotime("$selectedYear-$month-01"));
      
              // Calculate the total sales for the month
              $totalSales = 0;
              foreach ($ordersData as $row) {
                  $orderDate = date("Y-m-d", strtotime($row['placed_on']));
                  if ($orderDate >= $startDate && $orderDate <= $endDate) {
                      $totalSales += $row['total_price'];
                  }
              }
              $monthlyAmounts[] = $totalSales;
          }
      
          return array($monthlyDates, $monthlyAmounts);
      }
      
      $selectedYear = date('Y');
      if (isset($_GET['year'])) {
          $selectedYear = (int)$_GET['year'];
      }
      
      // Fetch orders data from the database
      $statement = $conn->prepare("SELECT * FROM orders WHERE payment_status='Completed' ORDER BY placed_on");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
      // Generate annual sales data
      $windowSize = 0; // Adjust the window size as desired
      $date = array();
      $amount = array();
      $movingAverage = array();
      $combinedDates = array();
      $combinedAmounts = array();
      $checkyear = '';
      
      foreach ($result as $row) {
          $year = date('Y', strtotime($row['placed_on']));
      
          if (strpos($checkyear, $year) !== false) {
              $date[] = '';
              $combinedDates[] = '';
          } else {
              $date[] = $year;
              $combinedDates[] = $year;
              $checkyear = $checkyear . ' : ' . $year;
          }
          $windowSize++;
          $amount[] = $row['total_price'];
          $combinedAmounts[] = $row['total_price'];
      }
      $date[] = 'End';
      
      // Calculate the moving average
      $totalAmount = count($combinedAmounts);
      for ($i = 0; $i < $totalAmount - $windowSize + 1; $i++) {
          $sum = array_sum(array_slice($combinedAmounts, $i, $windowSize));
          $average = $sum / $windowSize;
          $movingAverage[] = round($average, 2); // Round the average to 2 decimal places if needed
      }
      $combinedAmounts[] = round($average, 2);
      $combinedDates[] = 'Forecast';
      
      // Generate monthly sales data for the selected year
      list($monthlyDates, $monthlyAmounts) = generateMonthlySalesData($result, $selectedYear);

      ?>



<?php
function generateDailySalesData($ordersData, $selectedYear, $selectedMonth)
{
    // Initialize arrays to store daily data
    $dailyDates = array();
    $dailyAmounts = array();

    // Loop through each day of the selected month
    $lastDayOfMonth = date('t', strtotime("$selectedYear-$selectedMonth-01"));
    for ($day = 1; $day <= $lastDayOfMonth; $day++) {
        // Format the date to match the database date format
        $selectedDate = date("Y-m-d", strtotime("$selectedYear-$selectedMonth-$day"));

        // Initialize the total sales for the day
        $totalSales = 0;

        // Calculate the total sales for the day
        foreach ($ordersData as $row) {
            $orderDate = date("Y-m-d", strtotime($row['placed_on']));
            if ($orderDate === $selectedDate) {
                $totalSales += $row['total_price'];
            }
        }

        $dailyDates[] = date("F j, Y", strtotime("$selectedYear-$selectedMonth-$day"));
        $dailyAmounts[] = $totalSales;
    }

    return array($dailyDates, $dailyAmounts);
}

if (isset($_GET['year']) && isset($_GET['month'])) {
    $selectedYear = (int)$_GET['year'];
    $selectedMonth = (int)$_GET['month'];

    // Fetch orders data from the database
    $statement = $conn->prepare("SELECT * FROM orders WHERE payment_status='Completed' ORDER BY placed_on");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Generate daily sales data for the selected month
    list($dailyDates, $dailyAmounts) = generateDailySalesData($result, $selectedYear, $selectedMonth);
}

// ... (existing PHP code)
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
                  $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status != 'Completed'");
                  $select_pendings->execute([]);
                  if($select_pendings->rowCount() > 0){
                     while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                        $total_pendings += $fetch_pendings['total_price'];
                     }
                  }
                  ?>
               <h3><span>₱ </span><?= number_format($total_pendings,2); ?><span> </span></h3>
               <p>Total Pending Payments</p>
               <a href="placed_orders.php?method=Pending" class="btn">see orders</a>
            </div>
            <div class="box">
               <?php
                  $total_completes = 0;
                  $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
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


         <!-- Add the filter container -->
         <div class="filter-container">
            <label for="report-filter">Select Report:</label>
            <select id="report-filter" onchange="changeReport()">
               <option value="annual">Annual Report</option>
               <option value="monthly">Monthly Report</option>
            </select>
            <label for="year-filter">Select Year:</label>
            <select id="year-filter" onchange="changeYear()">
               <?php
               // Show the last 5 years, adjust the range as needed
               for ($year = date('Y'); $year >= date('Y') - 4; $year--) {
                  echo "<option value='$year'" . ($year === $selectedYear ? ' selected' : '') . ">$year</option>";
               }
               ?>
            </select>
            <button class = "expf" onclick="downloadData()">Download Sales Report</button>

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
         function changeReport() {
            var selectedReport = document.getElementById("report-filter").value;
            var ctx2 = document.getElementById("chartjs_bar2").getContext('2d');
            var ctx3 = document.getElementById("chartjs_bar3").getContext('2d');

            if (selectedReport === "annual") {
               myChart2.data.labels = <?php echo json_encode($date); ?>;
               myChart2.data.datasets[0].data = <?php echo json_encode($amount); ?>;
               myChart2.update();

               myChart3.data.labels = <?php echo json_encode($combinedDates); ?>;
               myChart3.data.datasets[0].data = <?php echo json_encode($combinedAmounts); ?>;
               myChart3.update();
            } else if (selectedReport === "monthly") {
               myChart2.data.labels = <?php echo json_encode($monthlyDates); ?>;
               myChart2.data.datasets[0].data = <?php echo json_encode($monthlyAmounts); ?>;
               myChart2.update();

               myChart3.data.labels = <?php echo json_encode($monthlyDates); ?>;
               myChart3.data.datasets[0].data = <?php echo json_encode($monthlyAmounts); ?>;
               myChart3.update();
            }
         }

         function changeYear() {
            var selectedYear = document.getElementById("year-filter").value;
            window.location.href = "dashboard.php?year=" + selectedYear; // Redirect to the selected year's report
         }

         var ctx2 = document.getElementById("chartjs_bar2").getContext('2d');
         var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
               labels:<?php echo json_encode($date); ?>,
               datasets: [{
                  backgroundColor: "#5969ff",
                  label: 'Actual Sales ',
                  data:<?php echo json_encode($amount); ?>,
                  borderWidth: 3,
                  fill: false,
                  borderColor: 'green',
                  pointBackgroundColor: "rgb(192,192,192)",
               }]
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

         var ctx3 = document.getElementById("chartjs_bar3").getContext('2d');
         var myChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
               labels:<?php echo json_encode($combinedDates); ?>,
               datasets: [{
                  backgroundColor: "#5969ff",
                  label: 'Sales Forecast',
                  data:<?php echo json_encode($combinedAmounts); ?>,
                  borderWidth: 3,
                  fill: false,
                  borderColor: 'blue',
                  pointBackgroundColor: "rgb(192,192,192)",
               }]
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

<script type="text/javascript">

    function downloadData() {
        // Get the selected report type
        var selectedReport = document.getElementById("report-filter").value;

        // Prepare the data to download based on the selected report type
        var csvContent = "";
        if (selectedReport === "daily") {
            csvContent += "Date,Actual Sales,Forecasted Sales\n";
            for (var i = 0; i < myChart2.data.labels.length; i++) {
                csvContent += myChart2.data.labels[i] + ",";
                csvContent += myChart2.data.datasets[0].data[i] + ",";
                csvContent += myChart3.data.datasets[0].data[i] + "\n";
            }
        } else if (selectedReport === "monthly") {
            csvContent += "Month,Actual Sales,Forecasted Sales\n";
            for (var i = 0; i < myChart2.data.labels.length; i++) {
                csvContent += myChart2.data.labels[i] + ",";
                csvContent += myChart2.data.datasets[0].data[i] + ",";
                csvContent += myChart3.data.datasets[0].data[i] + "\n";
            }
        } else if (selectedReport === "annual") {
            csvContent += "Year,Actual Sales,Forecasted Sales\n";
            for (var i = 0; i < myChart2.data.labels.length; i++) {
                csvContent += myChart2.data.labels[i] + ",";
                csvContent += myChart2.data.datasets[0].data[i] + ",";
                csvContent += myChart3.data.datasets[0].data[i] + "\n";
            }
        }

        // Create a temporary link element to trigger the download
        var link = document.createElement("a");
        link.setAttribute("href", "data:text/csv;charset=utf-8," + encodeURIComponent(csvContent));
        link.setAttribute("download", selectedReport + "_report.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

</script>

      <script src="../js/admin_script.js"></script>
   </body>

</html>