<?php
// 打开图片
$src = $_SERVER["DOCUMENT_ROOT"]."/image/tupian1.jpg";
$info = getimagesize($src);
$type = image_type_to_extension($info[2],false);
$fun = "imagecreatefrom{$type}";
$image = $fun($src);
// 操作图片
// 在内存中建立宽300，高200真色彩图片
$image_thumb = imagecreatetruecolor(100, 50);
// 将原图复制到图片上 并且按照一定比例压缩
imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, 100, 50, $info[0], $info[1]);
imagedestroy($image);
// 输出图片
header("content-type:".$info["mime"]);
$funs = "image{$type}";
$funs($image_thumb);
$funs($image_thumb,$_SERVER["DOCUMENT_ROOT"]."/image/newthumb.".$type);
// 销毁图片
imagedestroy($image_thumb);
?>