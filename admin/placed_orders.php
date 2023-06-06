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
   <title>Placed Orders</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
   <link rel="stylesheet" href="../css/admin_style.css">


<style>
   .btn-primary {
      background-color: #142d55;
      border-radius: 10px;
   }
    .btn-delete {
      border-radius: 10px;
   background-color: #960e0e;
   color: white;
}
.search-form form {
   display: flex;
   gap: 1rem;
   justify-content: flex-start;
   align-items: center;
   margin-left: 70px;
}
.search-form form input {
   width: 40%; 
   border: var(--border);
   border-radius: .5rem;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   padding: 1rem; 
   font-size: 1.6rem; 
   color: var(--black);
}
.search-form form button {
   font-size: 2rem; 
   height: 4.5rem; 
   line-height: 4.5rem; 
   background-color: var(--main-color);
   cursor: pointer;
   color: var(--white);
   border-radius: .5rem;
   width: 5rem; 
   text-align: center;
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
   <h1 class="heading">Placed Orders</h1>
   
   <div class="search-form">
   <form>
      <input type="text" id="datatableSearch" placeholder="Search...">
      <button type="button" id="datatableSearchButton"><i class="fas fa-search"></i></button>
   </form>
</div>

   <div class="container">
      <table id="ordersTable">
         <thead>
            <tr>
               <th>Placed On</th>
               <th>Name</th>
               <th>Number</th>
               <th>Address</th>
               <th>Total Products</th>
               <th>Total Price</th>
               <th>Payment Method</th>
               <th>Payment Status</th>
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
                     echo '<td>' . $fetch_orders['name'] . '</td>';
                     echo '<td>' . $fetch_orders['number'] . '</td>';
                     echo '<td>' . $fetch_orders['address'] . '</td>';
                     echo '<td>' . $fetch_orders['total_products'] . '</td>';
                     echo '<td>$' . $fetch_orders['total_price'] . '/-</td>';
                     echo '<td>' . $fetch_orders['method'] . '</td>';
                     echo '<td>' . $fetch_orders['payment_status'] . '</td>';
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
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
         echo '<div class="modal fade" id="editModal' . $fetch_orders['id'] . '" tabindex="-1" aria-labelledby="editModalLabel' . $fetch_orders['id'] . '" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="editModalLabel' . $fetch_orders['id'] . '">Edit Payment Status</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="post">
                     <div class="modal-body">
                        <input type="hidden" name="order_id" value="' . $fetch_orders['id'] . '">
                        <div class="mb-3">
                           <label for="paymentStatus' . $fetch_orders['id'] . '" class="form-label">Payment Status:</label>
                           <select name="payment_status" id="paymentStatus' . $fetch_orders['id'] . '" class="form-select">
                              <option value="pending" ' . ($fetch_orders['payment_status'] == 'pending' ? 'selected' : '') . '>Pending</option>
                              <option value="completed" ' . ($fetch_orders['payment_status'] == 'completed' ? 'selected' : '') . '>Completed</option>
                           </select>
                        </div>
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

   $('#datatableSearchButton').on('click', function() {
      var searchValue = $('#datatableSearch').val();
      table.search(searchValue).draw();
   });

       // Add ng filter dropdown sa header
       var paymentStatusColumn = table.column(7);
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
