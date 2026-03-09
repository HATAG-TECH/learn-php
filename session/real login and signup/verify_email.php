<?php
require "config.php";

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if (empty($token)) {
    $error = "Invalid verification link!";
} else {
    $sql = "SELECT id, verified FROM users WHERE verification_token = ? AND verification_expires > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ((int) $user['verified'] === 1) {
            $success = "Your email is already verified. <a href='secure login.php'>Login here</a>";
        } else {
            $sql = "UPDATE users SET verified = 1, verified_at = NOW(), verification_token = NULL, verification_expires = NULL WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user['id']);

            if ($stmt->execute()) {
                $success = "Email verified successfully! <a href='secure login.php'>Login here</a>";
            } else {
                $error = "Error verifying email!";
            }
        }
    } else {
        $error = "Invalid or expired verification link!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Email Verification</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($error !== '') { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <?php if ($success !== '') { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <p class="mt-3 text-center"><a href="secure login.php">Back to Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>