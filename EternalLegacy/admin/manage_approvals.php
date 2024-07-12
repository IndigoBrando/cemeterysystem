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

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $user_id = $_GET['id'];

    if ($action === 'approve') {
     
        $update_sql = "UPDATE members SET status = 'approved' WHERE id = $user_id AND status = 'pending'";
        mysqli_query($conn, $update_sql);
	
		$approval_message = "You have been approved! Thank you for choosing us.";
		$insert_notification_sql = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$approval_message')";
		mysqli_query($conn, $insert_notification_sql);


        $email_sql = "SELECT email FROM members WHERE id = $user_id";
        $email_result = mysqli_query($conn, $email_sql);
        $email_row = mysqli_fetch_assoc($email_result);
        $user_email = $email_row['email'];

        $subject = "Membership Approval Notification";
        $message = "Congratulations! Your membership request has been approved. Thank you for choosing us.";
        $headers = "From: your_email@example.com"; 

        mail($user_email, $subject, $message, $headers);
    } elseif ($action === 'deny') {
      
       $update_sql = "UPDATE members SET status = 'denied' WHERE id = $user_id AND status = 'pending'";
       mysqli_query($conn, $update_sql);
   
   $approval_message = "Sorry, but your request to reserve has been denied. Thank you for considering us.";
   $insert_notification_sql = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$approval_message')";
   mysqli_query($conn, $insert_notification_sql);

       $email_sql = "SELECT email FROM members WHERE id = $user_id";
       $email_result = mysqli_query($conn, $email_sql);
       $email_row = mysqli_fetch_assoc($email_result);
       $user_email = $email_row['email'];

       $subject = "Membership Approval Notification";
       $message = "Congratulations! Your membership request has been approved. Thank you for choosing us.";
       $headers = "From: your_email@example.com"; 

       mail($user_email, $subject, $message, $headers);
  }
    header("Location: manage_approvals.php");
    exit();
}
$sql = "SELECT * FROM members WHERE status = 'pending'";
$result = mysqli_query($conn, $sql);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Manage Approvals</title>

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
        <a href="manage_approvals.php" class="nav-link active">
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
    <a href="../logout.php"><img src="logout.png" width= "35" height="35" alt="Clickable Icon"></a>
  </div>
  <div class="b-example-divider"></div>
  <div class="container mt-5">
        <h1>Manage User Approvals</h1>

        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                            <td><?php echo $row['contact_number']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['sex']; ?></td>
                            <td>
                                <a href="?action=approve&id=<?php echo $row['id']; ?>">Approve</a>
                                <a href="?action=deny&id=<?php echo $row['id']; ?>">Deny</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No pending approvals at the moment.</p>
        <?php endif; ?>
        
    </div>
	

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
</body>
</html>