<?php
     include 'header.php';
     //查询报名方式
	$sql = "SELECT  * FROM km_signup WHERE sign_type =2 ";
	$signup = find($sql);
	if($signup != null){
		 //报名栏的标题信息
		$titleinfo=explode('/', $signup['sign_title']);

		//报名栏的联系方式
		$telinfo=explode('/', $signup['sign_tel']);

	}


//查询大赛简介

$sql = "SELECT * FROM  km_Schedule AS a INNER JOIN km_sche_type AS b  ON  a.sche_type = b.sche_type_id AND b.sche_type_name = '大赛指南' ";
$sche = find($sql);


//大赛行程
$sql = "SELECT * FROM  km_Schedule AS a INNER JOIN km_sche_type AS b  ON  a.sche_type = b.sche_type_id AND b.sche_type_name = '大赛行程' ";
$schexc = select_all($sql);

//大赛奖励
$sql = "SELECT * FROM  km_Schedule AS a INNER JOIN km_sche_type AS b  ON  a.sche_type = b.sche_type_id AND b.sche_type_name = '大赛奖励' ";
$schejl= select_all($sql);
include './view/about.html';
include 'footer.php';

?>