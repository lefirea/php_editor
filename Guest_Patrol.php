<?php
$ini_array = parse_ini_file('config.ini');
$Guest_path = $ini_array["GuestPath"];
$ctime = time();
//echo "$Guest_path";
//echo "<br>";
if ($userHandle = opendir("$Guest_path")) {
	while(false !==($userName = readdir($userHandle))){
		if($userName != "." && $userName!=".." && $userName!="fkoba_test"){
			$time1=file_get_contents("$Guest_path/$userName/"."time1.txt",true);
			//$time2=file_get_contents("$Guest_path/$userName/"."time2.txt",true);
			//echo $ctime-$time1;
			//echo "<br>";
			if($ctime-$time1 >= 3600){
				if($fileHandle = opendir($Guest_path."/".$userName)){
					while(false !== ($fileName = readdir($fileHandle))){
						if($fileName != "." && $fileName != ".."){
							removeDir($Guest_path."/".$userName);
						}
					}
					closedir($fileHandle);
				}
				rmdir($Guest_path."/".$userName);
				//echo $userName . " : have been daleted<br>";
			}
			
		}
	}
	closedir($userHandle);
}

function removeDir($dir){
	$cnt = 0;
	$handle = opendir($dir);
	if(!$handle){
		return ;
	}
	while(false !== ($item = readdir($handle))){
		if($item === "." || $item === ".."){
			continue;
		}
		$path = $dir . DIRECTORY_SEPARATOR . $item;
		if(is_dir($path)){
			// 再帰的に削除
			$cnt = $cnt + removeDir($path);
		}else{
			// ファイルを削除
			unlink($path);
		}
	}
	closedir($handle);
	// ディレクトリを削除
	if(!rmdir($dir)){
		return ;
	}
}
?>