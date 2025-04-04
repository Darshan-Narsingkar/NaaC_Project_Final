<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Records Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ecf0f1; /* Light background color */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 80%;
            margin: 80px auto; /* Adjusted margin for form spacing */
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #bdc3c7;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2C3E50; /* Title color */
            font-weight: 700;
        }
        label {
            font-weight: 600;
            color: #34495E; /* Slightly darker color for labels */
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #2C3E50; /* Button color */
            border: none;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #34495E; /* Slightly darker blue for hover */
        }
        .row {
            margin-bottom: 15px;
        }
        .text-center {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Repair Records Form</h2>
    <form action="repair_records_submit.php" method="POST">
        <!-- First Row (Year, Report Date, Completion Date) -->
        <div class="row">
            <div class="col-md-4">
                <label for="year" class="form-label">Year</label>
                <select class="form-control" id="year" name="year" required>
                    <?php
                            $currentYear = date("Y"); // Get the current year
                            for ($startYear = 2000; $startYear <= $currentYear; $startYear++) {
                                $endYear = $startYear + 1; // Calculate the end year
                                echo "<option value='$startYear-$endYear'>$startYear-$endYear</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="report_date" class="form-label">Report Date</label>
                <input type="date" class="form-control" id="report_date" name="report_date" required>
            </div>
            <div class="col-md-4">
                <label for="completion_date" class="form-label">Completion Date</label>
                <input type="date" class="form-control" id="completion_date" name="completion_date" required>
            </div>
        </div>
        <!-- Second Row (Facility Type, Location, Issue Description) -->
        <div class="row">
            <div class="col-md-4">
                <label for="facility_type" class="form-label">Facility Type</label>
                <input type="text" class="form-control" id="facility_type" name="facility_type" required>
            </div>
            <div class="col-md-4">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="col-md-4">
                <label for="issue_description" class="form-label">Issue Description</label>
                <input type="text" class="form-control" id="issue_description" name="issue_description" required>
            </div>
        </div>
        <!-- Third Row (Repair Type, Priority Level, Action Taken) -->
        <div class="row">
            <div class="col-md-4">
                <label for="repair_type" class="form-label">Repair Type</label>
                <input type="text" class="form-control" id="repair_type" name="repair_type" required>
            </div>
            <div class="col-md-4">
                <label for="priority_level" class="form-label">Priority Level</label>
                <select class="form-control" id="priority_level" name="priority_level" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="action_taken" class="form-label">Action Taken</label>
                <input type="text" class="form-control" id="action_taken" name="action_taken" required>
            </div>
        </div>
        <!-- Fourth Row (Inspection Remarks, Assigned To, Approved By) -->
        <div class="row">
            <div class="col-md-4">
                <label for="inspection_remarks" class="form-label">Inspection Remarks</label>
                <input type="text" class="form-control" id="inspection_remarks" name="inspection_remarks" required>
            </div>
            <div class="col-md-4">
                <label for="assigned_to" class="form-label">Assigned To</label>
                <input type="text" class="form-control" id="assigned_to" name="assigned_to" required>
            </div>
            <div class="col-md-4">
                <label for="approved_by" class="form-label">Approved By</label>
                <input type="text" class="form-control" id="approved_by" name="approved_by" required>
            </div>
        </div>
        <!-- Fifth Row (Approval Date, Budget Allocated, Vendor Details) -->
        <div class="row">
            <div class="col-md-4">
                <label for="approval_date" class="form-label">Approval Date</label>
                <input type="date" class="form-control" id="approval_date" name="approval_date" required>
            </div>
            <div class="col-md-4">
                <label for="budget_allocated" class="form-label">Budget Allocated</label>
                <input type="number" step="0.01" class="form-control" id="budget_allocated" name="budget_allocated" required>
            </div>
            <div class="col-md-4">
                <label for="vendor_details" class="form-label">Vendor Details</label>
                <input type="text" class="form-control" id="vendor_details" name="vendor_details" required>
            </div>
        </div>
        <!-- Sixth Row (Remarks) -->
        <div class="row">
            <div class="col-md-12">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="width: 200px;">Submit</button>
        </div>
    </form>
</div>
</body>
</html>