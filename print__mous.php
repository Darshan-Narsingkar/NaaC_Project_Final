<?php
session_start();

include('db_connect.php');

// Fetch research papers data for the IT department
$sql = "SELECT * FROM mous_data WHERE department = 'Information Technology' and status=1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print mous Papers</title>
    <style>
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
        .logo {
            height: 80px; /* Adjust size as needed */
            margin-right: 15px;
        }
        .college-image {
            height: 100px; /* Adjust size as needed */
            margin-left: 15px;
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
        .college-image {
    width: 100%; /* Full width of the header */
    max-height: 120px; /* Adjust height as needed */
    object-fit: contain; /* Ensures it scales properly */
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
        <img src="sipna.png" alt="College Image" class="college-image" >
    </div>
     <h2>MOUS data (IT Department)</h2>

   
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Organization</th>
            <th>Date of MoU Signed</th>
            <th>Purpose/Activities</th>
            <th>Teachers Participated</th>
            

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $status_text = ($row['status'] == 1) ? 'Accepted' : (($row['status'] == 2) ? 'Rejected' : 'Pending');

                    echo "<tr>
                            <td>{$row['id']}</td>
                        <td>{$row['organization']}</td>
                        <td>{$row['date_of_mou_signed']}</td>
                        <td>{$row['purpose_activities']}</td>
                        <td>{$row['teachers_participated']}</td>
                             
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
