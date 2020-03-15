<?php 
      include 'header.php';

        //删除数据
        if(isset($_GET['del'])){

          $id=$_GET['del'];
          $sql="DELETE FROM km_news WHERE `news_id` = $id";
          $res=del($sql);
          if($res['code']==1){
              echo "<script> alert('删除成功');window.location.href='news_list.php';</script>";
          }else{
              echo "<script> alert('删除失败')</script>";
          }


        }else{
          if(isset($_GET['type']) && !empty($_GET['type'])){
            //获取页码
            if(!empty($_GET['page_id']) && isset($_GET['page_id'])){
                 $page = $_GET['page_id'];
            }else{
                 $page = '1';
            }
            $where="   INNER JOIN km_news_type ON km_news.news_type = km_news_type.news_type_id AND km_news_type.news_type_id=".$_GET['type']; 
              $a="type=".$_GET['type']."&page_id";
              $newsinfo=pages('km_news',$page,$where,$a);

          }



        
            
        }




?>
  <!-- End: Sidebar -->   

  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">新闻管理</li>
      </ol>
    </div>
    <div class="container">
	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">
                    
                      <?php 

                            $sql="SELECT * FROM km_news_type WHERE news_type_id = ".$_GET['type'];

                            $findtype =find($sql);
                            if($findtype != null){
                              echo $findtype['news_type_name'];
                            }
                          
                            
                    ?>


                  </div>
                  <a href="news_add.php?type=<?php echo $_GET['type']; ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加新闻</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title"><?php echo $findtype['news_type_name'];?></h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>编号</th>
                        <th>新闻标题</th>
                        <th>发布时间</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php if($newsinfo['data'] != null){ foreach($newsinfo['data'] as $v){ ?>
                    	<tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td><?php echo $v['news_id'] ?></td>
                        <td><?php echo $v['news_title'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$v['news_time'])  ?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="news_add.php?edit_id=<?php echo $v['news_id'] ?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="news_list.php?del=<?php echo $v['news_id'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>

                    <?php } }?>
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
                  </div>
                  
                  <?php echo $newsinfo['page'] ;?>
                  
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