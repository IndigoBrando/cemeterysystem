<?php
session_start();
include('config.php');

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

function getGraveInfo($id) {
    global $conn;

    $query = "SELECT * FROM graves WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}

function getGraveList() {
    global $conn;

    $query = "SELECT * FROM graves";
    $result = mysqli_query($conn, $query);

    $graves = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $graves[] = $row;
        }
    }

    return $graves;
}

$graves = getGraveList();

$regularGraves = array_filter($graves, function ($grave) {
    return $grave['type'] === 'Regular';
});

$cementGraves = array_filter($graves, function ($grave) {
    return $grave['type'] === 'Cemented';
});

$houseGraves = array_filter($graves, function ($grave) {
    return $grave['type'] === 'House';
});
?>
<?php include_once("slider.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cemetery Map</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/cemeterymap.css" rel="stylesheet">
    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="cemetery_map.php">
        <img src="images/Eternal Legacy.png" alt="Cemetery Map Image">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact-us.php">Contact Us</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="login.php">Log-In</a>
            </li>
        </ul>
    </div>
</nav>


		<div class="header1">


    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">	  
        <ol class="carousel-indicators">
            <?php echo $button_html; ?>		
        </ol>	  
        <div class="carousel-inner">	  
            <?php echo $slider_html; ?>
        </div>	 
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>	 
        <ul class="thumbnails-carousel clearfix">
            <?php echo $thumb_html; ?>
        </ul>
    </div>	
		
	</div>
	
<div class="header">
	
  <h1>Welcome to Eternal Legacy, Cemetery Mapping!</h1>
  <p>"Feel Free to choose!, we are here to cater you, choose wisely slots are still available!"</p>
  	
</div>
<br>
	<br>

      <div class="container">
        
            
                <div class="section">
                    <p>Regular Graves</p>
                </div>
                <div class="map-container">
                    <?php
                    foreach ($regularGraves as $grave) {
                        echo '<div class="graveyard-area">';
                        echo '<a href="?grave_id=' . $grave['id'] . '">';
                        echo '<img src="' . $grave['image_path'] . '" alt="Graveyard ' . $grave['id'] . '" class="graveyard-image">';
                        echo '</a>';
                        echo '<div class="grave-details-container">';
                        echo '<h2>Graveyard ' . $grave['id'] . '</h2>';
                        echo '<p>Square Meters: ' . $grave['square_meters'] . '</p>';
                        echo '<p>Type: ' . $grave['type'] . '</p>';
                        echo '<p>Status: ' . $grave['status'] . '</p>';
                        if ($grave['status'] === 'Available') {
                            echo '<a href="reservation.php?grave_id=' . $grave['id'] . '" class="btn btn-success reserve-btn" onclick="return confirm(\'Are you sure you want to reserve this grave?\');">Reserve</a>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
				
				
					<br>
					<br>
					<div style="text-align: center; position: relative;">
					<span style="position: absolute; left: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
					<i aria-hidden="true" class="fas fa-cross fa-3x" style="color: #baac7b;"></i>
					<span style="position: absolute; right: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
				</div>
					<br>
					<br>
				
				
                <div class="section">
                    <p>Cemented Graves</p>
                </div>
                <div class="map-container">
                    <?php
                    foreach ($cementGraves as $grave) {
                        echo '<div class="graveyard-area">';
                        echo '<a href="?grave_id=' . $grave['id'] . '">';
                        echo '<img src="' . $grave['image_path'] . '" alt="Graveyard ' . $grave['id'] . '" class="graveyard-image">';
                        echo '</a>';
                        echo '<div class="grave-details-container">';
                        echo '<h2>Graveyard ' . $grave['id'] . '</h2>';
                        echo '<p>Square Meters: ' . $grave['square_meters'] . '</p>';
                        echo '<p>Type: ' . $grave['type'] . '</p>';
                        echo '<p>Status: ' . $grave['status'] . '</p>';
                        if ($grave['status'] === 'Available') {
                            echo '<a href="reservation.php?grave_id=' . $grave['id'] . '" class="btn btn-success reserve-btn" onclick="return confirm(\'Are you sure you want to reserve this grave?\');">Reserve</a>';
                        }
                        echo '</div>';
                        echo '</div>';

                    }
                    ?>
				
                </div>
				
				<br>
				<br>
				<div style="text-align: center; position: relative;">
					<span style="position: absolute; left: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
					<i aria-hidden="true" class="fas fa-cross fa-3x" style="color: #baac7b;"></i>
					<span style="position: absolute; right: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
				</div>
				<br>
				<br>
				
				
                <div class="section">
                    <p>House Graves</p>
                </div>
                <div class="map-container">
                    <?php
                    foreach ($houseGraves as $grave) {
                        echo '<div class="graveyard-area">';
                        echo '<a href="?grave_id=' . $grave['id'] . '">';
                        echo '<img src="' . $grave['image_path'] . '" alt="Graveyard ' . $grave['id'] . '" class="graveyard-image">';
                        echo '</a>';
                        echo '<div class="grave-details-container">';
                        echo '<h2>Graveyard ' . $grave['id'] . '</h2>';
                        echo '<p>Square Meters: ' . $grave['square_meters'] . '</p>';
                        echo '<p>Type: ' . $grave['type'] . '</p>';
                        echo '<p>Status: ' . $grave['status'] . '</p>';
                        if ($grave['status'] === 'Available') {
                            echo '<a href="reservation.php?grave_id=' . $grave['id'] . '" class="btn btn-success reserve-btn" onclick="return confirm(\'Are you sure you want to reserve this grave?\');">Reserve</a>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            
       
    </div>
	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
	<script src="js/carousel-slider.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>