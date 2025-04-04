<?php
session_start();

require_once('TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF library
include('db_connect.php');

// Fetch MoUs data for the IT department
$sql = "SELECT * FROM  research_awards WHERE department = 'civil'";
$result = $conn->query($sql);

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('research_AWARD Data Report');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Set title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'research_AWARD Data (CIVIL Department)', 0, 1, 'C');

// Table Header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(0, 123, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Title', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Faculty Name', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'AWard Date', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Award_organization', 1, 1, 'C', true);

// Reset text color
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);

// Add table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(50, 10, $row['award_name'], 1);
        $pdf->Cell(40, 10, $row['faculty_name'], 1);
        $pdf->Cell(60, 10, $row['award_date'], 1);
        $pdf->Cell(30, 10, $row['award_organization'], 1, 1);
    }
} else {
    $pdf->Cell(190, 10, 'No records found', 1, 1, 'C');
}

// Close database connection
$conn->close();

// Output PDF file
$pdf->Output('research_awards.pdf', 'D');
?>
