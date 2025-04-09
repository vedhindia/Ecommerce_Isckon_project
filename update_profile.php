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
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : null;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : null;
    $city = isset($_POST['city']) ? mysqli_real_escape_string($conn, $_POST['city']) : null;
    $state = isset($_POST['state']) ? mysqli_real_escape_string($conn, $_POST['state']) : null;
    $pincode = isset($_POST['pincode']) ? mysqli_real_escape_string($conn, $_POST['pincode']) : null;
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($current_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields cannot be empty']);
        exit;
    }

    // Verify current password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
    }

    $user = $result->fetch_assoc();
    if (!password_verify($current_password, $user['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect']);
        exit;
    }

    // Check if email already exists (for another user)
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
        exit;
    }

    // Prepare update query (no password change)
    $stmt = $conn->prepare("UPDATE users SET 
                        first_name = ?, 
                        last_name = ?, 
                        email = ?,
                        phone = ?,
                        address = ?,
                        city = ?,
                        state = ?,
                        pincode = ?,
                        newsletter = ? 
                        WHERE id = ?");

    $stmt->bind_param("ssssssssii", 
            $first_name, 
            $last_name, 
            $email,
            $phone,
            $address,
            $city,
            $state,
            $pincode,
            $newsletter,
            $user_id);

    // Execute the query
    if ($stmt->execute()) {
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
                alert('Failed to update profile: " . $conn->error . "');
                window.location.href = 'account-info.php';  // Redirect to desired page
              </script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
