<?php
// Database connection
include('db_connect.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM laboratory_facilities";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Facilities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0px;
            background-color: #f4f4f4;
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
            width: 400px;
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
        .edit-btn { background: #f39c12; display: flex; align-items: center; gap: 5px; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 8px;
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
    </style>
</head>
<body>

<div class="container">
    <div class="controls">
        <input type="text" id="searchInput" placeholder="Search by any field..." onkeyup="searchTable()">
        <button class="accept-btn">Accept</button>
        <button class="reject-btn">Reject</button>
        <button class="edit-btn"><i>&#9998;</i> Edit</button>
    </div>
    
    <table id="dataTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Number of Labs</th>
                <th onclick="sortTable(2)">Type of Labs</th>
                <th onclick="sortTable(3)">Total Seating Capacity</th>
                <th onclick="sortTable(4)">ICT Enabled</th>
                <th onclick="sortTable(5)">Modern Equipment Available</th>
                <th onclick="sortTable(6)">Safety Equipment</th>
                <th onclick="sortTable(7)">Size of Labs (sq. m)</th>
                <th onclick="sortTable(8)">Ventilation</th>
                <th onclick="sortTable(9)">Lab with Research Facilities</th>
                <th onclick="sortTable(10)">Availability of Fumehood</th>
                <th onclick="sortTable(11)">Sustainability Feature</th>
                <th onclick="sortTable(12)">Equipment Count</th>
                <th onclick="sortTable(13)">Maintenance Support</th>
                <th onclick="sortTable(14)">Chemical Storage Facilities</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['no_of_labs']}</td>
                            <td>{$row['type_of_labs']}</td>
                            <td>{$row['seating_capacity']}</td>
                            <td>{$row['ict_enabled']}</td>
                            <td>{$row['modern_equipment']}</td>
                            <td>{$row['safety_equipment']}</td>
                            <td>{$row['size_of_labs']}</td>
                            <td>{$row['ventilation']}</td>
                            <td>{$row['research_facilities']}</td>
                            <td>{$row['fumehood_availability']}</td>
                            <td>{$row['sustainability_feature']}</td>
                            <td>{$row['equipment_count']}</td>
                            <td>{$row['maintenance_support']}</td>
                            <td>{$row['chemical_storage_facilities']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='15'>No records found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
    function sortTable(columnIndex) {
        let table = document.getElementById("dataTable");
        let rows = Array.from(table.querySelectorAll("tbody tr"));
        let ascending = table.getAttribute("data-sort-order") !== "asc";

        rows.sort((a, b) => {
            let aValue = a.cells[columnIndex].textContent.trim();
            let bValue = b.cells[columnIndex].textContent.trim();
            
            if (!isNaN(aValue) && !isNaN(bValue)) {
                return ascending ? aValue - bValue : bValue - aValue;
            } else {
                return ascending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            }
        });

        table.setAttribute("data-sort-order", ascending ? "asc" : "desc");
        table.querySelector("tbody").append(...rows);
    }

    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.querySelectorAll("#dataTable tbody tr");

        rows.forEach(row => {
            let cells = row.getElementsByTagName("td");
            let match = false;

            for (let cell of cells) {
                if (cell.textContent.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? "" : "none";
        });
    }
</script>

</body>
</html>