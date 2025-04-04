<?php
session_start();

include('db_connect.php');

// Initialize variables
$id = $paper_title = $faculty_name = $publication_date = $journal_name = $journal_type = $proof_document = "";

// Check if 'id' is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $query = "SELECT * FROM research_papers WHERE id = ?";
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
    $paper_title = $row['paper_title'];
    $faculty_name = $row['faculty_name'];
    $publication_date = $row['publication_date'];
    $journal_name = $row['journal_name'];
    $journal_type = $row['journal_type'];
    $proof_document = $row['proof_document'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paper_title = $_POST['paper_title'];
    $faculty_name = $_POST['faculty_name'];
    $publication_date = $_POST['publication_date'];
    $journal_name = $_POST['journal_name'];
    $journal_type = $_POST['journal_type'];

    // Handle file upload (Check if file is uploaded)
    if (isset($_FILES["proof_document"]) && $_FILES["proof_document"]["error"] == 0) {
        $target_dir = "research_paper/";
        $target_file = $target_dir . basename($_FILES["proof_document"]["name"]);
        
        if (move_uploaded_file($_FILES["proof_document"]["tmp_name"], $target_file)) {
            $proof_document = basename($_FILES["proof_document"]["name"]);
        } else {
            echo "Error uploading file.";
        }
    } else {
        // Keep existing file if no new file is uploaded
        $proof_document = $row['proof_document'];
    }

    // Update query
    $updateQuery = "UPDATE research_papers SET paper_title = ?, faculty_name = ?, publication_date = ?, journal_name = ?, journal_type = ?, proof_document = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $paper_title, $faculty_name, $publication_date, $journal_name, $journal_type, $proof_document, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Record updated successfully!');
            window.location.href = 'hod.php';
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
    <title>Update Research Paper Record</title>
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


/* Responsive Design */
@media (max-width: 768px) {
    .action-btn {
        padding: 8px 12px;
        font-size: 13px;
    }
}




/* Update Button */
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
         

    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>
<body>
    <h2>Update Research Paper Record</h2>
    <form method="POST" enctype="multipart/form-data">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Faculty Name</th>
                    <th>Publication Date</th>
                    <th>Journal</th>
                    <th>Journal Type</th>
                    <th>Proof Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($id) ?></td>
                    <td><input type="text" name="paper_title" value="<?= htmlspecialchars($paper_title) ?>" required required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="faculty_name" value="<?= htmlspecialchars($faculty_name) ?>" required required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="date" name="publication_date" value="<?= htmlspecialchars($publication_date) ?>" required required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="journal_name" value="<?= htmlspecialchars($journal_name) ?>" required required style="border: none; outline: none; background: transparent;"></td>
                    <td><input type="text" name="journal_type" value="<?= htmlspecialchars($journal_type) ?>" required required style="border: none; outline: none; background: transparent;"></td>
                    <td>
                        
                        <input type="file" name="proof_document">
                    </td>
                    <td>
                        <button type="submit" class="update-btn">Update</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
