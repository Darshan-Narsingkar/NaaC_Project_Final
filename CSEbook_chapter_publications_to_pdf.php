<?php
session_start();
require_once('TCPDF-main/TCPDF-main/tcpdf.php'); // Include TCPDF library
include('db_connect.php'); // Include database connection

// Fetch all book chapter publications data for the IT department (Fixed SQL Query)
$sql = "SELECT id, academic_year, faculty_name, publication_type, title, publisher_name, ISBN_number FROM book_chapter_publications WHERE department = 'cse'";
$result = $conn->query($sql);

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Book Chapter Publications Report');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Set title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Book Chapter Publications (cse Department)', 0, 1, 'C');

// Table Header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(0, 123, 255);
$pdf->SetTextColor(255, 255, 255);

// Define column headers (without "Department")
$headers = ['ID', 'Academic Year', 'Faculty Name', 'Publication Type', 'Title', 'Publisher', 'ISBN Number'];
$widths = [10, 20, 40, 25, 40, 40, 20];

foreach ($headers as $key => $header) {
    $pdf->Cell($widths[$key], 10, $header, 1, 0, 'C', true);
}
$pdf->Ln(); // Move to next line

// Reset text color
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 8);

// Add table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(20, 10, $row['academic_year'], 1);
        $pdf->Cell(40, 10, $row['faculty_name'], 1);
        $pdf->Cell(25, 10, ucfirst($row['publication_type']), 1);
        $pdf->Cell(40, 10, $row['title'], 1);
        $pdf->Cell(40, 10, $row['publisher_name'], 1);
        $pdf->Cell(20, 10, $row['ISBN_number'], 1);
        $pdf->Ln(); // Move to next line
    }
} else {
    $pdf->Cell(array_sum($widths), 10, 'No records found', 1, 1, 'C');
}

// Close database connection
$conn->close();

// Output PDF file
$pdf->Output('book_chapter_publications.pdf', 'D');
?>
