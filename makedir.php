<?php
$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$dirname=$_POST['dirname'];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
chdir("$user_path/$c_path");
if($dirname != ""){
  if(!preg_match_all("/[^a-zA-Z0-9_]/", $dirname)){
    mkdir("./" . $dirname, 0777);
    //echo $dirname . "ディレクトリを作成しました。";
    echo "";
  }else{
    echo "ディレクトリ名は英数字と＿（アンダースコア）のみ使用できます。";
  }
}else{
  echo "";
}
?>
