<?php
session_start();
include("header.php");
include('../config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Check if the user is logged in and is a members
if (!(isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'Member')) {
  header("Location: ../login.php"); 
  exit();
}
?>
<!DOCTYPE html>
<title>About Us</title>
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">

    

<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
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

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  .footer {
        margin-top: auto;
        background-color: #000 !important; 
        padding: 5px 0;
        margin-top: 10%;

    }
	.footer{
		color: #CDCDCD;
		padding-top: 15px;
		padding-bottom: 15px;
		font-size: 18px;
	}
  .header {
  text-align: center;
  padding: 20px;
  margin-top: 30px;
  margin-bottom: 70px;
}
.header1 {
  text-align: center;
  padding: 0px;
  margin-top: -19px;
}

.header h1 {
  color: #486173;
  font-family: 'Playfair Display', sans-serif;
  font-size: 52px;
  line-height: 1.4em;
  padding: 0;
  margin: 0;
}
.header p {
  color: #BAAC7B;
  font-family: 'Bad Script', cursive;
  font-size: 42px;
  font-weight: 500;
  letter-spacing: -0.4px;
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
<main>
  
<br><br><br>
  <div class="container marketing">

 

    <div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">Eternal Legacy: <span class="text-muted">Nature's Embrace in a Cemetery</span></h2>
        <p class="lead">In a serene cemetery beneath ancient oaks draped in emerald moss, sunlight filters through leaves, casting dappled light on headstones and monuments. This sanctuary, rich in history, whispers stories of lives well-lived. Amidst vibrant flowerbeds, grief finds solace in nature's embrace, offering a haven of reflection and healing. It's a place where memories are cherished, and departed loved ones find rest under nature's watchful eyes.</p>
    </div>
      <div class="col-md-5">
      <img src="../stock_images/place1.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" role="img">

      </div>
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
    <div class="row featurette">
    <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Find Your Peace in Eternal Legacy: <span class="text-muted">Why This Cemetery is Right for You</span></h2>
        <p class="lead">Are you seeking a final resting place that offers peace, beauty, and a connection to nature? Look no further than this serene cemetery nestled among ancient oaks and vibrant wildflowers. Here, you'll find more than just headstones and monuments; you'll find a haven of tranquility where memories are cherished and loved ones are remembered with respect.</p>
      </div>
      <div class="col-md-5 order-md-1">
      <img src="../stock_images/place2.jpg" class="bd-placeholder-img img-fluid mx-auto" width="500" height="500" role="img">


      </div>
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
    <div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Find Your peace in Eternal Legacy</span></h2>
        <p class="lead">Find Your Peace in Eternal Legacy.' Our exclusive collection embodies timeless elegance, allowing you to create lasting impressions. Elevate your space with heirloom-quality pieces that echo the beauty of eternity. Immerse yourself in the luxury of legacy, where each item tells a unique story. Find tranquility and timeless style as you explore the curated selection that defines your personal legacy. Elevate your surroundings and make a statement with Eternal Legacy – where peace meets enduring beauty.</p>
      </div>
      <div class="col-md-5 mb-5">
      <img src="../stock_images/place3.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" role="img">

      </div>
      <br>
      <br>
      <div style="text-align: center; position: relative;">
					<span style="position: absolute; left: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
					<i aria-hidden="true" class="fas fa-cross fa-3x" style="color: #baac7b;"></i>
					<span style="position: absolute; right: 0; top: 38%; transform: translateY(-50%); border-bottom: 2px solid #baac7b; width: 46%;"></span>
				</div>
      <div class="header">
        <h1>Eternal Legacy Memorial Park</h1>
        <p>Developers</p>
        
        </div>


      <div class="container marketing">
      <div class="row">
    <div class="col-lg-4 text-center mb-5 mx-auto">
        <img src="../Pictures/Andri.jpg" class="bd-placeholder-img rounded-circle mx-auto img-fluid" alt="Cemetery Image" width="200" height="200" aria-hidden="true">
        <h2>Andrei Christian L. Lobo</h2>
        <p>Programmer / Tester</p>
    </div>
    
    <div class="col-lg-4 text-center mb-5 mx-auto">
        <img src="../Pictures/Blessie.jpg" class="bd-placeholder-img rounded-circle mx-auto img-fluid" alt="Cemetery Image" width="200" height="200" aria-hidden="true">
        <h2>Blessie Mae P. Espina</h2>
        <p>Programmer / Front End Designer</p>
    </div>
    
    <div class="col-lg-4 text-center mb-5 mx-auto">
        <img src="../Pictures/Baylaa.jpg" class="bd-placeholder-img rounded-circle mx-auto img-fluid" alt="Cemetery Image" width="200" height="200" aria-hidden="true">
        <h2>Marjohn M. Bayla</h2>
        <p>Head Programmer</p>
    </div>
    
    <div class="col-lg-4 text-center mx-auto mt-5">
        <img src="../Pictures/chan.png" class="bd-placeholder-img rounded-circle mx-auto img-fluid" alt="Cemetery Image" width="200" height="200" aria-hidden="true">
        <h2>Christian Paul P. Malimit</h2>
        <p>Admin / Database Head</p>
    </div>
    
    <div class="col-lg-4 text-center mx-auto mt-5">
        <img src="../Pictures/Kyong.jpg" class="bd-placeholder-img rounded-circle mx-auto img-fluid" alt="Cemetery Image" width="200" height="200" aria-hidden="true">
        <h2>Remigio Aguinaldo III</h2>
        <p>Programmer / Documentator</p>
    </div>
</div>

    </div>

</div>
</div>
    <div class="footer">
  <div class="footer_container mx-5 text-center">

    <p>&copy;2023 Eternal Legacy Memorial Park.</p>
  </div>
</div>


</body>
</html>