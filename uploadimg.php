<?php
  
  include './include/function.php';
  if($_FILES[$name]['error']==0){
  	 $upload = upload('pictureFile');
	if($upload['code']==1) {
		 echo  json_encode($upload['imgpath']);
	}else{
		 echo "";
	}
  		
  }
?>