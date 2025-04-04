<?php
session_start();

// Ensure the user is logged in and is a faculty member
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'faculty') {
    header("Location: login.php"); 
    exit();
}

// Display any success message from the session
if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']);
}

// Check if the faculty ID exists in the session
if (isset($_SESSION['faculty_id'])) {
    $faculty_id = $_SESSION['faculty_id']; // Get the logged-in faculty's ID from the session

    // Include the database connection file
    include('db_connect.php');

    // SQL query to fetch the faculty details based on the faculty ID
    $sql = "SELECT * FROM faculty WHERE faculty_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $faculty_id);  // Use the faculty ID from the session
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the faculty details if available
    $faculty = $result->fetch_assoc();

    // Close the database connection
    $conn->close();
    
    // Check if faculty data exists
    if (!$faculty) {
        echo "No faculty found with the given ID.";
        exit();
    }
} else {
    // If the faculty ID is not in the session, redirect to login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Chapter Publications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            max-width: 80%;
            margin: auto;
            margin-top: 50px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
        }
        h2 {
            font-size: 24px;
            color: #2C3E50;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: 600;
            color: #34495E;
        }
        .form-control {
            border: 1px solid #d6d9dd;
            border-radius: 5px;
            padding: 8px 12px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2C3E50;
        }
        .btn-submit {
            background-color: #2C3E50;
            color: white;
            padding: 8px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #34495E;
        }
        .form-row {
            margin-bottom: 15px;
        }
    
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Book Chapter Publications</h2>
    <form action="book_chapter_publications_submit.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="academic_year" class="form-label">Academic Year</label>
                <input type="text" class="form-control" id="academic_year" name="academic_year" maxlength="9" placeholder="e.g., 2024-2025" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="faculty_name" class="form-label">Faculty Name</label>
                <input type="text" class="form-control" id="faculty_name" name="faculty_name" placeholder="Enter Faculty Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($faculty['department']); ?>" readonly>
           
            </div>
            <div class="col-md-6 mb-3">
                <label for="publication_type" class="form-label">Publication Type</label>
                <select class="form-control" id="publication_type" name="publication_type" required>
                    <option value="">-- Select Type --</option>
                    <option value="Book">Book</option>
                    <option value="Chapter">Chapter</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="publisher_name" class="form-label">Publisher Name</label>
                <input type="text" class="form-control" id="publisher_name" name="publisher_name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ISBN_number" class="form-label">ISBN Number</label>
                <input type="text" class="form-control" id="ISBN_number" name="ISBN_number" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="proof_document" class="form-label">Proof Document</label>
                <input type="file" class="form-control" id="proof_document" name="proof_document" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
