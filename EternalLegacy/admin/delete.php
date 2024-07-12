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
    $id = $_GET['id'];

    $memberSql = "SELECT * FROM members WHERE id = $id";
    $adminSql = "SELECT * FROM admins WHERE id = $id";

    $result = mysqli_query($conn, $memberSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $graveyardId = $row['graveyard_id'];
        $deleteSql = "DELETE FROM members WHERE id = $id";
    } else {
        $result = mysqli_query($conn, $adminSql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $graveyardId = $row['graveyard_id'];
            $deleteSql = "DELETE FROM admins WHERE id = $id";
        } else {
            echo "Record not found.";
            exit();
        }
    }


    $updateGraveSql = "UPDATE graves SET status = 'Available' WHERE id = $graveyardId";
    mysqli_query($conn, $updateGraveSql);

    if (mysqli_query($conn, $deleteSql)) {
        echo "Record deleted successfully.";
        header("Location: manage_member.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
