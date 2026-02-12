<?php
// This file checks if user is logged in with session OR cookie


session_start();
require_once __DIR__ . "/db.php";

function check_login($conn)
{
    // if Session exists → user is already logged in
    if (isset($_SESSION["user_id"])) {
        return true;
    }

    // CASE 2: Session NOT set, but cookie exists → auto login
    if (isset($_COOKIE["remember_token"])) {
        $token = $_COOKIE["remember_token"];

        // Escape the token to prevent SQL injection
        $token = mysqli_real_escape_string($conn, $token);

        // Find user with this token in database
        $sql = "SELECT * FROM users WHERE remember_token = '$token'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Restore session from cookie to get back
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            return true;
        } else {
            // Cookie is invalid, delete it
            setcookie("remember_token", "", time() - 3600, "/");
            return false;
        }
    }

    //  No session, no cookie → not logged in , login again
    return false;
}

?>