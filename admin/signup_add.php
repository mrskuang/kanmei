    <?php 
        include 'header.php';
        //添加报名方式
        if(isset($_POST['sub'])){
            $title = $_POST['sign_title'];
            $tel = $_POST['sign_tel'];
            //上传图片
            if(!empty($_FILES)){
                $upload = uplaods();
                if($upload['code']==1){
                     $img = $upload['img'];
                     $thumb=$upload['thumb'];
                }else{
                    $img = "";
                    $thumb="";
                }
            }
           $sql="INSERT INTO km_signup (`sign_title`,`sign_tel`,`sign_wxcode`,`sign_sncode`) VALUES( '$title','$tel','$img','$thumb')";
           $res=insert($sql);
           if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='signup_list.php';</script>";
           }else{
                echo "<script> alert('添加失败')</script>";
           }
        }

        //查询单个报名栏信息
        if( isset($_GET['edit']) && !empty($_GET['edit'])){
            $sql="SELECT * FROM km_signup WHERE sign_id = ".$_GET['edit'];
            $findsigup=find($sql);
        }

        //修改报名栏信息
        if( isset($_POST['edit']) && !empty($_POST['edit'])){
             $id = $_POST['sign_id'];
             $title = $_POST['sign_title'];
             $tel = $_POST['sign_tel'];
             //上传图片
            if(!empty($_FILES)){
                $upload = uplaods();
                if($upload['code']==1){
                     $sign_wxcode = $upload['img'];
                     $sign_sncode=$upload['thumb'];
                      //删除本地图片
                      $img = explode('/',$findsigup['sign_wxcode']);
                      $imgs='./'.$img[4].'/'.$img[5];
                      if(is_file( $imgs)){
                          unlink($imgs);
                      }
                      //删除本地图片
                      $sncode = explode('/',$findsigup['sign_sncode']);
                      $lsncodes='./'.$sncode[4].'/'.$sncode[5];
                      if(is_file( $lsncodes)){
                          unlink($lsncodes);
                      }
                }else{
                    $img = $findsigup['sign_wxcode'];
                    $thumb=$findsigup['sign_sncode'];
                }
            }


            $sql="UPDATE km_signup SET `sign_title` = '$title' ,`sign_tel` ='$tel' , `sign_wxcode` ='$sign_wxcode',`sign_sncode`= '$sign_sncode' WHERE `sign_id` = $id";
             $res=edit($sql);
             if($res['code']==1){
                 echo "<script> alert('修改成功');window.location.href='signup_list.php';</script>";
             }else{
                 echo "<script> alert('修改失败');window.location.href='signup_list.php';</script>";
             }

        }





    
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加报名方式</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="sign_id" value="<?php  if(isset($findsigup)){ echo $findsigup['sign_id'];}else{ echo ""; }?>" />

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if( isset($findsigup)){ echo '编辑报名方式'; }else{ echo "添加报名方式"; } ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="sign_title" value="<?php

                                            if(isset($findsigup)){ echo $findsigup['sign_title'];}else{ echo "";}


                                            ?>" class="form-control" > 
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">联系方式</span>
                                            <input type="text" name="sign_tel" value="<?php 
                                                    if(isset($findsigup)){
                                                        echo $findsigup['sign_tel'];
                                                    }
                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div> <h3><b>图一</b></h3></div>
                                    <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($findsigup)){
                                                         echo $findsigup['sign_wxcode'];
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
                                                        <input type="file" name="pic1[]" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                                </div>
                                            </div>

                                    </div>
                                      <div> <h3><b>图二</b></h3></div>
                                      <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($findsigup)){
                                                         echo $findsigup['sign_sncode'];
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
                                                        <input type="file" name="pic1[]" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                                </div>
                                            </div>

                                    </div>
                                   
                                   
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($findsigup)){
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