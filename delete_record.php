<?php
// Database connection
include('db_connect.php');

// Get the ID from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $mous_id = intval($_GET['id']); // Ensure it's an integer

    // Prepare DELETE query
    $sql = "DELETE FROM MoUs_data WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mous_id);

    if ($stmt->execute()) {
        // Redirect back to main page after deletion
        header("Location: hod.php?msg=Record deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request!";
}

$conn->close();
?> 