<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Facilities Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Body background and form layout */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 78%;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2C3E50; /* Updated title color */
            font-weight: 700;
            margin-bottom: 30px;
        }
        label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #2C3E50; /* Updated button color */
            border: none;
            padding: 10px 20px;
            width: auto; /* Reduced width */
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #1A252F;
        }
        /* Adjusting form boxes */
        .form-group {
            margin-bottom: 20px;
        }
        .row {
            margin-bottom: 15px;
        }
        .col-md-4 {
            margin-bottom: 15px;
        }
        .form-label {
            font-size: 16px;
            margin-bottom: 5px;
        }
        /* Input box sizes */
        .form-control {
            font-size: 16px;
            padding: 10px;
        }
        select.form-control {
            font-size: 16px;
            padding: 10px;
        }
        /* Styling for buttons */
        .btn {
            font-size: 18px;
            background-color:#2C3E50; 
            color: #fff;
        }
        .btn:hover {
            background-color: #2C3E50; 
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Classroom Facilities Form</h2>
    <form action="classroom_facilities_submit.php" method="POST">
        <!-- First Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_classrooms" class="form-label">Number of Classrooms</label>
                    <input type="number" class="form-control" id="no_of_classrooms" name="no_of_classrooms" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="seating_capacity" class="form-label">Seating Capacity</label>
                    <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="avg_size_classroom" class="form-label">Avg Size of Class (sq.m)</label>
                    <input type="number" step="0.01" class="form-control" id="avg_size_classroom" name="avg_size_classroom" required>
                </div>
            </div>
        </div>
        <!-- Second Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_projectors" class="form-label">Number of Projectors</label>
                    <input type="number" class="form-control" id="no_of_projectors" name="no_of_projectors" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_smart_boards" class="form-label">Number of Smart Boards</label>
                    <input type="number" class="form-control" id="no_of_smart_boards" name="no_of_smart_boards" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_audio_systems" class="form-label">Number of Audio Systems</label>
                    <input type="number" class="form-control" id="no_of_audio_systems" name="no_of_audio_systems" required>
                </div>
            </div>
        </div>
        <!-- Third Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_au_facilities" class="form-label">Number of AU Facilities</label>
                    <input type="number" class="form-control" id="no_of_au_facilities" name="no_of_au_facilities" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_air_conditioners" class="form-label">Number of Air Conditioners</label>
                    <input type="number" class="form-control" id="no_of_air_conditioners" name="no_of_air_conditioners" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_boards" class="form-label">Number of Boards</label>
                    <input type="number" class="form-control" id="no_of_boards" name="no_of_boards" required>
                </div>
            </div>
        </div>
        <!-- Fourth Row -->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="internet_connectivity" class="form-label">Internet Connectivity</label>
                    <select class="form-control" id="internet_connectivity" name="internet_connectivity" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lighting" class="form-label">Lighting</label>
                    <select class="form-control" id="lighting" name="lighting" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="width: 200px;">Submit</button>
        </div>
    </form>
</div>

</body>
</html>