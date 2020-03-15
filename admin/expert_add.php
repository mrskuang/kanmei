    <?php 
        include 'header.php';
       

      
        //添加
        if(isset($_POST['sub']) && !empty($_POST['sub'])){


             $name = $_POST['expert_name'];
             $title = $_POST['expert_Title'];
             
             $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
            //上传图片
            if($_FILES['pic1']['error']==0){
                $upload = upload('pic1');
                if($upload['code']==1) {
                    $img = $upload['imgpath'];
                }else{
                    $img = "";
                }
            }


            $sql = "INSERT INTO km_expert (`expert_name`,`expert_Title`,`expert_desc`,`expert_img`) VALUES('$name','$title','$content','$img')";
           

            $res = insert($sql);
          
            if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='expert_list.php'</script>";
            }else{
                echo "<script> alert('添加失败');window.location.href='expert_list.php'</script>";
            }

        }

        //修改操作
        //查询单个数据
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $id= $_GET['edit'];
            $sql="SELECT  * FROM km_expert WHERE expert_id =".$id;
            $finddate = find($sql);

        }

        if(isset($_POST['edit']) && !empty($_POST['edit'])){
             $id = $_POST['expert_id'];
             $name = $_POST['expert_name'];
             $title = $_POST['expert_Title'];
             $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
            //上传图片
            if($_FILES['pic1']['error']==0){
                $upload = upload('pic1');
                if($upload['code']==1) {
                    $img = $upload['imgpath'];
                    //删除本地图片
                    $localimg = explode('/',$finddate['expert_img']);
                    $localimgs='./'.$localimg[4].'/'.$localimg[5];

                    if(is_file( $localimgs)){
                        unlink($localimgs);
                    }
                }else{
                    $img = $finddate['expert_img'];
                }
            }else{
                $img = $finddate['expert_img'];
            }

             $sql = "UPDATE km_expert SET `expert_name` = '$name' ,`expert_Title` ='$title' , `expert_desc` ='$content' ,`expert_img`= '$img'  WHERE `expert_id` = $id";
           
         
             $res = edit($sql);
            if($res['code']==1){
                echo "<script> alert('修改成功');window.location.href='expert_list.php';</script>";
            }else{
                echo "<script> alert('修改失败');window.location.href='expert_list.php';</script>";
            }



        }





      
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">专家管理 </li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="expert_id" value="<?php  if(isset($finddate)){ echo $finddate['expert_id'];}else{ echo ""; }?>" />

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if( isset($finddate)){ echo '编辑信息'; }else{ echo "添加信息"; } ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">姓名</span>
                                            <input type="text" name="expert_name" value="<?php 
                                                    if(isset($finddate)){
                                                        echo $finddate['expert_name'];
                                                    }
                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">职称描述</span>
                                            <input type="text" name="expert_Title" value="<?php 
                                                    if(isset($finddate)){
                                                        echo $finddate['expert_Title'];
                                                    }
                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($finddate)){
                                                         echo $finddate['expert_img'];
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
                                </div>
                                 <div class="form-group col-md-12">
                                        <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
                                               <?php if(isset($finddate)){echo $finddate['expert_desc'];} ?>
                                        </script>
                                    </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($finddate)){
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