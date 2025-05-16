<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_SESSION['user_id'])) {
    // The user is logged in, retrieve their information from the database
    $user_id = $_SESSION['user_id'];
    if (!$user_id) {
        die('Error: User ID not found in session');
    }

    $conn = new mysqli('localhost', 'root', '', 'dbbriskvrs');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query("SELECT * FROM tbluser WHERE user_id = '$user_id'");
    $user = $result->fetch_assoc();
}
?>