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

    $getGraveyardIdQuery = "SELECT graveyard_id FROM members WHERE id = $user_id";
    $result = mysqli_query($conn, $getGraveyardIdQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $graveyardId = $row['graveyard_id'];

        $updateGraveQuery = "UPDATE graves SET status = 'Available' WHERE id = $graveyardId";
        mysqli_query($conn, $updateGraveQuery);
    }

 
    $deleteNotificationsSql = "DELETE FROM notifications WHERE user_id = $user_id";
    mysqli_query($conn, $deleteNotificationsSql);

    $deleteSql = "DELETE FROM members WHERE id = $user_id";
    mysqli_query($conn, $deleteSql);

    header("Location:../index.php");
    exit();
}
?>
