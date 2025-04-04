<?php
include 'db_connect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ngo_name = $_POST['ngo_name'];
    $collaboration_type = $_POST['collaboration_type'];
    $beneficiaries = $_POST['beneficiaries'];
    $department = $_POST['department'];

    // File Upload Handling
    $target_dir = "CollaborationsNGO/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);

    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO ngos_collaborations (ngo_name, collaboration_type, beneficiaries, department, proof_file) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $ngo_name, $collaboration_type, $beneficiaries, $department, $proof_file);

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
