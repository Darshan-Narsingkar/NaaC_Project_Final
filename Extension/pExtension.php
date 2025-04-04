<?php
session_start();

include('db_connect.php');

// Get selected department from URL
$selectedDepartment = isset($_GET['department']) ? $_GET['department'] : '';

// Build SQL query based on department selection
if (!empty($selectedDepartment)) {
    // Prevent SQL injection using prepared statements
    $sql = "SELECT * FROM extension_outreach

 WHERE status='1' AND department = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedDepartment);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all data if no department is selected
    $sql = "SELECT * FROM extension_outreach

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
    <h2 class="text-center mb-4">extension_outreach

 Records</h2>

    <!-- Department Dropdown -->
    <form method="GET" action="Extension/pExtension.php" class="mb-3">
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
                    <th>program_name</th>
                <th>date_conducted</th>
                <th>participants</th>
                <th>key_outcomes</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['id']); ?></td>
                            <td><?php echo htmlspecialchars($record['program_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['date_conducted']); ?></td>
                            <td><?php echo htmlspecialchars($record['participants']); ?></td>
                            <td><?php echo htmlspecialchars($record['key_outcomes']); ?></td>
                            
                            <td><?php echo htmlspecialchars($record['department']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
           <button class="btn btn-secondary" onclick="window.open('Extension/Print_principal.php', '_blank')">Print</button>
            <button class="btn btn-success" onclick="window.open('Extension/principalexport_to_pdf.php', '_blank')">Export to PDF</button>
            <button class="btn btn-danger print-btn action-btn" onclick="window.open('Extension/Analysis.php', '_blank')">View Analysis</button>

    <?php endif; ?>
</div>


<div class="text-center mt-3">
    <a href="../principal_dashboard.php">Back to Home</a>
</div>
</body>
</html>