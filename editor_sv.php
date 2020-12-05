<?php
session_start();
require_once("caesar.php");
include('Guest_Patrol.php');

$ini_array =  parse_ini_file("config.ini");
$user_path = $ini_array["UserPath"];
$sys_path = $ini_array["SystemPath"];
$SQL_path = $ini_array["SQLPath"];
$Guest_Path = $ini_array["GuestPath"];


$jquery_path = 'lib/jquery.min.js';
$saccessPath = 'http://klab.eplang.jp/saccess'; // sAccess URL

// 必要ライブラリ
$class_authRequest_path = "lib/class_authRequest.php";	// 認証サーバアクセス用クラス
$class_dbServerRequest_path = "lib/class_dbServerRequest.php";	// sAccess SSOアクセス用クラス
// サーバアドレス設定 (URL or 相対パス, 管理者より連絡のあったものを設定)
$authServerPath = 'https://saccess2.eplang.jp/saccess/userManage/manage.php';	// 認証サーバURL
$dbServerPath = 'https://saccess2.eplang.jp/saccess/api.php';	// sAccess API URL

// 初期設定
require_once($class_authRequest_path);
require_once($class_dbServerRequest_path);
$auth = new AuthRequest($authServerPath);
$saccess = new DBServerRequest($dbServerPath);

function print_queryResultHTML($queryResult){
  if(!is_array($queryResult)){ echo 'no Result'; return(false);}
  $keylist = array_keys($queryResult[0]);
}

/* main */

$id='';
$token='';
$mode='';
$ssoResult='';

session_start();

$mode=$_POST['mode'];
switch($mode){
	case 'login':
		$id=$_POST['id'];
		$lognum = $id;
		$courseID = $_POST['courseID'];
		$classID = $courseID;
		$_SESSION['courseID'] = $classID;
		$authResult = $auth->studentLogin($id, $courseID);
		$authResult['message'] = '';
		if($authResult['code'] === 0){
			$_SESSION['token'] = $authResult['token'];
			$_SESSION['id'] = $id;
			$_SESSION['db'] = '';
		}
		print $authResult['message'];
		if(strpos($authResult['message'],'does not exist') !== false){
			error_log("does not exists");
			echo '<a href="index.php">ログインはこちら</a>';
			exit;
		}
		break;
	case 'confirm':
		$token=$_SESSION['token'];
		$id=$_SESSION['id'];
		$lognum=$id;
		$authResult = $auth->studentConfirm($id, $token);
		if($authResult['code'] === 0){
			print $authResult['values']['courseID'];
			$classID = $authResult['values']['courseID'];
			$_SESSION['courseID'] = $classID;
			$token='';
		}
		//print $authResult['message'];
		break;
	case 'revoke':
		$token=$_SESSION['token'];
		$id=$_SESSION['id'];
		$authResult = $auth->studentLogout($id, $token);
		if($authResult['code'] === 0){
			$_SESSION=array();
			session_destroy();
		}
		//print $authResult['message'];
		break;
	case 'saccess':
		break;
}
	
	
$_SESSION["lognum"] = $lognum;
$_SESSION["classID"] = $classID;
//ディレクトリの名前
$dirname = "./";
// --------------------------------------------- //
if ($_SESSION["lognum"] == "") {
echo "ようこそPHPエディタへ!<br>";
	echo "ログインが出来ていません。";
	echo '<a href="index.php">ログインはこちら</a>';
exit;
} else {
	// ログインでidがわかった後に以下を実行する。
	if("$user_path/$classID" == $Guest_Path){
	// ディレクトリを作る。すでに存在するとエラーになるが構わない。
		umask(0000);
		mkdir("/$Guest_Path", 0755,TRUE);
		umask(0022);
		umask(0000);
		mkdir("/$Guest_Path/$lognum", 0755,TRUE);
		umask(0022);
		if(!file_exists("$Guest_Path" . "/" . $lognum . "/common.php")){
			copy("common.php","$Guest_Path/$lognum/"."common.php");
			copy("error_check.js","$Guest_Path/$lognum/"."error_check.js");
			copy("./sample/HelloPHP.php","$Guest_Path/$lognum/"."HelloPHP.php");
			copy("./sample/quiz.php","$Guest_Path/$lognum/"."quiz.php");
			copy("./sample/formcheck.php","$Guest_Path/$lognum/"."formcheck.php");
			copy("./sample/conveni.php","$Guest_Path/$lognum/"."conveni.php");
			copy("./db/conveni.db","$Guest_Path/$lognum/"."conveni.db");
			copy("./db/rental.db","$Guest_Path/$lognum/"."rental.db");
			copy("./db/library.db","$Guest_Path/$lognum/"."library.db");
			copy("./db/studentList.db","$Guest_Path/$lognum/"."syudentList.db");
			touch("$Guest_Path/$lognum/"."time1.txt");
			file_put_contents("$Guest_Path/$lognum/"."time1.txt",filemtime("$Guest_Path/$lognum/"."time1.txt"));
		}
	}else{
	// ディレクトリを作る。すでに存在するとエラーになるが構わない。
		umask(0000);
		mkdir("/$user_path/$classID", 0755,TRUE);
		umask(0022);
		umask(0000);
		mkdir("/$user_path/$classID/$lognum", 0755,TRUE);
		umask(0022);
		copy("common.php","$user_path/$classID/$lognum/"."common.php");
		copy("error_check.js","$user_path/$classID/$lognum/"."error_check.js");
	}
	$dir = "$user_path/$classID/template/";
	// ディレクトリの存在を確認し、ハンドルを取得
	// 
	if( is_dir( $dir ) && $handle = opendir( $dir ) ) {
		copy("common.php","$user_path/$classID/template/"."common.php");
		// ループ処理
		while( ($file = readdir($handle)) !== false ) {
			// ファイルのみ取得
			if( filetype( $path = $dir . $file ) == "file" ) {
				// 各ファイルへの処理
				if (!preg_match("/\.txt$/", $file) && !file_exists("$user_path/$classID/$lognum/$file")) {
					copy($path,"$user_path/$classID/$lognum/$file");
				}
			}
			elseif(filetype($path = $dir.$file) == "dir"){
				if($file == "." || $file == ".."){ continue; }
				$_handle = opendir($dir.$file);
				mkdir("$user_path/$classID/$lognum/$file", 0777);
				while(($_file = readdir($_handle)) !== false){
					if(!preg_match("/\.txt$/", $_file) && !file_exists("$user_path/$classID/$lognum/$file/$_file")){
						copy($dir.$file."/".$_file, "$user_path/$classID/$lognum/$file/$_file");
					}
				}
			}
		}
	}
	setfile($user_path,"chat.txt",$classID,$lognum);
	// 個人に該当するファイルを探す ===================================== //
	$create = "$user_path/$classID/$lognum";
	$file_list = "";
	$dh = opendir("$create");
	while(false !==($f_list[] = readdir($dh)));
	closedir($dh);
	sort($f_list);
	$count=0;
	foreach ($f_list as $file) {
		if (!preg_match("/^lib$/", $file) && !preg_match("/^\.+$/", $file) && !preg_match("/.txt$/", $file) && preg_match("/\..*$/", $file) && !preg_match("/.db$/", $file) && $file != "common.php" && $file != "error_check.js") {
			$file_list .= "<li class=$count onclick=set_filename(event) title=$file id=$file>$file</li>";
		}else if(!preg_match("/^lib$/", $file) && !preg_match("/^\.+$/", $file) && !preg_match("/.txt$/", $file) && preg_match("/.+/", $file) && !preg_match("/.db$/", $file) && !preg_match("/.db$/", $file) && $file != "common.php"  && $file != "error_check.js"){
			$file_list .= "<li class=$count onclick=ch_dir(event) title=$file id=$file>$file/</li>";
		}else if(filetype($file) == "dir" && !preg_match("/^\.+$/", $file)){
             		$file_list .= "<li class=$count onclick=ch_dir(event) title=$file id=$file>$file/</li>";
		}
		$count++;
	}
	unset($file);
}
function setfile($path,$name,$class,$user){
	$target = $path."/".$class."/".$name;
	$link = $path."/".$class."/".$user."/".$name;
	unlink($link);
	link($target,$link);
} 
function rmdir_all($dir) {
  if (!file_exists("$dir")) {
    return;
  }
  $dhandle = opendir($dir);
   if ( $dirHandle = opendir ( $dir )) {
        while ( false !== ( $fileName = readdir ( $dirHandle ) ) ) {
            if ( $fileName != "." && $fileName != ".." ) {
                unlink($dir."/".$fileName);
            }
        }
        closedir ( $dirHandle );
    }
  rmdir($dir);
}
?>
