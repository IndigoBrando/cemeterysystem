<?php
session_start();
include('../config.php');

// Check if a user is not logged in, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'Member')) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$checkStatusSql = "SELECT status FROM members WHERE id = ?";
$checkStatusStmt = mysqli_prepare($conn, $checkStatusSql);
mysqli_stmt_bind_param($checkStatusStmt, "i", $user_id);
mysqli_stmt_execute($checkStatusStmt);
$statusResult = mysqli_stmt_get_result($checkStatusStmt);

if ($statusResult && mysqli_num_rows($statusResult) > 0) {
    $memberStatus = mysqli_fetch_assoc($statusResult)['status'];

    if ($memberStatus === 'pending') {
       
        echo "<script>
                alert('Wait for Manager\'s approval on your account. Thank you for patiently waiting.');
                window.location.href='../index.php';
              </script>";
        exit();
    }
}

if ($result && mysqli_num_rows($result) > 0) {
    $notification = mysqli_fetch_assoc($result);
    $status_message = $notification['message'];

    if (isset($notification['status']) && $notification['status'] === 'denied') {
    
        echo "Denial logic triggered";

        $deleteMemberSql = "DELETE FROM members WHERE user_id = ?";
        $deleteMemberStmt = mysqli_prepare($conn, $deleteMemberSql);
        mysqli_stmt_bind_param($deleteMemberStmt, "i", $user_id);

        if (mysqli_stmt_execute($deleteMemberStmt)) {
           
            mysqli_stmt_close($deleteMemberStmt);

            session_destroy();
            echo "<script>
                    alert('$status_message');
                    window.location.href='../index.php';
                  </script>";
            exit();
        } else {
           
            echo "Error deleting member: " . mysqli_error($conn);
            exit();
        }
    } elseif (isset($notification['status']) && $notification['status'] === 'approved') {
        
        echo "<script>
                alert('$status_message');
              </script>";
    }

    $deleteSql = "DELETE FROM notifications WHERE id = ?";
    $deleteStmt = mysqli_prepare($conn, $deleteSql);
    mysqli_stmt_bind_param($deleteStmt, "i", $notification['id']);
    mysqli_stmt_execute($deleteStmt);
    mysqli_stmt_close($deleteStmt);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Member Dashboard</title>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="../css/index.css">
<style>
    .notification {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        margin-bottom: 15px;
    }
    </style>


</head>
<body>

<?php if (!empty($status_message)) : ?>
   <script>
       alert("<?php echo $status_message; ?>");
   </script>
<?php endif; ?>

<div class="nav-bar mx-5 mb-0">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <span style="color: #A18315; font-size: 30px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Eternal Legacy Memorial</span>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="member_dashboard.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Home</a></li>
          <li><a href="aboutus-member.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">About Us</a></li>
          <li><a href="member_cemetery_map.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Cemetery Map</a></li>
          <li><a href="contactus-member.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Contact Us</a></li>
          <li><a href="../logout.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Logout</a></li>
        </ul>

    </header>
</div>


<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../stock_images/cemetery.jpg" class="bd-placeholder-img img-fluid" alt="Cemetery Image" width="100%" height="90%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Thank you for having us!</h1>
                    <p style="font-size: 19px;">Come Visit your Lot! We are happy to cater you.</p>
                    <h1><a class="btn btn-success btn-reserve-now" href="member_cemetery_map.php">Check Lot</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="header">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>"Feel Free to choose!, we are here to cater you, choose wisely slots are still available!"</p>  
        </div>

    <div class="container_marketing text-center">
        <div class="row">
        <div class="col-lg-4 text-center">
            <img src="../stock_images/North.jpg" class="bd-placeholder-img rounded-circle mx-auto marketing-image" alt="Cemetery Image" width="70%" height="70%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2>Regular</h2>
            <p>The Regular Grave at Serenity Gardens is a peaceful haven where loved ones lay forever. Discover timeless repose here. Elegant plots offer a blank canvas for individualized memorials, guaranteeing a peaceful and permanent resting place for treasured memories.</p>
            
        </div>
        <div class="col-lg-4 text-center">
            <img src="../stock_images/South.jpg" class="bd-placeholder-img rounded-circle mx-auto marketing-image" alt="Cemetery Image" width="70%" height="70%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2>Cemented</h2>
            <p>The Cemented Grave at Serenity Gardens offers everlasting peace. These tastefully designed and immaculately cared for sites provide a lasting, respectable place to die. Select timeless peace for your loved ones—a memorial engraved in concrete that will last a lifetime.</p>
            
        </div>
        <div class="col-lg-4 text-center">
            <img src="../stock_images/West.jpg" class="cemeteryhouse rounded-circle " alt="Cemetery Image" >
            <h2>House</h2>
            <p>Presenting Serenity Haven House Graves, an exceptional fusion of peace and comfort. Give the people you care about a unique, forever home where memories are made. Find enduring tranquility in a unique setting intended for treasured memories.</p>
            
        </div> 

        <div class="container_gallery">
            <div class="row">
               
                <div class="col-md-3">
                    <img src="../images/natures1.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures2.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures3.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="../images/naturess4.jpg" class="img-fluid" alt="Gallery Image 4">
                </div>
             
                <div class="col-md-3">
                    <img src="../images/natures1.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures2.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures3.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="../images/naturess4.jpg" class="img-fluid" alt="Gallery Image 4">
                </div>
            
                <div class="col-md-3">
                    <img src="../images/natures1.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures2.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="../images/natures3.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="../images/naturess4.jpg" class="img-fluid" alt="Gallery Image 4">
                </div>
            </div>
        </div>

    </div>
   

</div></main>
<div class="footer">
    <div class="footer_container mx-5 text-center">
        <p>&copy;2023 Eternal Legacy Memorial Park.</p>
    </div>
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
</body>
</html>
<?php
