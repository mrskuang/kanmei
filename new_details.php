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

	if(isset($_GET['new_id']) && !empty($_GET['new_id'])){
		$sql = "SELECT  * FROM km_news WHERE news_id =".$_GET['new_id'];
		$newsinfo = find($sql);


	}


	
   include './view/dasai2.html';
   include 'footer.php';


?>