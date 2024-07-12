<?php
include("header.php");
?>


<title>Homepage</title>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="css/index.css">
  
</head>
<body>

<div class="nav-bar mx-5 mb-0">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <span style="color: #A18315; font-size: 30px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Eternal Legacy Memorial</span>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Home</a></li>
          <li><a href="aboutus.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">About Us</a></li>
          <li><a href="cemetery_map.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Cemetery Map</a></li>
          <li><a href="contact-us.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Contact Us</a></li>
          <li><a href="login.php" class="nav-link" style="color: #A18315; font-size: 18px; font-family: Kaisei HarunoUmi; font-weight: 400; word-wrap: break-word">Login</a></li>
        </ul>

    </header>
</div>


<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="stock_images/cemetery.jpg" class="bd-placeholder-img img-fluid" alt="Cemetery Image" width="100%" height="90%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Lots Available</h1>
                    <p style="font-size: 19px;">Come and choose your desired graveyard...</p>
                    <h1><a class="btn btn-success btn-reserve-now" href="cemetery_map.php">Reserve Now</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="header">
        <h1>Eternal Legacy Memorial Park</h1>
        <p>"Feel Free to choose!, we are here to cater you, choose wisely slots are still available!"</p>  
        </div>

    <div class="container_marketing text-center">
        <div class="row">
        <div class="col-lg-4 text-center">
            <img src="img/grave1.jpg" class="bd-placeholder-img rounded-circle mx-auto marketing-image" alt="Cemetery Image" width="70%" height="70%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2>Regular</h2>
            <p>The Regular Grave at Serenity Gardens is a peaceful haven where loved ones lay forever. Discover timeless repose here. Elegant plots offer a blank canvas for individualized memorials, guaranteeing a peaceful and permanent resting place for treasured memories.</p>
            <p><br><a class=".btn-success" href="cemetery_map.php">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center">
            <img src="img/grave2.jpg" class="bd-placeholder-img rounded-circle mx-auto marketing-image" alt="Cemetery Image" width="70%" height="70%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2>Cemented</h2>
            <p>The Cemented Grave at Serenity Gardens offers everlasting peace. These tastefully designed and immaculately cared for sites provide a lasting, respectable place to die. Select timeless peace for your loved ones—a memorial engraved in concrete that will last a lifetime.</p>
            <p><br><a class=".btn-success" href="cemetery_map.php">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4 text-center">
            <img src="img/grave3.jpg" class="cemeteryhouse rounded-circle " alt="Cemetery Image" >
            <h2>House</h2>
            <p>Presenting Serenity Haven House Graves, an exceptional fusion of peace and comfort. Give the people you care about a unique, forever home where memories are made. Find enduring tranquility in a unique setting intended for treasured memories.</p>
            <p><br><a class=".btn-success" href="cemetery_map.php">View details &raquo;</a></p>
        </div> 

        <div class="container_gallery">
            <div class="row">
               
                <div class="col-md-3">
                    <img src="images/natures1.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="images/natures2.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="images/natures3.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="images/cement1.jpg" class="img-fluid" alt="Gallery Image 4">
                </div>
             
                <div class="col-md-3">
                    <img src="images/cement2.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="images/cement3.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="images/cement4.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="images/cement5.jpg" class="img-fluid" alt="Gallery Image 4">
                </div>
            
                <div class="col-md-3">
                    <img src="images/cement4.jpg" class="img-fluid" alt="Gallery Image 1">
                </div>
               
                <div class="col-md-3">
                    <img src="images/cement8.jpg" class="img-fluid" alt="Gallery Image 2">
                </div>
               
                <div class="col-md-3">
                    <img src="images/cement3.jpg" class="img-fluid" alt="Gallery Image 3">
                </div>
             
                <div class="col-md-3">
                    <img src="images/cement9.jpg" class="img-fluid" alt="Gallery Image 4">
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