<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Area Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 75%;
            margin: 100px auto; /* Top margin for spacing above the form */
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            border: 1px solid #dee2e6;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0d6efd; /* Bootstrap primary blue */
            font-weight: 700;
        }
        label {
            font-weight: 600;
            color: #495057; /* Dark grey for labels */
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-primary {
            background-color:#2C3E50;  /* Bootstrap primary blue */
            border: none;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color:#2C3E50;  /* Slightly darker blue */
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
        <h2>Campus Area Form</h2>
        <form action="campus_area_submit.php" method="POST">
            <!-- First Row -->
            <div class="row">
                <div class="col-md-4">
                    <label for="total_area" class="form-label">Total Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="total_area" name="total_area" required>
                </div>
                <div class="col-md-4">
                    <label for="built_up_area" class="form-label">Built-Up Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="built_up_area" name="built_up_area" required>
                </div>
                <div class="col-md-4">
                    <label for="green_area" class="form-label">Green Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="green_area" name="green_area" required>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col-md-4">
                    <label for="playground_area" class="form-label">Playground Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="playground_area" name="playground_area" required>
                </div>
                <div class="col-md-4">
                    <label for="open_space" class="form-label">Open Space (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="open_space" name="open_space" required>
                </div>
                <div class="col-md-4">
                    <label for="parking_area" class="form-label">Parking Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="parking_area" name="parking_area" required>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col-md-4">
                    <label for="administrator_block_area" class="form-label">Administrator Block Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="administrator_block_area" name="administrator_block_area" required>
                </div>
                <div class="col-md-4">
                    <label for="academic_block_area" class="form-label">Academic Block Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="academic_block_area" name="academic_block_area" required>
                </div>
                <div class="col-md-4">
                    <label for="auditorium_area" class="form-label">Auditorium Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="auditorium_area" name="auditorium_area" required>
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col-md-4">
                    <label for="residential_area" class="form-label">Residential Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="residential_area" name="residential_area" required>
                </div>
                <div class="col-md-4">
                    <label for="sustainability_area" class="form-label">Sustainability Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="sustainability_area" name="sustainability_area" required>
                </div>
                <div class="col-md-4">
                    <label for="hostel_area" class="form-label">Hostel Area (sq. m)</label>
                    <input type="number" step="0.01" class="form-control" id="hostel_area" name="hostel_area" required>
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