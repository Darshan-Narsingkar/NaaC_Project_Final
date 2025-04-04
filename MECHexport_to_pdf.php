<?php
session_start();

require_once('TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF library

include('db_connect.php');

// Fetch MoUs data for the IT department
$sql = "SELECT * FROM mous_data WHERE department = 'mech'";
$result = $conn->query($sql);

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('MoUs Data Report');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Set title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'MoUs Data  Department)', 0, 1, 'C');

// Table Header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(0, 123, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Organization', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Date Signed', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Purpose/Activities', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Teachers', 1, 1, 'C', true);

// Reset text color
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);

// Add table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['organization'], 1);
        $pdf->Cell(40, 10, $row['date_of_mou_signed'], 1);
        $pdf->Cell(60, 10, $row['purpose_activities'], 1);
        $pdf->Cell(30, 10, $row['teachers_participated'], 1, 1);
    }
} else {
    $pdf->Cell(190, 10, 'No records found', 1, 1, 'C');
}

// Close database connection
$conn->close();

// Output PDF file
$pdf->Output('MoUs_Data.pdf', 'D');
?>
