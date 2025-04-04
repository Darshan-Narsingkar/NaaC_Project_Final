<?php
 include('db_connect.php');

// Capture form data
$total_area = $_POST['total_area'];
$built_up_area = $_POST['built_up_area'];
$green_area = $_POST['green_area'];
$playground_area = $_POST['playground_area'];
$open_space = $_POST['open_space'];
$parking_area = $_POST['parking_area'];
$administrator_block_area = $_POST['administrator_block_area'];
$academic_block_area = $_POST['academic_block_area'];
$auditorium_area = $_POST['auditorium_area'];
$residential_area = $_POST['residential_area'];
$sustainability_area = $_POST['sustainability_area'];
$hostel_area = $_POST['hostel_area'];

// Prepare SQL query to insert data
$sql = "INSERT INTO campus_area (total_area, built_up_area, green_area, playground_area, open_space, parking_area, administrator_block_area, academic_block_area, auditorium_area, residential_area, sustainability_area, hostel_area) 
        VALUES ('$total_area', '$built_up_area', '$green_area', '$playground_area', '$open_space', '$parking_area', '$administrator_block_area', '$academic_block_area', '$auditorium_area', '$residential_area', '$sustainability_area', '$hostel_area')";

// Execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Campus area details submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>