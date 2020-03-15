<?php



   //加载db类
   include './include/db.php';
   include './include/function.php';


	$config = [
		'host' =>  '127.0.0.1',
		'user' =>  'kanmei',
		'pwd' => '123456',
		'dbname' => 'kangmei',
		'charset' =>'uft-8',
		'tb_prefix' =>'km_'
	];
	$db =  Db::mysql_con($config);

	if(isset($_POST['sub'])){
	  $info = [];
	 //上传图片
        if($_FILES['pic1']['error']==0){
            $upload = upload('pic1');
            if($upload['code']==1) {
                $info['store_name_img'] = $upload['imgpath'];
            }else{
                $info['store_name_img'] = "";
            }
        }
      
		$info['store_username'] = $_POST['username'];
		$info['store_pwd'] = md5($_POST['password']);
		$info['store_name'] = $_POST['code'];
		$info['store_region'] =$_POST['sheng'].','.$_POST['shi'].','.$_POST['qu'];
		$info['store_sheng'] = $_POST['sheng'];
		$info['store_shi'] = $_POST['store_shi'];
		$info['store_qu'] = $_POST['store_qu'];
		$info['store_adder'] = $_POST['addres'];
		$info['storeqq'] = $_POST['qq'];
		$info['store_chain_name'] = $_POST['Chain_name'];
		$info['store_slogan'] = $_POST['slogan'];
		$info['store_tel'] = $_POST['tel'];
		$info['store_contacts'] = $_POST['Contacts'];
		
		//验证类

        //头像上传

		//插入方法

	   $res	= $db->add('km_storeinfo',$info);
	   if($res['code']==1){
	   	    echo "<script> alert('报名成功');window.location.href='login.php';</script>";
	   }else{
 			echo "<script> alert('报名失败');window.location.href='login.php';</script>";
	   }	    
	}

	if(isset($_POST['edit'])){
		 $info = [];
	    //上传图片
        if($_FILES['pic1']['error']==0){
            $upload = upload('pic1');
            if($upload['code']==1) {
                $info['store_name_img'] = $upload['imgpath'];
            }else{
                $info['store_name_img'] = "";
            }
        }else{

        }
      
        $id = $_POST['store_id'];
		$info['store_username'] = $_POST['username'];
		$info['store_pwd'] = md5($_POST['password']);
		$info['store_name'] = $_POST['code'];
		$info['store_region'] =$_POST['sheng'].','.$_POST['shi'].','.$_POST['qu'];
		$info['store_adder'] = $_POST['addres'];
		$info['storeqq'] = $_POST['qq'];
		$info['store_chain_name'] = $_POST['Chain_name'];
		$info['store_slogan'] = $_POST['slogan'];
		$info['store_tel'] = $_POST['tel'];
		$info['store_contacts'] = $_POST['Contacts'];

		

		$where = " WHERE `store_id` = {$id}";
		$res = $db->edit('km_storeinfo',$info,$where);
        if($res['code']==1){
	   	    echo "<script> alert('修改成功');window.location.href='huiyuan.php';</script>";
	    }else{
 			echo "<script> alert('修改成功');window.location.href='huiyuan.php';</script>";
	    }	    
		

	}

?>