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
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];


    $delete_notifications_sql = "DELETE FROM notifications WHERE user_id = $user_id";
    mysqli_query($conn, $delete_notifications_sql);

  
    $delete_sql = "DELETE FROM members WHERE id = $user_id";
    mysqli_query($conn, $delete_sql);

    header("Location:../index.php");
    exit();
}
?>
