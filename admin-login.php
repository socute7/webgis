<?php
session_start();

if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-dashboard.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "admin";
    $admin_password = password_hash("123456", PASSWORD_DEFAULT);
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $admin_username && password_verify($password, $admin_password)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button[type="submit"],
        button[type="button"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            display: block;
            margin-top: 10px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        button[type="button"] {
            background-color: #808080;
        }
        button[type="button"]:hover {
            background-color: #666666;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <?php
        if(isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <button type="button" onclick="window.location.href='index.php';">Back</button>
    </div>
</body>
</html>
