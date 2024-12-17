<?php
session_start();


$admin_username = "admin";
$admin_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid ID or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
        <div class="logo">Car Care Workshop</div>
        <ul>
            <li><a href="index.html#home">Home</a></li>
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#about-us">About</a></li>
            <li><a href="index.html#contact">Contact</a></li>
        </ul>
    </nav>

    <h2>Admin Login</h2>
    <form method="POST" action="login.php">
        <label for="username">Admin ID:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
