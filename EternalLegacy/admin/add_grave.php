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

$id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
  
    $square_meters = $_POST['square_meters'];
    $status = $_POST['status'];
    $type = $_POST['type'];

  
    if ($_FILES['changedp']['error'] > 0) {
        echo "<div class='alert alert-danger mt-3'>Error: " . $_FILES['changedp']['error'] . "</div>";
    } else {
        $temp_name = $_FILES['changedp']['tmp_name'];
        $org_name = $_FILES['changedp']['name'];
        $path = "img";
        $upload_pic = "$path/$org_name";

        move_uploaded_file($temp_name, "$path/$org_name");

       
        $insertSql = "INSERT INTO graves (square_meters, status, type, image_path) VALUES ('$square_meters', '$status', '$type', '$upload_pic')";

        if (mysqli_query($conn, $insertSql)) {
            echo '<script>alert("New grave added successfully with image.")</script>';
        } else {
            echo "Error adding new grave: " . mysqli_error($conn);
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Add Grave</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">

    
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="apple-touch-icon" href="/do/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>

    <link href="sidebars.css" rel="stylesheet">
  </head>
  <body>
  
  <main>
  <h1 class="visually-hidden">Sidebars</h1>

  <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="manager_dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <img src="logo1.png" class="bi me-2" width="100%" height="100%">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="manager_dashboard.php" class="nav-link text-white" aria-current="page">
            <img src="dashboard.png" class="bi me-2" width="28" height="28" alt="Clickable Icon"> Dashboard</a>
        </a>
      </li>
      <li>
        <a href="manage_user.php" class="nav-link text-white">
        <img src="manageuser.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage User</a>
        </a>
      </li>
      <li>
        <a href="manage_approvals.php" class="nav-link text-white">
         <img src="approve.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage User Approvals</a>
        </a>
      </li>
      <li>
        <a href="manage_graveyard.php" class="nav-link active">
        <img src="graveyard.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage Graveyard Approvals</a>
        </a>
      </li>
    </ul>
    <hr>
    <a href="../logout.php"><img src="logout.png" width= "35" height="35" alt="Clickable Icon"></a>
  </div>
  <div class="b-example-divider"></div>
 <div class="container mt-5">
        <h1>Add New Grave</h1>
       
        <form method="POST" enctype="multipart/form-data">
          <label for="square_meters">Square Meters:</label>
          <input type="text" id="square_meters" class="form-control" name="square_meters" pattern="[0-9]+" title="Only numeric input allowed" required><br><br>

          <label for="status">Status:</label>
          <select id="status" class="form-control" name="status" required>
            <option value="Available">Available</option>
            <option value="Reserved">Reserved</option>
            <option value="Occupied">Occupied</option>
          </select><br><br>

          <label for="type">Type:</label>
          <select id="type" class="form-control" name="type" required>
            <option value="Regular">Regular</option>
            <option value="Cemented">Cemented</option>
            <option value="House">House</option>
          </select><br><br>

          <div class="form-group">
            <label for="changedp">Choose an Image to for this Grave:</label>
            <input type='file' class="form-control-file" name='changedp' id="changedp"/>
          </div>
		<br>
          <input type="submit" class="btn btn-primary" name="submit" value="Add Grave">
        </form>
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
</body>
</html>