<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $award_name = $_POST['award_name'];
    $issuing_organization = $_POST['issuing_organization'];
    $date_received = $_POST['date_received'];
    $department = $_POST['department'];

    // File upload handling
    $target_dir = "Recognition_Received/uploads/"; // Ensure this directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if not exists
    }

    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);

    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO awards (award_name, issuing_organization, date_received, department, proof_file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $award_name, $issuing_organization, $date_received, $department, $proof_file);

        if ($stmt->execute()) {
            echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
        }

        $stmt->close();
    } else {
        echo "File upload failed.";
    }

    $conn->close();
}
?>
