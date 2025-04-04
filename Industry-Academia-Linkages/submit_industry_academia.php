<?php
include 'db_connect.php'; // Ensure db_connect.php correctly initializes $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $industry_name = $_POST['industry_name'];
    $collaboration_type = $_POST['collaboration_type'];
    $beneficiaries = $_POST['beneficiaries'];
    $department = $_POST['department'];

    // Ensure upload directory exists
    $target_dir = "Industry-Academia-Linkages/uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    // Handle file upload
    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Ensure database connection is established
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO industry_academia (industry_name, collaboration_type, beneficiaries, department, proof_file) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt) {
            $stmt->bind_param("ssiss", $industry_name, $collaboration_type, $beneficiaries, $department, $proof_file);
            
            if ($stmt->execute()) {
                echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('SQL Execution Error: " . addslashes($stmt->error) . "');</script>";
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "File upload failed!";
    }
}
?>
