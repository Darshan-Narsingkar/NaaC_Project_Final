<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Facilities Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            width: 78%;
            margin: 50px auto;
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
    <h2>ICT Facilities Form</h2>
    <form action="ict_facilities_submit.php" method="POST">
        <!-- First Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="total_computers" class="form-label">Total Computers</label>
                <input type="number" class="form-control" id="total_computers" name="total_computers" required>
            </div>
            <div class="col-md-4">
                <label for="internet_bandwidth" class="form-label">Internet Bandwidth</label>
                <input type="text" class="form-control" id="internet_bandwidth" name="internet_bandwidth" required>
            </div>
            <div class="col-md-4">
                <label for="wifi_availability" class="form-label">WiFi Availability</label>
                <input type="text" class="form-control" id="wifi_availability" name="wifi_availability" required>
            </div>
        </div>
        <!-- Second Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="no_of_smart_boards" class="form-label">Number of Smart Boards</label>
                <input type="number" class="form-control" id="no_of_smart_boards" name="no_of_smart_boards" required>
            </div>
            <div class="col-md-4">
                <label for="audio_visual_facilities" class="form-label">Audio/Visual Facilities</label>
                <input type="text" class="form-control" id="audio_visual_facilities" name="audio_visual_facilities" required>
            </div>
            <div class="col-md-4">
                <label for="no_of_servers" class="form-label">Number of Servers</label>
                <input type="number" class="form-control" id="no_of_servers" name="no_of_servers" required>
            </div>
        </div>
        <!-- Third Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="it_support_staff" class="form-label">IT Support Staff</label>
                <input type="text" class="form-control" id="it_support_staff" name="it_support_staff" required>
            </div>
            <div class="col-md-4">
                <label for="backup_system" class="form-label">Backup System</label>
                <input type="text" class="form-control" id="backup_system" name="backup_system" required>
            </div>
            <div class="col-md-4">
                <label for="electronic_resources" class="form-label">Electronic Resources</label>
                <input type="text" class="form-control" id="electronic_resources" name="electronic_resources" required>
            </div>
        </div>
        <!-- Fourth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="video_conferencing" class="form-label">Video Conferencing Facilities</label>
                <input type="text" class="form-control" id="video_conferencing" name="video_conferencing" required>
            </div>
            <div class="col-md-4">
                <label for="digital_learning_platform" class="form-label">Digital Learning Platform</label>
                <input type="text" class="form-control" id="digital_learning_platform" name="digital_learning_platform" required>
            </div>
            <div class="col-md-4">
                <label for="lab_ict_enable" class="form-label">Lab ICT Enabled</label>
                <input type="text" class="form-control" id="lab_ict_enable" name="lab_ict_enable" required>
            </div>
        </div>
        <!-- Fifth Row -->
        <div class="row">
            <div class="col-md-4">
                <label for="energy_efficient" class="form-label">Energy Efficient</label>
                <input type="text" class="form-control" id="energy_efficient" name="energy_efficient" required>
            </div>
            <div class="col-md-4">
                <label for="it_tech_support_availability" class="form-label">IT Tech Support Availability</label>
                <input type="text" class="form-control" id="it_tech_support_availability" name="it_tech_support_availability" required>
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