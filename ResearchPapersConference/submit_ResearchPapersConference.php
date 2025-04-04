<?php
 include('db_connect.php');
// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paper_title = $_POST['paper_title'];
    $proceedings_title = $_POST['proceedings_title'];
    $department = $_POST['department'];
    $conference_name = $_POST['conference_name'];
    $conference_type = $_POST['conference_type'];
    $isbn_issn = $_POST['isbn_issn'];
    $publisher = $_POST['publisher'];
    $affiliating_institute = $_POST['affiliating_institute'];

    // Handle file upload
    $target_dir = "ResearchPapersConference/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if not exists
    }
    
    $proof_file = $target_dir . basename($_FILES["proof_file"]["name"]);
    move_uploaded_file($_FILES["proof_file"]["tmp_name"], $proof_file);

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO conference_papers 
        (paper_title, proceedings_title, department, conference_name, conference_type, isbn_issn, publisher, affiliating_institute, proof_file) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssss", $paper_title, $proceedings_title, $department, $conference_name, $conference_type, $isbn_issn, $publisher, $affiliating_institute, $proof_file);

    if ($stmt->execute()) {
        echo "<script>alert('Paper submitted successfully!'); window.location.href='../index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
