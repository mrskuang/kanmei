
<?php

   include './include/function.php';
   $conn = db_conn();
   
   $sql = "SELECT * FROM km_region WHERE `level` = 1 Limit 0,6";
   $data= select_all($sql);

   
   function select($data){
      for($i=0;$i<count($data);$i++){
        $sql = "SELECT `id`,`name` FROM km_region WHERE `pid` =".$data[$i]['id']." Limit 0,6";
        $data[$i]['children']= select_all($sql);
        if(count($data[$i]['children'])>0){
           $data[$i]['children'] = select($data[$i]['children']);
        }
      }
      return $data;
   }
   
   
   $soure= select($data);
  

?>

<head>
  <meta charset="utf-8" />
  <title>下拉菜单</title>
</head>
<style type="text/css">
  ul li {
    list-style: none;
    width: 150px;
    cursor: pointer;

  }
  li ul{
    display: none;
  }
  .plus{
    list-style-image: url(img/plus.gif);
  }
  .minus{
    list-style-image: url(img/minus.gif);
  }
</style>

<body>
  <ul style="display: flex;">
  
    <?php foreach($soure as $val){?>
        <li onclick="cc(<?php echo $val['id'] ?>)">
          
          <?php echo $val['name'] ?>

          <ul>
            <?php foreach($val['children'] as $v){ ?>
             <li onclick="cc(<?php echo $v['id'] ?>)">
             <?php echo $v['name']; ?>
               <ul>
                 <?php foreach($v['children'] as $c){ ?>
                  <li onclick="cc(<?php echo $c['id'] ?>)">
                    <?php  echo $c['name']?>
                  </li>
                 <?php } ?>

               </ul>
             </li>
            <?php } ?>

          </ul>
        </li>

    <?php }?>
  </ul>
  <div style="height: 100px;">
    nihao 
  </div>
  
 
  <script src="./static/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">
    var a = '';
    $(function(){
      //给有子菜单的li添加一个图标
      $("li").has("ul").addClass("plus")
      .click(function(e){
       
        e.stopPropagation();
        if($(e.target).children().length){
          $(this).children().slideToggle(800);
          $(this).toggleClass("minus");
         
        }else{
           a = '1';
        }
       
      })
    });
    
  </script>
  <script type="text/javascript">
    function cc(index){
      
      
        
        
    }
  </script>

</body>
