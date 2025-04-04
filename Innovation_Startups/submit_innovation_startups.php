<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startup_name = $_POST['startup_name'];
    $founders = $_POST['founders'];
    $year_established = $_POST['year_established'];
    $funding_received = $_POST['funding_received'];
    $industry_collaborations = $_POST['industry_collaborations'];
    $department = $_POST['department'];
    $status = '0'; // Default status (Pending)

    // File Upload Handling
    $target_dir = "Innovation_Startups/files/";
    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file);

    // Database Insert Query
    $sql = "INSERT INTO innovation_startups 
        (startup_name, founders, year_established, funding_received, industry_collaborations, department, proof_file, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidssss", $startup_name, $founders, $year_established, $funding_received, $industry_collaborations, $department, $proof_file, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
    }
    $stmt->close();
    $conn->close();
}
?>
