<?php

include('db_connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    
    $faculty_id = $_POST['faculty_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $blood_group = $_POST['blood_group'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $joining_date = $_POST['joining_date'];
    $qualification = $_POST['qualification'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];
    $official_email = $_POST['official_email'];
    $personal_email = $_POST['personal_email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $postal_address = $_POST['postal_address'];
    $permanent_address = $_POST['permanent_address'];

    
    
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        
        
        $sql = "INSERT INTO faculty (faculty_id, first_name, middle_name, last_name, gender, date_of_birth, blood_group, department, designation, joining_date, qualification, specialization, experience, official_email, personal_email, phone_number, password, postal_address, permanent_address)
        VALUES ('$faculty_id', '$first_name', '$middle_name', '$last_name', '$gender', '$date_of_birth', '$blood_group', '$department', '$designation', '$joining_date', '$qualification', '$specialization', '$experience', '$official_email', '$personal_email', '$phone_number', '$password', '$postal_address', '$permanent_address')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Faculty registered successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body {
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

    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Faculty Registration Form</h2>
            <form action="faculty_form.php" method="POST">
                
                <!-- Faculty ID (Not Auto-Generated) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="faculty_id" class="form-label">Faculty ID</label>
                        <input type="text" class="form-control" id="faculty_id" name="faculty_id" required>
                    </div>
                    <div class="col-md-6">
                        <label for="initials" class="form-label">Initials</label>
                        <input type="text" class="form-control" id="initials" name="initials" readonly>
                    </div>
                </div>

                <!-- First Name, Middle Name, Last Name -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="col-md-4">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <!-- Gender, Date of Birth, Blood Group -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                    </div>
                    <div class="col-md-4">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select class="form-select" id="blood_group" name="blood_group" required>
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <!-- Department, Designation, Joining Date -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="it">Information Technology</option>
                            <option value="extc">Electronics and Telecommunication</option>
                            <option value="cse">Computer Science and Engineering</option>
                            <option value="mech">Mechanical Engineering</option>
                            <option value="civil">Civil Engineering</option>
                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" required>
                    </div>
                    <div class="col-md-4">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date" required>
                    </div>
                </div>

                <!-- Qualification, Specialization, Experience -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" required>
                    </div>
                    <div class="col-md-4">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization">
                    </div>
                    <div class="col-md-4">
                        <label for="experience" class="form-label">Experience (Years)</label>
                        <input type="number" class="form-control" id="experience" name="experience" readonly>
                    </div>
                </div>

               
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="official_email" class="form-label">Official Email</label>
                        <input type="email" class="form-control" id="official_email" name="official_email" required>
                    </div>
                    <div class="col-md-4">
                        <label for="personal_email" class="form-label">Personal Email</label>
                        <input type="email" class="form-control" id="personal_email" name="personal_email">
                    </div>
                    <div class="col-md-4">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                </div>

                <!-- Password and Confirm Password -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-md-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                </div>

                <!-- Postal Address and Permanent Address in a Single Row -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="postal_address" class="form-label">Postal Address</label>
                        <textarea class="form-control" id="postal_address" name="postal_address" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="permanent_address" class="form-label">Permanent Address</label>
                        <textarea class="form-control" id="permanent_address" name="permanent_address" required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register Faculty</button>
            </form>
            <div class="text-center mt-3">
                <p>Don't have an account? <a href="login.php" class="text-decoration-none">Sign in</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Automatically generate initials from first, middle, and last names
        document.getElementById('first_name').addEventListener('input', generateInitials);
        document.getElementById('middle_name').addEventListener('input', generateInitials);
        document.getElementById('last_name').addEventListener('input', generateInitials);

        function generateInitials() {
            var firstName = document.getElementById('first_name').value;
            var middleName = document.getElementById('middle_name').value;
            var lastName = document.getElementById('last_name').value;
            var initials = firstName.charAt(0) + (middleName.charAt(0) || '') + lastName.charAt(0);
            document.getElementById('initials').value = initials.toUpperCase();
        }

        // Automatically calculate experience based on joining date
        document.getElementById('joining_date').addEventListener('change', function() {
            var joiningDate = new Date(this.value);
            var currentDate = new Date();
            var years = currentDate.getFullYear() - joiningDate.getFullYear();
            var months = currentDate.getMonth() - joiningDate.getMonth();
            if (months < 0 || (months === 0 && currentDate.getDate() < joiningDate.getDate())) {
                years--;
            }
            document.getElementById('experience').value = years;
        });
    </script>
</body>
</html>
