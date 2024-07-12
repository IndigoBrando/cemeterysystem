<?php
session_start();
include('config.php');

function getGraveyardInfo($id) {
    global $conn;

    $query = "SELECT * FROM graves WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

if (isset($_GET['grave_id'])) {
    $graveyardId = $_GET['grave_id'];
    $graveyardInfo = getGraveyardInfo($graveyardId);

    if ($graveyardInfo && $graveyardInfo['status'] === 'Available') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve Graveyard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #c3e6cb;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Reserve Graveyard</h1>
    <p class="mb-3">Selected Graveyard ID: <?php echo $graveyardInfo['id']; ?></p>

    <form action="process_reservation.php?grave_id=<?php echo $graveyardId; ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="tel" pattern="[0-9]+" class="form-control" id="contact_number" name="contact_number" required>
            <small class="form-text text-muted">Please enter a valid numeric phone number.</small>

        </div>

        <div class="form-group">
            <label for="email">Email (Optional):</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="sex">Sex:</label>
            <select class="form-control" id="sex" name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
		
        <div class="form-group">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" id="birthday" name="birthday">
        </div>

        <div class="form-group">
            <label for="middle_name">Middle Name (Optional):</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name">
        </div>

        <button type="submit" class="btn btn-primary">Submit Reservation</button>
    </form>

</div>

</body>
</html>

<?php
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
