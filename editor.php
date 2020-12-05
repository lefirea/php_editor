<?php
$jquery_path = 'lib/jquery.min.js';
$saccessPath = 'http://klab.eplang.jp/saccess'; // sAccess URL

// 必要ライブラリ
$class_authRequest_path = "lib/class_authRequest.php";	// 認証サーバアクセス用クラス
$class_dbServerRequest_path = "lib/class_dbServerRequest.php";	// sAccess SSOアクセス用クラス
// サーバアドレス設定 (URL or 相対パス, 管理者より連絡のあったものを設定)
$authServerPath = 'http://klab.eplang.jp/saccess/userManage/manage.php';	// 認証サーバURL
$dbServerPath = 'http://klab.eplang.jp/saccess/api.php';	// sAccess API URL

// 初期設定
require_once($class_authRequest_path);
require_once($class_dbServerRequest_path);
$auth = new AuthRequest($authServerPath);
$saccess = new DBServerRequest($dbServerPath);

function print_queryResultHTML($queryResult){
  if(!is_array($queryResult)){ echo 'no Result'; return(false);}
  $keylist = array_keys($queryResult[0]);
  ?>
  <table>
	<thead>
	  <tr>
		<?php foreach($keylist as $key) {?>
		<th><?php echo $key;?></th>
		<?php } ?>
	  </tr>
	</thead>
	<tbody>
      <?php foreach($queryResult as $record){ ?>
	  <tr>
		<?php foreach($keylist as $key) {?>
		<td><?php echo $record[$key];?></td>
		<?php } ?>
	  </tr>
      <?php }  ?>
    </tbody>
  </table>
  <?php
}

/* main */

$id='';
$token='';
$mode='';
$ssoResult='';

session_start();

$mode=$_POST['mode'];
switch($_POST['req_submit']){
  case '検証':
	switch($mode){
		case 'login':
			$id=$_POST['id'];
			$courseID = $_POST['courseID'];
			$authResult = $auth->studentLogin($id, $courseID);
			if($authResult['code'] === 0){
				$_SESSION['token'] = $authResult['token'];
				$_SESSION['id'] = $id;
				$_SESSION['db'] = '';
			}
			print $authResult['message'];
			break;
		case 'confirm':
			$token=$_SESSION['token'];
			$id=$_SESSION['id'];
			$authResult = $auth->studentConfirm($token);
			if($authResult['code'] === 0){
				print $authResult['values']['courseID'];
				$token='';
			}

echo "<br>";
			print $authResult['message'];
			break;
		case 'revoke':
			$token=$_SESSION['token'];
			$id=$_SESSION['id'];
			$authResult = $auth->studentLogout($id, $token);
			if($authResult['code'] === 0){
				$_SESSION=array();
				session_destroy();
			}
			print $authResult['message'];
			break;
		case 'saccess':
			break;
	}
	
	break;
  
  case 'DBリスト取得':
	$result = $saccess->getDBList($_SESSION['id'], $_SESSION['token'], 'ja');
	if($result['code'] === 0){
		$display = $result['courseID'].'<select name="dbLabel">';
		foreach($result['dblist'] as $dbLabel)
			$display .= "<option value=\"{$dbLabel}\">{$dbLabel}</option>";
		$display .= '</select><input type="submit" name="req_submit" value="DB接続"><!--<input type="submit" name="req_submit" value="DBパス取得">-->';
	}
	break;
  case 'DB接続':
	$result = $saccess->useDB($_SESSION['id'], $_SESSION['token'], $_POST['dbLabel']);
	if($result['code'] === 0){
		$tableLabelList = array();
		foreach($result['tables'] as $t){ $tableLabelList[] = $t['label']; }
		$display = $result['message'];//."(".implode(',',$tableLabelList).")";
		$_SESSION['db'] = $_POST['dbLabel'];
		$_SESSION['tableList'] = $tableLabelList;
	} else {
		$display ='取得失敗';
	} 
	break;
  case 'SQL発行':
	$result = $saccess->query($_SESSION['id'], $_SESSION['token'], $_POST['query']);
	if($result['code'] === 0){
		//$display = $result['message'];
		$queryResult_display = '成功';//print_r($result);
	} else {
		$queryResult_display ='失敗:'.$result['message'];
	} 
	break;
  /*case 'DBパス取得':
	$result = $saccess->getDBPath($_SESSION['id'], $_SESSION['token'], $_POST['dbLabel']);
	if($result['code'] === 0){
		$display = $result['dbPath'];
	} else {
		$display ='取得失敗';
	} 
	break;
	*/
}

?><!DOCTYPE html>
<html lang="ja">
 <head>
  <meta charset="utf-8">
  <script src="<?php print $jquery_path; ?>"></script>
  <script>
		$(document).on("change", "select[name='mode']",function(e){
			switch($(this).val()){
				case 'login':
					$("input[name=id]").toggle(true);
					$("input[name=courseID]").toggle(true);
					$("span[id=idPrint]").text('');
					$("span[id=tokenPrint]").text('');
					break;
				case 'confirm':
					$("input[name=id]").toggle(false);
					$("input[name=courseID]").toggle(false);
					$("span[id=idPrint]").text('<?=$_SESSION['id']?>');
					$("span[id=tokenPrint]").text('<?=$_SESSION['token']?>');
					break;
				case 'revoke':
					$("input[name=id]").toggle(false);
					$("input[name=courseID]").toggle(false);
					$("span[id=idPrint]").text('<?=$_SESSION['id']?>');
					$("span[id=tokenPrint]").text('<?=$_SESSION['token']?>');
					break;
			}
		});
		

  </script>
 </head>
 <body>
  <form method="post" action="">
   <select name="mode">
	<option value="login">Login</option>
	<option value="confirm">Confirm</option>
	<option value="revoke">Revoke</option>
   </select><br>
   UserID:  <input type="text" name="id" value="<?=$id?>"><span id="idPrint"></span><br>
   CourseID:  <input type="text" name="courseID" value="<?=$courseID?>"><span id="coursePrint"></span><br>
   Token:<span id="tokenPrint"></span><br>
   <input type="submit" name="req_submit" value="検証">
      
  </form>
  <form method="post" action="<?php print $saccessPath;?>">
	<input type="hidden" name="mode" value="sso">
	<input type="hidden" name="id" value="<?php print $_SESSION['id'];?>">
	<input type="hidden" name="token" value="<?php print $_SESSION['token'];?>">
   <input type="submit" name="req_submit" value="sAccessへ">
  </form>
  <hr>
  <form method="post" action="">
	<input type="submit" name="req_submit" value="DBリスト取得"><br>
   <span id="ssoPrint"><?php print_r($display); ?></span><br>
  </form>
  <hr>
  <form method="post" action="">
	DB: <?=$_SESSION['db']?> <?php if(isset($_SESSION['tableList'])) echo "(".implode(',',$_SESSION['tableList']).")";?><br>
	<input type="text" name="query" size="80" value="<?=$_POST['query']?>">
	<input type="submit" name="req_submit" value="SQL発行"><br>
    <span id="queryPrint"><?php print_r($queryResult_display); ?></span><br>
	<?php print_queryResultHTML($result['queryResult']); ?>
  </form>
 </body>
</html>
