<?php
session_start();

include('db_connect.php');


// Accept action
if (isset($_GET['accept_id'])) {
    $id = $_GET['accept_id'];
    $sql = "UPDATE research_awards SET status = '1' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully!'); window.location.href='CVILhod.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
    
}

// Reject action
if (isset($_GET['reject_id'])) {
    $id = $_GET['reject_id'];
    $sql = "UPDATE research_awards SET status = '2' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record reject successfully!'); window.location.href='CVILhod.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
    
}


// Pagination settings
$records_per_page = 5;  
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search_id = "";
$where_clause = "WHERE department = 'civil'";

if (isset($_POST['search_id']) && !empty($_POST['search_id'])) {
    $search_id = intval($_POST['search_id']);
    $where_clause .= " AND id = $search_id";
}

// Count total records for pagination
$sql_count = "SELECT COUNT(*) as total FROM research_awards $where_clause";
$result_count = $conn->query($sql_count);
$total_records = $result_count->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records with pagination
$sql = "SELECT * FROM research_awards $where_clause LIMIT $records_per_page OFFSET $offset";
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
    <title>research_awards Records (CVILDepartment)</title>
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
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
            font-size: 16px;
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

<h2>research_awards Records (CIVIL Department)</h2>

<!-- Search Form -->
<form method="post" action="CIVILresearch_awards.php">
    <label for="search_id">Search by ID: </label>
    <input type="text" id="search_id" name="search_id" value="<?= htmlspecialchars($search_id); ?>" placeholder="Enter research_awards  ID">
    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
        <th>ID</th>
                <th>Award Title</th>
                <th>Faculty Name</th>
                <th>Award Date</th>
                <th>Award_organization</th>
                
                <th>Status</th>
                <th>Proof Document</th>
                <th>Actions</th>

        </tr>
    </thead>
    <tbody>
    <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status_class = ($row['status'] == '1') ? 'accepted' : (($row['status'] == '2') ? 'rejected' : 'pending');
        $status_text = ($row['status'] == '1') ? 'Accepted' : (($row['status'] == '2') ? 'Rejected' : 'Pending');
        $proof_document = !empty($row['proof_document']) ? "<a href='research_awards/{$row['proof_document']}' download>Download</a>" : "No file";
        ?>

        <tr class="<?= $status_class; ?>">
            <td><?= $row['id']; ?></td>
            <td><?= $row['award_name']; ?></td>
            <td><?= $row['faculty_name']; ?></td>
            <td><?= $row['award_date']; ?></td>
            <td><?= $row['award_organization']; ?></td>
            
            <td><strong><?= $status_text; ?></strong></td>
            <td><?= $proof_document; ?></td>
            <td>
                <?php if ($row['status'] == '0' || $row['status'] == '2') { ?>
                    <a href="MECHresearch_awards.php?accept_id=<?= $row['id']; ?>" class="accept-btn">Accept</a>
                <?php } ?>

                <?php if ($row['status'] == '0' || $row['status'] == '1') { ?>
                    <a href="MECHresearch_awards.php?reject_id=<?= $row['id']; ?>" class="reject-btn">Reject</a>
                <?php } ?>

                <?php if ($row['status'] != '2') { ?>
                    <a href="Updateaward.php?id=<?= $row['id']; ?>">
                        <button class="update-btn">Update</button>
                    </a>
                <?php } ?>
            </td>
        </tr>

        <?php
    }
} else {
    echo "<tr><td colspan='8' style='text-align:center;'>No records found.</td></tr>";
}
?>
</tbody>
</table>

<!-- Action Buttons -->
<button onclick="window.open('CIVILprint_research_award.php', '_blank')" class="action-btn print-btn">Print</button>
<button class="btn btn-danger print-btn action-btn" onclick="window.open('CIVILresearch_award_to_pdf.php', '_blank')">Export to PDF</button>
<button class="btn btn-danger print-btn action-btn" onclick="window.open('CIVILresearch_awardanalysis.php', '_blank')">View Analysis</button>

<!-- Pagination -->
<div style="text-align:center; margin-top:20px;">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="MECHresearch_awards.phpp?page=<?= $i; ?>" style="margin: 5px;"><?= $i; ?></a>
    <?php } ?>
    <p><a href="CVILhod.php">Back to Home</a></p>
</div>

</body>
</html>

<?php $conn->close(); ?>
