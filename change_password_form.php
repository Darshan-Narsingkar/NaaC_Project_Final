<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Arial', sans-serif;
    background: #f4f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Container Styling */
.container {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    padding: 40px;
    text-align: center;
}

/* Heading Styling */
h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
    text-align: left;
    font-size: 16px;
}

/* Label Styling */
label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

/* Input Styling */
input[type="password"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 5px;
    transition: all 0.3s ease;
}

/* Focus Effect on Input */
input[type="password"]:focus {
    border-color: #6C63FF;
    outline: none;
}

/* Button Styling */
button {
    width: 100%;
    padding: 14px;
    background-color: #6C63FF;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Button Hover Effect */
button:hover {
    background-color: #5a52e6;
}

/* Error and Success Message Styling */
.error {
    color: #e74c3c;
    font-size: 14px;
    margin-bottom: 20px;
}

.success {
    color: #2ecc71;
    font-size: 14px;
    margin-bottom: 20px;
}

        </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <?php
        // Display error or success messages
        if (isset($_GET['error'])) {
            echo "<p class='error'>".$_GET['error']."</p>";
        }
        if (isset($_GET['message'])) {
            echo "<p class='success'>".$_GET['message']."</p>";
        }
        ?>

        <form action="change_password_submit.php" method="POST">
            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" id="old_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>

            <button type="submit">Change Password</button>
           
        </form>
        <p>Back to dashboard? <a href="index.php" class="text-decoration-none">Home</a></p>
           
    </div>
</body>
</html>
