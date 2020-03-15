<?php

	include './include/function.php';
	$conn=db_conn();
	if($_POST['username'] && $_POST['password']){
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM km_storeinfo WHERE `store_username`= '$username' AND `store_pwd` = '$password' ";
	
	$res = mysqli_query($conn,$sql);
	if($res && mysqli_num_rows($res)>0){
		 $userinfo =mysqli_fetch_assoc($res);
	     //用户名
	     setcookie('username',$userinfo['store_name'],time()+60*60*10*10,'/');
	       //用户名
	     setcookie('uid',$userinfo['store_id'],time()+60*60*10*10,'/');
	     //设置登录状态
	     setcookie('clientlogin',1,time()+60*60*10*10,'/');
	     echo "<script> alert('登录成功');window.location.href='index.php'</script>";
	}else {
		 echo "<script> alert('登录失败，请从新登录');window.location.href='login.php'</script>";
	}

}

?>