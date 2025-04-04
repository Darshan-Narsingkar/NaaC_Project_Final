<?php
session_start();

include('db_connect.php');
// Initialize variables
$id = $award_name = $faculty_name = $award_date = $award_organization = $proof_document = "";

// Check if 'id' is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $query = "SELECT * FROM research_awards WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (!$row) {
        die("Error: No record found with ID $id.");
    }

    // Assign values
    $award_name = $row['award_name'];
    $faculty_name = $row['faculty_name'];
    $award_date = $row['award_date'];
    $award_organization = $row['award_organization'];
    $proof_document = $row['proof_document'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $award_name = $_POST['award_name'];
    $faculty_name = $_POST['faculty_name'];
    $award_date = $_POST['award_date'];
    $award_organization = $_POST['award_organization'];

    // Handle file upload (if a new file is uploaded)
    if (isset($_FILES["proof_document"]) && $_FILES["proof_document"]["error"] == 0) {
        $target_dir = "research_awards/";
        $target_file = $target_dir . basename($_FILES["proof_document"]["name"]);

        if (move_uploaded_file($_FILES["proof_document"]["tmp_name"], $target_file)) {
            $proof_document = basename($_FILES["proof_document"]["name"]);
        } else {
            echo "Error uploading file.";
        }
    }

    // Update query
    $updateQuery = "UPDATE research_awards 
                    SET award_name = ?, faculty_name = ?, award_date = ?, award_organization = ?, proof_document = ? 
                    WHERE id = ?";

    $stmt = $conn->prepare($updateQuery);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $award_name, $faculty_name, $award_date, $award_organization, $proof_document, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Record updated successfully!');
            window.location.href = 'hod.php';
        </script>";
        exit;
    } else {
        die("Error updating record: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Research Award Record</title>
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
        }
    </style>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h2>Update Research Award Record</h2>
    <form method="POST" enctype="multipart/form-data">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Award Title</th>
                    <th>Faculty Name</th>
                    <th>Award Date</th>
                    <th>Award Organization</th>
                    <th>Proof Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($id) ?></td>
                    <td><input type="text" name="award_name" value="<?= htmlspecialchars($award_name) ?>" required></td>
                    <td><input type="text" name="faculty_name" value="<?= htmlspecialchars($faculty_name) ?>" required></td>
                    <td><input type="date" name="award_date" value="<?= htmlspecialchars($award_date) ?>" required></td>
                    <td><input type="text" name="award_organization" value="<?= htmlspecialchars($award_organization) ?>" required></td>
                    <td>
                        <input type="file" name="proof_document">
                        <?php if (!empty($proof_document)) : ?>
                            <br>
                            <a href="research_awards/<?= htmlspecialchars($proof_document) ?>" target="_blank">View File</a>
                        <?php endif; ?>
                    </td>
                    <td><button type="submit" class="update-btn">Update</button></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
