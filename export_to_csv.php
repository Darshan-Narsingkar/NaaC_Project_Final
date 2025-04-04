<?php

include('db_connect.php');

// Fetch all records where status = 1
$sql = "SELECT * FROM MoUs_data WHERE status = 1";
$result = $conn->query($sql);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="all_accepted_mous.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, ['ID', 'Organization', 'Date of MoU Signed', 'Purpose & Activities', 'No of Teachers/Students Participated']);

// Output data rows
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();

?>
