<?php

   //清除cookie
	foreach($_COOKIE as $key=>$value){
			setCookie($key,"",time()-1,'/');
	}
	echo "<script> alert('注销用户');window.location.href='index.php'</script>";

?>