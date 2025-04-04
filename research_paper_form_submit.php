<?php
 include('db_connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $academic_year = $_POST['academic_year'];
    $faculty_name = $_POST['faculty_name'];
    $department = $_POST['department'];
    $paper_title = $_POST['paper_title'];
    $journal_name = $_POST['journal_name'];
    $journal_type = $_POST['journal_type'];
    $ISSN_number = $_POST['ISSN_number'];
    $publication_date = $_POST['publication_date'];

    // File upload handling
    $upload_dir = "research_paper/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $proof_document = '';
    if (isset($_FILES['proof_document']) && $_FILES['proof_document']['error'] == 0) {
        $proof_document = basename($_FILES['proof_document']['name']);
        $upload_file = $upload_dir . $proof_document;

        if (!move_uploaded_file($_FILES['proof_document']['tmp_name'], $upload_file)) {
            echo "<script>alert('Error uploading file.'); window.location.href='research_paper_form.php';</script>";
            exit();
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO research_papers (academic_year, faculty_name, department, paper_title, journal_name, journal_type, ISSN_number, publication_date, proof_document) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $academic_year, $faculty_name, $department, $paper_title, $journal_name, $journal_type, $ISSN_number, $publication_date, $proof_document);

    if ($stmt->execute()) {
        echo "<script>alert('Record inserted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='research_paper_form.php';</script>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
