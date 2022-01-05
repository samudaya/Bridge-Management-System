<?php
@session_start();


$new_string;

$string = md5(rand(0,9999));
$new_string = substr($string, 17, 6);

$_SESSION['new_string']=$new_string;
$im = ImageCreate(60, 20);

$white = ImageColorAllocate($im, 0, 0, 243);
$black = ImageColorAllocate($im, 254, 211, 0);

ImageFill($im, 0, 0, $black);

ImageString($im, 24, 3, 3, $new_string, $white);

Header("Content-Type: image/png");
ImagePNG($im);
ImageDestroy($im);
?>