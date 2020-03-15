<?php
	include 'conf.php';
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

	/*
		*获取url

	*/
	function geturl(){
		$url=$_SERVER['PHP_SELF']."?";
		if($_GET){
			foreach ($_GET as $key => $value) {
				# code...
				if($key!='page'){
					$url.="{$key}={$value}&";
				}
			}
		}
		return $url;

	}
	

	//获取全部数据
	function select_all($sql){
		$conn=db_conn();
		$res=mysqli_query($conn,$sql);
	    while ($info=mysqli_fetch_assoc($res)) {
				$datas[]=$info;
		}
		return $datas;

	}


    //输出分页码
	function page($current,$count,$limit,$size,$condition){

		$str='';
		//如果数据条数大于每页限制显示的条数，则分页
	// $url=geturl();

	// echo '55555555555555555555555555555555555555555555555555555555555555555555555555555555555555'.$url;
	// exit;
		if($count>$limit){
			$str.=" <div class='pull-right'>
                    <ul class='pagination' id='paginator-example'>";

            //首页
            if($current==1){

                     
            	 $str.="<li><a>&lt;</a></li>";
            	  $str.="<li><a href='?".$condition."=1'>首页</a></li>";
            

            }else{
            	$str.="<li><a href='?".$condition."=".($current-1)."'>&lt;</a></li>";
            	  $str.="<li><a href='?".$condition."=1'>首页</a></li>";
            	
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
            		$str.="<li class='active'><a>".$i."</a></li>";
            	}else{
            		$str.="<li><a href='?".$condition."={$i}' >".$i."</a></li>";
            	}
            	
            }

            //尾页
            if($current==$size){
            	$str.="<li class=''><a href='?".$condition."=".$size."'>尾页</a></li>";
            	$str.="<li><a>&gt;</a></li>";

            	
            }else{
            	$str.="<li class=''><a href='?".$condition."=".$size."'>尾页</a></li>";
            	$str.="<li class='prev'><a href='?".$condition."=".($current+1)."'>&gt;</a></li>";
            }
          ;
			$str.="</ul></div>";
		}else{
			return  '';
		}

		return $str;
	}

     //查询咨询的所有分类
    function casetype(){
		//连接数据库
		$conn=db_conn();
		$sql='SELECT * FROM nnd_info_type';
		
		$result=mysqli_query($conn,$sql);

	    while ($res=mysqli_fetch_assoc($result)) {
	    	 $casetypeinfo[]=$res;
	    }
	    return $casetypeinfo;
	}




	//查询类型
	 function type($sql){
		//连接数据库
		$conn=db_conn();
		$result=mysqli_query($conn,$sql);
	    while ($res=mysqli_fetch_assoc($result)) {
	    	 $type[]=$res;
	    }
	    return $type;
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


    //上传多图
	function uplaods($file_dir='./uploads'){
        $img_info=[];
        $file_num = count($_FILES['pic1']['name']);
        for ($i = 0; $i < $file_num; $i++) {
            // 1. 判断错误信息
            if ($_FILES['pic1']['error'][$i] > 0) {
                switch ($_FILES['pic1']['error'][$i]) {
                    case 1:
                        $img_info['msg']= "文件大小超出了 upload_max_filesize 的值";
                        break;
                    case 2:
                        $img_info['msg']= "上传的文件大小超出了MAX_FILE_SIZE指令的值";
                        break;
                    case 3:
                        $img_info['msg']= "如果文件没有完全上传";
                        break;
                    case 4:
                        $img_info['msg']= "没有指定上传文件";
                        break;
                    default:
                        $img_info['msg']= "未知错误";
                        break;
                }
                return $img_info;
            }

            $uploads = $file_dir; //指定上传目录

            // 获取文件名
            $name = $_FILES['pic1']['name'][$i];

            // 获取文件类型
            $type = explode('/', $_FILES['pic1']['type'][$i]); // image/jpeg

            // 获取文件后缀
            $suffix = array_pop($type);

            // 允许上传的数据类型
            $allows = ['jpeg', 'jpg', 'png', 'gif', 'psd'];

            //判断上传的文件类型
            if (!in_array($suffix, $allows)) { //in_array检查数组中是否存在某个值
                $img_info['msg']="不允许上传$allow文件类型";
            }

            // 指定文件名
            $filename = date("YmdHis") . mt_rand(100, 999) . '.' . $suffix;
            $path = $uploads . '/' . $filename;

            if (move_uploaded_file($_FILES['pic1']['tmp_name'][$i], $path)) {
                if ($i == 0) {
                    $img = IMGPATH . ltrim($path, '.');
                } else {
                    $thumb = IMGPATH . ltrim($path, '.');
                }
            }else{
                $code=0;
            }
        }
        if(isset($code)&&!empty($code)){
            $img_info['code']='0';
        }else{
            $img_info['msg']='上传成功';
            $img_info['img']=$img;
            $img_info['thumb']=$thumb;
            $img_info['code']='1';
        }
        return $img_info;

    }
	function insert($sql){
		$conn=db_conn();
		$res=mysqli_query($conn,$sql);
		if($res){
			$info['code']='1';
		}else{
			$info['code']='0';
		}
		return $info;

	}



	//查询全部数据
    function select($sql){
        $conn=db_conn();
        $res=mysqli_query($conn,$sql);
        while ($rs=mysqli_fetch_assoc($res)){
            $arr_list[]=$rs;
        }
        return $arr_list;

    }

    //查询单个数据

    function find($sql){
    	$conn=db_conn();
    	$res=mysqli_query($conn,$sql);
    	$result=mysqli_fetch_assoc($res);
    	return $result;

    }
   //修改数据
    function edit($sql){
    	$conn=db_conn();
    	$res=mysqli_query($conn,$sql);
    	if($res){
			$info['code']='1';
		}else{
			$info['code']='0';
		}
		return $info;
    }

    //删除数据

    function del($sql){
    	$conn=db_conn();
    	$res=mysqli_query($conn,$sql);
    	if($res){
			$info['code']='1';
		}else{
			$info['code']='0';
		}
		return $info;
    }


   //打印数组

    function dump($data){

    	echo "<pre>";
    	var_dump($data);
    	echo "</pre>";
    }




    /**
     * @param $img_addr         [原图路径]
     * @param $width            [缩略图宽度]
     * @param $hight            [缩略图高度]
     * @param string $path      [存储目录]
     * @param string $filename  [原图文件名]
     * @return string           [缩略图路径]
     */
    function thumb($img_addr,$width,$hight,$path='',$filename=''){
        list($w,$h,$type) = getimagesize($img_addr);
        $types = [
            1 => 'gif',
            2 => 'jpeg',
            3 => 'png'
        ];
        $desc_str = "imagecreatefrom".$types[$type];
        $desc_img = $desc_str($img_addr);

        $img_new = imagecreatetruecolor($width,$hight);

        //imagecolorallocate 为一幅图像分配颜色
        $white = imagecolorallocate($img_new,255,255,255);
        //imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
        //$white = imagecolorallocatealpha($img_new,255,255,255,100);
        imagefill($img_new,0,0,$white);

        imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);


        //后缀
        $suffix = $types[$type];

        //header("Content-Type:image/{$suffix}");

        $filename = 'thumb_'.$filename;

        $thumb = $path.'/'.$filename;

        $save = "image".$types[$type];
        $save($img_new,$thumb); //保存
        //$save($img_new); //输出

        //8. 释放内存
        imagedestroy($img_new);


        return IMGPATH .'/'.$thumb;
    }


       //加水印
        function watermark($img_addr,$string='康美集团',$path = ''){
            list($w,$h,$type) = getimagesize($img_addr);
            $types = [
                1 => 'gif',
                2 => 'jpeg',
                3 => 'png'
            ];
            //变量函数
            $createimg = "imagecreatefrom".$types{$type};
            //原图
            $img=$createimg($img_addr);
            //为图像分配颜色

            $white=imagecolorallocate($img,255,255,255);
            $black=imagecolorallocate($img,0,0,0);
            $red=imagecolorallocate($img,255,0,0);
            $pink=imagecolorallocate($img,255,0,255);

            //设置字体
            imagettftext($img,30,0,50,50,$red,'../static/fonts/STHUPO.ttf',$string);
         
            //后缀
            $suffix = $types[$type];
            //header("Content-Type:image/{$suffix}");
            if($path==""){
                $path='./uploads/';
            }
            //
            $save = "image".$types[$type];
            $thumb=$path.time().'.'.$types[$type];
            $save($img,$thumb); //保存
            
            trim($thumb,'.');
            //8. 释放内存
            imagedestroy($img);
            $infs=explode('/', $thumb);
            return IMGPATH .'/'.$infs[1].'/'.$infs[2];

          
        }


         function watermark_img($origin_img,$water_img,$path=''){
            list($w,$h,$type) = getimagesize($origin_img);
            list($ww,$wh,$wtype) = getimagesize($water_img);
            $types = [
                1 => 'gif',
                2 => 'jpeg',
                3 => 'png'
            ];
            //变量函数
            //原图
            $originimg = "imagecreatefrom".$types{$type};
            //水印图
            $waterimg = "imagecreatefrom".$types{$wtype};

            //创建画布
            $img_src = $originimg($origin_img);//原图
            $img_des = $waterimg($water_img);//水印图
            //随机位置不能超出原图的位置
            //$x = mt_rand(4,$w - $ww);
            //$y = mt_rand(4,$h - $wh);
            $x = $w-$ww-20;
            $y = $h-$wh-20;
            imagecopy($img_src,$img_des,$x,$y,0,0,$ww,$wh);
            //后缀
            $suffix = $types[$type];

           
            if($path==""){
                $path='./uploads/';
            }
            //
            $save = "image".$types[$type];
            $thumb=$path.time().'.'.$types[$type];
            $save($img_src,$thumb); //保存
           
            
            //8. 释放内存
            imagedestroy($img_src);
            imagedestroy($img_des);
            $infs=explode('/', $thumb);
            return IMGPATH .'/'.$infs[1].'/'.$infs[2];
          

        }











        //判断当前用户是否登陆

       function login($username,$pwd){
         $conn=db_conn();
         $sql="SELECT `admin_id`,`admin_name`,`admin_last_login`,`admin_pwd` FROM  km_admin WHERE `admin_name` = '{$username}'";
       
         $result=mysqli_query($conn,$sql);
         if($result->num_rows>0){
             $userinfo=mysqli_fetch_assoc($result);
             if($userinfo['admin_pwd']==md5($pwd)){
                 //登录时间
                 setcookie('lastlogin',$userinfo['admin_last_login'],time()+60*60*10,'/');
                 //用户名
                 setcookie('username',$userinfo['admin_name'],time()+60*60*10,'/');
                 //设置登录状态
                 setcookie('islogin',1,time()+60*60*10,'/');
                 return 1;

             }else{
                return 0;
             }

         }else{
            return 0;
         }
    
      }




      //分页查询的函数
      /**
			$table 数据表
			$condition 查询的条件 
			$page 当前页
      */

      function pages($table,$page,$condition='',$where='page_id'){


      		$conn=db_conn();
		    //每一页显示的数据
		    $pagelimit = '5';
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




?>