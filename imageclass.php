<?php
class Image{
	private static $info; //图片信息
	private static $image;  //内存中的图片
	/*
	* 加载图片
	* @param string $src
	*/
	public function __construct($src){
		// 获取图片信息
		$info = getimagesize($src);
		self::$info = array(
			"width" => $info[0],
			"height" => $info[1],
			// 获取图片格式
			"type" => image_type_to_extension($info[2],false),
			// 获取图片详细格式
			"mime" => $info["mime"]
		);
		// 拼接创建图片函数字符串
		$fun = "imagecreatefrom".self::$info['type'];
		// 在内存中创建图片
		self::$image = $fun($src);
	}

	/*
	 * 操作图片（压缩）
	 * @param string $width
	 * @param string $height
	 */
	public function thumb($width,$height){
		// 在内存中新建真色彩图片
		$image_thumb = imagecreatetruecolor($width, $height);
		// 在新图片上添加原有图片 并改变大小
		imagecopyresampled($image_thumb, self::$image, 0, 0, 0, 0, $width, $height, self::$info["width"], self::$info["height"]);
		// 销毁原有图片
		imagedestroy(self::$image);
		// 把改变后图片存入内存
		self::$image = $image_thumb;
	}

	/*
	 * 操作图片（添加文字水印）
	 * @param string $content
	 * @param string $font_url
	 * @param int    $size
	 * @param array  $color
	 * @param array  $local
	 * @param int    $angle
	 */
	public function fontmark($content,$font_url,$size,$color,$local,$angle){
		// 设置文字颜色
		$col = imagecolorallocatealpha(self::$image, $color[0], $color[1], $color[2], $color[3]);
		// 添加文字
		imagettftext(self::$image, $size, $angle, $local['x'], $local['y'], $col, $font_url, $content);

	}

	/*
	 * 操作图片（添加图片水印）
	 *
	 */
	public function imagemark($source,$local){
		// 获取图片信息
		$info = getimagesize($source);
		// 获取图片格式
		$type = image_type_to_extension($info[2],false);
		// 拼接创建图片函数
		$fun = "imagecreatefrom".$type;
		// 在内存中创建图片
		$water = $fun($source);
		// 合并图片
		imagecopy(self::$image, $water, $local['x'], $local['y'], 0, 0, $info[0], $info[1]);
		// 销毁水印
		imagedestroy($water);
	}


	/*
	 * 输出图片
	 *
	 */
	public function show(){
		// 图片格式输出信息头
		header("content-type:".self::$info["mime"]);
		// 拼接输出函数字符串
		$funs = "image".self::$info['type'];
		// 输出图片
		$funs(self::$image);
	}

	/*
	 * 把图片保存在硬盘中
	 * @param string $newname
	 */
	public function save($newname){
		// 拼接输出函数字符串
		$funs = "image".self::$info['type'];
		$funs(self::$image,$_SERVER["DOCUMENT_ROOT"].$newname.".".$type);
	}

	/*
	 * 销毁图片
	 * 
	 */
	public function __destruct(){
		// 销毁图片
		imagedestroy(self::$image);
	}



}
?>