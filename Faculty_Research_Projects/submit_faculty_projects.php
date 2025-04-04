<?php
session_start();
include('db_connect.php'); // Ensure database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the user is logged in and is a faculty member
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'faculty') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form inputs
    $project_title = trim($_POST['project_title']);
    $pi_name = trim($_POST['pi_name']);
    $co_investigators = !empty($_POST['co_investigators']) ? trim($_POST['co_investigators']) : NULL;
    $department = trim($_POST['department']);
    $funding_agency = !empty($_POST['funding_agency']) ? trim($_POST['funding_agency']) : NULL;
    $grant_amount = isset($_POST['grant_amount']) && is_numeric($_POST['grant_amount']) 
        ? number_format((float)$_POST['grant_amount'], 2, '.', '') 
        : NULL;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $research_objectives = !empty($_POST['research_objectives']) ? trim($_POST['research_objectives']) : NULL;
    $research_outcomes = !empty($_POST['research_outcomes']) ? trim($_POST['research_outcomes']) : NULL;

    // File Upload Handling
    $target_dir = "Faculty_Research_Projects/projectinfo/";

    // Ensure the directory exists
    if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
        die("<script>alert('Failed to create upload directory.');</script>");
    }

    // Process file upload
    $proof_file = $_FILES['proof_file']['name'];
    $proof_tmp = $_FILES['proof_file']['tmp_name'];
    $proof_path = $target_dir . basename($proof_file);

    if ($_FILES['proof_file']['error'] !== UPLOAD_ERR_OK) {
        die("<script>alert('File upload error: " . $_FILES['proof_file']['error'] . "');</script>");
    }

    if (!move_uploaded_file($proof_tmp, $proof_path)) {
        die("<script>alert('File upload failed! Debug info: tmp_name=$proof_tmp, target_path=$proof_path');</script>");
    }

    // Prepare SQL query (without status)
    $sql = "INSERT INTO faculty_projects 
            (project_title, pi_name, co_investigators, department, funding_agency, grant_amount, start_date, end_date, research_objectives, research_outcomes, proof_file) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssdsssss", 
            $project_title, $pi_name, $co_investigators, $department, $funding_agency, 
            $grant_amount, $start_date, $end_date, $research_objectives, $research_outcomes, 
            $proof_path
        );

        if ($stmt->execute()) {
            echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>alert('SQL Statement Preparation Failed: " . addslashes($conn->error) . "');</script>";
    }

    $conn->close();
}
?>
