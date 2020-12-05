<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="http://oecu-edu.sakura.ne.jp/php/Editor/jquery.qrcode.min.js"></script> 
</head>
<div id="qrcode"></div> 
<?php
$ini_array =  parse_ini_file("config.ini");
$abs_path = $ini_array["AbsPath"];
$qr_path = $ini_array["QRcodePath"];
$file_name = $_POST['name'];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");

echo '<div class="text-center"><p>実行結果 : ' . '<a href="'."$abs_path" . "/" . "$c_path" . "/" . "$file_name" . '"target = "_blank">別ページで実行</a> ： ' . '<a href="' . "$qr_path" . "$c_path" . "/" . "$file_name" . '"target = "_blank">QRコード生成</a></p></div><iframe id="run_res" style= "zoom:100%" width="98%" height="1200" src="' . $abs_path . "/" . $c_path . "/" . $file_name . '"></iframe>';

?>
<script type="text/javascript">
$(document).ready(function(){
     $('#qrcode').qrcode({                     
         width:100,                               //QRコードの幅
         height:100,                              //QRコードの高さ 
         text:<?php echo "$abs_path/$c_path/$file_name"; ?>               //QRコードの内容
   });
});
</script>