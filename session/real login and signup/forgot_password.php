<?php
session_start();
require "config.php";

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_POST["forgot"])){
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid request!";
    } else {
        $email = trim($_POST["email"]);

        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Please enter a valid email!";
        } else {
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows === 1){
                $reset_token = bin2hex(random_bytes(32));
                $reset_expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

                $sql = "UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $reset_token, $reset_expires, $email);
                $stmt->execute();

                $success = "If the email exists, a reset link has been sent. Check your email.";
            } else {
                $success = "If the email exists, a reset link has been sent.";
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
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Forgot Password</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <form method="POST" action="">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter your email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <button type="submit" name="forgot" class="btn btn-primary w-100">Send Reset Link</button>
                        </form>
                        <p class="mt-3 text-center"><a href="secure login.php">Back to Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>