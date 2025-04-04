<?php

include('db_connect.php');


$organization = $_POST['organization'];
$date_of_mou_signed = $_POST['date_of_mou_signed'];
$purpose_activities = $_POST['purpose_activities'];
$teachers_participated = $_POST['teachers_participated'];
$department = isset($_POST['department']) ? $_POST['department'] : 'general'; 


$target_dir = "mous/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); 
}

$file_name = basename($_FILES["proof_file"]["name"]);
$target_file = $target_dir . time() . "_" . $file_name; 
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed_types = array("pdf", "jpg", "jpeg", "png", "doc", "docx");

if (in_array($file_type, $allowed_types)) {
    if (move_uploaded_file($_FILES["proof_file"]["tmp_name"], $target_file)) {
        
        $sql = "INSERT INTO MoUs_data (organization, date_of_mou_signed, purpose_activities, teachers_participated, department, proof_file) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiss", $organization, $date_of_mou_signed, $purpose_activities, $teachers_participated, $department, $target_file);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Data inserted successfully!');
                    window.location.href = 'index.php'; // Change this to your actual form page
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                    window.history.back();
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('Error uploading file! Please try again.');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid file type! Allowed types: PDF, JPG, PNG, DOC, DOCX.');
            window.history.back();
          </script>";
}

$conn->close();
?>
