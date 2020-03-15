 <?php
    include 'header.php';
    //查询轮播图信息
    if(isset($_GET['type']) && !empty($_GET['type'])){
         $sql='SELECT * FROM km_marvellous WHERE Marvellous_type_id = '.$_GET['type'];
         $marinfo=select($sql);


    }
 
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $id=$_GET['del'];
        $sql="SELECT * FROM km_marvellous_type WHERE `Marvellous_type_id` = $id";
        $findinfo=find($sql);
        //删除banner
        $sqls="DELETE  FROM km_marvellous_type WHERE `Marvellous_type_id` =$id";

        $res=del($sqls);
        if($res['code']==1){
          //删除本地图片
          $localimg = explode('/',$findinfo['Marvellous_type_img']);
          $localimgs='./'.$localimg[4].'/'.$localimg[5];
          if(is_file( $localimgs)){
              unlink($localimgs);
          }

          echo "<script> alert('删除成功');window.location.href='activity_list.php';</script>";

        }else{
          echo "<script> alert('删除失败');window.location.href='activity_list.php';</script>";

        }


    }






  ?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">精彩图锦</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">精彩图锦列表</div>
                  <a href="activity_type_add.php?type=<?php echo $_GET['type'];  ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">精彩图锦</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>图片</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php  if($marinfo != null){ foreach($marinfo as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                      
                        <td><img src="<?php 
                          echo   "./include/thumb.php?imgs=".$v['Marvellous_thumb']; ?>" /></td>
                        <td>
                          <div class="btn-group">
                            <a href="activity_type_add.php?edit=<?php  echo $v['Marvellous_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="activity_list.php?del=<?php echo $v['Marvellous_type_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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