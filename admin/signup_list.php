 <?php
    include 'header.php';
    //查询轮播图信息
    $sql='SELECT * FROM km_signup';
    $sigupinfo=select($sql);
    if(isset($_GET['del']) && !empty($_GET['del'])){
        $id=$_GET['del'];

        $sql="SELECT * FROM km_signup WHERE `sign_id` = $id";
        $findban=find($sql);

        //删除banner
        $sqls="DELETE  FROM km_signup WHERE `sign_id` =$id";

        $res=del($sqls);
        if($res['code']==1){
          //删除本地图片
          $localimg = explode('/',$findban['sign_wxcode']);
          $localimgs='./'.$localimg[4].'/'.$localimg[5];
          if(is_file( $localimgs)){
              unlink($localimgs);
          }

          //删除本地缩略图
           $localthumb = explode('/',$findban['sign_sncode']);
           if(!empty($localthumb)){
              $localthumbs='./'.$localthumb[4].'/'.$localthumb[5];
              if(is_file( $localthumbs)){
                unlink($localthumbs);
              }
           }

          echo "<script> alert('删除成功');window.location.href='signup_list.php';</script>";

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
        <li class="active">报名方式管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">报名方式列表</div>
                  <a href="signup_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加方式</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title">报名方式</h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>标题</th>
                        <th>联系方式</th>
                        <th>图片1</th>
                        <th>图片2</th>
                        <th width="200">操作</th>
                      </tr>
                    
                      <?php foreach($sigupinfo as $v){ ?>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['sign_title'] ?></td>
                        <td><?php echo $v['sign_tel'] ?></td>
                        <td><img src="<?php 
                          echo  "./include/thumb.php?imgs=".$v['sign_wxcode'];?>" /></td>
                        </td>
                          <td><img src="<?php 
                          echo   "./include/thumb.php?imgs=".$v['sign_sncode'];?>" /></td>
                        </td>
                        <td>
                          <div class="btn-group">
                            <a href="signup_add.php?edit=<?php  echo $v['sign_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="signup_list.php?del=<?php echo $v['sign_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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