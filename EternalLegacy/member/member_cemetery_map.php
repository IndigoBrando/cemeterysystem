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

function getMemberGraveInfo($memberId) {
    global $conn;

    $query = "SELECT * FROM members WHERE id = $memberId"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $graveyardId = $row['graveyard_id'];

        $graveyardQuery = "SELECT * FROM graves WHERE id = $graveyardId";
        $graveyardResult = mysqli_query($conn, $graveyardQuery);

        if ($graveyardResult && mysqli_num_rows($graveyardResult) > 0) {
            return mysqli_fetch_assoc($graveyardResult);
        }
    }

    return null;
}

$memberId = $_SESSION['user_id'];

$graveInfo = getMemberGraveInfo($memberId);
?>
<?php
if (isset($_POST['occupy'])) {
    
    $graveId = $_POST['grave_id'];

    $updateQuery = "UPDATE graves SET status = 'Occupied' WHERE id = $graveId";
    
    mysqli_query($conn, $updateQuery);
    
    header("Location: member_cemetery_map.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cemetery Map</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 10px;
        }

        .container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-back {
            margin-bottom: 20px;
        }

        .card {
            max-width: 400px;
            margin: auto;
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #009933;
            color: #fff;
        }

        .card-body {
            text-align: left;
        }

        .btn-reserve, .btn-occupy {
            width: 100%;
            margin-top: 20px;
        }
		.nav-link {
	color: #000 !important;
	font-family: 'Poppins', sans-serif;
	font-weight: 700; 
	font-size: 22px;
	margin-right: -10px; 
	transition: color 0.3s; 
	}
	.nav li {
	margin-right: -40px; 
	}
	.nav-link:hover {
	color: #A18315 !important; 
	font-family: 'Poppins', sans-serif;
	font-size: 22px;
	font-weight: 700; 
	}

	.nav-link {
	color: #000 !important;
	font-family: 'Playfair Display', sans-serif;
	font-size: 22px;
	margin-right: 50px;
	transition: color 0.3s; 
	margin-right: 20px; 
	margin-left: 50px;
	}
    </style>
</head>
<body>
<div class="nav-bar mx-5 mb-0">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="member_dashboard.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
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
<br>
<br>
    <div class="container">
        
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Cemetery Map</h1>
            </div>
            <div class="card-body">
                <?php if ($graveInfo) : ?>
                    <h2 class="mb-3"><?php echo 'Reserved Graveyard: ' . $graveInfo['id']; ?></h2>
                    <p class="mb-3">Square Meters: <?php echo $graveInfo['square_meters']; ?></p>
                    <p class="mb-3">Status: <?php echo $graveInfo['status']; ?></p>

                    <?php if ($graveInfo['status'] === 'Available') : ?>
                        <a href="reservation.php?grave_id=<?php echo $graveInfo['id']; ?>" class="btn btn-primary btn-reserve" onclick="return confirm('Are you sure you want to reserve this grave?');">Reserve</a>
                    <?php elseif ($graveInfo['status'] === 'Reserved') : ?>
                        <form method="post" action="">
                            <input type="hidden" name="grave_id" value="<?php echo $graveInfo['id']; ?>">
                            <button type="submit" name="occupy" class="btn btn-danger btn-occupy">Occupy</button>
                        </form>
                    <?php endif; ?>

                <?php else : ?>
                    <p>No reserved grave found for this member.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


