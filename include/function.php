<?php

  include 'conf.php';
  //数据库连接函数
  function db_conn(){
		// 创建连接
		$conn=mysqli_connect(LOCALHOST,USER_NAME,PASS);
		if(!$conn){
			die('数据库连接失败'.mysqli_connect_error());
		}

		//选择数据库
		mysqli_select_db($conn,DATABASES);
		//设置数据库编码
		mysqli_set_charset($conn,'utf8');
		return $conn;
  }

  //封装打印函数

  function dump($data){
  	 echo "<pre>";
  	 var_dump($data);
  	 echo "</pre>";
  }


   //查询单个数据

    function find($sql){
    	$conn=db_conn();
    	$res=mysqli_query($conn,$sql);
    	$result=mysqli_fetch_assoc($res);
    	return $result;

    }


    //查询全部数据
    function select_all($sql){
        $data=array();
        $conn=db_conn();
        $res=mysqli_query($conn,$sql);
        while($result=mysqli_fetch_assoc($res)){
            $data[] = $result;
        }
        return $data;

    }

     //输出分页码
  function page($current,$count,$limit,$size,$condition){
      if($count>$limit){
      $str.=" <ul class='page'>";

            //首页
            if($current==1){

                     
            
                $str.="<li><a href='?".$condition."=1' style='color:rgb(179, 159, 99)'>首页</a></li>";
            

            }else{
             
                $str.="<li><a href='?".$condition."=1' style='color:rgb(179, 159, 99)'>首页</a></li>";
              
            }


            if($current<=floor($limit/2)){
              $start=1;
              $end=$size>$limit ?$limit:$size;

            }else if($current>$size-floor($limit/2)){
                //$start=$size-$limit+1;
                $start=($size-$limit+1<1)?1:$size-$limit+1;
                $end=$size;
            }else{
              $start =$current-floor($limit/2);
              $end=$current+floor($limit/2);
            }

            for($i=$start;$i<=$end;$i++){
              if($i==$current){
                $str.="<li class='active'><a style='color:rgb(179, 159, 99)'>".$i."</a></li>";
              }else{
                $str.="<li><a href='?".$condition."={$i}'  style='color:rgb(179, 159, 99)'>".$i."</a></li>";
              }
              
            }

            //尾页
            if($current==$size){
              $str.="<li class=''><a href='?".$condition."=".$size."' style='color:rgb(179, 159, 99)'>尾页</a></li>";
             

              
            }else{
              $str.="<li class=''><a href='?".$condition."=".$size."' style='color:rgb(179, 159, 99)'>尾页</a></li>";
             
            }
          ;
      $str.="</ul>";
    }else{
      return  '';
    }

    return $str;
  }
  




    //分页查询的函数
      /**
      $table 数据表
      $condition 查询的条件 
      $page 当前页
      */

      function pages($table,$page,$condition='',$where='page_id',$limit='6'){


        $conn=db_conn();
        //每一页显示的数据
        $pagelimit = $limit;
        //每一页显示页码的条数
         $size='5';
        //查询总共的条数
        $sqls = "SELECT * FROM $table" .$condition;  



    
        //获取长度
        $count=$conn->query($sqls)->num_rows;
          
        //获得页码的长度
        $pagecount=ceil($count/$pagelimit);

         if($page>$pagecount ||$page<0){
                
                 return $navinfo=[];
             }
           
        $navinfo['page']=page($page,$count,$size,$pagecount,$where);
        //偏移量
        $n = ($page - 1) * $pagelimit;
        $sql="SELECT * FROM $table ".$condition . "  limit "."$n,"."$pagelimit";

        $result=mysqli_query($conn,$sql);
        while ($res=mysqli_fetch_assoc($result)) {
          $navinfo['data'][]=$res;
        }


        return $navinfo;



      }

      //图片上传

  function upload($name,$file_dir='./uploads'){

    $img_info=[];
    if($_FILES[$name]['error']>0){
      switch($_FILES[$name]['error']){
        case 1:
          $img_info['msg']= "文件超出了Upload_max_filesize的值";
          break;
        case 2:
          $img_info['msg']="上传的文件大小超出了MAX_FILE_SIZE指令";
          break;
        case 3:
          $img_info['msg']="文件没有完全上传";
          break;
        case 4:
          $img_info['msg']="没有指定上传的文件";

          break;
        default:
          $img_info['msg']="位置错误";
          break;
      }
      return $img_info;

    }

    $uploads=$file_dir;

    //指定上传目录
    if(!file_exists($uploads)){
      mkdir($uploads,0755,TRUE);
    }

    //文件名字
    //$imgname=$_FILES[$name]['name'];
    //文件后缀
    $typeinfo=explode('/',$_FILES[$name]['type']);
    $type=end($typeinfo);
    $imgname=time().'.'.$type;
    //允许上传的数据类型
    $allow = ['jpeg','jpg','png','gif','svg'];
    if(!in_array($type,$allow)){
      $img_info['msg']="不允许上传$allow文件类型";
    }
    $path =$uploads.'/'.$imgname;
    if(move_uploaded_file($_FILES[$name]['tmp_name'], $path)){
      $img_info['msg']='上传成功';
      $img_info['imgpath']=IMGPATH.ltrim($path,'.');
      $img_info['code']='1';

    }else{
      $img_info['msg']='上传失败';
      $img_info['code']='0';
    }
    return   $img_info;
  }


?>