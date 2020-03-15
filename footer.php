<?php





//查询网站配置信息
$sql = "SELECT * FROM km_conf Limit 1";
$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_assoc($result);




include'./view/footer.html';

?>