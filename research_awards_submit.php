<?php
 include('db_connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $academic_year = $_POST['academic_year'];
    $faculty_name = $_POST['faculty_name'];
    $department = $_POST['department'];
    $award_name = $_POST['award_name'];
    $award_organization = $_POST['award_organization'];
    $award_date = $_POST['award_date'];

    // Handle file upload
    $target_dir = "research_awards/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $proof_document = basename($_FILES["proof_document"]["name"]);
    $target_file = $target_dir . $proof_document;
    move_uploaded_file($_FILES["proof_document"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO research_awards (academic_year, faculty_name, department, award_name, award_organization, award_date, proof_document) 
            VALUES ('$academic_year', '$faculty_name', '$department', '$award_name', '$award_organization', '$award_date', '$proof_document')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Submission Successful!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
