<?php
if($_COOKIE['clientlogin']!=1){
	echo "<script> alert('请登录后访问');window.location.href='login.php'</script>";
}




//加载头部
include 'header.php';

$id = $_COOKIE['uid'];
$sql = 'SELECT * FROM km_storeinfo WHERE `store_id`='.$id;
$res = mysqli_query($conn,$sql);
$userinfo = mysqli_fetch_assoc($res);


//加载内容

//查询报名方式
$sql = "SELECT  * FROM km_signup WHERE sign_type =2 ";
$signup = find($sql);
if($signup != null){
	 //报名栏的标题信息
	$titleinfo=explode('/', $signup['sign_title']);

	//报名栏的联系方式
	$telinfo=explode('/', $signup['sign_tel']);

}







include './view/huiyuan.html';


//加载底部

include 'footer.php';

?>