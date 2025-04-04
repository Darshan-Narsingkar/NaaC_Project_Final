<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Conducted by Institution</title>
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
        .btn-submit {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-submit:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Program Conducted by Institution</h2>
            <form action="save_program.php" method="POST" enctype="multipart/form-data">

                <!-- Faculty ID and Department Name -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="faculty_id" class="form-label">Faculty ID</label>
                        <select class="form-select" id="faculty_id" name="faculty_id" required>
                            <option value="">Select Faculty</option>
                            <?php
                            // Database connection
                            $conn = new mysqli("localhost", "root", "", "faculty_registration");

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch Faculty IDs
                            $sql = "SELECT faculty_id FROM faculty_info";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['faculty_id']) . "'>" . htmlspecialchars($row['faculty_id']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Faculty Found</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="department_name" class="form-label">Department Name</label>
                        <select class="form-select" id="department_name" name="department_name" required>
                            <option value="">Select Department</option>
                            <?php
                            // Reopen database connection
                            $conn = new mysqli("localhost", "root", "", "faculty_registration");

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch Department Names
                            $sql = "SELECT department_name FROM department";
                            $result = $conn->query($sql);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['department_name']) . "'>" . htmlspecialchars($row['department_name']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No Departments Found</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Title of Activity and Date of Activity -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="activity_title" class="form-label">Title of Activity</label>
                        <input type="text" class="form-control" id="activity_title" name="activity_title" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_of_activity" class="form-label">Date of Activity</label>
                        <input type="date" class="form-control" id="date_of_activity" name="date_of_activity" required>
                    </div>
                </div>

                <!-- Number of Participants, Outcome -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="no_of_participants" class="form-label">Number of Participants</label>
                        <input type="number" class="form-control" id="no_of_participants" name="no_of_participants" required>
                    </div>
                    <div class="col-md-6">
                        <label for="outcome" class="form-label">Outcome</label>
                        <textarea class="form-control" id="outcome" name="outcome" rows="3" required></textarea>
                    </div>
                </div>

                <!-- Additional Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="no_of_teachers" class="form-label">Number of Teachers Involved</label>
                        <input type="number" class="form-control" id="no_of_teachers" name="no_of_teachers" required>
                    </div>
                    <div class="col-md-6">
                        <label for="collaborate_agencies" class="form-label">Collaborating Agencies</label>
                        <input type="text" class="form-control" id="collaborate_agencies" name="collaborate_agencies">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="award_received" class="form-label">Award Received</label>
                        <input type="text" class="form-control" id="award_received" name="award_received">
                    </div>
                    <div class="col-md-6">
                        <label for="award_bodies" class="form-label">Award Bodies</label>
                        <input type="text" class="form-control" id="award_bodies" name="award_bodies">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description of the Activity</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="proof" class="form-label">Upload Proof</label>
                        <input type="file" class="form-control" id="proof" name="proof" accept="image/*,application/pdf" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-submit w-40">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
