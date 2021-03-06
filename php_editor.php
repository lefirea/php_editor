<?php
require_once "editor.js";
require_once "editor_sv.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
<!--	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<title>PHP Editor</title>
	<link href="jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
	<style>
		li:nth-child(odd){
		background-color: #f5f5f5;
		white-space: nowrap;
		overflow: hidden;
		}
		textarea{
			white-space:nowrap;
			overflow:scroll;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="well">
			<div class="pull-left"><span style="font-size:large">PHP_Editor<?php echo "(クラス : " .$classID.", ユーザー : ".$lognum.")";?></span></div>
			<div class="pull-right">
  				<?php echo '<a href="index.php">ログアウト</a>'; ?>
			</div>
		</div>
		<div class="col-sm-12 col-md-6" id="editor">
			<input type="hidden" id="user" value="<?php echo $lognum; ?>">
			<input type="hidden" id="run_file" name="filename" value="<?php echo $_POST['filename']; ?>">
			<input type="hidden" id="c_path" value="<?php echo "/".$classID . "/".$lognum."/";?>">
			<input type="hidden" id="classID" value="<?php echo $_SESSION['courseID'];?>">
			<input type="hidden" id="err_str" value="">
			<input type="hidden" id="request_RW" value="">
			<input type="hidden" id="old_file" value="">
			<input type="hidden" id="old_c_path" value="">
			<input type="hidden" name="lognum" id="lognum" value="<?php echo $lognum; ?>">
			<input type="hidden" name="filename" value="<?php echo $filename; ?>">
			<div class="btn-group">
				<button id="btn_newfile" class="btn btn-default" onclick="new_file();" title="新規ファイル"><span class="glyphicon glyphicon-file"></span></button>
				<button id="btn_newfolder" class="btn btn-default" onclick="input_dn();" title="新規フォルダ"><span class="glyphicon glyphicon-folder-open"></span></button>
				<button id="btn_trash" class="btn btn-default" onclick="Confirmation();" title="ファイル削除"><span class="glyphicon glyphicon-trash"></span></button>
				<button id="btn_duplicate" class="btn btn-default" onclick="duplicate();Formcheck();" title="ファイル複製"><span class="glyphicon glyphicon-duplicate"></span></button>
				<button id="btn_ok" class="btn btn-default" type="submit" onClick="input_fn();Formcheck();" title="ファイル保存"><span class="glyphicon glyphicon-floppy-disk"></span></button>
				<input type="file" id="upload_img" name="file_up" style="display:none"></input>
				<!--<button id="btn_upload" class="btn btn-default" title="ファイルアップロード"><span class="glyphicon glyphicon-upload"></span></button>-->
				<button id="btn_run" type="submit" name="save" class="btn btn-default" onClick="Formcheck();" title="実行" ><span class="glyphicon glyphicon-play"></span></button>
				<button id="btn_resize" class="btn btn-default" onclick="resize();" title="resize"><span class="glyphicon glyphicon-resize-full" area-hidden="true" id="icon_resize"></span>
			</div>
			<div class="text-center"><p id="current_path"style="border:1px solid; float: left; width: 50%;"><?php echo "カレントディレクトリ : /";?></p>
				<p id="usingfile"style="border:1px solid;">編集中 : 新規ファイル</p></div>
				<div class="row">
					<div class="col-xs-3" id="file_tree">
						<ul id="file_list" class="list-unstyled" style="border:1px solid; padding-left: 5px; overflow: scroll;height: 33em; " >
						<?php echo $file_list; ?>
						</ul>
					</div>
					<div class="col-xs-9" id="textarea">
						<textarea name="text" wrap="off" cols="256" class="lined form-control" style="font-family: Menlo; Courier: monospace; height:450px; resize: none; width: calc(100% - 60px);background-color:#fefffd;" id='request' onkeydown="insertTab(this, event);"></textarea>
					</div>
				</div>
				<div class="text-center"><p style="border:1px solid;">コンパイル結果</p><p id="err"></p></div>
			</div>
			<div id="result" class="col-sm-12 col-md-6">
				<div class="text-center"><p><!--実行結果--></p></div>
			</div>
		</div>
	</div>
</body>
</html>
