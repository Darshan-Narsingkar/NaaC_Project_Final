<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Resources Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ecf0f1; /* Light background color */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 80%;
            margin: 80px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #bdc3c7;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2C3E50;
            font-weight: 700;
        }
        label {
            font-weight: 600;
            color: #34495E;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #2C3E50;
            border: none;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #34495E;
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
    <h2>Libraryy Resources Form</h2>
    <form action="laboratory_resources_submit.php" method="POST">
        <!-- First Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="no_of_books" class="form-label">Number of Books</label>
                <input type="number" class="form-control" id="no_of_books" name="no_of_books" required>
            </div>
            <div class="col-md-4">
                <label for="no_of_journals" class="form-label">Number of Journals</label>
                <input type="number" class="form-control" id="no_of_journals" name="no_of_journals" required>
            </div>
            <div class="col-md-4">
                <label for="ebooks_available" class="form-label">E-books Available</label>
                <input type="number" class="form-control" id="ebooks_available" name="ebooks_available" required>
            </div>
        </div>
        <!-- Second Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="digital_resources" class="form-label">Digital Resources</label>
                <input type="text" class="form-control" id="digital_resources" name="digital_resources" required>
            </div>
            <div class="col-md-4">
                <label for="sitting_capacity" class="form-label">Sitting Capacity</label>
                <input type="number" class="form-control" id="sitting_capacity" name="sitting_capacity" required>
            </div>
            <div class="col-md-4">
                <label for="total_library_area" class="form-label">Total Library Area (sq. m)</label>
                <input type="number" step="0.01" class="form-control" id="total_library_area" name="total_library_area" required>
            </div>
        </div>
        <!-- Third Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="library_timing" class="form-label">Library Timing</label>
                <input type="text" class="form-control" id="library_timing" name="library_timing" required>
            </div>
            <div class="col-md-4">
                <label for="reference_section" class="form-label">Reference Section</label>
                <input type="text" class="form-control" id="reference_section" name="reference_section" required>
            </div>
            <div class="col-md-4">
                <label for="internet_access" class="form-label">Internet Access</label>
                <input type="text" class="form-control" id="internet_access" name="internet_access" required>
            </div>
        </div>
        <!-- Fourth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="library_staff_count" class="form-label">Library Staff Count</label>
                <input type="number" class="form-control" id="library_staff_count" name="library_staff_count" required>
            </div>
            <div class="col-md-4">
                <label for="journal_subscribe" class="form-label">Journals Subscribed</label>
                <input type="text" class="form-control" id="journal_subscribe" name="journal_subscribe" required>
            </div>
            <div class="col-md-4">
                <label for="library_software" class="form-label">Library Softwares</label>
                <input type="text" class="form-control" id="library_software" name="library_software" required>
            </div>
        </div>
        <!-- Fifth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="online_database" class="form-label">Online Database</label>
                <input type="text" class="form-control" id="online_database" name="online_database" required>
            </div>
            <div class="col-md-4">
                <label for="accessible_to_disabled" class="form-label">Accessible to Differently Abled</label>
                <input type="text" class="form-control" id="accessible_to_disabled" name="accessible_to_disabled" required>
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