<?php
session_start();
include_once 'dbconnection.php';

// Check if admin is logged in
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
    exit;
}

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orders_export_' . date('Y-m-d') . '.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Add UTF-8 BOM to fix Excel display issues with special characters
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Set column headers
fputcsv($output, array(
    'Order ID', 
    'Date', 
    'Customer Name', 
    'Email', 
    'Phone',
    'Product',
    'Subtotal',
    'Tax',
    'Shipping',
    'Total',
    'Payment Status',
    'Address',
    'City',
    'Country',
    'ZIP'
));

// Query to get all orders with related information
$query = "SELECT o.*, p.product_name, u.first_name, u.last_name, py.payment_status 
          FROM orders o
          INNER JOIN products p ON o.product_id = p.id
          INNER JOIN users u ON o.user_id = u.id
          LEFT JOIN payment py ON o.user_id = py.user_id AND py.amount = o.total
          ORDER BY o.created_at DESC";

$result = mysqli_query($conn, $query);

// Output each row of data
while ($row = mysqli_fetch_assoc($result)) {
    $address = $row['address1'];
    if (!empty($row['address2'])) {
        $address .= ', ' . $row['address2'];
    }
    
    fputcsv($output, array(
        $row['id'],
        date('Y-m-d', strtotime($row['created_at'])),
        $row['first_name'] . ' ' . $row['last_name'],
        $row['email'],
        $row['phone'],
        $row['product_name'],
        $row['subtotal'],
        $row['tax'],
        $row['shipping'],
        $row['total'],
        $row['payment_status'],
        $address,
        $row['city'],
        $row['country'],
        $row['zip']
    ));
}

// Close the file pointer
fclose($output);
exit;
?>