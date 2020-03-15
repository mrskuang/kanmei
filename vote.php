<?php
 include './include/function.php';
 //连接数据库
 $conn = db_conn();
 if ($_GET['ids']) {
 	$sql= "SELECT * FROM km_store_works WHERE `store_works_id` =".$_GET['ids'];
    $finds = find($sql);
   
    $nums = $finds['store_works_Number']+1;
   


 	$sql = "UPDATE  km_store_works  SET    `store_works_Number` = '{$nums}' WHERE `store_works_id` = ".$_GET['ids'];
 
    $res =	mysqli_query($conn,$sql);
    if($res){
		$info['msg'] = '投票成功';
		$info['code'] = '1';
	
    }else{
		$info['msg'] = '投票失败';
		$info['code'] = '0';
		
    }
	
	echo json_encode($info);
 }
 
?>