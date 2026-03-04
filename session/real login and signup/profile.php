<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: secure login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

if(isset($_POST["update"])){
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);

    if(empty($username) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Valid username and email are required!";
    } else {
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $user_id);
        if($stmt->execute()){
            $_SESSION['username'] = $username;
            $success = "Profile updated successfully!";
        } else {
            $error = "Error updating profile!";
        }
    }
}

// Fetch current user data
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Edit Profile</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary w-100">Update Profile</button>
                        </form>
                        <p class="mt-3 text-center"><a href="../dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>