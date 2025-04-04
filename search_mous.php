<?php
 include('db_connect.php');

// Get search term
$search_id = isset($_POST['search_id']) ? intval($_POST['search_id']) : '';

// Fetch records
$sql = "SELECT * FROM MoUs_data ";
if ($search_id != "") {
    $sql .= " AND id = $search_id"; // Filter by ID
}
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status_class = ($row['status'] == 1) ? 'accepted' : (($row['status'] == 2) ? 'rejected' : 'pending');
        $status_text = ($row['status'] == 1) ? 'Accepted' : (($row['status'] == 2) ? 'Rejected' : 'Pending');
        $proof_file = !empty($row['proof_file']) ? "<a href='mous/{$row['proof_file']}' download>Download</a>" : "No file";

        echo "<tr class='$status_class'>
                <td>{$row['id']}</td>
                <td>{$row['organization']}</td>
                <td>{$row['date_of_mou_signed']}</td>
                <td>{$row['purpose_activities']}</td>
                <td>{$row['teachers_participated']}</td>
                <td><strong>$status_text</strong></td>
                <td>$proof_file</td>
                <td>";

        if ($row['status'] == 0 || $row['status'] == 2) {
            echo "<a href='hMoUs_data.php?accept_id={$row['id']}'>
                      <button class='accept-btn'>Accept</button>
                  </a>";
        }

        if ($row['status'] == 0 || $row['status'] == 1) {
            echo "<a href='hMoUs_data.php?reject_id={$row['id']}'>
                      <button class='reject-btn'>Reject</button>
                  </a>";
        }

        if ($row['status'] != 2) {
            echo "<a href='Updatemou.php?id={$row['id']}'>
                      <button class='update-btn'>Update</button>
                  </a>";
        }

        echo "</td></tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}
?>
