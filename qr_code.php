<!DOCTYPE html>
<html lang="ja">
<head>
<style type="text/css">
html, body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
html {
  display: table;
}
body {
  display: table-cell;
  text-align: center;
  vertical-align: middle;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="http://oecu-edu.sakura.ne.jp/php/refact/jquery.qrcode.min.js"></script> 
</head>
<body>
 <div id="qrcode"></div> 
<?php echo $_GET['link']; ?>
<?php
$ini_array =  parse_ini_file("config.ini");
$abs_path = $ini_array["AbsPath"];
?>
<script type="text/javascript">
$(document).ready(function(){
     $('#qrcode').qrcode({                     
         width:200,                               //QRコードの幅
         height:200,                              //QRコードの高さ 
         text:'<?php echo $abs_path  . "/". $_GET['link']; ?>'               //QRコードの内容
   });
});
</script>
</body>
</html>