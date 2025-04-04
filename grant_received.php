<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grant Received Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }
        .form-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            color: #0056b3;
            margin-bottom: 25px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Grant Received Form</h2>
            <form action="save_grant.php" method="POST" enctype="multipart/form-data">
                
                <!-- Faculty ID -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="faculty_id" class="form-label">Faculty ID</label>
                        <select class="form-select" id="faculty_id" name="faculty_id" required>
                            <option value="">Select Faculty</option>
                            <!-- Options will be dynamically populated from the database -->
                            <?php
                            // Fetch faculty IDs from the faculty_info table
                            include('db_connection.php');
                            $result = $conn->query("SELECT faculty_id, CONCAT(first_name, ' ', last_name) AS name FROM faculty_info");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['faculty_id']."'>".$row['faculty_id']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="">Select Department</option>
                            <!-- Options will be dynamically populated from the department table -->
                            <?php
                            // Fetch departments from the department table
                            $dept_result = $conn->query("SELECT * FROM department");
                            while ($dept_row = $dept_result->fetch_assoc()) {
                                echo "<option value='".$dept_row['id']."'>".$dept_row['department_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nature_of_project" class="form-label">Nature of Project</label>
                        <input type="text" class="form-control" id="nature_of_project" name="nature_of_project" required>
                    </div>
                </div>

                <!-- Duration, Funding Agency, Amount -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="duration" class="form-label">Duration (Months)</label>
                        <input type="number" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="col-md-4">
                        <label for="funding_agency" class="form-label">Funding Agency</label>
                        <input type="text" class="form-control" id="funding_agency" name="funding_agency" required>
                    </div>
                    <div class="col-md-4">
                        <label for="amount_received" class="form-label">Amount Received (INR)</label>
                        <input type="number" class="form-control" id="amount_received" name="amount_received" required>
                    </div>
                </div>

                <!-- Proof of Grant -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="proof" class="form-label">Proof of Grant</label>
                        <input type="file" class="form-control" id="proof" name="proof" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-30">Submit Grant Details</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>