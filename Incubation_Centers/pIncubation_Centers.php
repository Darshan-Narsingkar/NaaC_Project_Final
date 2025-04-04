<?php
session_start();

include('db_connect.php');

// Get selected department from URL
$selectedDepartment = isset($_GET['department']) ? $_GET['department'] : '';

// Build SQL query based on department selection
if (!empty($selectedDepartment)) {
    // Prevent SQL injection using prepared statements
    $sql = "SELECT * FROM incubation_centers

 WHERE status='1' AND department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDepartment);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all data if no department is selected
    $sql = "SELECT * FROM incubation_centers

 WHERE status='1'";
    $result = $conn->query($sql);
}

$records = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All MoUs Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">incubation_centers

 Records</h2>

    <!-- Department Dropdown -->
    <form method="GET" action="Incubation_Centers/pIncubation_Centers.php" class="mb-3">
        <label for="department-dropdown" class="form-label">Select Department:</label>
        <select name="department" id="department-dropdown" class="form-select" onchange="this.form.submit()">
            <option value="">-- All Departments --</option>
            <option value="cse" <?php if ($selectedDepartment == "cse") echo "selected"; ?>>Computer Science and Engineering</option>
            <option value="it" <?php if ($selectedDepartment == "it") echo "selected"; ?>>Information Technology</option>
            <option value="extc" <?php if ($selectedDepartment == "extc") echo "selected"; ?>>Electronics and Telecommunication Engineering</option>
            <option value="mech" <?php if ($selectedDepartment == "mech") echo "selected"; ?>>Mechanical Engineering</option>
            <option value="civil" <?php if ($selectedDepartment == "civil") echo "selected"; ?>>Civil Engineering</option>
        </select>
        
    </form>
     
    <?php if (empty($records)): ?>
        <div class="alert alert-warning text-center">No records found.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <tr>
                    <th>ID</th>
                    <th>center_name</th>
                <th>year_established</th>
                <th>affiliated_institution</th>
                <th>funding_received</th>
                <th>startups_supported</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['center_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['year_established']); ?></td>
                            <td><?php echo htmlspecialchars($record['affiliated_institution']); ?></td>
                            <td><?php echo htmlspecialchars($record['funding_received']); ?></td>
                            <td><?php echo htmlspecialchars($record['startups_supported']); ?></td>
                            
                            <td><?php echo htmlspecialchars($record['department']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
           <button class="btn btn-secondary" onclick="window.open('Incubation_Centers/Print_principal.php', '_blank')">Print</button>
            <button class="btn btn-success" onclick="window.open('Incubation_Centers/principalexport_to_pdf.php', '_blank')">Export to PDF</button>
            <button class="btn btn-danger print-btn action-btn" onclick="window.open('Incubation_Centers/Analysis.php', '_blank')">View Analysis</button>

    <?php endif; ?>
</div>


<div class="text-center mt-3">
    <a href="../principal_dashboard.php">Back to Home</a>
</div>
</body>
</html>