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
<title>Contact Us</title>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../contact-us.css">
    <title>Document</title>
    <style>
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

<section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="contact-wrapper">
                <div class="contact-form">
                    <h3>Send us a message</h3>
                    <form action="mailto:vantage@gmail.com">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Your Message"></textarea>
                        </div>
                        <button action="mailto:vantage@gmail.com" type="submit">Send Message</button>
                    </form>
                </div>
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>
       
        <i class="fab fa-facebook"></i>
        <a href="https://www.facebook.com/LeCheese01" target="_blank">Eternal Legacy Facebook</a>
    </p>
    <p>
       
        <i class="fas fa-envelope"></i>
        <a href="mailto:vantage@gmail.com" target="_blank">Email me</a>
    </p>

    <p>
        <!-- Use the Font Awesome icon along with the Google Maps link -->
        <i class="fas fa-map-marker-alt"></i>
        <a href="https://maps.app.goo.gl/25cwVKkuaAEaVVQj8" target="_blank">Google Maps Location</a>
    </p>

                </div>
            </div>
        </div>
        
    </section>
    
</body>
</html>