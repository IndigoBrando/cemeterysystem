<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['grave_id'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $graveyardId = $_GET['grave_id'];

    $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
    $middleName = isset($_POST['middle_name']) ? mysqli_real_escape_string($conn, $_POST['middle_name']) : null;

    $insertQuery = "INSERT INTO members (username, password, first_name, last_name, contact_number, email, sex, birthday, middle_name, graveyard_id, status) 
                    VALUES ('$username', '$password', '$first_name', '$last_name', '$contact_number', '$email', '$sex', '$birthday', '$middleName', '$graveyardId', 'pending')";

    if (mysqli_query($conn, $insertQuery)) {
        $updateQuery = "UPDATE graves SET status = 'Reserved' WHERE id = $graveyardId";
        mysqli_query($conn, $updateQuery);

        $_SESSION['reservation_success'] = true;

        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
