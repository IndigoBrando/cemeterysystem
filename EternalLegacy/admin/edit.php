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
        $isMember = true;
    } else {
        $result = mysqli_query($conn, $adminSql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $isMember = false;
        } else {
            echo "Record not found.";
            exit();
        }
    }
} else {
    echo "Invalid request.";
    exit();
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
    <title>Sidebars · Bootstrap v5.1</title>
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
    .bot-of-btn {
        padding: 10px 15px;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
    }

    .btn {
        cursor: pointer;
    }

    .primary {
        background-color: #4CAF50;
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
        <a href="manage_user.php" class="nav-link active">
        <img src="manageuser.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage User</a>
        </a>
      </li>
      <li>
        <a href="manage_approvals.php" class="nav-link text-white">
         <img src="approve.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage User Approvals</a>
        </a>
      </li>
      <li>
        <a href="manage_graveyard.php" class="nav-link text-white">
        <img src="graveyard.png" class="bi me-2" width="28" height="28" alt="Clickable Icon">Manage Graveyard Approvals</a>
        </a>
      </li>
    </ul>
    <hr>
    <a href="#"><img src="logout.png" width= "35" height="35" alt="Clickable Icon"></a>
  </div>
  <div class="b-example-divider"></div>
  <div class="container mt-5">
  <h2>Edit <?php echo ($isMember ? "Member" : "Admin"); ?></h2>
    <form method="POST">
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name"class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>"><br><br>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name"class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>"><br><br>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" class="form-control" name="email" value="<?php echo $row['email']; ?>"><br><br>
    </div>
    <div class="form-group">
        <label for="number">Contact Number:</label>
        <input type="text" id="phone" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>"><br><br>
    </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </div>
    <?php
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];

    if ($isMember) {
        $updateSql = "UPDATE members SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_number = '$contact_number' WHERE id = $id";
    } else {
        $updateSql = "UPDATE admins SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_number = '$contact_number' WHERE id = $id";
    }

    if (mysqli_query($conn, $updateSql)) {
        echo '<script>alert("Record updated succesfully")</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
    </form>
  </main>
    
</body>
</html>
