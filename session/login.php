<?php
session_start();

$users = [
    ["username" => "hatag", "password" => "1234", "role" => "admin"],
    ["username" => "john",  "password" => "1111", "role" => "user"],
    ["username" => "sara",  "password" => "2222", "role" => "user"]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $foundUser = null;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $foundUser = $user;
            break;
        }
    }

    if ($foundUser) {
        $_SESSION['username'] = $foundUser['username'];
        $_SESSION['role'] = $foundUser['role'];
        header($foundUser['role'] === 'admin' ? 'Location: admin.php' : 'Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid login!';
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Login Page</h2>
<form method="post" action="">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
</body>
</html>