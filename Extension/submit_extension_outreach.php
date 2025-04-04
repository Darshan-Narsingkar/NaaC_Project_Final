<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_name = $_POST['program_name'];
    $date_conducted = $_POST['date_conducted'];
    $participants = $_POST['participants'];
    $department = $_POST['department'];
    $key_outcomes = $_POST['key_outcomes'];

    // File upload handling
    $target_dir = "Extension/uploads/"; // Ensure this directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if not exists
    }

    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);

    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO extension_outreach (program_name, date_conducted, participants, department, key_outcomes, proof_file) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $program_name, $date_conducted, $participants, $department, $key_outcomes, $proof_file);

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
