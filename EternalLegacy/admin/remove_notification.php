<?php
session_start();
include('../config.php');

// Check if a user is not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'Manager')) {
    header("Location: ../login.php"); 
    exit();
}

if (isset($_POST['id'])) {
    $notificationId = $_POST['id'];

    $delete_notification_sql = "DELETE FROM notifications WHERE id = $notificationId";
    mysqli_query($conn, $delete_notification_sql);
}
?>
