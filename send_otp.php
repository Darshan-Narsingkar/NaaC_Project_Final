<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $official_email
 = $_POST['official_email
'];
    $otp = rand(100000, 999999);

    // Store OTP in session
    $_SESSION['otp'] = $otp;
    $_SESSION['official_email
'] = $official_email
;

    // Store OTP in the database
    $stmt = $conn->prepare("UPDATE faculty SET otp=? WHERE official_official_email
=?");
    $stmt->bind_param("ss", $otp, $official_email
);
    $stmt->execute();

    // Send OTP via official_email

    $to = $official_email
;
    $subject = "Your OTP Code";
    $message = "Your OTP is: " . $otp;
    $headers = "From: noreply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "OTP sent successfully.";
        echo '<form action="verify_otp.php" method="post">
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <button type="submit">Verify OTP</button>
              </form>';
    } else {
        echo "Failed to send OTP.";
    }
}
?>
