<?php
session_start();
require "config.php";

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if(isset($_POST["reset"])){
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if(empty($password) || $password !== $confirm_password || strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)){
        $error = "Password must be at least 8 characters, include an uppercase letter and a number, and match confirmation!";
    } else {
        $sql = "SELECT id FROM users WHERE reset_token = ? AND reset_expires > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $token);
            if($stmt->execute()){
                $success = "Password reset successfully! <a href='secure login.php'>Login here</a>";
            } else {
                $error = "Error resetting password!";
            }
        } else {
            $error = "Invalid or expired token!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Reset Password</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <?php if(empty($success)): ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm New Password:</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" name="reset" class="btn btn-primary w-100">Reset Password</button>
                        </form>
                        <?php endif; ?>
                        <p class="mt-3 text-center"><a href="secure login.php">Back to Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>