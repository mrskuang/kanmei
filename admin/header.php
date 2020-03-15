
<?php
    include './include/function.php';

    //验证用户是否登录
     if(!(isset( $_COOKIE['islogin'] ) && $_COOKIE['islogin'] == 1)){
         echo "<script> alert('您未登录,请先登录')</script>";
         echo "<script> setTimeout(()=>{window.location.href='login.php'})</script>";
         die;
     }



   //当前url
    $current_url = basename($_SERVER['REQUEST_URI']);
    if($current_url == '') $current_url = 'index.php';
       $reg = '/\?/';
    if(preg_match($reg,$current_url)){
      $current_url = preg_split($reg, $current_url);
      $current_url = $current_url[0];
    }
     $type = isset($_GET) ? $_GET['type'] : '';

    //查询所有赛程类型
    $schetype = select_all("SELECT * FROM km_sche_type");

    //查看所有新闻类型
    $newstype = select_all("SELECT * FROM km_news_type");

    //查看图锦类型
    $marverinfo = select_all("SELECT * FROM km_marvellous_type");


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
  <link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">

  <!-- Theme CSS -->
  <link href="css/bootstrap-fileinput.css" rel="stylesheet">
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
  
  <!-- Core Javascript - via CDN --> 
  <script type="text/javascript" src="js/jquery.min.js"></script> 
  <script type="text/javascript" src="js/jquery-ui.min.js"></script> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="js/uniform.min.js"></script> 
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/custom.js"></script> 
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
  <div class="pull-left"> <a class="navbar-brand" href="#">
    <div class="navbar-logo"><img src="images/logo.png" alt="logo"></div>
    </a> </div>
  <div class="pull-right header-btns">
    <a class="user"><span class="glyphicons glyphicon-user"></span> <?php echo $_COOKIE['username'] ?></a>
    <a href="loginout.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>
  </div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main"> 
    <!-- Start: Sidebar -->
  <aside id="sidebar" class="affix">
    <div id="sidebar-search">
    		<div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li>
          <a href="index.php"><span class="glyphicons glyphicon-home"></span><span class="sidebar-title">后台首页</span></a>
        </li>
         <li class="<?php 
          if($current_url=='nav_list.php'||$current_url=='nav_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
          if($current_url=='nav_list.php'||$current_url=='nav_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">导航管理</span><span class="caret"></span></a>
            <ul class="nav sub-nav" id="sideEight" style="">
               <li class="<?php if($type==''&& $current_url=='nav_list.php'||$current_url=='nav_add.php'){ echo 'active';} ?>"><a href="nav_list.php"><span class="glyphicons glyphicon-record"></span> 导航列表</a></li>
             
            </ul>
        </li>
        <li class="<?php 
          if($current_url=='banner_list.php'||$current_url=='banner_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
          if($current_url=='banner_list.php'||$current_url=='banner_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">轮播图管理</span><span class="caret"></span></a>
            <ul class="nav sub-nav" id="sideEight" style="">
               <li class="<?php if($type==''&& $current_url=='banner_list.php'||$current_url=='banner_add.php'){ echo 'active';} ?>"><a href="banner_list.php"><span class="glyphicons glyphicon-record"></span> 轮播图列表</a></li>
             
            </ul>
        </li>


        <li class="<?php 
          if($current_url=='notice_list.php'||$current_url=='notice_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
          if($current_url=='notice_list.php'||$current_url=='notice_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">公告栏管理</span><span class="caret"></span></a>
            <ul class="nav sub-nav" id="sideEight" style="">
               <li class="<?php if($type==''&& $current_url=='notice_list.php'||$current_url=='notice_add.php'){ echo 'active';} ?>"><a href="notice_list.php"><span class="glyphicons glyphicon-record"></span> 公告栏列表</a></li>
            </ul>
        </li>
        
         <li class="<?php 
          if($current_url=='signup_list.php'||$current_url=='signup_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php 
          if($current_url=='signup_list.php'||$current_url=='signup_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">报名管理</span><span class="caret"></span></a>
            <ul class="nav sub-nav" id="sideEight" style="">
               <li class="<?php if($type==''&& $current_url=='signup_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="signup_list.php"><span class="glyphicons glyphicon-record"></span> 报名列表</a></li>
            </ul>
        </li>

          <li class="<?php
          if($current_url=='product_list.php'||$current_url=='signup_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='product_list.php'||$current_url=='signup_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">产品管理</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='product_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="product_list.php"><span class="glyphicons glyphicon-record"></span> 产品列表</a></li>
              </ul>
          </li>

          <li class="<?php
          if($current_url=='Schedule_list.php'||$current_url=='Schedule_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='Schedule_list.php'||$current_url=='Schedule_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">赛程管理</span><span class="caret"></span></a>
              <ul class="nav sub-nav" id="sideEight" style="">
                  <?php foreach($schetype as $val){ ?>
                    <li class="<?php 
                      if($type==$val['sche_type_id'] || $current_url=="Schedule_add.php?type=".$val['sche_type_id']){ 
                          echo 'active';
                      }
                    ?>"><a href="Schedule_list.php?type=<?php echo $val['sche_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['sche_type_name']  ?></a></li>
                  <?php } ?>
              </ul>
          </li>


          <li class="<?php
          if($current_url=='sche_type_list.php'||$current_url=='Schedule_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='sche_type_list.php'||$current_url=='Schedule_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">赛程类型</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='sche_type_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="sche_type_list.php"><span class="glyphicons glyphicon-record"></span> 类型列表</a></li>
              </ul>
          </li>

          <li class="<?php
          if($current_url=='news_list.php'||$current_url=='news_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='news_list.php'||$current_url=='news_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">新闻管理</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                   <?php foreach($newstype as $val){ ?>
                    <li class="<?php 
                      if($type==$val['news_type_id'] || $current_url=="news_add.php?type=".$val['news_type_id']){ 
                          echo 'active';
                      }
                    ?>"><a href="news_list.php?type=<?php echo $val['news_type_id']; ?>"><span class="glyphicons glyphicon-record"></span><?php echo $val['news_type_name']  ?></a></li>
                  <?php } ?>
              </ul>
          </li>


          <li class="<?php
          if($current_url=='expert_list.php'||$current_url=='news_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='expert_list.php'||$current_url=='news_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">专家管理</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='expert_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="expert_list.php"><span class="glyphicons glyphicon-record"></span> 专家列表</a></li>
              </ul>
          </li>

           <li class="<?php
          if($current_url=='activity_list.php'||$current_url=='news_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='activity_list.php'||$current_url=='news_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">活动管理</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='activity_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="activity_list.php"><span class="glyphicons glyphicon-record"></span> 活动列表</a></li>
              </ul>
          </li>

           <li class="<?php
          if($current_url=='activity_type_list.php'||$current_url=='news_add.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='activity_type_list.php'||$current_url=='news_add.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">精彩图锦</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">

                  <?php foreach($marverinfo as $v){ ?>
                  <li class="<?php if($type==$v['Marvellous_type_id']&& $current_url=='activity_type_list.php'){ echo 'active';} ?>"><a href="activity_type_list.php?type=<?php echo $v['Marvellous_type_id'] ?>"><span class="glyphicons glyphicon-record"></span> <?php echo mb_substr($v['Marvellous_type_name'] , 0,5) ?></a></li>
                   <?php } ?>

              </ul>
          </li>

           <li class="<?php
          if($current_url=='storeinfo_list.php'||$current_url=='store_works_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='storeinfo_list.php'||$current_url=='store_works_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">门店管理</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='storeinfo_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="storeinfo_list.php"><span class="glyphicons glyphicon-record"></span> 门店列表</a></li>
                  <li class="<?php if($type==''&& $current_url=='store_works_list.php'||$current_url=='stroe_works_add.php'){ echo 'active';} ?>"><a href="store_works_list.php"><span class="glyphicons glyphicon-record"></span> 门店作品</a></li>
              </ul>
          </li>

          <li class="<?php
          if($current_url=='conf_list.php'||$current_url=='conf_list.php'){echo 'active';} ?>"> <a href="#sideEight" class="accordion-toggle  <?php
              if($current_url=='conf_list.php'||$current_url=='conf_list.php'){echo 'menu-open';} ?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">网站配置</span><span class="caret"></span></a>
             <ul class="nav sub-nav" id="sideEight" style="">
                  <li class="<?php if($type==''&& $current_url=='conf_list.php'||$current_url=='signup_add.php'){ echo 'active';} ?>"><a href="conf_list.php"><span class="glyphicons glyphicon-record"></span> 配置列表</a></li>
                
              </ul>
          </li>

      </ul>
    </div>
  </aside>