<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $faculty_id = $_POST['faculty_id'];
    $department = $_POST['department'];
    $project_name = $_POST['project_name'];
    $nature_of_project = $_POST['nature_of_project'];
    $duration = $_POST['duration'];
    $funding_agency = $_POST['funding_agency'];
    $amount_received = $_POST['amount_received'];
    $proof = $_FILES['proof']['name'];

    // Define the directory where the file will be uploaded
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($proof);
    
    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['proof']['tmp_name'], $target_file)) {
        // Prepare the SQL query to insert data into the grant_receive table
        $stmt = $conn->prepare("INSERT INTO grant_receive 
            (faculty_id, department, project_name, nature_of_project, duration, funding_agency, amount_received, proof)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("ssssisss", $faculty_id, $department, $project_name, $nature_of_project, $duration, $funding_agency, $amount_received, $proof);
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Grant details submitted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close the database connection
$conn->close();
?>