<?php
$filename=$_POST['name'];
$lognum=$_POST['lognum'];
$c_path=$_POST['c_path'];
$cof = $_POST['cof'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
chdir("userfile/$c_path");
if($cof == 'true'){
	//error_log("[trash.php] filename:$filename", 3, "/var/www/html/php/saccess_PHP/x.log");
  unlink($filename);
}else{

}

?>
