<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_name = $_POST['program_name'];
    $date_conducted = $_POST['date_conducted'];
    $participants = $_POST['participants'];
    $key_outcomes = $_POST['key_outcomes'];
    $department = $_POST['department'];
    $status = '0'; // Default status (Pending)

    // File Upload Handling
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/NaaC_Project/NaaC_Project1/Entrepreneurship/files/";
    
    // Ensure directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    $proof_file_name = basename($_FILES["proof_file"]["name"]);
    $proof_file_path = $target_dir . $proof_file_name;

    // Check if file is uploaded properly
    if ($_FILES["proof_file"]["error"] === 0) {
        if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file_path)) {
            // Store the relative path to the database
            $proof_file_db_path = "Entrepreneurship/files/" . $proof_file_name;

            // Database Insert Query
            $sql = "INSERT INTO entrepreneurship_programs 
                (program_name, date_conducted, participants, key_outcomes, department, proof_file, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssissss", $program_name, $date_conducted, $participants, $key_outcomes, $department, $proof_file_db_path, $status);

            if ($stmt->execute()) {
                echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
            }

            $stmt->close();
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        echo "Error: File upload failed with error code " . $_FILES["proof_file"]["error"];
    }

    $conn->close();
}
?>
