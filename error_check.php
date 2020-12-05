<?php
$ini_array =  parse_ini_file("config.ini");
$err_cgi_path = $ini_array["ErrorcgiPath"];
$user_path = $ini_array["UserPath"];
$c_path = $_POST['c_path'];
$c_path = ltrim("$c_path","/");
$c_path = rtrim("$c_path","/");
$filename = $_POST['name']; 

    $url = "$err_cgi_path/$c_path/$filename";
    //$errstr = file_get_contents($url);
    if(preg_match(".php$")){
    	$errstr = exec("php -l $user_path/$c_path/$filename");
    }else{
    	$errstr = "No syntax errors";
    }
    error_log("error_log:".$errstr);
//var_dump($errstr);
    if (strpos($errstr, 'No syntax errors') == "false") {   
       $errmsg = '<div class="alert alert-success">エラーはありませんでした。</div>';
    } else {
      $errmsg = '<div style="border:1px solid;"><div class="alert alert-danger">エラーがありました。</div><br>'.$errstr;
      if (strpos($errstr, 'unexpected $end') || strpos($errstr, 'unexpected end')) {
        $errmsg .= '<b>文字列「"..."」や中括弧「{...}」の対応や抜けを調べてみてください。</b>';
      } else if (strpos($errstr, 'unexpected \'}\'')) {
        $errmsg .= '<b>中括弧「{...}」の対応を調べてみてください。</b>';
      } else if (strpos($errstr, 'line ')) {
        $error_line = substr($errstr, strpos($errstr, 'line ')+strlen('line '));
        $error_line = split(" ",$error_line);
        $line = str_replace('Errors',' ',$error_line[0]);
        $errmsg .= "<b>$line" . '行目の内容や、前の行末の「;」の抜けなどを調べてみてください。</b>';
      }   
      $errmsg .= '</div>';
    }
    echo $errmsg;
?>
