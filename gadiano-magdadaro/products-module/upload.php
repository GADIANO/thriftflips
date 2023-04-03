<?php
require_once '../config/config.php';
require_once '../classes/class.product.php';
$product = new Product();
$id= isset($_GET['id']) ? $_GET['id'] : '';
// Set maximum allowed file size in bytes
$max_size = 5 * 1024 * 1024; // 5 MB

// Set upload directory
$upload_dir = "../img/";

// Get uploaded file details
$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];

// Get file extension
$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

// Allowed file extensions
$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

// Check if file extension is allowed
if (in_array($file_ext, $allowed_ext) === false) {
    echo "Error: Invalid file extension.";
    exit();
}

// Check if file size is within the allowed limit
if ($file_size > $max_size) {
    echo "Error: File size is too large.";
    exit();
}

// Generate unique file name
$uniq_name = uniqid() . '.' . $file_ext;

// Upload original file
move_uploaded_file($file_tmp, $upload_dir . $uniq_name);

// Create image resource from uploaded file
if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
    $image = imagecreatefromjpeg($upload_dir . $uniq_name);
} else if ($file_ext == 'png') {
    $image = imagecreatefrompng($upload_dir . $uniq_name);
} else if ($file_ext == 'gif') {
    $image = imagecreatefromgif($upload_dir . $uniq_name);
} else {
    echo "Error: Invalid file format.";
    exit();
}

// Get original image dimensions
$width = imagesx($image);
$height = imagesy($image);

// Set maximum width and height for resized image
$max_width = 240;
$max_height = 240;

// Calculate new image dimensions while retaining aspect ratio
if ($width > $height) {
    $new_width = $max_width;
    $new_height = intval($height * ($max_width / $width));
} else {
    $new_height = $max_height;
    $new_width = intval($width * ($max_height / $height));
}
// Create new image resource with the calculated dimensions
$resized_image = imagecreatetruecolor($new_width, $new_height);

// Copy and resize original image to the new image resource
imagecopyresampled($resized_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Save resized image
if ($file_ext == 'jpg' || $file_ext == 'jpeg') {
    imagejpeg($resized_image, $upload_dir . $id."_" . $uniq_name, 100);
} else if ($file_ext == 'png') {
    imagepng($resized_image, $upload_dir . $id."_" . $uniq_name, 9);
} else if ($file_ext == 'gif') {
    imagegif($resized_image, $upload_dir . $id."_" . $uniq_name);
}

// Free up memory
imagedestroy($image);
imagedestroy($resized_image);

// Add to database
$product->update_product_img($id."_".$uniq_name,$id);
// Display success message
//echo "Image uploaded successfully.";

header("location: ../index.php?page=settings&subpage=products&action=profile&id=".$id);
