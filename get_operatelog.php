<?php
$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$c_path = $_POST['c_path'];
$operate = $_POST['operate'];
$fname = $_POST['fname'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
$class = explode("/", $c_path, 2);

if($class[0] == "demoCourse"){
  chdir("$user_path/demoCourse");
  $c_path = str_replace("/","\t",$c_path);
  // == ログに書き込む処理 ======================================================= /
  $log = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname  . "\t" . $operate . "\n";
  $fp = fopen("operate_log.txt", "a");
  flock($fp, LOCK_EX);
  fwrite($fp, $log);
  flock($fp, LOCK_UN);
  fclose($fp);
}else{
  chdir("$user_path/$c_path");
  $c_path = str_replace("/","\t",$c_path);
  // == ログに書き込む処理 ======================================================= /
  $log = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname  . "\t" . $operate . "\n";
  $fp = fopen("operate_log.txt", "a");
  flock($fp, LOCK_EX);
  fwrite($fp, $log);
  flock($fp, LOCK_UN);
  fclose($fp);
}
?>