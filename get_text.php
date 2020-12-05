<?php
$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$file_select = $_POST['name'];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");

chdir("$user_path/$c_path");
$fp = fopen($file_select, "r");
	flock($fp, LOCK_SH);
	$string = fread($fp, filesize($file_select));
	flock($fp, LOCK_UN);
	fclose($fp);
	closedir($dh);
echo $string;
?>