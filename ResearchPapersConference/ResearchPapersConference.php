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
    <title>Research Paper Publications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            max-width: 65%;
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


<div class="container mt-5">
    <h2 class="text-center">Conference Paper Submission</h2>
    <form action="ResearchPapersConference/submit_ResearchPapersConference.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded bg-light">
    
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Title of the Paper</label>
                <input type="text" class="form-control" name="paper_title" placeholder="Enter paper title" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Title of the Proceedings of the Conference</label>
                <input type="text" class="form-control" name="proceedings_title" placeholder="Enter proceedings title" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Department</label>
                <input type="text" class="form-control" name="department" value="<?php echo isset($faculty['department']) ? htmlspecialchars($faculty['department']) : ''; ?>" readonly>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Name of the Conference</label>
                <input type="text" class="form-control" name="conference_name" placeholder="Enter conference name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">National / International</label>
                <select class="form-select" name="conference_type" required>
                    <option value="National">National</option>
                    <option value="International">International</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">ISBN/ISSN Number of the Proceeding</label>
                <input type="text" class="form-control" name="isbn_issn" placeholder="Enter ISBN/ISSN number">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Name of the Publisher</label>
                <input type="text" class="form-control" name="publisher" placeholder="Enter publisher name">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Affiliating Institute at the Time of Publication</label>
                <input type="text" class="form-control" name="affiliating_institute" placeholder="Enter affiliating institute">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Upload Proof Document</label>
                <input type="file" class="form-control" name="proof_file" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>