<?php
 include('db_connect.php');

// Fetch data from the database
$sql = "SELECT * FROM campus_area";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0px;
        }

        .container {
            max-width: 100%;
            overflow-x: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            margin-left: -5px;
        }

        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        #searchInput {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
        }

        button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            color: white;
        }

        .accept-btn { background: #2ecc71; }
        .reject-btn { background: #e74c3c; }
        .edit-btn { background: #f39c12; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: white;
            cursor: pointer;
        }

        tbody tr:nth-child(odd) { background: #f4f4f4; }
        tbody tr:nth-child(even) { background: #ffffff; }
        tbody tr:hover { background: #d1e7fd; transition: 0.3s ease-in-out; }

        /* Custom Popup Styling */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            z-index: 1000;
            text-align: center;
        }
        .popup button {
            margin: 10px;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            color: white;
        }
        .popup .yes-btn { background: #e74c3c; }
        .popup .no-btn { background: #2c3e50; }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="controls">
        <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
        <button class="accept-btn">Accept</button>
        <button class="reject-btn" onclick="confirmDeletion()">Reject</button>
        <button class="edit-btn">&#9998; Edit</button>
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



</body>
</html>
<?php $conn->close(); ?>
