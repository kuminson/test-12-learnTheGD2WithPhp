<?php
// 引入图片封装的类
require_once $_SERVER["DOCUMENT_ROOT"]."/imageclass.php";
$src = $_SERVER["DOCUMENT_ROOT"]."/image/tupian1.jpg";
$image = new Image($src);

// $image -> thumb(100,50);

// $content = "你好，慕课";
// $font_url = $_SERVER["DOCUMENT_ROOT"]."/image/msyh.ttf";
// $size = 14;
// $color = array(0,0,0,50);
// $local = array(
// 	'x' => 10,
// 	'y' => 20
// );
// $angle = -10;
// $image -> fontmark($content,$font_url,$size,$color,$local,$angle);

$source = $_SERVER["DOCUMENT_ROOT"]."/image/icon.png";
$local = array(
	'x' => 20,
	'y' => 20
);
$image -> imagemark($source,$local);
$image -> show();


?>