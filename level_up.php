<?php
$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/"); 
$c_path = rtrim("$c_path","/");
if($c_path != $_POST['classID']){
	$dh = opendir("$user_path/$c_path");
}else{
	$c_path = $c_path ."/" . $_POST['lognum'];
	$dh = opendir($user_path . "/" . $_POST['classID'] . "/" . $_POST['lognum']);
}

while(false !==($f_list[] = readdir($dh)));
closedir($dh);
sort($f_list);
$count=0;
foreach ($f_list as $file) {
	if (!preg_match("/^lib$/", $file) && !preg_match("/^\.+$/", $file) && !preg_match("/.txt$/", $file) && preg_match("/\..*$/", $file) && !preg_match("/.db$/", $file) && $file != "common.php" && $file != "error_check.js") {
		$file_list .= "<li class=$count onclick=set_filename(event) title=$file id=$file>$file</li>";
	}else if(!preg_match("/^lib$/", $file) && !preg_match("/^\.+$/", $file) && !preg_match("/.txt$/", $file) && preg_match("/.+/", $file) && !preg_match("/.db$/", $file) && !preg_match("/.db$/", $file) && $file != "common.php" && $file != "error_check.js"){
		$file_list .= "<li class=$count onclick=ch_dir(event) title=$file id=$file>$file/</li>";
	}else{
	}
	$count++;
}
if($c_path !=  $_POST['classID']."/".$_POST['lognum']){
	$file_list .= "<li class=back onclick=level_up(event) id=$c_path>上の階層へ</li>";
}
echo $file_list;

?>
