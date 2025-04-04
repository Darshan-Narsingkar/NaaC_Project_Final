<?php
session_start();

require_once('TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF library
include('db_connect.php');

// Fetch project funding data for the IT department
$sql = "SELECT * FROM project_funding WHERE department = 'it'";
$result = $conn->query($sql);

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Research Paper Data Report');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Set Title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Research Paper Data (IT Department)', 0, 1, 'C');

// Table Header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(0, 123, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Project Nature', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'duration', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'funding_agency', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Amount Received', 1, 1, 'C', true);

// Reset text color
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);

// Add table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['project_nature'], 1);
        $pdf->Cell(40, 10, $row['duration'], 1);
        $pdf->Cell(60, 10, $row['funding_agency'], 1);
        $pdf->Cell(30, 10, $row['amount_received'], 1, 1);
    }
} else {
    $pdf->Cell(190, 10, 'No records found', 1, 1, 'C');
}

// Close database connection
$conn->close();

// Output PDF file
$pdf->Output('project_funding.pdf', 'D');
?>
