<?php
include("config.php");

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
    $thumb_image = "natures_thumb_" . $rows['id'] . ".jpg";

    $slider_html .= "<div class='item " . $active_class . "'>";
    $slider_html .= "<img src='images/" . $rows['image'] . "' alt='Image " . $rows['id'] . "' class='img-responsive' style='width: 10000px; height: 650px;'>";
    $slider_html .= "<div class='carousel-caption'></div></div>";

    $thumb_html .= "<li><img src='images/" . $thumb_image . "' alt='$thumb_image'></li>";

    $button_html .= "<li data-target='#carousel-example-generic' data-slide-to='" . $image_count . "' class='" . $active_class . "'></li>";
}
?>
