<?php
session_start();
include('db_connect.php'); // Ensure this file correctly establishes your database connection

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query to fetch faculty details from the IT department
$query = "SELECT * FROM faculty WHERE department = mech";
$result = mysqli_query($conn, $query);

// Debugging: Check if query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Debugging: Check if any rows were returned
if (mysqli_num_rows($result) == 0) {
    echo "<p>No faculty data found for the MECH department.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard - MECH Faculty</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .table-container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            border: 1px solid #ddd;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 800px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Prevents text from wrapping */
        }

        th {
            background-color:#2C3E50;;
            color: white;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Responsive Table */
        @media screen and (max-width: 768px) {
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px;
            }
        }

        /* Back to Dashboard Link */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color:#2C3E50;;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>MECH Department Faculty Details</h2>

    <div class="table-container">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Faculty ID</th>
                        <th>Initials</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Blood Group</th>
                        <th>Designation</th>
                        <th>Joining Date</th>
                        <th>Qualification</th>
                        <th>Specialization</th>
                        <th>Experience</th>
                        <th>Official Email</th>
                        <th>Personal Email</th>
                        <th>Phone Number</th>
                        <th>Postal Address</th>
                        <th>Permanent Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['faculty_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['initials']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['middle_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                        <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                        <td><?php echo htmlspecialchars($row['designation']); ?></td>
                        <td><?php echo htmlspecialchars($row['joining_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['qualification']); ?></td>
                        <td><?php echo htmlspecialchars($row['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($row['experience']); ?></td>
                        <td><?php echo htmlspecialchars($row['official_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['personal_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['postal_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['permanent_address']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p style="text-align: center; font-size: 16px; color: #888;">No faculty members found in the IT department.</p>
        <?php } ?>
    </div>

    <a href="MECHhod.php" class="back-link">Back to Dashboard</a>

</body>
</html>

<?php mysqli_close($conn); ?>
