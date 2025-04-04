<?php
 include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $faculty_id = $conn->real_escape_string($_POST['faculty_id']);
    $title_of_innovation = $conn->real_escape_string($_POST['title_of_innovation']);
    $name_of_award = $conn->real_escape_string($_POST['name_of_award']);
    $date_of_award = $conn->real_escape_string($_POST['date_of_award']);
    $category = $conn->real_escape_string($_POST['category']);

    // Handle file upload
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory if not exists
    }

    $proof_file = $_FILES['proof_file'];
    $proof_file_name = basename($proof_file['name']);
    $proof_file_path = $upload_dir . $proof_file_name;

    // Validate and move uploaded file
    if (move_uploaded_file($proof_file['tmp_name'], $proof_file_path)) {
        // Insert data into the innovation ecosystem table
        $query = "INSERT INTO innovation_ecosystem (faculty_id, title_of_innovation, name_of_award, date_of_award, category, proof_file)
                  VALUES ('$faculty_id', '$title_of_innovation', '$name_of_award', '$date_of_award', '$category', '$proof_file_path')";

        if ($conn->query($query) === TRUE) {
            echo "Record successfully saved!";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload proof file.";
    }
}

$conn->close();
?>