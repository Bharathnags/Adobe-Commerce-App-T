<?php
global $conn;
require_once __DIR__ . "/auth_check.php";
require_once __DIR__ . "/db.php";

// Check if user is logged in
if (!check_login($conn)) {
    header("Location: login.php");
    exit();
}

// Fetch current user data from database
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Extract current values (for pre-filling the form)
$username = $user["username"];
$email = $user["email"];
$gender = $user["gender"] ? $user["gender"] : "";
$country = $user["country"] ? $user["country"] : "";
$about = $user["about"] ? $user["about"] : "";

// Hobbies are stored as comma-separated string like "Reading,Gaming,Music"
// Convert to array for checkbox checking
$hobbies_string = $user["hobbies"] ? $user["hobbies"] : "";
$hobbies_array = $hobbies_string ? explode(",", $hobbies_string) : [];

// Available options
$country_list = ["India", "USA", "UK", "Canada", "Australia", "Germany", "Japan"];
$hobby_list = ["Reading", "Gaming", "Music", "Sports", "Cooking", "Travel"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .radio-group,
        .checkbox-group {
            padding: 10px 0;
        }

        .radio-group label,
        .checkbox-group label {
            font-weight: normal;
            display: inline-block;
            margin-right: 20px;
            margin-top: 0;
        }

        .radio-group input,
        .checkbox-group input {
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
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

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .form-box {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<h2>✏️ Edit Profile</h2>

<div class="form-box">
    <!-- Form sends data to update.php -->
    <form method="post" action="update.php">

        <!-- TEXT: Name -->
        <label for="username">👤 Name:</label>
        <input type="text"
               name="username"
               id="username"
               value="<?php echo htmlspecialchars($username); ?>"
               required>

        <!-- EMAIL: Email -->
        <label for="email">📧 Email:</label>
        <input type="email"
               name="email"
               id="email"
               value="<?php echo htmlspecialchars($email); ?>"
               required>

        <!-- RADIO: Gender -->
        <label>⚧ Gender:</label>
        <div class="radio-group">
            <label>
                <input type="radio"
                       name="gender"
                       value="Male"
                        <?php echo ($gender == "Male") ? "checked" : ""; ?>>
                Male
            </label>
            <label>
                <input type="radio"
                       name="gender"
                       value="Female"
                        <?php echo ($gender == "Female") ? "checked" : ""; ?>>
                Female
            </label>
            <label>
                <input type="radio"
                       name="gender"
                       value="Other"
                        <?php echo ($gender == "Other") ? "checked" : ""; ?>>
                Other
            </label>
        </div>

        <!-- SELECT: Country -->
        <label for="country">🌍 Country:</label>
        <select name="country" id="country">
            <option value="">-- Select Country --</option>
            <?php foreach ($country_list as $c): ?>
                <option value="<?php echo $c; ?>"
                        <?php echo ($country == $c) ? "selected" : ""; ?>>
                    <?php echo $c; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- CHECKBOX: Hobbies -->
        <label>🎯 Hobbies:</label>
        <div class="checkbox-group">
            <?php foreach ($hobby_list as $hobby): ?>
                <label>
                    <input type="checkbox"
                           name="hobbies[]"
                           value="<?php echo $hobby; ?>"
                            <?php echo in_array($hobby, $hobbies_array) ? "checked" : ""; ?>>
                    <?php echo $hobby; ?>
                </label>
            <?php endforeach; ?>
        </div>

        <!-- TEXTAREA: About -->
        <label for="about">📝 About:</label>
        <textarea name="about"
                  id="about"
                  placeholder="Tell us about yourself..."
        ><?php echo htmlspecialchars($about); ?></textarea>

        <button type="submit" name="update">💾 Update Profile</button>
    </form>
</div>

<a href="dashboard.php" class="back-link">← Back to Dashboard</a>

</body>
</html>