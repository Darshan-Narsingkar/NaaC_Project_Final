<?php
session_start();

// Ensure the user is logged in and is a faculty member
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'faculty') {
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

// Check if the faculty ID exists in the session
if (!isset($_SESSION['faculty_id'])) {
    echo json_encode(["error" => "Faculty ID not found"]);
    exit();
}

$faculty_id = $_SESSION['faculty_id']; // Get faculty ID from session

// Include database connection
include('db_connect.php');

// SQL query to fetch faculty details
$sql = "SELECT * FROM faculty WHERE faculty_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$result = $stmt->get_result();
$faculty = $result->fetch_assoc();

// Close database connection
$stmt->close();
$conn->close();

// If no faculty data found
if (!$faculty) {
    echo json_encode(["error" => "No faculty found with the given ID"]);
    exit();
}

// Return faculty details as JSON
echo json_encode($faculty);
?>
