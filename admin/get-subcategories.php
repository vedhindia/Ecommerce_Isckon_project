<?php
session_start();
include_once 'dbconnection.php';
if (empty($_SESSION['admin_session'])) {
    header('Location:login.php');
}


// Get main category from request
if(isset($_GET['main_category'])) {
    $main_category = mysqli_real_escape_string($conn, $_GET['main_category']);
    
    // Fetch subcategories for the given main category
    $query = "SELECT DISTINCT subcategory_name FROM subcategories WHERE category_name = '$main_category' ORDER BY subcategory_name";
    $result = mysqli_query($conn, $query);
    
    $subcategories = [];
    
    while($row = mysqli_fetch_assoc($result)) {
        $subcategories[] = $row['subcategory_name'];
    }
    
    // Return as JSON
    header('Content-Type: application/json');
    echo json_encode($subcategories);
} else {
    // Return empty array if no main category provided
    header('Content-Type: application/json');
    echo json_encode([]);
}
?>