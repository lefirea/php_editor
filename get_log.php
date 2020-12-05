<?php
$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$c_path = $_POST['c_path'];
$err = $_POST['err'];
$fname = $_POST['fname'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
$class = explode("/", $c_path, 2);
$errstr = $_POST['errstr'];
$source = json_decode($_POST['request'],true);

$text="";
//Asciiコード変換
for($i = 0;$i <= count($source);$i++){
  $text.=preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function($matched){
    return mb_convert_encoding(pack('H*', $matched[1]), 'UTF-8', 'UTF-16');
  }, $source[$i]);
}
if($class[0] == demoCourse){
  chdir("$user_path/demoCourse");
  // == ログに書き込む処理 ======================================================= /
  $log = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname . "\t" .$err . "\t" . "# " . $errstr . "\t" . $text . "\n";
  $fp = fopen("src_log.txt", "a");
  flock($fp, LOCK_EX);
  fwrite($fp, $log);
  flock($fp, LOCK_UN);
  fclose($fp);
  // == ログに書き込む処理 ======================================================= /
  $log2 = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname . "\t" .$err . "\t" . "# " . $errstr . "\n";
  $fp2 = fopen("log.txt", "a");
  flock($fp2, LOCK_EX);
  fwrite($fp2, $log2);
  flock($fp2, LOCK_UN);
  fclose($fp2);

}else{
  chdir("$user_path/$c_path");
  $c_path = str_replace("/","\t",$c_path);
  // == ログに書き込む処理 ======================================================= /
  $log = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname . "\t" .$err . "\t" . "# " . $errstr . "\t" . $text . "\n";
  $fp = fopen("src_log.txt", "a");
  flock($fp, LOCK_EX);
  fwrite($fp, $log);
  flock($fp, LOCK_UN);
  fclose($fp);
  // == ログに書き込む処理 ======================================================= /
  $log2 = date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $c_path . "\t" . $fname . "\t" .$err . "\t" . "# " . $errstr . "\n";
  $fp2 = fopen("log.txt", "a");
  flock($fp2, LOCK_EX);
  fwrite($fp2, $log2);
  flock($fp2, LOCK_UN);
  fclose($fp2);
}
?>