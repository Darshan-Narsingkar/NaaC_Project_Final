<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Facilities Form</title>
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
    <h2>Laboratory Facilities Form</h2>
    <form action="laboratory_facilities_submit.php" method="POST">
        <!-- First Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="no_of_labs" class="form-label">Number of Labs</label>
                <input type="number" class="form-control" id="no_of_labs" name="no_of_labs" required>
            </div>
            <div class="col-md-4">
                <label for="type_of_labs" class="form-label">Type of Labs</label>
                <input type="text" class="form-control" id="type_of_labs" name="type_of_labs" required>
            </div>
            <div class="col-md-4">
                <label for="seating_capacity" class="form-label">Total Seating Capacity</label>
                <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
            </div>
        </div>
        <!-- Second Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="ict_enabled" class="form-label">ICT Enabled</label>
                <input type="text" class="form-control" id="ict_enabled" name="ict_enabled" required>
            </div>
            <div class="col-md-4">
                <label for="modern_equipment" class="form-label">Modern Equipment Available</label>
                <input type="text" class="form-control" id="modern_equipment" name="modern_equipment" required>
            </div>
            <div class="col-md-4">
                <label for="safety_equipment" class="form-label">Safety Equipment</label>
                <input type="text" class="form-control" id="safety_equipment" name="safety_equipment" required>
            </div>
        </div>
        <!-- Third Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="size_of_labs" class="form-label">Size of Labs (sq. m)</label>
                <input type="number" step="0.01" class="form-control" id="size_of_labs" name="size_of_labs" required>
            </div>
            <div class="col-md-4">
                <label for="ventilation" class="form-label">Ventilation</label>
                <input type="text" class="form-control" id="ventilation" name="ventilation" required>
            </div>
            <div class="col-md-4">
                <label for="research_facilities" class="form-label">Lab with Research Facilities</label>
                <input type="text" class="form-control" id="research_facilities" name="research_facilities" required>
            </div>
        </div>
        <!-- Fourth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="fumehood_availability" class="form-label">Availability of Fumehood</label>
                <input type="text" class="form-control" id="fumehood_availability" name="fumehood_availability" required>
            </div>
            <div class="col-md-4">
                <label for="sustainability_feature" class="form-label">Sustainability Feature</label>
                <input type="text" class="form-control" id="sustainability_feature" name="sustainability_feature" required>
            </div>
            <div class="col-md-4">
                <label for="equipment_count" class="form-label">Equipment Count</label>
                <input type="number" class="form-control" id="equipment_count" name="equipment_count" required>
            </div>
        </div>
        <!-- Fifth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="maintenance_support" class="form-label">Maintenance Support</label>
                <input type="text" class="form-control" id="maintenance_support" name="maintenance_support" required>
            </div>
            <div class="col-md-4">
                <label for="chemical_storage_facilities" class="form-label">Chemical Storage Facilities</label>
                <input type="text" class="form-control" id="chemical_storage_facilities" name="chemical_storage_facilities" required>
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