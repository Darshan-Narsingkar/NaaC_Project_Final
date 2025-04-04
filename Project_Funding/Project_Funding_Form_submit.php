<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_nature = $_POST['project_nature'];
    $duration = $_POST['duration'];
    $funding_agency = $_POST['funding_agency'];
    $total_grant = $_POST['total_grant'];
    $amount_received = $_POST['amount_received'];
    $department = $_POST['department'];

    // Handling file upload
    $proof_file = "";
    if (!empty($_FILES['proof_file']['name'])) {
        $target_dir = "Project_Funding/Project_Funding_files/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
        move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file);
    }

    // Insert data into database
    $sql = "INSERT INTO project_funding (project_nature, duration, funding_agency, total_grant, amount_received, department, proof_file)
            VALUES ('$project_nature', '$duration', '$funding_agency', '$total_grant', '$amount_received', '$department', '$proof_file')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data submitted successfully!'); window.location.href='../index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
