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


	//分页 大赛快讯
	 $type = 1; 
	//获取页码
		if(!empty($_GET['page_id']) && isset($_GET['page_id'])){

		     $page = $_GET['page_id'];

		}else{
		     $page = '1';
         }
	    $where="   INNER JOIN km_news_type ON km_news.news_type = km_news_type.news_type_id AND km_news_type.news_type_id=".$type; 

	 
	  $newsinfo=pages('km_news',$page,$where);







	
   include './view/dasai.html';
   include 'footer.php';

?>