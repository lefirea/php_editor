<!DOCTYPE html>
<head>
	<title>クイズ</title>
</head>
<body>
	<p>Q.上り坂と下り坂日本で多いのは？</p>
	<form name="answers" action="quiz.php" method="post">
		<input type="radio" name="A" value="上り坂">A:上り坂<br>
		<input type="radio" name="A" value="下り坂">B:下り坂<br>
		<input type="radio" name="A" value="同じ">C:同じ<br>
		<input type="submit" value="回答">
	</form>
<?php
if(isset($_POST['A'])){
	$answer = $_POST['A'];
	if($answer == '同じ' ){
		echo '<h2>正解！</h2>';
	}else{
		echo '<h2>間違い...</h2>';
		echo '<p>上り坂も下り坂もおなじですよね．';
	}
}
?>

</body>
</html>