<html> <head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="10">
<title>PHP Status</title>
</head> <body>

<?php
//$basedir="http://php.eplang.jp/PHP_Editor/";
$basedir="http://oecu-edu.sakura.ne.jp/php/refact/userfile/250881/";
$okfile="ok.txt";
$errfile="error.txt";
$fp = fopen($okfile, "r");
for ($i = 0; $ok[$i] = fgets($fp,2048); $i++){ }
fclose($fp);
$fp = fopen($errfile, "r");
for ($i = 0; $err[$i] = fgets($fp,2048); $i++){ }
fclose($fp);
$okcnt=count($ok)-1;
$errcnt=count($err)-1;
$fname = $ok[mt_rand(0, $okcnt-1)];
$url = $basedir . $fname;
?>

<h1><?php echo $fname . "（成功: " . $okcnt . "人、エラー: " . $errcnt . "人）"; ?></h1> <hr>
<IFRAME src="<?php echo $url; ?>" target="_blank" name="sample" frameborder="0" width="100%" height="90%"></IFRAME>
<iframe width=800 height=90 src="http://oecu-edu.sakura.ne.jp/php/refact/getStatus_proto.cgi"></iframe>
</body> </html>
