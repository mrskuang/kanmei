    <?php 
        include 'header.php';
        if(isset($_GET['type']) && $_GET['type']){
            $sql="SELECT  * FROM km_sche_type WHERE sche_type_id =".$_GET['type'];
            $findtype = find($sql);

        }

        //查询类型

        $sql = "SELECT * FROM km_sche_type";
        $scheinfo=select_all($sql);
        //添加
        if(isset($_POST['sub']) && !empty($_POST['sub'])){

             $title = $_POST['sche_title'];
             $type = $_POST['thumb'];
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


            $sql = "INSERT INTO km_Schedule (`sche_title`,`sche_content`,`sche_img`,`sche_type`) VALUES('$title','$content','$img',$type)";
            $res = insert($sql);
            if($res['code']){
                echo "<script> alert('添加成功');window.location.href='Schedule_list.php?type=".$type."';</script>";
            }else{
                echo "<script> alert('添加失败');window.location.href='Schedule_list.php?type=".$type."';</script>";
            }

        }

        //修改操作
        //查询单个数据
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $id= $_GET['edit'];
            $sql="SELECT  * FROM km_Schedule WHERE sche_id =".$id;
            $finddate = find($sql);

        }

        if(isset($_POST['edit']) && !empty($_POST['edit'])){
             $id = $_POST['sche_id'];
            
             $title = $_POST['sche_title'];
             $type = $_POST['thumb'];
             $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
            //上传图片
            if($_FILES['pic1']['error']==0){
                $upload = upload('pic1');
                if($upload['code']==1) {
                    $img = $upload['imgpath'];
                    //删除本地图片
                    $localimg = explode('/',$finddate['sche_img']);
                    $localimgs='./'.$localimg[4].'/'.$localimg[5];

                    if(is_file( $localimgs)){
                        unlink($localimgs);
                    }
                }else{
                    $img = $finddate['sche_img'];
                }
            }else{
                $img = $finddate['sche_img'];
            }

             $sql = "UPDATE km_Schedule SET `sche_title` = '$title' ,`sche_content` ='$content' , `sche_img` ='$img' ,`sche_type`= $type  WHERE `sche_id` = $id";
         
             $res = edit($sql);
            if($res['code']){
                echo "<script> alert('修改成功');window.location.href='Schedule_list.php?type=".$type."';</script>";
            }else{
                echo "<script> alert('修改失败');window.location.href='Schedule_list.php?type=".$type."';</script>";
            }



        }





      
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">赛程管理 > <?php echo $findtype['sche_type_name'] ?></li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="sche_id" value="<?php  if(isset($finddate)){ echo $finddate['sche_id'];}else{ echo ""; }?>" />

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
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="sche_title" value="<?php 


                                                    if(isset($finddate)){
                                                        echo $finddate['sche_title'];
                                                    }





                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($finddate)){
                                                         echo $finddate['sche_img'];
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
                                                <?php 
                                                   if(isset($finddate)){$type= $finddate['sche_type'];}else{$type=$_GET['type'];}
                                                foreach($scheinfo as $v){  ?>
                                                <option value="<?php echo $v['sche_type_id'] ?>" <?php if($type == $v['sche_type_id']){echo "selected=true"; } ?>>
                                                    <?php  echo $v['sche_type_name']?>
                                                </option>

                                                 <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group col-md-12">
                                        <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
                                               <?php if(isset($finddate)){echo $finddate['sche_content'];} ?>
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