<?php

// Define fonts path
putenv('GDFONTPATH=' . realpath('./fonts'));

// Define base parameters
$color = 'white';
$width = 300;
$height = 50;
$font = 'Pacifico';
$fontSize = 25;
$icon = 'icons/rocket.png';
$iconSize = 35;
$text = 'Company';

// Get parameters from URL
$form = filter_input_array(INPUT_GET);
if (!empty($form)) {
    extract($form);
}

// Create image
$image = imagecreatetruecolor($width, $height);
$backgroundColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $backgroundColor);

// Paste icon
$src = imagecreatefrompng($icon);
imagecopyresampled($image, $src, 5, 5, 0, 0, $iconSize, $iconSize, 256, 256);
if ($color === 'white') {
    imagefilter($image, IMG_FILTER_GRAYSCALE);
    imagefilter($image, IMG_FILTER_CONTRAST, 255);
    imagefilter($image, IMG_FILTER_COLORIZE, 255, 255, 255);
}

// Write text
if ($color === 'white') {
    $fontColor = imagecolorallocate($image, 255, 255, 255);
} else {
    $fontColor = imagecolorallocate($image, 0, 0, 0);
}
imagettftext($image, $fontSize, 0, $iconSize + 10, $fontSize + 10, $fontColor, $font, $text);

// Output image
header('Content-type:image/png');
imagealphablending($image, true);
imagesavealpha($image, true);
imagepng($image);
imagedestroy($image);