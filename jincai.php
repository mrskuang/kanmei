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

     //查询活动信息
	if(!empty($_GET['page_id']) && isset($_GET['page_id'])){

		     $page = $_GET['page_id'];

	}else{
		     $page = '1';
    }
    $newsinfo = pages('km_marvellous_type',$page,'','page_id','4');
    $huodong = $newsinfo['data'];
    $pages = $newsinfo['page'];

	










	
   include './view/jincai.html';
   include 'footer.php';




?>