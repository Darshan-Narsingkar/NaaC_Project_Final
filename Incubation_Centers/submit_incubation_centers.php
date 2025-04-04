<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $center_name = $_POST['center_name'];
    $year_established = $_POST['year_established'];
    $affiliated_institution = $_POST['affiliated_institution'];
    $funding_received = $_POST['funding_received'];
    $startups_supported = $_POST['startups_supported'];
    $department = $_POST['department'];
    $facilities_provided = $_POST['facilities_provided'];
    $status = '0'; // Default status (Pending)

    // File Upload Handling
    $target_dir = "Incubation_Centers/files";
    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file);

    // Database Insert Query
    $sql = "INSERT INTO incubation_centers 
        (center_name, year_established, affiliated_institution, funding_received, startups_supported, department, proof_file, facilities_provided, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisdissss", $center_name, $year_established, $affiliated_institution, $funding_received, $startups_supported, $department, $proof_file, $facilities_provided, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
