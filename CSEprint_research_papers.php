<?php
session_start();
include('db_connect.php');

// Fetch research papers data for the IT department
$sql = "SELECT * FROM research_papers WHERE department = 'cse' and status='1'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Research Papers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: white;
            text-align: center;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .college-image {
            width: 100%;
            max-height: 120px;
            object-fit: contain;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #000;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) { background: #f2f2f2; }
        tr:hover { background: #e0e0e0; }
        .print-btn {
            margin: 20px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .print-btn:hover {
            background: #218838;
        }
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <img src="sipna.png" alt="College Image" class="college-image">
</div>
<h2>Research Papers Data (CSE Department)</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Faculty Name</th>
            <th>Publication Date</th>
            <th>Journal</th>
            <th>Journal Type</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['paper_title']}</td>
                        <td>{$row['faculty_name']}</td>
                        <td>{$row['publication_date']}</td>
                        <td>{$row['journal_name']}</td>
                        <td>{$row['journal_type']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

<button class="print-btn" onclick="window.print()">Print</button>

</body>
</html>

<?php $conn->close(); ?>
