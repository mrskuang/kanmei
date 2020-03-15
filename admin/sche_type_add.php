    <?php 
        include 'header.php';
        //添加操作
        if(isset($_POST['add'])){
            $name=$_POST['sche_type_name'];
            $sql="INSERT INTO km_sche_type (`sche_type_name`) VALUES('$name')";
            $res=insert($sql);
            if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='sche_type_list.php';</script>";
            }else{
                echo "<script> alert('添加失败')</script>";
            }


        }

        //修改操作
        if(isset($_GET['edit']) && !empty($_GET['edit'])){
            $id=$_GET['edit'];
            $sql="SELECT * FROM km_sche_type WHERE sche_type_id = $id";
            $findinfo=find($sql);

        }
        if(isset($_POST['edit'])){
            $id=$_POST['sche_type_id'];
            $name=$_POST['sche_type_name'];
           
            $sql="UPDATE km_sche_type SET `sche_type_name` = '$name' WHERE `sche_type_id` = $id";
            $res=edit($sql);
            if($res['code']==1){
                echo "<script> alert('修改成功');window.location.href='sche_type_list.php';</script>";
            }else{
                echo "<script> alert('修改失败')</script>";
            }
        }





    ?>
    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">赛程类型</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform">
                    <input type="hidden" name="sche_type_id" value="<?php  if(isset($findinfo)){ echo $findinfo['sche_type_id'];}else{ echo ""; }?>" />
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title"> <?php if(isset($findinfo)){ echo "修改信息";}else{echo "添加信息";} ?></div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="sche_type_list.php"
                                       class="btn btn-default btn-gradient dropdown-toggle" ><span
                                            class="glyphicon glyphicon-chevron-left" ></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                   
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">类型名称</span>
                                            <input type="text" name="sche_type_name" value="<?php 
                                                if(isset($findinfo)){
                                                    echo $findinfo['sche_type_name'];

                                                } 
                                            ?>" 
                                            class="form-control" required>
                                        </div>
                                    </div>
                                   
                              
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="<?php if(isset($findinfo)){ echo "edit";}else{
                                            echo "add";
                                        } ?>">
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

</body>

</html>