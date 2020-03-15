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

	if(isset($_GET['id']) && !empty($_GET['id'])){
		//先查询当前数据 ，也就是当前的活动
		$sql = "SELECT  * FROM km_marvellous_type WHERE Marvellous_type_id = ".$_GET['id'];
	    $find = find($sql);
	    //在查询当前的活动的图片集锦
	    $sqls = "SELECT  * FROM km_marvellous WHERE Marvellous_type_id = ".$_GET['id'];
	    $infos = select_all($sqls);

	}

   

	










	
   include './view/jincai2.html';
   include 'footer.php';




?>