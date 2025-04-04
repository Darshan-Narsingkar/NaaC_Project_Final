<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $total_computers = $_POST['total_computers'];
    $internet_bandwidth = $_POST['internet_bandwidth'];
    $wifi_availability = $_POST['wifi_availability'];
    $no_of_smart_boards = $_POST['no_of_smart_boards'];
    $audio_visual_facilities = $_POST['audio_visual_facilities'];
    $no_of_servers = $_POST['no_of_servers'];
    $it_support_staff = $_POST['it_support_staff'];
    $backup_system = $_POST['backup_system'];
    $electronic_resources = $_POST['electronic_resources'];
    $video_conferencing = $_POST['video_conferencing'];
    $digital_learning_platform = $_POST['digital_learning_platform'];
    $lab_ict_enable = $_POST['lab_ict_enable'];
    $energy_efficient = $_POST['energy_efficient'];
    $it_tech_support_availability = $_POST['it_tech_support_availability'];

    // SQL query to insert data into ICT Facilities table
    $sql = "INSERT INTO ict_facilities (total_computers, internet_bandwidth, wifi_availability, no_of_smart_boards, audio_visual_facilities, no_of_servers, it_support_staff, backup_system, electronic_resources, video_conferencing, digital_learning_platform, lab_ict_enable, energy_efficient, it_tech_support_availability) 
            VALUES ('$total_computers', '$internet_bandwidth', '$wifi_availability', '$no_of_smart_boards', '$audio_visual_facilities', '$no_of_servers', '$it_support_staff', '$backup_system', '$electronic_resources', '$video_conferencing', '$digital_learning_platform', '$lab_ict_enable', '$energy_efficient', '$it_tech_support_availability')";

    // Check if data is inserted
    if (mysqli_query($conn, $sql)) {
        echo "ICT Facilities details submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>