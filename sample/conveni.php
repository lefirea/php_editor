<!DOCTYPE html>
<html lang="ja">
<head>
	<title>サンプル</title>
</head>

<body>
	<h1 class="shop_name">サンプルショップ</h1>
	<form method="POST" action="conveni.php" class="search">
		<p>商品名検索：
		<input type="text" size="13" name="sname">
		<input type="submit" value="検索"></p>
	</form>
<?php
session_start();
require_once("common.php");
$cond="";
$sname="";

//データベースへの接続を表すPHP_ PDO インスタンスを生成する
$db = new PHP_PDO('コンビニ');

if(array_key_exists('sname',$_POST)){
	$sname = $_POST['sname'];
}
$sql='select * from 商品データ';

if($sname != ""){
	$cond=" where 商品名 like '%" . $sname ."%' ";
}
$sql = $sql . $cond;

//クエリの実行結果をPHP_PDOStatementオブジェクトで返す．
//クエリにエラーがあればエラーメッセージの方を文字列で返す.
$Statement = $db->query($sql);

//カラム名を配列で取得，引数でカラム名を指定可能．
$columnList = $Statement->getColumnMeta();
echo '<table border = "1">';
echo '<tr>';
foreach($columnList as $column){
	echo "<th>{$column}</th>";
}
echo '</tr>';

//結果を全て配列で取得する．
//fetch()では次の一行を取得可能．
foreach($Statement->fetchAll() as $row){
	echo '<tr>';
	foreach($columnList as $column){
		echo "<td>{$row[$column]}</td>";
	}
	echo '</tr>';
}
echo '</table>';
?>

</body>
</html>