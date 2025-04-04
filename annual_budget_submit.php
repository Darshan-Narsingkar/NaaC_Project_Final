<?php
// Database configuration
include('db_connect.php');

// Establish a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $year = $_POST['year'];
    $total_annual_budget = $_POST['total_annual_budget'];
    $building_maintenance = $_POST['building_maintenance'];
    $electrical_system = $_POST['electrical_system'];
    $hvac_system = $_POST['hvac_system'];
    $plumbing = $_POST['plumbing'];
    $landscaping = $_POST['landscaping'];
    $safety_equipment = $_POST['safety_equipment'];
    $water_supply_system = $_POST['water_supply_system'];
    $waste_management = $_POST['waste_management'];
    $ict_facilities = $_POST['ict_facilities'];
    $green_campus_initiatives = $_POST['green_campus_initiatives'];
    $security_systems = $_POST['security_systems'];
    $pest_control = $_POST['pest_control'];
    $repair_works = $_POST['repair_works'];
    $transport_facilities = $_POST['transport_facilities'];
    $research_labs = $_POST['research_labs'];
    $hostel_facilities = $_POST['hostel_facilities'];
    $sports_facilities = $_POST['sports_facilities'];
    $contingency_budget = $_POST['contingency_budget'];

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO annual_budget (
        year, total_annual_budget, building_maintenance, electrical_system, hvac_system, 
        plumbing, landscaping, safety_equipment, water_supply_system, waste_management, 
        ict_facilities, green_campus_initiatives, security_systems, pest_control, repair_works, 
        transport_facilities, research_labs, hostel_facilities, sports_facilities, contingency_budget
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sddddddddddddddddddd",
        $year, $total_annual_budget, $building_maintenance, $electrical_system, $hvac_system,
        $plumbing, $landscaping, $safety_equipment, $water_supply_system, $waste_management,
        $ict_facilities, $green_campus_initiatives, $security_systems, $pest_control, $repair_works,
        $transport_facilities, $research_labs, $hostel_facilities, $sports_facilities, $contingency_budget
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "Annual budget data submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
