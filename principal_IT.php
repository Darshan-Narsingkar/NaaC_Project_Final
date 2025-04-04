<?php
 include('db_connect.php');

$department = isset($_GET['department']) ? $_GET['department'] : '';

// Fetch data based on department
$sql = "SELECT * FROM MoUs_data WHERE status=1 AND department = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

$conn->close();

// Return the results as JSON
echo json_encode($records);
?>
