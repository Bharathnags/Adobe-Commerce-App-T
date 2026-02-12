<?php
global $conn;
require_once __DIR__ . "/db.php";

$message = "";
$msg_type = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //  if email already exists
    $check_email = mysqli_real_escape_string($conn, $email);
    $check_sql = "SELECT id FROM users WHERE email = '$check_email'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Email already taken
        $message = "This email is already registered! Please use another.";
        $msg_type = "error";
    } else {
        //  Encrypt password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //  Escape inputs for safety
        $safe_username = mysqli_real_escape_string($conn, $username);
        $safe_email = mysqli_real_escape_string($conn, $email);

        //  Inserting  into database
        $sql = "INSERT INTO users (username, email, password)
                VALUES ('$safe_username', '$safe_email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            // Step 5: Redirect to login page
            header("Location: login.php?registered=1");
            exit();
        } else {
            $message = "Registration failed: " . mysqli_error($conn);
            $msg_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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

        input {
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
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

        p {
            text-align: center;
        }
    </style>
</head>
<body>
<h2>📝 Register</h2>

<?php if ($message): ?>
    <div class="message <?php echo $msg_type; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="post">
    <input name="username" placeholder="Username" required
           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

    <input name="email" type="email" placeholder="Email" required
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <input name="password" type="password" placeholder="Password" required>

    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>