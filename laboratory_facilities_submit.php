<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$no_of_labs = $_POST['no_of_labs'];
$type_of_labs = $_POST['type_of_labs'];
$seating_capacity = $_POST['seating_capacity'];
$ict_enabled = $_POST['ict_enabled'];
$modern_equipment = $_POST['modern_equipment'];
$safety_equipment = $_POST['safety_equipment'];
$size_of_labs = $_POST['size_of_labs'];
$ventilation = $_POST['ventilation'];
$research_facilities = $_POST['research_facilities'];
$fumehood_availability = $_POST['fumehood_availability'];
$sustainability_feature = $_POST['sustainability_feature'];
$equipment_count = $_POST['equipment_count'];
$maintenance_support = $_POST['maintenance_support'];
$chemical_storage_facilities = $_POST['chemical_storage_facilities'];

// SQL Insert query
$sql = "INSERT INTO laboratory_facilities (no_of_labs, type_of_labs, seating_capacity, ict_enabled, modern_equipment, safety_equipment, size_of_labs, ventilation, research_facilities, fumehood_availability, sustainability_feature, equipment_count, maintenance_support, chemical_storage_facilities) 
        VALUES ('$no_of_labs', '$type_of_labs', '$seating_capacity', '$ict_enabled', '$modern_equipment', '$safety_equipment', '$size_of_labs', '$ventilation', '$research_facilities', '$fumehood_availability', '$sustainability_feature', '$equipment_count', '$maintenance_support', '$chemical_storage_facilities')";

if ($conn->query($sql) === TRUE) {
    echo "Record submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>