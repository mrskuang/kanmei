<?php

//加载公共函数
include './include/function.php';

//当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
    if($current_url == '') $current_url = 'index.php';
       $reg = '/\?/';
    if(preg_match($reg,$current_url)){
      $current_url = preg_split($reg, $current_url);
      $current_url = $current_url[0];
    }

//查询导航栏信息
$conn=db_conn();
$sql='SELECT * FROM km_nav';
$result=mysqli_query($conn,$sql);
while ($res=mysqli_fetch_assoc($result)){
	 	$nav_info[]=$res;
}


//通告栏

$sqls='SELECT  * FROM  km_notice';
$notice=mysqli_query($conn,$sqls);
while ($res=mysqli_fetch_assoc($notice)) {
	$notice_arr[]=$res;
}


//banner图信息
$bans='SELECT  * FROM  km_banner';
$ban=mysqli_query($conn,$bans);
while ($baners=mysqli_fetch_assoc($ban)) {
	$banner_arr[]=$baners;
}

if($_COOKIE['clientlogin'] == 1){
     $loginname['name'] = '会员中心';
     $loginname['url'] = 'huiyuan.php';
     $logininfo['name'] = '退出登录';
     $logininfo['url'] = 'loginout.php';
}else{
     $loginname['name'] = '立即登录';
     $loginname['url'] = 'login.php';
     $logininfo['name'] = '立即报名';
     $logininfo['url'] = 'reg.php';
}


//加载头部文件
include './view/header.html';


?>