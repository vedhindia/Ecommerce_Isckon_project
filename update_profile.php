<?php
include 'admin/dbconnection.php';
include 'check-auth.php';

// Require login for this page
requireLogin();

// Get current user ID from session
$user_id = $_SESSION['user_id'];

// Ensure form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : null;
    $city = isset($_POST['city']) ? mysqli_real_escape_string($conn, $_POST['city']) : null;
    $state = isset($_POST['state']) ? mysqli_real_escape_string($conn, $_POST['state']) : null;
    $pincode = isset($_POST['pincode']) ? mysqli_real_escape_string($conn, $_POST['pincode']) : null;

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($current_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields cannot be empty']);
        exit;
    }

    // Verify current password
    $query = "SELECT password FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
    }

    $user = mysqli_fetch_assoc($result);
    if (!password_verify($current_password, $user['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect']);
        exit;
    }

    // Check if email already exists (for another user)
    $query = "SELECT id FROM users WHERE email = '$email' AND id != $user_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        exit;
    }

    // Update query
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $query = "UPDATE users SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    email = '$email',
                    phone = '$phone',
                    address = '$address',
                    city = '$city',
                    state = '$state',
                    pincode = '$pincode',
                    password = '$hashed_password' 
                    WHERE id = $user_id";
    } else {
        $query = "UPDATE users SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    email = '$email',
                    phone = '$phone',
                    address = '$address',
                    city = '$city',
                    state = '$state',
                    pincode = '$pincode' 
                    WHERE id = $user_id";
    }

    // Execute query
    if (mysqli_query($conn, $query)) {
        // Update session data if email has changed
        if ($_SESSION['email'] != $email) {
            $_SESSION['email'] = $email;
        }

        // Success: Alert and redirect
        echo "<script>
                alert('Profile updated successfully!');
                window.location.href = 'account-info.php';  // Redirect to desired page
              </script>";
    } else {
        // Error: Show error message
        echo "<script>
                alert('Failed to update profile: " . mysqli_error($conn) . "');
                window.location.href = 'account-info.php';  // Redirect to desired page
              </script>";
    }

    // Close connection
    mysqli_close($conn);
}
?>
