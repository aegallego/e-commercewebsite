<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Accounts | Gemstar Cleaning Supplies International</title>
   <link rel="icon"  href="../images/logo.png" type="image/x-icon"/>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>  <!-- sorting arrows-->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
   <style>

a{
   text-decoration: none;
}
   .btn-primary {
      background-color: #0856cf;
      border-radius: 10px;
      width: 5%;
      font-size: 1rem;
   }
    .btn-delete {
      border-radius: 10px;
   background-color: #142d55;
   color: white;
   width: 5%;
      font-size: 1rem;
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
   width: 10%;
}
a.logo{
   text-decoration: none;
}

.container {
   margin-top: 2%;
   margin-left: 6%;
   width: 85vw;
   display: block;
   overflow: auto;
   align-items: center;
   text-align: center;
   border: 1px solid black;
   border-radius: 10px;
   border-collapse: collapse;
   background-color: white;
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
}.modal {
  z-index: 1050; /* Adjust the value if needed */
}

.modal-backdrop {
  z-index: 1040; /* Adjust the value if needed */
}


</style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">user accounts</h1>
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
               <th>User ID</th>
               <th>Username</th>
               <th>Email</th>
            </tr>
            </thead>
         <tbody>
   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){ 
            echo '<tr>';
            echo '<td>' . $fetch_accounts['id'] . '</td>';
            echo '<td>' . $fetch_accounts ['name'] .'</td>';
            echo '<td>' . $fetch_accounts ['email'] .'</td>';
         }?>
         </tbody>
      </table>
   </div>
</section>
   <?php
         }
      else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>


<script src="../js/admin_script.js"></script>
   
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
