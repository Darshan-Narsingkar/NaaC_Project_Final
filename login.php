<?php
session_start();

include('db_connect.php');


if (isset($_SESSION['user_role'])) {
    $redirects = [
        'principal' => 'principal_dashboard.php',
        'faculty' => 'index.php',  
        'hod' => 'hod.php',
        'MECHhod'=>'MECHhod.php',
        'CVILhod'=>'CVILhod.php',
        'CSEhod'=>'CSEhod.php',
        'EXTChod'=>'EXTChod.php'
    ];
    
    $userRole = $_SESSION['user_role'];
    if (isset($redirects[$userRole])) {
        header("Location: " . $redirects[$userRole]);
        exit();
    }
}



$users = [
    'principal' => ['username' => 'principal', 'password' => 'principal123', 'redirect' => 'principal_dashboard.php'],
    'hod' => ['username' => 'hod', 'password' => 'hod123', 'redirect' => 'hod.php'],
    'MECHhod' => ['username' => 'MECHhod', 'password' => 'MECHhod123', 'redirect' => 'MECHhod.php'],
    'CVILhod' => ['username' => 'CVILhod', 'password' => 'CVILhod123', 'redirect' => 'CVILhod.php'],
    'CSEhod' => ['username' => 'CSEhod', 'password' => 'CSEhod123', 'redirect' => 'CSEhod.php'],
    'EXTChod' => ['username' => 'EXTChod', 'password' => 'EXTChod123', 'redirect' => 'EXTChod.php']
];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    
    $sql = "SELECT * FROM faculty WHERE official_email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Assuming you are using faculty_id to track the logged-in user
        $user = $result->fetch_assoc();
        $_SESSION['user_role'] = 'faculty';
        $_SESSION['faculty_id'] = $user['faculty_id']; // Store the faculty_id in session
        header("Location: index.php");
        exit();
    }

    
    
    foreach ($users as $role => $credentials) {
        if ($username === $credentials['username'] && $password === $credentials['password']) {
            $_SESSION['user_role'] = $role;
            header("Location: " . $credentials['redirect']);
            exit();
        }
    }
    
    
    
    $error = "Invalid username or password!";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h3 class="text-center fas fa-university mb-4">&nbsp;Login</h3>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="change_password_form.php" class="text-decoration-none">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                

                <p>Don't have an account? <a href="faculty_form.php" class="text-decoration-none">Sign up</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
