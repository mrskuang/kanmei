 <?php
    include 'header.php';
   


    if(isset($_GET['del']) && !empty($_GET['del'])){
        $id=$_GET['del'];
        //删除公告
        $sqls="DELETE  FROM km_notice WHERE `nic_id` =$id";
        $res=del($sqls);
        if($res['code']==1){
          echo "<script> alert('删除成功');window.location.href='notice_list.php';</script>";

        }else{
          echo "<script> alert('删除失败')</script>";

        }
    }else{
       //查询公告信息
       $sql='SELECT * FROM km_notice';
       $noticeinfo=select($sql);

    }






  ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">公告栏管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">公告栏列表</div>
                  <a href="notice_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加公告</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">公告</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>店主</th>
                        <th>门店名称</th>
                        <th>添加时间</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php foreach($noticeinfo as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['nic_name'] ?></td>
                        <td><?php echo $v['nic_store_name'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$v['nic_time'])?></td>
                        <td>
                        <div class="btn-group">
                          <a href="notice_add.php?edit=<?php  echo $v['nic_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                          <a onclick="return confirm('确定要删除吗？');" href="notice_list.php?del=<?php echo $v['nic_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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