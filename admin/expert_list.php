 <?php
    include 'header.php';
   

    

       //获取页码
      if(!empty($_GET['page_id']) && isset($_GET['page_id'])){
           $page = $_GET['page_id'];
      }else{
           $page = '1';
      }
     
      $data = pages('km_expert',$page,'');

      if($data != null){
         $Schedule = $data['data'];
         $pages = $data['page'];
      }
    

    if(isset($_GET['del']) && !empty($_GET['del'])){

        $id = $_GET['del'];
        $sql="SELECT * FROM km_expert WHERE `expert_id` = $id";
        $findsche=find($sql);

        //删除banner
        $sqls="DELETE  FROM km_expert WHERE `expert_id` =$id";

        $res=del($sqls);
        if($res['code']==1){
          //删除本地图片
          $localimg = explode('/',$findsche['expert_img']);
          $localimgs='./'.$localimg[4].'/'.$localimg[5];
          if(is_file( $localimgs)){
              unlink($localimgs);
          }
          echo "<script> alert('删除成功');window.location.href='expert_list.php';</script>";

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
        <li class="active">专家管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">
                   
                  
                  </div>
                  <a href="expert_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">专家列表</h2>

                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>名字</th>
                        <th>职称描述</th>
                        <th>头像</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php if(isset($Schedule)){foreach($Schedule as $v){ ?>
                      <tr class="success">
                      <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                      <td><?php echo $v['expert_name'] ?></td>
                      <td><?php echo $v['expert_Title'] ?></td>
                      
                      <td><img src="<?php echo   "./include/thumb.php?imgs=".$v['expert_img']; ?>" /></td>
                      <td>
                        <div class="btn-group">
                          <a href="expert_add.php?edit=<?php  echo $v['expert_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                          <a onclick="return confirm('确定要删除吗？');" href="expert_list.php?del=<?php echo $v['expert_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                        </div>
                      </td>
                      </tr>

                    <?php } }?>

                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                      <?php echo $pages ;?>
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