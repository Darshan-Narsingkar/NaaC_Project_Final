<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checking if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $no_of_classrooms = $_POST['no_of_classrooms'];
    $seating_capacity = $_POST['seating_capacity'];
    $avg_size_classroom = $_POST['avg_size_classroom'];
    $no_of_projectors = $_POST['no_of_projectors'];
    $no_of_smart_boards = $_POST['no_of_smart_boards'];
    $no_of_audio_systems = $_POST['no_of_audio_systems'];
    $no_of_au_facilities = $_POST['no_of_au_facilities'];
    $no_of_air_conditioners = $_POST['no_of_air_conditioners'];
    $no_of_boards = $_POST['no_of_boards'];
    $internet_connectivity = $_POST['internet_connectivity'];
    $lighting = $_POST['lighting'];

    // SQL query to insert form data into the database
    $sql = "INSERT INTO classroom_facilities (no_of_classrooms, seating_capacity, avg_size_classroom, no_of_projectors, no_of_smart_boards, no_of_audio_systems, no_of_au_facilities, no_of_air_conditioners, no_of_boards, internet_connectivity, lighting)
            VALUES ('$no_of_classrooms', '$seating_capacity', '$avg_size_classroom', '$no_of_projectors', '$no_of_smart_boards', '$no_of_audio_systems', '$no_of_au_facilities', '$no_of_air_conditioners', '$no_of_boards', '$internet_connectivity', '$lighting')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>