<?php
session_start();
include('db_connect.php');

// Initialize variables
$id = $title = $academic_year = $faculty_name = $publication_type = $publisher_name = $ISBN_number = $proof_document = "";

// Check if 'id' is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing data
    $query = "SELECT * FROM book_chapter_publications WHERE id = ?";
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
    $title = $row['title'];
    $academic_year = $row['academic_year'];
    $faculty_name = $row['faculty_name'];
    $publication_type = $row['publication_type'];
    $publisher_name = $row['publisher_name'];
    $ISBN_number = $row['ISBN_number'];
    $proof_document = $row['proof_document'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $academic_year = $_POST['academic_year'];
    $faculty_name = $_POST['faculty_name'];
    $publication_type = $_POST['publication_type'];
    $publisher_name = $_POST['publisher_name'];
    $ISBN_number = $_POST['ISBN_number'];

    // Fetch existing proof document (in case no new file is uploaded)
    $proof_document = $row['proof_document'] ?? '';

    // Handle file upload
    if (!empty($_FILES["proof_document"]["name"]) && $_FILES["proof_document"]["error"] == 0) {
        $target_dir = "book_chapter_publications/";
        $target_file = $target_dir . basename($_FILES["proof_document"]["name"]);
        
        // Validate file type (optional but recommended)
        $allowed_types = ['pdf', 'doc', 'docx'];
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_types)) {
            die("Error: Only PDF, DOC, and DOCX files are allowed.");
        }

        // Move file to the target directory
        if (move_uploaded_file($_FILES["proof_document"]["tmp_name"], realpath($target_file))) {
            $proof_document = basename($_FILES["proof_document"]["name"]);
        } else {
            echo "Error uploading file.";
        }
    }

    // Update query
    $updateQuery = "UPDATE book_chapter_publications SET title = ?, academic_year = ?, faculty_name = ?, publication_type = ?, publisher_name = ?, ISBN_number = ?, proof_document = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssssi", $title, $academic_year, $faculty_name, $publication_type, $publisher_name, $ISBN_number, $proof_document, $id);

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
    <title>Update Book Chapter Publication</title>
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
<h2>Update Book Chapter Publication</h2>
<form method="POST" enctype="multipart/form-data">
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Academic Year</th>
                <th>Faculty Name</th>
                <th>Publication Type</th>
                <th>Publisher Name</th>
                <th>ISBN Number</th>
                <th>Proof Document</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($id) ?></td>
                <td><input type="text" name="title" value="<?= htmlspecialchars($title) ?>"  required style="border: none; outline: none; background: transparent;"></td>
                <td><input type="text" name="academic_year" value="<?= htmlspecialchars($academic_year) ?>"  required style="border: none; outline: none; background: transparent;"></td>
                <td><input type="text" name="faculty_name" value="<?= htmlspecialchars($faculty_name) ?>" required style="border: none; outline: none; background: transparent;"></td>
                <td><input type="text" name="publication_type" value="<?= htmlspecialchars($publication_type) ?>" required style="border: none; outline: none; background: transparent;"></td>
                <td><input type="text" name="publisher_name" value="<?= htmlspecialchars($publisher_name) ?>"  required style="border: none; outline: none; background: transparent;"></td>
                <td><input type="text" name="ISBN_number" value="<?= htmlspecialchars($ISBN_number) ?>"  required style="border: none; outline: none; background: transparent;"></td>
                <td>
                    <input type="file" name="proof_document">
                    <br>
                    
                </td>
                <td><button type="submit" class="update-btn">Update</button></td>
            </tr>
        </tbody>
    </table>
</form>
</body>
</html>
