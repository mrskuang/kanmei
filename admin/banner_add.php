    <?php 
        include 'header.php';
        //添加轮播图
        if(isset($_POST['sub'])){
            $name = $_POST['ban_name'];
            // 值为0 代表生成原图和缩略图， 1 代表生成文字水印  ， 2代表生成图片水印
            $type  = $_POST['thumb'];
            //上传图片
            if(!empty($_FILES)){
                $upload = upload('pic1');
                if($upload['code']==1){
                     $imgpath = $upload['imgpath'];
                     if($type==0){
                        //截取数组最后一个元素
                         $arr_list=explode('/',$imgpath);
                         $c=count($arr_list)-1;
                         $filename=$arr_list[$c];
                         //生成缩略图
                         $thumbimg=thumb($imgpath,150,102,'uploads/thumb',$filename);
                     }else if($type==1){
                         $imgpath=watermark($imgpath);
                     }else if($type==2){
                        $imgpath=watermark_img($imgpath,'./images/logos.png');
                     }else{
                        $thumbimg="";
                     }
                }else{
                     $imgpath="";
                     $thumbimg="";
                }
            }

           $sql="INSERT INTO km_banner (`ban_name`,`ban_imges`,`ban_thumb`) VALUES( '$name','$imgpath','$thumbimg')";
           $res=insert($sql);
           if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='banner_list.php';</script>";
           }else{
                echo "<script> alert('添加失败')</script>";
           }
        }


        //修改操作
        if(isset($_GET['edit'])&& !empty($_GET['edit'])){

                $sql="SELECT * FROM km_banner WHERE ban_id=".$_GET['edit'];
                $findban=find($sql);
        }

        if(isset($_POST['edit']) && !empty($_POST['edit'])){

                $id=trim($_POST['ban_id']);
                $name=trim($_POST['ban_name']);
                $type=trim($_POST['thumb']);

                //验证数据

               //上传图片
                if($_FILES['pic1']['error']==0){
                    $upload = upload('pic1');
                    if($upload['code']==1){
                         $imgpath = $upload['imgpath'];
                         if($type==0){
                             //截取数组最后一个元素
                             $arr_list=explode('/',$imgpath);
                             $c=count($arr_list)-1;
                             $filename=$arr_list[$c];
                             //生成缩略图
                             $thumbimg=thumb($imgpath,150,102,'uploads/thumb',$filename);

                            //删除本地图片
                            $localimg = explode('/',$findban['ban_imges']);
                            $localimgs='./'.$localimg[4].'/'.$localimg[5];

                            if(is_file( $localimgs)){
                                unlink($localimgs);
                            }

                            //删除本地缩略图
                            $locathumb = explode('/',$infos['ban_thumb']);
                            $locathumbs='./uploads/'.$locathumb[5].'/'.$locathumb[6];
                            if(is_file( $locathumbs)){
                                unlink($locathumbs);
                            }
                         }else if($type==1){
                             $imgpath=watermark($imgpath);

                             $thumbimg=$findban['ban_thumb'];
                            //删除本地图片
                            $localimg = explode('/',$findban['ban_imges']);
                            $localimgs='./'.$localimg[4].'/'.$localimg[5];

                            if(is_file( $localimgs)){
                                unlink($localimgs);
                            }
                         }else if($type==2){
                            $imgpath=watermark_img($imgpath,'./images/logos.png');
                            $thumbimg=$findban['ban_thumb'];
                            //删除本地图片
                            $localimg = explode('/',$findban['ban_imges']);
                            $localimgs='./'.$localimg[4].'/'.$localimg[5];
                            if(is_file( $localimgs)){
                                unlink($localimgs);
                            }
                         
                    }else{

                    }
                }else{
                    $thumbimg="";
                    //删除本地图片
                    $localimg = explode('/',$findban['ban_imges']);
                    $localimgs='./'.$localimg[4].'/'.$localimg[5];
                    if(is_file($localimgs)){
                        unlink($localimgs);
                    }
                }
            }else{
               
                 if($type==0){
                    //截取数组最后一个元素
                     $arr_list=explode('/',$findban['ban_imges']);
                     $c=count($arr_list)-1;
                     $filename=$arr_list[$c];
                     //生成缩略图
                     $thumbimg=thumb($imgpath,150,102,'uploads/thumb',$filename);

                    //删除本地图片
                    $localthumb = explode('/',$thumbimg);
                    $localthumbs='./'.$localthumb[5].'/'.$localthumb[6];

                    if(is_file( $localthumbs)){
                        unlink($localthumbs);
                    }


                 }else if($type==1){
                    $imgpath=watermark($findban['ban_imges']);
                    $thumbimg=$findban['ban_thumb'];
                    //删除本地图片
                    $localimg = explode('/',$findban['ban_imges']);
                    $localimgs='./'.$localimg[4].'/'.$localimg[5];

                    if(is_file( $localimgs)){
                        unlink($localimgs);
                    }

                 }else if($type==2){
                    $imgpath=watermark_img($findban['ban_imges'],'./images/logos.png');
                    $thumbimg=$findban['ban_thumb'];
                    //删除本地图片
                    $localimg = explode('/',$findban['ban_imges']);
                    $localimgs='./'.$localimg[4].'/'.$localimg[5];
                    if(is_file( $localimgs)){
                        unlink($localimgs);
                    }

                 }else{
                     $imgpath=$findban['ban_imges'];
                     $thumbimg=$findban['ban_thumb'];
                 }

                 
            }
             $sql="UPDATE km_banner SET `ban_name` = '$name' ,`ban_imges` ='$imgpath' , `ban_thumb` ='$thumbimg' WHERE `ban_id` = $id";
             $res=edit($sql);
             if($res['code']==1){
                 echo "<script> alert('修改成功');window.location.href='banner_list.php';</script>";
             }else{
                 echo "<script> alert('修改失败');window.location.href='banner_list.php';</script>";
             }
       }
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加轮播图</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="ban_id" value="<?php  if(isset($findban)){ echo $findban['ban_id'];}else{ echo ""; }?>" />

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if( isset($findban)){ echo '编辑轮播图'; }else{ echo "添加轮播图"; } ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">名称</span>
                                            <input type="text" name="ban_name" value="<?php 


                                                    if(isset($findban)){
                                                        echo $findban['ban_name'];
                                                    }





                                            ?>" class="form-control" >
                                        </div>
                                    </div>

                                   
                                    <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($findban)){
                                                         echo $findban['ban_imges'];
                                                     }else{
                                                        echo "images/uploadimg.png";
                                                     }

                                                ?>" alt="" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">选择文件</span>
                                                        <span class="fileinput-exists">换一张</span>
                                                        <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                                </div>
                                            </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">类型</span>
                                            <select name="thumb" id="standard-list1" class="form-control">
                                                <option value="3">请选择</option>
                                                <option value="0">缩略图</option>
                                                <option value="1">文字水印</option>
                                                <option value="2">图片水印</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($findban)){
                                                echo "edit";
                                        }else{echo "sub" ;} ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <!-- End: Content -->
</div>
<!-- End: Main -->

<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
 <script src="js/bootstrap-fileinput.js"></script>
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
    var ue = UM.getEditor('myEditor', {
        autoClearinitialContent: false,
        wordCount: false,
        elementPathEnabled: false,
        initialFrameHeight: 300
    });
</script>
<script type="text/javascript">
    $(function () {
        //比较简洁，细节可自行完善
        $('#uploadSubmit').click(function () {
            var data = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'xxx/xxx',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if(data.status){
                        console.log('upload success');
                    }else{
                        console.log(data.message);
                    }
                },
                error: function (data) {
                    console.log(data.status);
                }
            });
        });

    })
</script>
</body>

</html>