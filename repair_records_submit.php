<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$year = $_POST['year'];
$report_date = $_POST['report_date'];
$completion_date = $_POST['completion_date'];
$facility_type = $_POST['facility_type'];
$location = $_POST['location'];
$issue_description = $_POST['issue_description'];
$repair_type = $_POST['repair_type'];
$priority_level = $_POST['priority_level'];
$action_taken = $_POST['action_taken'];
$inspection_remarks = $_POST['inspection_remarks'];
$assigned_to = $_POST['assigned_to'];
$approved_by = $_POST['approved_by'];
$approval_date = $_POST['approval_date'];
$budget_allocated = $_POST['budget_allocated'];
$vendor_details = $_POST['vendor_details'];
$remarks = $_POST['remarks'];

// SQL Query to insert data into the repair_records table
$sql = "INSERT INTO repair_records (year, report_date, completion_date, facility_type, location, issue_description, 
        repair_type, priority_level, action_taken, inspection_remarks, assigned_to, approved_by, approval_date, 
        budget_allocated, vendor_details, remarks) 
        VALUES ('$year', '$report_date', '$completion_date', '$facility_type', '$location', '$issue_description', 
        '$repair_type', '$priority_level', '$action_taken', '$inspection_remarks', '$assigned_to', '$approved_by', 
        '$approval_date', '$budget_allocated', '$vendor_details', '$remarks')";

// Check if the query was successful
if ($conn->query($sql) === TRUE) {
    echo "Repair record added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>