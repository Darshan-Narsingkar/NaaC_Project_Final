<?php
session_start();
include('db_connect.php');
// Check if the user is logged in
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if faculty_id is set in the session (it should be when logged in)
if (!isset($_SESSION['faculty_id'])) {
    die("Faculty ID is missing. Please log in again.");
}

$faculty_id = $_SESSION['faculty_id']; // Get the faculty_id from the session


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        header("Location: change_password_form.php?error=New password and confirmation do not match");
        exit();
    }

    // Fetch the current password from the database using faculty_id
    $sql = "SELECT password FROM faculty WHERE faculty_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Compare the entered old password with the stored password (plain text)
        if ($old_password === $user['password']) {
            // If passwords match, update the new password
            $update_sql = "UPDATE faculty SET password = ? WHERE faculty_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_password, $faculty_id);
            if ($update_stmt->execute()) {
                header("Location: change_password_form.php?message=Password successfully updated");
                exit();
            } else {
                header("Location: change_password_form.php?error=Error updating password");
                exit();
            }
        } else {
            header("Location: change_password_form.php?error=Old password is incorrect");
            exit();
        }
    } else {
        header("Location: change_password_form.php?error=User not found");
        exit();
    }
}

$conn->close();
?>
