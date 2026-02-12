<?php
global $conn;
session_start();
require_once __DIR__ . "/db.php";

//  Remove remember_token from database
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "UPDATE users SET remember_token = NULL WHERE id = $user_id";
    mysqli_query($conn, $sql);
}

//  Delete the cookie by setting expiry to past
if (isset($_COOKIE["remember_token"])) {
    setcookie("remember_token", "", time() - 3600, "/");
}

//  Destroy session
session_unset();
session_destroy();

//  Redirect to login page
header("Location: login.php");
exit();
?>