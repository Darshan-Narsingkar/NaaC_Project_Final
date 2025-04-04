<?php
 include('db_connect.php');
// Fetch data from database
$sql = "SELECT * FROM campus_area";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Area Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 100%;
            overflow-x: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .controls {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .reject-btn {
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #2c3e50;
            color: white;
        }
        tbody tr:nth-child(odd) { background: #f4f4f4; }
        tbody tr:hover { background: #d1e7fd; }
    </style>
</head>
<body>

<div class="container">
    <div class="controls">
        <button class="reject-btn" onclick="confirmDeletion()">Reject</button>
    </div>

    <table id="dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Total Area</th>
                <th>Built Up Area</th>
                <th>Green Area</th>
                <th>Playground Area</th>
                <th>Open Space</th>
                <th>Parking Area</th>
                <th>Admin Block Area</th>
                <th>Academic Block Area</th>
                <th>Auditorium Area</th>
                <th>Residential Area</th>
                <th>Sustainability Area</th>
                <th>Hostel Area</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['total_area']}</td>
                            <td>{$row['built_up_area']}</td>
                            <td>{$row['green_area']}</td>
                            <td>{$row['playground_area']}</td>
                            <td>{$row['open_space']}</td>
                            <td>{$row['parking_area']}</td>
                            <td>{$row['administrator_block_area']}</td>
                            <td>{$row['academic_block_area']}</td>
                            <td>{$row['auditorium_area']}</td>
                            <td>{$row['residential_area']}</td>
                            <td>{$row['sustainability_area']}</td>
                            <td>{$row['hostel_area']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDeletion() {
        if (confirm("Are you really want to delete this data?")) {
            fetch('delete_data.php', { method: 'POST' })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error("Error:", error));
        }
    }
</script>

</body>
</html>
<?php $conn->close(); ?>
