 <?php
    include 'header.php';
   

    if(isset($_GET['type']) && !empty($_GET['type'])){

       //获取页码
      if(!empty($_GET['page_id']) && isset($_GET['page_id'])){
           $page = $_GET['page_id'];
      }else{
           $page = '1';
      }
      $condition=" WHERE sche_type = ".$_GET['type'];

      $data = pages('km_Schedule',$page,$condition,'');
      if($data != null){
         $Schedule = $data['data'];
         $page = $data['page'];
      }
    }

    if(isset($_GET['del']) && !empty($_GET['del'])){

        $id = $_GET['del'];
        $sql="SELECT * FROM km_Schedule WHERE `sche_id` = $id";
        $findsche=find($sql);

        //删除banner
        $sqls="DELETE  FROM km_Schedule WHERE `sche_id` =$id";

        $res=del($sqls);
        if($res['code']==1){
          //删除本地图片
          $localimg = explode('/',$findsche['sche_img']);
          $localimgs='./'.$localimg[4].'/'.$localimg[5];
          if(is_file( $localimgs)){
              unlink($localimgs);
          }
          echo "<script> alert('删除成功');window.location.href='Schedule_list.php?type=1';</script>";

        }else{
          echo "<script> alert('删除失败')</script>";

        }



    }






  ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">赛程管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">
                    <?php 

                            $sql="SELECT * FROM km_sche_type WHERE sche_type_id = ".$_GET['type'];

                            $findtype =find($sql);
                            if($findtype != null){
                              echo $findtype['sche_type_name'];
                            }
                          
                            
                    ?>
                  
                  </div>
                  <a href="Schedule_add.php?type=<?php echo $_GET['type'];  ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title"><?php  echo $findtype['sche_type_name']; ?>列表</h2>

                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>标题</th>
                       
                        <th>图片</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php if(isset($Schedule)){foreach($Schedule as $v){ ?>
                      <tr class="success">
                      <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                      <td><?php echo $v['sche_title'] ?></td>
                      
                      <td><img src="<?php echo   "./include/thumb.php?imgs=".$v['sche_img']; ?>" /></td>
                      <td>
                        <div class="btn-group">
                          <a href="Schedule_add.php?edit=<?php  echo $v['sche_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                          <a onclick="return confirm('确定要删除吗？');" href="Schedule_list.php?del=<?php echo $v['sche_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                        </div>
                      </td>
                      </tr>

                    <?php } }?>

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