    <?php 
        include 'header.php';
       

        if(isset($_GET['type']) && !empty($_GET['type'])){
            $type = $_GET['type'];
        }
        //查看图锦类型
        $marverinfo = select_all("SELECT * FROM km_marvellous_type");
        if(isset($_POST['sub'])){
             $type = $_POST['thumb'];
            //上传图片
            if(!empty($_FILES)){
                $upload = upload('pic1');
                if($upload['code']==1){
                     $imgpath = $upload['imgpath'];
                  }else{
                    $imgpath ="";
                  }
            }else{
                $imgpath = "";
            }

           $sql="INSERT INTO km_marvellous (`Marvellous_thumb`,`Marvellous_type_id`) VALUES( '$imgpath',$type)";
           $res=insert($sql);
           if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='activity_type_list.php?type=".$type."';</script>";
           }else{
                echo "<script> alert('添加失败');window.location.href='activity_type_list.php?type=".$type."';</script>";
           }
        }


        //修改操作
        if(isset($_GET['edit'])&& !empty($_GET['edit'])){

                $sql="SELECT * FROM km_marvellous WHERE Marvellous_id=".$_GET['edit'];
                $findinfo=find($sql);
        }

        if(isset($_POST['edit']) && !empty($_POST['edit'])){

                $id=trim($_POST['Marvellous_id']);
                $type = $_POST['thumb'];

                //验证数据

               //上传图片
                if($_FILES['pic1']['error']==0){
                    $upload = upload('pic1');
                    if($upload['code']==1){
                           $imgpath = $upload['imgpath'];
                
                            //删除本地图片
                            $localimg = explode('/',$findinfo['Marvellous_thumb']);
                            $localimgs='./'.$localimg[4].'/'.$localimg[5];
                            if(is_file( $localimgs)){
                                unlink($localimgs);
                            }

                     }
                 }else{
                    $imgpath = $findinfo['Marvellous_thumb'];
                 }      
                 
            
             $sql="  UPDATE km_marvellous SET `Marvellous_thumb` = '$imgpath' ,`Marvellous_type_id` = $type WHERE `Marvellous_id` = $id";
             $res=edit($sql);
             if($res['code']==1){
                 echo "<script> alert('修改成功');window.location.href='activity_type_list.php';</script>";
             }else{
                 echo "<script> alert('修改失败');window.location.href='activity_type_list.php';</script>";
             }
       }
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加精彩图锦</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="Marvellous_id" value="<?php  if(isset($findinfo)){ echo $findinfo['Marvellous_id'];}else{ echo ""; }?>" />

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if( isset($findinfo)){ echo '编辑'; }else{ echo "添加图片"; } ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 150px;" src="<?php 
                                                        if(isset($findinfo)){
                                                         echo $findinfo['Marvellous_thumb'];
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
                                                   if(isset($findinfo)){$type= $findinfo['Marvellous_type_id'];}else{$type=$_GET['type'];}
                                                foreach($marverinfo as $v){  ?>
                                                <option value="<?php echo $v['Marvellous_type_id'] ?>" <?php if($type == $v['Marvellous_type_id']){echo "selected=true"; } ?>>
                                                    <?php  echo $v['Marvellous_type_name']?>
                                                </option>

                                                 <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                   
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($findinfo)){
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