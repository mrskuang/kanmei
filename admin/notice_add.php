    <?php 
        include 'header.php';
        if(isset($_POST['sub']) && !empty($_POST['sub'])){

            $name = trim($_POST['nic_name']);
            $storename = trim($_POST['nic_store_name']);
            $time = time();

            $sql = "INSERT  INTO km_notice (`nic_name`,`nic_store_name`,`nic_time`) VALUES ('$name','$storename','$time')";
          
            $res = insert($sql);
            if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='notice_list.php';</script>";
           }else{
                echo "<script> alert('添加失败')</script>";
           }



        }

        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $sql = "SELECT * FROM km_notice WHERE nic_id =".$_GET['edit'];
            $noticeinfo = find($sql);
        }

        if(isset($_POST['edit']) && !empty($_POST['edit'])){
              $id = $_POST['nic_id'];
              $name = trim($_POST['nic_name']);
              $storename = trim($_POST['nic_store_name']);
              $time = time();

              $sql = "UPDATE km_notice SET `nic_name` = '$name',`nic_store_name` = '$storename',`nic_time` = '$time' WHERE `nic_id` = $id";
              $res = edit($sql);
              if($res['code']==1){
                 echo "<script> alert('修改成功');window.location.href='notice_list.php';</script>";
             }else{
                 echo "<script> alert('修改失败');window.location.href='notice_list.php';</script>";
             }

        }

        
    ?>
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">公告栏管理</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                    <input type="hidden" name="nic_id" value="<?php  if(isset($noticeinfo)){ echo $noticeinfo['nic_id'];}else{ echo ""; }?>" />

                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if( isset($noticeinfo)){ echo '编辑公告'; }else{ echo "添加公告"; } ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">店主名称</span>
                                            <input type="text" name="nic_name" value="<?php 
                                                    if(isset($noticeinfo)){
                                                        echo $noticeinfo['nic_name'];
                                                    }
                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">门店名称</span>
                                            <input type="text" name="nic_store_name" value="<?php 
                                                    if(isset($noticeinfo)){
                                                        echo $noticeinfo['nic_store_name'];
                                                    }
                                            ?>" class="form-control" >
                                        </div>
                                    </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($noticeinfo)){
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