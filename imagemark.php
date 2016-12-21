<?php
// 打开图片
// 配置图片路径
$src = $_SERVER["DOCUMENT_ROOT"]."/image/tupian1.jpg";
// 获取图片信息
$info = getimagesize($src);
// 获取图片格式
$type = image_type_to_extension($info[2],false);
// 拼接函数
$fun = "imagecreatefrom{$type}";
// 复制图片到内存中
$image = $fun($src);

// 操作图片
// 设置水印的路径
$image_mark = $_SERVER["DOCUMENT_ROOT"]."/image/icon.png";
// 获取水印的基本信息
$info2 = getimagesize($image_mark);
// 获取水印格式
$type2 = image_type_to_extension($info2[2],false);
// 拼接函数
$fun2 = "imagecreatefrom{$type2}";
// 复制水印图片到内存中
$image2 = $fun2($image_mark);
// 合并图片
imagecopymerge($image, $image2, 20, 20, 0, 0, $info2[0], $info2[1], 30);
// 销毁水印图片
imagedestroy($image2);

// 输出图片
// 添加输出头
header("content-type:".$info["mime"]);
// 拼接输出函数
$printimg = "image{$type}";
// 在浏览器中输出图片
$printimg($image);
// 保存图片
$printimg($image,$_SERVER["DOCUMENT_ROOT"]."/image/newwater.".$type);
// 销毁图片
imagedestroy($image);
?>