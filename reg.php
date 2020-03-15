<?php
//简介
//加载头部
include 'header.php';
if($_COOKIE['clientlogin'] == 1){
	if($_GET['user_id']){
	$sql = 'SELECT * FROM km_storeinfo WHERE `store_id` = '.$_GET['user_id'];
	$userinfo = find($sql);

	 $region = explode(',', $userinfo['store_region']);
	 $arr = [];
	 for($i=0;$i<count($region);$i++){
	 	$sql = 'SELECT `id`,`name` FROM km_region WHERE `id` ='.$region[$i];
	 	$arr[$i]=find($sql);
	 }
	 

   }

}


//加载内容

//查询报名方式
$sql = "SELECT  * FROM km_signup WHERE sign_type =2 ";
$signup = find($sql);
if($signup != null){
	 //报名栏的标题信息
	$titleinfo=explode('/', $signup['sign_title']);

	//报名栏的联系方式
	$telinfo=explode('/', $signup['sign_tel']);

}







include './view/reg.html';


//加载底部

include 'footer.php';

?>