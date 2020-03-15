<?php

   //引用函数库
   include './include/function.php';
	//最后登录的时间
	$time=time();
	$ip=$_SERVER["REMOTE_ADDR"];
	$name=$_COOKIE['username'];
	$conn=db_conn();
	$sql="UPDATE km_admin SET `admin_last_login` = '$time',`admin_login_ip` ='$ip' WHERE `admin_name`= '$name'";

	$res=mysqli_query($conn,$sql);
	if($res){
		//清除cookie
		foreach($_COOKIE as $key=>$value){
	 		setCookie($key,"",time()-1,'/');
		}
	}else{ 
		//清除cookie
		foreach($_COOKIE as $key=>$value){
	 		setCookie($key,"",time()-1,'/');
		}
	}

	  echo "<script> alert('注销用户');window.location.href='login.php'</script>";
    
    

?>