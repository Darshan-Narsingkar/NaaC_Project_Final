<?php
session_start();
include('db_connect.php');

// Initialize variables
$id = $center_name = $year_established = $affiliated_institution = $funding_received = $proof_file = "";

// Check if 'id' is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $query = "SELECT * FROM incubation_centers WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        die("Error: No record found with ID $id.");
    }

    // Assign values
    $center_name = $row['center_name'];
    $year_established = $row['year_established'];
    $affiliated_institution = $row['affiliated_institution'];
    $funding_received = $row['funding_received'];
    $proof_file = $row['proof_file'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $center_name = $_POST['center_name'];
    $year_established = $_POST['year_established'];
    $affiliated_institution = $_POST['affiliated_institution'];
    $funding_received = $_POST['funding_received'];

    // Handle file upload (Check if a file is uploaded)
    if (isset($_FILES["proof_file"]) && $_FILES["proof_file"]["error"] == 0) {
        $target_dir = "Incubation_Centers/files/";
        $target_file = $target_dir . basename($_FILES["proof_file"]["name"]);

        if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $target_file)) {
            $proof_file = basename($_FILES["proof_file"]["name"]);
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    } else {
        // Keep existing file if no new file is uploaded
        if (isset($row)) {
            $proof_file = $row['proof_file'];
        }
    }

    // Update query
    $updateQuery = "UPDATE incubation_centers 
                    SET center_name = ?, year_established = ?, affiliated_institution = ?, funding_received = ?, proof_file = ? 
                    WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $center_name, $year_established, $affiliated_institution, $funding_received, $proof_file, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Record updated successfully!');
            window.location.href = '../hod.php';
        </script>";
        exit;
    } else {
        die("Error updating record: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Incubation Center Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
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

        .update-btn {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: black;
        }

        .update-btn:hover {
            background: linear-gradient(135deg, #e0a800, #c69500);
            transform: scale(1.05);
            box-shadow: 2px 6px 10px rgba(255, 193, 7, 0.3);
        }

        .print-btn {
            background: #17a2b8;
            color: white;
        }

        .print-btn:hover {
            background: #138496;
        }
    </style>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h2>Update Incubation Center Record</h2>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Center Name</th>
                    <th>Year Established</th>
                    <th>Affiliated Institution</th>
                    <th>Funding Received</th>
                    <th>Proof Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($id) ?></td>
                    <td><input type="text" name="center_name" value="<?= htmlspecialchars($center_name) ?>" required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="year_established" value="<?= htmlspecialchars($year_established) ?>" required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="affiliated_institution" value="<?= htmlspecialchars($affiliated_institution) ?>" required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="funding_received" value="<?= htmlspecialchars($funding_received) ?>" required style="border: none; outline: none; background: transparent;"></td>
                    <td>
                        <input type="file" name="proof_file">
                        <?php if (!empty($proof_file)) : ?>
                            <br><a href="Incubation_Centers/files/<?= htmlspecialchars($proof_file) ?>" target="_blank">View File</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button type="submit" class="action-btn update-btn" onclick="return confirmAction('Are you sure you want to update this record?')">Update</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
