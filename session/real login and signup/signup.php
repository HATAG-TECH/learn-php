<?php
session_start();
require "config.php";

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST["signup"])){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid request!";
    } else {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
            $error = "All fields are required!";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email format!";
        } elseif($password !== $confirm_password){
            $error = "Passwords do not match!";
        } elseif(strlen($username) < 3 || !preg_match('/^[A-Za-z0-9_]+$/', $username)) {
            $error = "Username must be at least 3 characters and contain only letters, numbers, and underscores!";
        } elseif(strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)){
            $error = "Password must be at least 8 characters, include an uppercase letter and a number!";
        } else {
            $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $error = "Username or email already exists!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $verification_token = bin2hex(random_bytes(32));
                $role = "user";
                $sql = "INSERT INTO users (username, email, password, role, verified) VALUES (?, ?, ?, ?, 1)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
                if($stmt->execute()){
                    $success = "Account created successfully! <a href='secure login.php'>Login here</a>";
                } else {
                    $error = "Error creating account!";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Signup</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <form method="POST" action="">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password:</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary w-100">Signup</button>
                        </form>
                        <p class="mt-3 text-center">Already have an account? <a href="secure login.php" class="btn btn-secondary">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>