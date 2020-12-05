<?php
require "caesar.php";
header("Content-type: text/plain; charset=UTF-8");
$filename = $_POST['name'];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
chdir("userfile/".$c_path);
//Json形式のデータを配列に入れ連結
$source = json_decode($_POST['request'],true);

$text="";
//Asciiコード変換
for($i = 0;$i <= count($source);$i++){
  $text.=preg_replace_callback('/\\\\u([0-9a-f]{4})/i', function($matched){
    return mb_convert_encoding(pack('H*', $matched[1]), 'UTF-8', 'UTF-16');
  }, $source[$i]);
}
if(file_exists($filename)){
if ($filename != ""){
  if(preg_match_all("/^[a-zA-Z0-9_\.]+$/", $filename)){
    //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）
     //保存ボタンが押されたとき
      if (preg_match("/.php$/", "$filename") || preg_match("/.js$/", "$filename") || preg_match("/.html$/", "$filename") || preg_match("/.css$/", "$filename")) {
         $fp = fopen($filename, "w");
         flock($fp, LOCK_EX);
         fwrite($fp, "$text");
         flock($fp, LOCK_UN);
         fclose($fp); 
       	 //echo $filename . "を保存しました";
         echo "succeed";
      }else{
        echo "ファイル拡張子が不正です。";
      }
  }else if(preg_match("/新規ファイル/", "$filename")){
    echo "cancel";
  }else{
    echo "ファイル名に使用できない文字が含まれています。";
  }
}else{
    echo '';
}
}
echo '';

?>