 <?php
    include 'header.php';

    //获取页码
      if(!empty($_GET['page_id']) && isset($_GET['page_id'])){
           $page = $_GET['page_id'];
      }else{
           $page = '1';
      }
      $data = pages('km_store_works',$page,' as a INNER JOIN km_storeinfo as b  ON  a.store_storeuser_id=b.store_id ');
      
      $storeworks=$data['data'];
    
      $page=$data['page'];

    if(isset($_GET['del']) && !empty($_GET['del'])){
        $id=$_GET['del'];

        $sql="SELECT * FROM km_store_works WHERE `store_works_id` = $id";
        $findban=find($sql);

        //删除banner
        $sqls="DELETE  FROM km_store_works WHERE `store_works_id` =$id";

        $res=del($sqls);
        if($res['code']==1){
          //删除本地图片
          $localimg = explode('/',$findban['store_works_desc']);
          $localimgs='./'.$localimg[4].'/'.$localimg[5];
          if(is_file( $localimgs)){
              unlink($localimgs);
          }
         
          echo "<script> alert('删除成功');window.location.href='store_works_list.php';</script>";

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
        <li class="active">门店作品</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">门店作品</div>
                    <a href="stroe_works_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">门店作品</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>图片</th>
                        <th>门店名称</th>
                        <th>门店地址</th>
                        <th>经营者</th>
                        <th>点赞数</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php  if($storeworks != null){ foreach($storeworks as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                          <td ><img src="<?php echo   "./include/thumb.php?imgs=".$v['store_works_img']; ?>"/></td>
                          <td><?php  echo $v['store_name'] ?></td>
                          <td><?php  echo $v['store_adder'] ?></td>
                          <td><?php  echo $v['store_contacts'] ?></td>
                          <td><?php  echo $v['store_works_Number'] ?></td>
                         
                          <td>
                          <div class="btn-group">
                            <a href="stroe_works_add.php?edit=<?php  echo $v['store_works_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="store_works_list.php?del=<?php echo $v['store_works_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        </td>
                      </tr>

                    <?php } }?>

                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>

                    <?php echo $page;?>
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