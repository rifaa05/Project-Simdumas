<?php
session_start();

// buat random string 4 karakter
$karakter = 'ABCDEFGHJKMNOPQRSTUVWXYZabcdefghjkmnopqrstuvwxyz';
$captcha = substr(str_shuffle($karakter), 0, 4);

$_SESSION['captcha'] = $captcha;

// buat gambar
$image = imagecreate(100, 40);
$bg = imagecolorallocate($image, 160, 196, 255); // biru kalem
$text_color = imagecolorallocate($image, 0, 0, 0);

// isi background
imagefilledrectangle($image, 0, 0, 100, 40, $bg);

// tulis captcha
imagestring($image, 5, 20, 10, $captcha, $text_color);

// header image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>