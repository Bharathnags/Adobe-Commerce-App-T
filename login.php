<?php
global $conn;
session_start();
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/auth_check.php";

// If already logged in (session or cookie), go to dashboard
if (check_login($conn)) {
    header("Location: dashboard.php");
    exit();
}

$message = "";

// Show success message after registration
if (isset($_GET['registered'])) {
    $message = "✅ Registration successful! Please login.";
    $msg_type = "success";
} else {
    $msg_type = "error";
}

if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Escape email for safety
    $safe_email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE email = '$safe_email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        // Login successful - Set session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];

        // Handle "Remember Me" checkbox
        if (isset($_POST["remember"])) {
            // Generate a random secure token
            $token = bin2hex(random_bytes(32));

            // Save token in database
            $user_id = $user["id"];
            $update_sql = "UPDATE users SET remember_token = '$token' WHERE id = $user_id";
            mysqli_query($conn, $update_sql);
            // if browser close session close but cookie value is there for 7 days u can come back but remember button need to click
            // Set cookie with token (7 days = 7 * 24 * 60 * 60)
            setcookie("remember_token", $token, time() + (86400 * 7), "/");
        }

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Wrong email or password!";
        $msg_type = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #1976D2;
        }

        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            text-align: center;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .remember-me {
            margin: 10px 0;
        }

        .remember-me input {
            width: auto;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
<h2>🔐 Login</h2>

<?php if ($message): ?>
    <div class="message <?php echo $msg_type; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="post">
    <input name="email"
           type="email"
           placeholder="Email"
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
           required>

    <input name="password" type="password" placeholder="Password" required>

    <div class="remember-me">
        <label>
            <input type="checkbox" name="remember"> Remember Me (7 days)
        </label>
    </div>

    <button type="submit" name="login">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>



