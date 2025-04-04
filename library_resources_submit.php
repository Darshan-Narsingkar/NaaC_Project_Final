<?php
 include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$no_of_books = $_POST['no_of_books'];
$no_of_journals = $_POST['no_of_journals'];
$ebooks_available = $_POST['ebooks_available'];
$digital_resources = $_POST['digital_resources'];
$sitting_capacity = $_POST['sitting_capacity'];
$total_library_area = $_POST['total_library_area'];
$library_timing = $_POST['library_timing'];
$reference_section = $_POST['reference_section'];
$internet_access = $_POST['internet_access'];
$library_staff_count = $_POST['library_staff_count'];
$journal_subscribe = $_POST['journal_subscribe'];
$library_software = $_POST['library_software'];
$online_database = $_POST['online_database'];
$accessible_to_disabled = $_POST['accessible_to_disabled'];

// SQL Insert query
$sql = "INSERT INTO laboratory_resources (no_of_books, no_of_journals, ebooks_available, digital_resources, sitting_capacity, total_library_area, library_timing, reference_section, internet_access, library_staff_count, journal_subscribe, library_software, online_database, accessible_to_disabled) 
        VALUES ('$no_of_books', '$no_of_journals', '$ebooks_available', '$digital_resources', '$sitting_capacity', '$total_library_area', '$library_timing', '$reference_section', '$internet_access', '$library_staff_count', '$journal_subscribe', '$library_software', '$online_database', '$accessible_to_disabled')";

if ($conn->query($sql) === TRUE) {
    echo "Record submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>