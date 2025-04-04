<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Budget Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ecf0f1;
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
        <h2>Annual Budget Form</h2>
        <form action="annual_budget_submit.php" method="POST">
            <!-- Year and Total Annual Budget -->
            <div class="row">
                <div class="col-md-6">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-control" id="year" name="year" required>
    <?php
        $currentYear = date("Y"); // Get the current year
        for ($startYear = 2000; $startYear < $currentYear; $startYear++) {
            $endYear = $startYear + 1; // Calculate the end year
            echo "<option value='$startYear-$endYear'>$startYear-$endYear</option>";
        }
    ?>
</select>

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="total_annual_budget" class="form-label">Total Annual Budget</label>
                    <input type="number" class="form-control" id="total_annual_budget" name="total_annual_budget" required>
                </div>
            </div>

            <!-- Allocation Fields -->
            <div class="row">
                <div class="col-md-4">
                    <label for="building_maintenance" class="form-label">Allocation for Building Maintenance</label>
                    <input type="number" class="form-control" id="building_maintenance" name="building_maintenance" required>
                </div>
                <div class="col-md-4">
                    <label for="electrical_system" class="form-label">Allocation for Electrical System</label>
                    <input type="number" class="form-control" id="electrical_system" name="electrical_system" required>
                </div>
                <div class="col-md-4">
                    <label for="hvac_system" class="form-label">Allocation for HVAC</label>
                    <input type="number" class="form-control" id="hvac_system" name="hvac_system" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="plumbing" class="form-label">Allocation for Plumbing</label>
                    <input type="number" class="form-control" id="plumbing" name="plumbing" required>
                </div>
                <div class="col-md-4">
                    <label for="landscaping" class="form-label">Allocation for Landscaping</label>
                    <input type="number" class="form-control" id="landscaping" name="landscaping" required>
                </div>
                <div class="col-md-4">
                    <label for="safety_equipment" class="form-label">Allocation for Safety Equipment</label>
                    <input type="number" class="form-control" id="safety_equipment" name="safety_equipment" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="water_supply_system" class="form-label">Allocation for Water Supply System</label>
                    <input type="number" class="form-control" id="water_supply_system" name="water_supply_system" required>
                </div>
                <div class="col-md-4">
                    <label for="waste_management" class="form-label">Allocation for Waste Management</label>
                    <input type="number" class="form-control" id="waste_management" name="waste_management" required>
                </div>
                <div class="col-md-4">
                    <label for="ict_facilities" class="form-label">Allocation for ICT Facilities</label>
                    <input type="number" class="form-control" id="ict_facilities" name="ict_facilities" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="green_campus_initiatives" class="form-label">Allocation for Green Campus Initiatives</label>
                    <input type="number" class="form-control" id="green_campus_initiatives" name="green_campus_initiatives" required>
                </div>
                <div class="col-md-4">
                    <label for="security_systems" class="form-label">Allocation for Security Systems</label>
                    <input type="number" class="form-control" id="security_systems" name="security_systems" required>
                </div>
                <div class="col-md-4">
                    <label for="pest_control" class="form-label">Allocation for Pest Control</label>
                    <input type="number" class="form-control" id="pest_control" name="pest_control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="repair_works" class="form-label">Allocation for Repair Works</label>
                    <input type="number" class="form-control" id="repair_works" name="repair_works" required>
                </div>
                <div class="col-md-4">
                    <label for="transport_facilities" class="form-label">Allocation for Transport Facilities</label>
                    <input type="number" class="form-control" id="transport_facilities" name="transport_facilities" required>
                </div>
                <div class="col-md-4">
                    <label for="research_labs" class="form-label">Allocation for Research Labs</label>
                    <input type="number" class="form-control" id="research_labs" name="research_labs" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="hostel_facilities" class="form-label">Allocation for Hostel Facilities</label>
                    <input type="number" class="form-control" id="hostel_facilities" name="hostel_facilities" required>
                </div>
                <div class="col-md-4">
                    <label for="sports_facilities" class="form-label">Allocation for Sports Facilities</label>
                    <input type="number" class="form-control" id="sports_facilities" name="sports_facilities" required>
                </div>
                <div class="col-md-4">
                    <label for="contingency_budget" class="form-label">Contingency Budget</label>
                    <input type="number" class="form-control" id="contingency_budget" name="contingency_budget" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary" style="width: 200px;">Submit Annual Budget</button>
            </div>
        </form>
    </div>
</body>
</html>