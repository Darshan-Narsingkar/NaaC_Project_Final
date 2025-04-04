<?php
// Establishing the connection to the database
include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $faculty_id = $_POST['faculty_id'];
    $department_name = $_POST['department_name'];
    $activity_title = $_POST['activity_title'];
    $date_of_activity = $_POST['date_of_activity'];
    $no_of_participants = $_POST['no_of_participants'];
    $outcome = $_POST['outcome'];
    $no_of_teachers = $_POST['no_of_teachers'];
    $collaborate_agencies = $_POST['collaborate_agencies'];
    $award_received = $_POST['award_received'];
    $award_bodies = $_POST['award_bodies'];
    $description = $_POST['description'];

    // File upload handling for proof
    $proof = $_FILES['proof']['name'];
    $proof_tmp_name = $_FILES['proof']['tmp_name'];
    $proof_folder = 'uploads/' . $proof;
    move_uploaded_file($proof_tmp_name, $proof_folder);

    // Insert data into the database
    $sql = "INSERT INTO program_conducted 
            (faculty_id, department_name, activity_title, date_of_activity, no_of_participants, outcome, 
             no_of_teachers, collaborate_agencies, award_received, award_bodies, description, proof)
            VALUES 
            ('$faculty_id', '$department_name', '$activity_title', '$date_of_activity', '$no_of_participants', '$outcome',
             '$no_of_teachers', '$collaborate_agencies', '$award_received', '$award_bodies', '$description', '$proof_folder')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>