<?php
setcookie('adminadmin', true, time() + 24*3600, '/', null, false, true);
if(isset($_SERVER['HTTP_REFERER'])){
	header('Location:'.$_SERVER['HTTP_REFERER']);
}else{
	header('Location: ../index.php');
}
?>