<?php
   //配置目录
	define('ROOT',$_SERVER['HTTP_HOST']);
	//加载css目录
	define('CSS_DIR','/static/css/');
	//加载js目录
	define('JS_DIR', '/static/js/');
	//加载图片目录
	define('IMG_DIR', '/static/img/');

	/*数据库的配置*/
	//地址
	define('LOCALHOST', 'localhost');
	//用户名
	define('USER_NAME', 'kanmei');
	//密码
	define('PASS', '123456');
	//数据库
	define('DATABASES', 'kangmei');


	 //存储图片的路径
	$pattern='/\/[a-z]+/';
	preg_match($pattern,$_SERVER['PHP_SELF'],$arr);
	$imgs='http://'.$_SERVER['HTTP_HOST'].$arr[0];
	
	
	define('IMGPATH', $imgs);

?>