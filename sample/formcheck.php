<!DOCTYPE html>
<head>
	<title>フォームチェック</title>
</head>
<body>
	<p>送信フォームの入力値をチェックします。</p>
	<form name="input" action="formcheck.php" method="post">
		<input type="text" name="content" id='con'>
		<input type="submit" onclick="return check()" value="チェック">
	</form>

<script>
function check(){
	var con = document.getElementById('con').value;
	if(!con.match(/^[^ -~.-‘]*$/)){
		alert('全角文字以外が含まれています。')
		return false;
	}else
		alert('正しい入力です。')
		return true;
	}
</script>
</body>
<html>

<?php
if(isset($_POST['content'])){
	$con = $_POST['content'];
	echo "<h3>$con</h3>";
}
?>