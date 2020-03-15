<?php
	
	$conn = mysqli_connect('localhost','kanmei','123456','kangmei');
	 if(isset($_POST['pcode']) && !empty($_POST['pcode'])){
	 	  $pid =$_POST['pcode'];
	      $sqls = "SELECT * FROM km_region WHERE `pid` = {$pid} ";
	       $city =  mysqli_query($conn,$sqls);
	       while ($ress=mysqli_fetch_assoc($city)){
	           $cityinfo[] = $ress;
	       }
	       echo json_encode($cityinfo);
   } 

?>