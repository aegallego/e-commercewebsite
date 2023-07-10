<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);

   $order_id = $_POST['order_id'];
   $courier_type = $_POST['courier_type'];
   $courier_type = filter_var($courier_type, FILTER_SANITIZE_STRING);
   if($courier_type == ''){
      $update_payment = $conn->prepare("UPDATE `orders` SET courier_type = ? WHERE id = ?");
      $update_payment->execute([$courier_type = "-", $order_id]);
   }else{
      $update_payment = $conn->prepare("UPDATE `orders` SET courier_type = ? WHERE id = ?");
      $update_payment->execute([$courier_type, $order_id]);
   }

   $order_id = $_POST['order_id'];
   $order_tracking = $_POST['order_tracking'];
   $order_tracking = filter_var($order_tracking, FILTER_SANITIZE_STRING);
   if($order_tracking == ''){
      $update_payment = $conn->prepare("UPDATE `orders` SET order_tracking = ? WHERE id = ?");
      $update_payment->execute([$order_tracking = "-", $order_id]);
   }else{
      $update_payment = $conn->prepare("UPDATE `orders` SET order_tracking = ? WHERE id = ?");
      $update_payment->execute([$order_tracking, $order_id]);
   }
   
   $message[] = 'Payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="../images/logo.png" type="image/x-icon"/>   
   
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">   

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>  <!-- sorting arrows-->
  
   
   
   


   
<style>

.custom-container {
   width: 97vw ;
   margin-top: 2%;
   display: block;
   overflow: auto;
   align-items: center;
   text-align: center;
   border: 1px solid black;
   border-radius: 10px;
   border-collapse: collapse;
   background-color: var(--white);
}


/* 
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}
.modal-body{
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-decoration: none;
}
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    color: var(--bs-modal-color);
    pointer-events: auto;
    background-color: var(--bs-modal-bg);
    background-clip: padding-box;
    border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
    border-radius: var(--bs-modal-border-radius);
    outline: 0;
}
.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: var(--bs-modal-header-padding);
    border-bottom: var(--bs-modal-header-border-width) solid var(--bs-modal-header-border-color);
    border-top-left-radius: var(--bs-modal-inner-border-radius);
    border-top-right-radius: var(--bs-modal-inner-border-radius);
}
.modal.show .modal-dialog {
    transform: none;
}
.modal.fade .modal-dialog {
    transition: transform .3s ease-out;
    transform: translate(0,-50px);
}

.modal-dialog {
    max-width: var(--bs-modal-width);
    margin-right: auto;
    margin-left: auto;
}
.modal-dialog {
    position: relative;
    width: auto;
    margin: var(--bs-modal-margin);
    pointer-events: none;
} 
.modal {
  z-index: 1050;
}

.modal-backdrop {
  z-index: 1040;
}
*/
.btn{
display: flex;
width: 100%; 
margin-top: 1.2rem;
border-radius: .5rem;
padding: 1rem 3rem;
font-size: 1.4rem;
color: var(--white);
cursor: pointer;
text-align: center;
justify-content: center;
align-content: flex-end;
}
a{
   text-decoration: none;
}
.btn-primary {
      background-color: #0856cf;
      border-radius: 10px;
      /* width: 5%; */
      font-size: 1.5rem;
   }
.btn-delete {
   border-radius: 10px;
   background-color: #142d55;
   color: white;
   /* width: 5%; */
   font-size: 1.5rem;
}
.search-form form{
   display: flex;
   gap:1rem;
}

.search-form form input{
   width: 60%;
   border:var(--border);
   border-radius: .5rem;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   padding:1.4rem;
   margin-left: 17.5%;
   font-size: 1.8rem;
   color:var(--black);
}

.search-form form button{
   font-size: 2.5rem;
   height: 5.5rem;
   line-height: 5.5rem;
   background-color: var(--main-color);
   cursor: pointer;
   color:var(--white);
   border-radius: .5rem;
   width: 6rem;
   text-align: center;
}
.header .flex .navbar a{
   margin:0 1rem;
   font-size: 2rem;
   color:var(--black);
   text-decoration: none;
   text-transform: capitalize;
}

.header .flex .navbar a:hover{
   color:var(--main-color);
   text-decoration: none;
}


.search-form form button:hover{
   background-color: var(--black);
}
.sorting{
   font-style: 'Poppins';
   font-size:1.5em;
   font-weight: bolder;
}
.sorting_1{
   font-style: 'Poppins';
   font-size:1.5rem;
   justify-content: center;
   text-align: center;
}
td{
   font-style: 'Poppins';
   font-size:1.5rem;
   justify-content: center;
   text-align: center;
}

a.logo{
   text-decoration: none;
}
 .search-form form button:hover {
   background-color: var(--black);
}
      .dataTables_wrapper .dataTables_filter {
   display: none;
}
#ordersTable tr:nth-child(even) {
    background-color: #B7E3FF !important;
}
#ordersTable tr:nth-child(odd) {
    background-color: #57e3ff!important;
    ;
}
#ordersTable tr:nth-child(1) {
    background-color: #57e3ff!important;
    ;
}



</style>
</head>
<body>
<?php include '../components/admin_header.php'; ?>

<section class="orders">


   <center><b h1 class="heading">Placed Orders</h1></b></center>
   
   <div class="search-form">
   <form>
      <input type="text" id="datatableSearch" placeholder="Search...">
      <button type="button" id="datatableSearchButton"><i class="fas fa-search"></i></button>
   </form>
</div>

   <div class="custom-container">
      <table id="ordersTable">
         <thead>
            <tr>
               <th>Placed On</th>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Number</th>
               <th>Address</th>
               <th>Products</th>
               <th>Total Price</th>
               <th>Payment Method</th>
               <th>Payment Status</th>
               <th>Courier Type</th>
               <th>Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders`");
               $select_orders->execute();
               if($select_orders->rowCount() > 0){
                  while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                     echo '<tr>';
                     echo '<td>' . $fetch_orders['placed_on'] . '</td>';
                     echo '<td>' . $fetch_orders['user_id'] . '</td>';
                     echo '<td>' . $fetch_orders ['name'] .'</td>';
                     echo '<td>' . $fetch_orders ['email'] .'</td>';
                     echo '<td>' . $fetch_orders['number'] . '</td>';
                     echo '<td>' . $fetch_orders['address'] . '</td>';
                     echo '<td>' . $fetch_orders['total_products'] . '</td>';
                     echo '<td>₱' . $fetch_orders['total_price'] . '</td>';
                     echo '<td>' . $fetch_orders['method'] . '</td>';
                     echo '<td>' . $fetch_orders['payment_status'] . '</td>';
                     echo '<td>' . $fetch_orders['courier_type'] . '</td>';
                     echo '<td>' . $fetch_orders['order_tracking'] . '</td>';
                     echo '<td>
   <div class="btn-group" role="group">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal' . $fetch_orders['id'] . '">Edit</button>
      <a href="placed_orders.php?delete=' . $fetch_orders['id'] . '" class="btn btn-danger btn-delete" onclick="return confirm(\'Delete this order?\');">Delete</a>
   </div>
</td>';
                     echo '</tr>';
                  }
               }
            ?>
         </tbody>
      </table>
   </div>
</section>
<?php
$select_orders = $conn->prepare("SELECT * FROM `orders`");
$select_orders->execute();
if ($select_orders->rowCount() > 0) {
   while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class="modal fade" id="editModal' . $fetch_orders['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $fetch_orders['id'] . '" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel' . $fetch_orders['id'] . '">Edit Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="" method="post">
                        <div class="modal-body">
                           <input type="hidden" name="order_id" value="' . $fetch_orders['id'] . '">
                           <p>Courier Type:</p>
                           <input type="hidden" name="courier_type" value="">
                           <select name="courier_type" id="courierType' . $fetch_orders['id'] . '" class="select" ' . ($fetch_orders['payment_status'] == "Pending" ? 'disabled' : '') . '>
                              <option>' . $fetch_orders['courier_type'] . '</option>
                              <!-- <option selected disabled>-</option> -->
                              <option value="Own">Own</option>
                              <option value="Third-party">Third-party</option>
                           </select>
                           <p>Status:</p>
                           <input type="hidden" name="order_tracking" value="">
                           <select name="order_tracking" id="orderTracking' . $fetch_orders['id'] . '" class="select" ' . ($fetch_orders['payment_status'] == "Pending" ? 'disabled' : '') . '>
                              <option>' . $fetch_orders['order_tracking'] . '</option>
                              <!-- <option selected disabled>-</option> -->
                              <option value="Packed">Packed</option>
                              // <option value="To Ship">To Ship</option>
                              <option value="Picked-up">Picked-up</option>
                              <option value="To Receive">To Receive</option>
                              <option value="Completed">Completed</option>
                           </select>
                           <p>Payment Status:</p>
                           <select name="payment_status" id="paymentStatus' . $fetch_orders['id'] . '" class="select">
                              <option>' . $fetch_orders['payment_status'] . '</option>
                              <!-- <option selected disabled>-</option> -->
                              <option value="Pending">Pending</option>
                              <option value="Completed">Completed</option>
                           </select>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary" name="update_payment">Save Changes</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>';
   }
}
?>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="../js/admin_script.js"></script>

<script>
$(document).ready(function() {
   var table = $('#ordersTable').DataTable({
      dom: 'Bfrtip',
      searching: true,
      scrollX: true
   });

   $('#datatableSearch').on('input', function() {
   var searchValue = $(this).val();
   table.search(searchValue).draw();
});

       // Add ng filter dropdown sa header
       var paymentStatusColumn = table.column(9);
    var paymentStatusData = paymentStatusColumn.data().unique();
    var paymentStatusFilter = $('<select class="filter-dropdown"><option value="">All</option></select>');

    // append sa header cell
    $(paymentStatusColumn.header()).append(paymentStatusFilter);

    paymentStatusFilter.on('change', function () {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        paymentStatusColumn.search(val ? '^' + val + '$' : '', true, false).draw();
    });

    paymentStatusData.sort().each(function (d) {
        paymentStatusFilter.append('<option value="' + d + '">' + d + '</option>');
    });
         $('.modal').on('hidden.bs.modal', function () {
         $(this).find('form')[0].reset();
      });
});
</script>

</body>
</html>