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
$sql = "SELECT * FROM classroom_facilities";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom Facilities</title>
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
                <th onclick="sortTable(1)">Number of Classrooms</th>
                <th onclick="sortTable(2)">Seating Capacity</th>
                <th onclick="sortTable(3)">Avg Size of Class (sq.m)</th>
                <th onclick="sortTable(4)">Number of Projectors</th>
                <th onclick="sortTable(5)">Number of Smart Boards</th>
                <th onclick="sortTable(6)">Number of Audio Systems</th>
                <th onclick="sortTable(7)">Number of AU Facilities</th>
                <th onclick="sortTable(8)">Number of Air Conditioners</th>
                <th onclick="sortTable(9)">Number of Boards</th>
                <th onclick="sortTable(10)">Internet Connectivity</th>
                <th onclick="sortTable(11)">Lighting</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['no_of_classrooms']}</td>
                            <td>{$row['seating_capacity']}</td>
                            <td>{$row['avg_size_classroom']}</td>
                            <td>{$row['no_of_projectors']}</td>
                            <td>{$row['no_of_smart_boards']}</td>
                            <td>{$row['no_of_audio_systems']}</td>
                            <td>{$row['no_of_au_facilities']}</td>
                            <td>{$row['no_of_air_conditioners']}</td>
                            <td>{$row['no_of_boards']}</td>
                            <td>{$row['internet_connectivity']}</td>
                            <td>{$row['lighting']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No records found</td></tr>";
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