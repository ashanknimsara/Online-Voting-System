<?php
session_start();
include 'includes/conn.php';

// Check if the user is logged in, otherwise, redirect to the login page
if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    header('location: index.php');
    exit;
}

// Check if there is a last activity timestamp in the session
if (isset($_SESSION['last_activity'])) {
    // Check if the user has been inactive for more than 1800 seconds
    $inactive_seconds = 1800;
    $current_time = time();
    $last_activity_time = $_SESSION['last_activity'];

    if ($current_time - $last_activity_time > $inactive_seconds) {
        // Expire the session
        session_unset();
        session_destroy();
        header('location: index.php');
        exit;
    }
}

// Update the last activity timestamp
$_SESSION['last_activity'] = time();

// Retrieve user data
$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
$query = $conn->query($sql);
$user = $query->fetch_assoc();
?>