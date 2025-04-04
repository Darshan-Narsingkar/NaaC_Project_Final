<?php
session_start();

include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $academic_year = trim($_POST['academic_year']);
    $faculty_name = trim($_POST['faculty_name']);
    $department = trim($_POST['department']);
    $publication_type = trim($_POST['publication_type']);
    $title = trim($_POST['title']);
    $publisher_name = trim($_POST['publisher_name']);
    $ISBN_number = trim($_POST['ISBN_number']);

    // Handle File Upload
    $target_dir = "book_chapter_publications/";

    // Ensure directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["proof_document"]["name"]);
    $file_tmp = $_FILES["proof_document"]["tmp_name"];
    $file_size = $_FILES["proof_document"]["size"];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'png']; // Allowed file types
    $max_size = 5 * 1024 * 1024; // 5MB file size limit

    // Validate file type
    if (!in_array($file_type, $allowed_types)) {
        echo "<script>alert('Invalid file type! Only PDF, DOC, DOCX, JPG, PNG are allowed.'); window.history.back();</script>";
        exit;
    }

    // Validate file size
    if ($file_size > $max_size) {
        echo "<script>alert('File too large! Maximum 5MB allowed.'); window.history.back();</script>";
        exit;
    }

    // Set file path
    $proof_document = $target_dir . time() . "_" . $file_name; // Add timestamp to avoid duplicate names

    // Move file
    if (!move_uploaded_file($file_tmp, $proof_document)) {
        echo "<script>alert('Error uploading file.'); window.history.back();</script>";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO book_chapter_publications 
            (academic_year, faculty_name, department, publication_type, title, publisher_name, ISBN_number, proof_document, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, '0')";  // '0' = Pending status

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $academic_year, $faculty_name, $department, $publication_type, $title, $publisher_name, $ISBN_number, $proof_document);

    if ($stmt->execute()) {
        echo "<script>alert('Record inserted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
