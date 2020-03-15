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



   $sqls = "SELECT * FROM km_region WHERE `level` = 1 Limit 0,6";
   $soure= select_all($sqls);


     
     

   /*
   递归查询市区
   function select($data){
      for($i=0;$i<count($data);$i++){
        $sql = "SELECT `id`,`name` FROM km_region WHERE `pid` =".$data[$i]['id']." Limit 0,6";
        $data[$i]['children']= select_all($sql);
        if(count($data[$i]['children'])>0){
           $data[$i]['children'] = select($data[$i]['children']);
        }
      }
      return $data;
   }
   */
   
   
   
     //获取页码
      if(!empty($_GET['page_id']) && isset($_GET['page_id'])){
           $page = $_GET['page_id'];
      }else{
           $page = '1';
      }

       

     

     //更具城市id查询对应的门店作品
     if(isset($_GET['men_id']) && !empty($_GET['men_id'])){
        $men_id = $_GET['men_id'];
     }else{
        $men_id = '110000';
     }
     $data = pages('km_store_works',$page," as a INNER JOIN km_storeinfo as b ON a.store_storeuser_id=b.store_id AND  a.stroe_woks_sheng ={$men_id}");
      if($data != null){
         $stroeworks = $data['data'];
         $pages = $data['page'];
      }

     
   
   


   




   include './view/mendian.html';
   include 'footer.php';

?>