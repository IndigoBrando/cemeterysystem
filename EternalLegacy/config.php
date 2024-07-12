<?php
$host = "localhost";
$username = "root";
$password = ""; 
$database = "cemetery_system";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, image FROM slider LIMIT 4";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$image_count = 0;
$button_html = '';
$slider_html = '';
$thumb_html = '';

while ($rows = mysqli_fetch_assoc($resultset)) {
    $active_class = "";

    if (!$image_count) {
        $active_class = 'active';
        $image_count = 1;
    }

    $image_count++;
    $thumb_image = "nature_thumb_" . $rows['id'] . ".jpg";

    // Slider image html
    $slider_html .= "<div class='item " . $active_class . "'>";
    $slider_html .= "<img src='images/" . $rows['image'] . "' alt='1.jpg' class='img-responsive'>";
    $slider_html .= "<div class='carousel-caption'></div></div>";

    // Thumbnail html
    $thumb_html .= "<li><img src='images/" . $thumb_image . "' alt='$thumb_image'></li>";

    // Button html
    $button_html .= "<li data-target='#carousel-example-generic' data-slide-to='" . $image_count . "' class='" . $active_class . "'></li>";
}


?>
