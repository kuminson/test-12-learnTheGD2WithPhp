<?php
// 打开图片
// 配置图片路径
$src = $_SERVER["DOCUMENT_ROOT"].'/image/tupian1.jpg';
// 获取图片信息
$info = getimagesize($src);
// 获取图片格式
$type = image_type_to_extension($info[2],false);
// 内存中创建和图像类型一样的图片
$fun = "imagecreatefrom{$type}";
$image = $fun($src);
// echo "<pre>";
// print_r($type);

// 操作图片
// 配置文字路径
$font = $_SERVER["DOCUMENT_ROOT"]."/image/msyh.ttf";
// 配置文件内容
$content = "你好，慕课网";
// 设置字体颜色和透明度
$col = imagecolorallocatealpha($image, 255, 0, 0, 50);
// 写入文字
imagettftext($image, 14, 0, 10, 30, $col, $font, $content);

// 输出图片
// 增加头信息 要输出一张图片
header("content-type:".$info['mime']);
// 拼接输出函数
$func = "image{$type}";
// 浏览器输出
$func($image);
// 保存图片
$func($image,$_SERVER["DOCUMENT_ROOT"]."/image/newpic.".$type);

// 销毁图片
imagedestroy($image);
?>