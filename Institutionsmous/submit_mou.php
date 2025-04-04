<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $institution_name = $_POST['institution_name'];
    $mou_signed_date = $_POST['mou_signed_date'];
    $mou_purpose = $_POST['mou_purpose'];
    $department = $_POST['department'];

    // File Upload Handling
    $target_dir = "Institutionsmous/mou_files/"; // Ensure this folder exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create folder if it doesn't exist
    }

    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    
    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Insert into Database
        $sql = "INSERT INTO mou_institutions 
                (institution_name, mou_signed_date, mou_purpose, department, proof_file) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $institution_name, $mou_signed_date, $mou_purpose, $department, $proof_file);

        
        if ($stmt->execute()) {
            echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>
