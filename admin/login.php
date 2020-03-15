<?php

    //引入公共函数
    include './include/function.php';

    if($_COOKIE['islogin'] ==1 && isset($_COOKIE['islogin'])){

       echo "<script> alert('您已登陆');window.location.href='index.php'</script>";

    }
    if(isset($_POST['login'])){
      $user=trim($_POST['username']);
      $pwd=trim($_POST['password']);
      $code=trim($_POST['code']);
      if($user===""){
        echo "<script> alert('用户名不能为空');window.history.go(-1)</script>";
        return;
      }
      if($pwd===""){
        echo "<script> alert('密码不能为空');window.history.go(-1)</script>";
        return;
      }
      if($code === ""||$code != strtolower($_COOKIE['code'])){
        echo "<script> alert('验证码不正确');window.history.go(-1)</script>";
        return;
      }
      $rs=login($user, $pwd);
      if($rs){
        echo "<script> alert('登录成功');window.location.href='index.php'</script>";
      }else{
        echo "<script> alert('登录失败，请从新登录');window.location.href='login.php'</script>";
      }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<title>CMS内容管理系统</title>
	<meta name="keywords" content="Admin">
	<meta name="description" content="Admin">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Core CSS  -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/pages.css">
	<link rel="stylesheet" type="text/css" href="css/plugins.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	<!-- Boxed-Layout CSS -->
	<link rel="stylesheet" type="text/css" href="css/boxed.css">

	<!-- Demonstration CSS -->
	<link rel="stylesheet" type="text/css" href="css/demo.css">

	<!-- Your Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

</head>

<body class="login-page">

<!-- Start: Main -->
<div id="main">
  <div class="container">
    <div class="row">
      <div id="page-logo"></div>
    </div>
    <div class="row">
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title">CMS内容管理系统</div>
		</div>
        <form action="login.php" class="cmxform" id="altForm" method="post">
          <div class="panel-body">
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">用户名</span>
                <input type="text" name="username" class="form-control phone" maxlength="10" autocomplete="off" placeholder="请输入用户名" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;码</span>
                <input type="password" name="password" class="form-control product" maxlength="10" autocomplete="off" placeholder="请输入密码" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">验证码</span>
                <input type="text" name="code" class="form-control product" maxlength="10" autocomplete="off" placeholder="请输入验证码" required style="width:60%">
                 <img src="code.php"  style="width: 39%;margin-left: 1%;height: 34px;border: 1px solid #ccc;border-radius: 2px;" id="code">
              </div>
            </div>
          </div>
          <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"></span>
            <div class="form-group margin-bottom-none">
              <input class="btn btn-primary pull-right" type="submit" value="登 录"  name='login'/>

              <div class="clearfix"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Main --> 

<!-- Core Javascript - via CDN --> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery-ui.min.js"></script> 
<script src="js/bootstrap.min.js"></script> <!-- Theme Javascript --> 
<script type="text/javascript" src="js/uniform.min.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/custom.js"></script> 
<script type="text/javascript">

jQuery(document).ready(function() {

	// Init Theme Core 	  
	Core.init();  
   $('#code').click(function(){
        this.src='code.php?='+Math.random();
    }) 
	
});

</script>
</body>

</html>
