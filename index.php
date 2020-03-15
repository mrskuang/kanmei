<?php
include 'header.php';
//报名方式

$sql = "SELECT  * FROM km_signup WHERE sign_type =1 ";
$signup = find($sql);
if($signup != null){
	 //报名栏的标题信息
	$titleinfo=explode('/', $signup['sign_title']);

	//报名栏的联系方式
	$telinfo=explode('/', $signup['sign_tel']);

}

//产品信息
$productinfo=select_all("SELECT * FROM km_product");



include'./view/index.html';
include 'footer.php';

?>