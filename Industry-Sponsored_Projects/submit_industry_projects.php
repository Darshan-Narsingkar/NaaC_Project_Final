<?php
include('db_connect.php');

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_title = $_POST['project_title'];
    $industry_partner = $_POST['industry_partner'];
    $industry_type = $_POST['industry_type'];
    $funding_amount = $_POST['funding_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $department = $_POST['department'];

    // Handle file upload
    $target_dir = "Industry-Sponsored_Projects/files/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    
    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Insert data into database
        $sql = "INSERT INTO industry_projects (project_title, industry_partner, industry_type, funding_amount, start_date, end_date, department, proof_file) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $project_title, $industry_partner, $industry_type, $funding_amount, $start_date, $end_date, $department, $proof_file);

        if ($stmt->execute()) {
            echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
        }
        
        $stmt->close();
    } else {
        echo "File upload failed.";
    }
}

$conn->close();
?>
