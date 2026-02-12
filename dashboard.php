<?php
global $conn;
require_once __DIR__ . "/auth_check.php";
require_once __DIR__ . "/db.php";

// Check if user is logged in (session or cookie)
if (!check_login($conn)) {
    header("Location: login.php");
    exit();
}

// Fetch fresh user data from database
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    // User not found in DB, destroy session
    session_destroy();
    header("Location: login.php");
    exit();
}

// Extract user data
$username = $user["username"];
$email = $user["email"];
$gender = $user["gender"] ? $user["gender"] : "Not set";
$country = $user["country"] ? $user["country"] : "Not set";
$hobbies = $user["hobbies"] ? $user["hobbies"] : "Not set";
$about = $user["about"] ? $user["about"] : "Not set";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #333;
        }

        .welcome-box {
            background-color: #e8f5e9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
        }

        .user-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-info table tr {
            border-bottom: 1px solid #eee;
        }

        .user-info table td {
            padding: 10px 5px;
        }

        .user-info table td:first-child {
            font-weight: bold;
            color: #555;
            width: 120px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
            margin-top: 10px;
        }

        .edit-btn {
            background-color: #2196F3;
        }

        .edit-btn:hover {
            background-color: #1976D2;
        }

        .logout-btn {
            background-color: #f44336;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        .session-info {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="welcome-box">
    <h2>👋 Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>You are successfully logged in.</p>
</div>

<div class="user-info">
    <h3>📋 Your Profile:</h3>
    <table>
        <tr>
            <td>👤 Name</td>
            <td><?php echo htmlspecialchars($username); ?></td>
        </tr>
        <tr>
            <td>📧 Email</td>
            <td><?php echo htmlspecialchars($email); ?></td>
        </tr>
        <tr>
            <td>⚧ Gender</td>
            <td><?php echo htmlspecialchars($gender); ?></td>
        </tr>
        <tr>
            <td>🌍 Country</td>
            <td><?php echo htmlspecialchars($country); ?></td>
        </tr>
        <tr>
            <td>🎯 Hobbies</td>
            <td><?php echo htmlspecialchars($hobbies); ?></td>
        </tr>
        <tr>
            <td>📝 About</td>
            <td><?php echo htmlspecialchars($about); ?></td>
        </tr>
    </table>
</div>

<a href="edit.php" class="btn edit-btn">✏️ Edit Profile</a>
<a href="logout.php" class="btn logout-btn">🚪 Logout</a>

<div class="session-info">
    <p>Session ID: <?php echo session_id(); ?></p>
    <p>Cookie Status: <?php echo isset($_COOKIE["remember_token"]) ? "Active ✅" : "Not Set ❌"; ?></p>
</div>

</body>
</html>