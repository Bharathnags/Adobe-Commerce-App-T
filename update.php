<?php
global $conn;
require_once __DIR__ . "/auth_check.php";
require_once __DIR__ . "/db.php";

// Check if user is logged in
if (!check_login($conn)) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["update"])) {
    $user_id = $_SESSION["user_id"];

    // Get form data
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $country = isset($_POST["country"]) ? $_POST["country"] : "";
    $about = trim($_POST["about"]);

    // Handle hobbies array → convert to comma-separated string
    // Example: ["Reading", "Gaming", "Music"] → "Reading,Gaming,Music"
    if (isset($_POST["hobbies"]) && is_array($_POST["hobbies"])) {
        $hobbies = implode(",", $_POST["hobbies"]);
    } else {
        $hobbies = "";
    }

    // Escape all inputs for safety
    $safe_username = mysqli_real_escape_string($conn, $username);
    $safe_email = mysqli_real_escape_string($conn, $email);
    $safe_gender = mysqli_real_escape_string($conn, $gender);
    $safe_country = mysqli_real_escape_string($conn, $country);
    $safe_hobbies = mysqli_real_escape_string($conn, $hobbies);
    $safe_about = mysqli_real_escape_string($conn, $about);

    // Check if new email already belongs to another user
    $email_check = "SELECT id FROM users WHERE email = '$safe_email' AND id != $user_id";
    $email_result = mysqli_query($conn, $email_check);

    if (mysqli_num_rows($email_result) > 0) {
        // Email already used by someone else
        echo "<script>
                alert('This email is already used by another user!');
                window.location.href = 'edit.php';
              </script>";
        exit();
    }

    // Update query
    $update_sql = "UPDATE users SET
                    username = '$safe_username',
                    email    = '$safe_email',
                    gender   = '$safe_gender',
                    country  = '$safe_country',
                    hobbies  = '$safe_hobbies',
                    about    = '$safe_about'
                   WHERE id = $user_id";

    if (mysqli_query($conn, $update_sql)) {
        // Also update session variables
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
} else {
    // If someone opens update.php directly without form submission
    header("Location: edit.php");
    exit();
}
?>