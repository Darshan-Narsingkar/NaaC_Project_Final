<?php
session_start();
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include('db_connect.php');
// Fetch all data from MoUs_data table
$sql = "SELECT * FROM MoUs_data";
$result = $conn->query($sql);

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row
$headers = ["ID", "Organization", "Date of MoU Signed", "Purpose/Activities", "Teachers Participated", "Status", "Proof File"];
$column = 'A';

foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

// Insert data
$rowNumber = 2;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status_text = ($row['status'] == 1) ? 'Accepted' : (($row['status'] == 2) ? 'Rejected' : 'Pending');
        $proof_file = !empty($row['proof_file']) ? "mous/{$row['proof_file']}" : "No file";

        $sheet->setCellValue('A' . $rowNumber, $row['id']);
        $sheet->setCellValue('B' . $rowNumber, $row['organization']);
        $sheet->setCellValue('C' . $rowNumber, $row['date_of_mou_signed']);
        $sheet->setCellValue('D' . $rowNumber, $row['purpose_activities']);
        $sheet->setCellValue('E' . $rowNumber, $row['teachers_participated']);
        $sheet->setCellValue('F' . $rowNumber, $status_text);
        $sheet->setCellValue('G' . $rowNumber, $proof_file);
        $rowNumber++;
    }
}

// Set headers for file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="MoUs_data.xlsx"');
header('Cache-Control: max-age=0');

// Write file to output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Close database connection
$conn->close();
exit;
?>
