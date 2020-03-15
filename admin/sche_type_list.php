 <?php
    include 'header.php';
    //查询大赛类型
    $sql='SELECT * FROM km_sche_type';
    $info=select($sql);
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $id=$_GET['del'];
        $sql="SELECT * FROM km_Schedule WHERE `sche_type` = $id";
        $data=select_all($sql);
        if($data != null){
            echo "<script> alert('该类型下存在数据，不可删除');window.location.href='sche_type_list.php';</script>";
        }else{
          $sqls="DELETE  FROM km_sche_type WHERE `sche_type_id` =$id";
          $res=del($sqls);
          if($res['code']==1){
              echo "<script> alert('删除成功');window.location.href='sche_type_list.php';</script>";
          }else{
               echo "<script> alert('删除失败')</script>";
 
          }

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
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">赛程类型</div>
                  <a href="sche_type_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加类型</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">大赛类型</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>名称</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php foreach($info as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['sche_type_name'] ?></td>
                        <td>
                          <div class="btn-group">
                            <a href="sche_type_add.php?edit=<?php  echo $v['sche_type_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="sche_type_list.php?del=<?php echo $v['sche_type_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        </td>
                      </tr>

                    <?php } ?>

                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>