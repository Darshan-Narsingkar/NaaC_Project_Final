<?php
session_start();

include('db_connect.php');

// Handle Accept or Reject actions
if (isset($_GET['accept_id'])) {
    $id = intval($_GET['accept_id']);
    $status = 1;  // Accepted status
    
    $sql = "UPDATE MoUs_data SET status = $status WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record accepted successfully'); window.location.href='CSEhod.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . addslashes($conn->error) . "');</script>";
    }
}

if (isset($_GET['reject_id'])) {
    $id = intval($_GET['reject_id']);
    $status = 2;  // Rejected status
    
    $sql = "UPDATE MoUs_data SET status = $status WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record rejected successfully'); window.location.href='CSEhod.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . addslashes($conn->error) . "');</script>";
    }
}

// Pagination settings
$records_per_page = 5;  // Number of records per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search_id = "";
$where_clause = "WHERE department = 'cse'";

if (isset($_POST['search_id']) && !empty($_POST['search_id'])) {
    $search_id = intval($_POST['search_id']);
    $where_clause .= " AND id = $search_id";
}

// Count total records for pagination
$sql_count = "SELECT COUNT(*) as total FROM MoUs_data $where_clause";
$result_count = $conn->query($sql_count);
$total_records = $result_count->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records with pagination
$sql = "SELECT * FROM MoUs_data $where_clause LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoUs Records (CSE Department)</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    overflow: hidden;
    margin: auto;
}

th, td {
    padding: 6px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 14px;
}

th {
    background: #007bff;
    color: white;
}

tr:nth-child(even) {
    background: #f2f2f2;
}

tr:hover {
    background: #e0e0e0;
}


        /* Status styles */
        .accepted {
            background: #d4edda !important; /* Green */
            color: #155724;
        }

        .rejected {
            background: #f8d7da !important; /* Red */
            color: #721c24;
        }

        .pending {
            background: #fff3cd !important; /* Yellow */
            color: #856404;
        }

        /* Buttons */
        .action-btn {
            padding: 12px 18px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            text-decoration: none;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
        }

        /* Accept Button */
        .accept-btn {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            font-size: 14px;
            padding: 12px 18px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            text-decoration: none;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
        }

        .accept-btn:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: scale(1.05);
            box-shadow: 2px 6px 10px rgba(40, 167, 69, 0.3);
        }

        /* Reject Button */
        .reject-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            font-size: 14px;
            padding: 12px 18px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            text-decoration: none;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
        }

        .reject-btn:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            transform: scale(1.05);
            box-shadow: 2px 6px 10px rgba(220, 53, 69, 0.3);
        }

        .update-btn {
            background: linear-gradient(135deg, #ffc107, #e0a800); /* Yellow */
            color: black;
            font-size: 14px;
            padding: 12px 18px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin: 10px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            text-decoration: none;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.15);
        }

        .update-btn:hover {
            background: linear-gradient(135deg, #e0a800, #c69500);
            transform: scale(1.05);
            box-shadow: 2px 6px 10px rgba(255, 193, 7, 0.3);
        }

        .print-btn { background: #17a2b8; color: white; }
        .print-btn:hover { background: #138496; }
    </style>
</head>
<body>

<h2>MoUs Records (CSE Department)</h2>

<!-- Search Form -->
<form method="post" action="CSEMoUs_data.php">
    <label for="search_id">Search by ID: </label>
    <input type="text" id="search_id" name="search_id" value="<?= htmlspecialchars($search_id); ?>" placeholder="Enter MoU ID">
    <button type="submit" id='submit'>Search</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Organization</th>
            <th>Date of MoU Signed</th>
            <th>Purpose/Activities</th>
            <th>Teachers Participated</th>
            <th>Status</th>
            <th>Proof File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status_class = ($row['status'] == 1) ? 'accepted' : (($row['status'] == 2) ? 'rejected' : 'pending');
                $status_text = ($row['status'] == 1) ? 'Accepted' : (($row['status'] == 2) ? 'Rejected' : 'Pending');
                $proof_file = !empty($row['proof_file']) ? "<a href='mous/{$row['proof_file']}' download>Download</a>" : "No file";

                echo "<tr class='$status_class'>
                        <td>{$row['id']}</td>
                        <td>{$row['organization']}</td>
                        <td>{$row['date_of_mou_signed']}</td>
                        <td>{$row['purpose_activities']}</td>
                        <td>{$row['teachers_participated']}</td>
                        <td><strong>$status_text</strong></td>
                        <td>$proof_file</td>
                        <td>";

                if ($row['status'] == 0 || $row['status'] == 2) {
                    echo "<a href='CSEMoUs_data.php?accept_id={$row['id']}' onclick=\"return confirm('Are you sure you want to accept this record?');\">
                              <button class='accept-btn'>Accept</button></a>";
                }

                if ($row['status'] == 0 || $row['status'] == 1) {
                    echo "<a href='CSEMoUs_data.php?reject_id={$row['id']}' onclick=\"return confirm('Are you sure you want to reject this record?');\">
                              <button class='reject-btn'>Reject</button></a>";
                }

                if ($row['status'] != 2): ?>
                    <a href="Updatemou.php?id=<?= $row['id']; ?>">
                        <button class="update-btn">Update</button>
                    </a>
                <?php endif;

                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8' style='text-align:center;'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>
<button onclick="window.open('CSEprint__mous.php', '_blank')" class="action-btn print-btn">Print</button>
<button class="btn btn-danger print-btn action-btn" onclick="window.open('CSEexport_to_pdf.php', '_blank')">Export to PDF</button>

<button class="btn btn-danger print-btn action-btn" onclick="window.open('CSEanalysis.php', '_blank')">View Analysis</button>

<!-- Pagination -->
<div style="text-align:center; margin-top:20px;">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="hMoUs_data.php?page=<?= $i; ?>" style="margin: 5px;"><?= $i; ?></a>
    <?php } ?>
    <p><a href="CSEhod.php">Back to Home</a></p>
</div>

</body>
</html>
