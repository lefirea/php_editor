<?php
session_start();
require_once("common.php");
$db = new PHP_PDO("コンビニ");

$sql='select * from 商品データ';
$result = $db->query($sql);
$list = $result->getColumnMeta();

foreach($list as $f){
	echo $f."<br>";
}
?>