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
<body>
<!DOCTYPE html>
<html>
<head>
<div class="container mt-5">
    <h2 class="text-center">MoUs Signed During the Year</h2>
    <form action="MoUs_submit.php" method="POST" enctype="multipart/form-data" onsubmit="return validateFileSize()" class="p-4 border rounded bg-light">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="organization" class="form-label">Organization</label>
                <input type="text" class="form-control" id="organization" name="organization" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="date_of_mou_signed" class="form-label">Date Of MoUs Signed</label>
                <input type="date" class="form-control" id="date_of_mou_signed" name="date_of_mou_signed" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="purpose_activities" class="form-label">Purpose/Activities</label>
                <input type="text" class="form-control" id="purpose_activities" name="purpose_activities" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="teachers_participated" class="form-label">No of Teachers/Students Participated under MoUs</label>
                <input type="number" class="form-control" id="teachers_participated" name="teachers_participated" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="department" class="form-label">Select Department:</label>
                <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($faculty['department']); ?>" readonly>
           
            </div>
            <div class="col-md-6 mb-3">
                <label for="proof_file" class="form-label">Upload Proof of MoU (Max: 1MB)</label>
                <input type="file" class="form-control" id="proof_file" name="proof_file" accept=".pdf,.jpg,.png,.doc,.docx" required>
                <small class="text-danger" id="file_error"></small>
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn-submit">Submit</button>
        </div>
    </form>
</div>
<script>
    function validateFileSize() {
        var fileInput = document.getElementById('proof_file');
        var fileError = document.getElementById('file_error');
        var maxSize = 1048576; // 1MB in bytes
        
        if (fileInput.files.length > 0) {
            var fileSize = fileInput.files[0].size;
            if (fileSize > maxSize) {
                fileError.textContent = "File size must be 1MB or less.";
                alert("File size exceeds 1MB. Please select a smaller file.");
                return false;
            }
        }
        fileError.textContent = ""; // Clear error message
        return true;
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>