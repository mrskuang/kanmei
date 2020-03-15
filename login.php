<?php
//简介

//加载头部
include 'header.php';



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





include './view/login.html';


//加载底部

include 'footer.php';