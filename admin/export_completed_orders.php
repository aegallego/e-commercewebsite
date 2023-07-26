<?php
include '../components/connect.php';

// Retrieve the selected year from the URL parameter
if (isset($_GET['year'])) {
    $selectedYear = $_GET['year'];
} else {
    // If no year is selected, redirect back to the previous page
    header('Location: placed_orders.php');
    exit;
}

// Fetch data from the database for the selected year
$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE YEAR(placed_on) = ?");
$select_orders->execute([$selectedYear]);
$ordersData = $select_orders->fetchAll(PDO::FETCH_ASSOC);

// Create a CSV file
$filename = 'completed_orders_' . $selectedYear . '.csv';

// Set headers for download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Open file pointer to php output stream
$output = fopen('php://output', 'w');

// Set CSV header row
fputcsv($output, array('Placed On', 'Order ID', 'ID', 'Name', 'Email', 'Number', 'Address', 'Products', 'Total Price', 'Payment Method', 'Payment Status', 'Courier Type', 'Status'));

// Fill in the data from the database
foreach ($ordersData as $order) {
    $row = array(
        $order['placed_on'],
        $order['id'],
        $order['user_id'],
        $order['name'],
        $order['email'],
        $order['number'],
        $order['address'],
        $order['total_products'],
        '₱' . $order['total_price'],
        $order['method'],
        $order['payment_status'],
        $order['courier_type'],
        $order['order_tracking']
    );

    fputcsv($output, $row);
}

// Close the file pointer
fclose($output);
exit;
?>
