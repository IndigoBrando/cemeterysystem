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

$id = $_GET['id'];


$sql = "SELECT * FROM graves WHERE id = '$id'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 0) {
    echo "Grave not found.";
    exit();
}

$row = mysqli_fetch_assoc($result);
$square_meters = $row['square_meters'];
$status = $row['status'];
$type = $row['type'];
$image_path = $row['image_path'];


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

        
$updateSql = "UPDATE graves SET square_meters = '$square_meters', status = '$status', type = '$type', image_path = '$upload_pic' WHERE id = '$id'";

if (mysqli_query($conn, $updateSql)) {
    echo '<script>alert("Grave details updated successfully with image.")</script>';
} else {
    echo "Error updating grave details: " . mysqli_error($conn);
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
      <title>Edit Grave</title>

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
          <h1>Edit Grave</h1>
         
          <form method="POST" enctype="multipart/form-data">
    <label for="square_meters">Square Meters:</label>
    <input type="text" id="square_meters" class="form-control" name="square_meters" pattern="[0-9]+" title="Only numeric input allowed" required value="<?php echo $square_meters; ?>"><br><br>

    <label for="status">Status:</label>
    <select id="status" class="form-control" name="status" required>
        <option value="Available" <?php echo ($status === 'Available') ? 'selected' : ''; ?>>Available</option>
        <option value="Reserved" <?php echo ($status === 'Reserved') ? 'selected' : ''; ?>>Reserved</option>
        <option value="Occupied" <?php echo ($status === 'Occupied') ? 'selected' : ''; ?>>Occupied</option>
    </select><br><br>

    <label for="type">Type:</label>
    <select id="type" class="form-control" name="type" required>
        <option value="Regular" <?php echo ($type === 'Regular') ? 'selected' : ''; ?>>Regular</option>
        <option value="Cemented" <?php echo ($type === 'Cemented') ? 'selected' : ''; ?>>Cemented</option>
        <option value="House" <?php echo ($type === 'House') ? 'selected' : ''; ?>>House</option>
    </select><br><br>

    <div class="form-group">
        <label for="changedp">Choose an Image for this Grave:</label>
        <input type='file' class="form-control-file" name='changedp' id="changedp"/>
    </div>
    <br>
    <input type="submit" class="btn btn-primary" name="submit" value="Update Grave">
</form>
        </div>
      </main>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
  </body>
  </html>