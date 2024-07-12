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
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $delete_id = $_GET['id'];

 
    $delete_member_query = "DELETE FROM members WHERE graveyard_id = $delete_id";
    $delete_member_result = mysqli_query($conn, $delete_member_query);

    if ($delete_member_result) {
      
        $delete_grave_query = "DELETE FROM graves WHERE id = $delete_id";
        $delete_grave_result = mysqli_query($conn, $delete_grave_query);

        if ($delete_grave_result) {
            header("Location: manage_graveyard.php");
            exit();
        } else {
            echo "Error deleting grave record: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting member records: " . mysqli_error($conn);
    }
} else {
    echo "Invalid ID or ID not provided.";
}
?>
