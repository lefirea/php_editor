<html>
<head>
<title>インサート生成</title>
</head>

<body>
<form method="post" action="insert.php" onSubmit="return Formcheck()">
<table>
<tr><td align="right">バーコード(pid):</td><td><input type="text" name="id" id="id" style="width:1000px;"></td></tr>
<tr><td align="right">商品名(pname):</td><td><input type="text" name="name" id="name" style="width:1000px;"></td></tr>
<tr><td align="right">メーカー(pmaker):</td><td><input type="text" name="maker" id="maker" style="width:1000px;"></td></tr>
<tr><td align="right">値段(pprice):</td><td><input type="text" name="price" id="price" style="width:1000px;"></td></tr>
<tr><td align="right">画像URL(pimage):</td><td><input type="text" name="url" id="url" style="width:1000px;" onblur="ImageRead()"></td></tr>
<tr><td align="right">在庫(pstock):</td><td><input type="text" name="stock" id="stock" style="width:1000px;" maxlength="5"></td></tr>
</table>
<input type="submit" value="生成">
</form>

<?php
$id = $_POST['id'];
$name = $_POST['name'];
$maker = $_POST['maker'];
$price = $_POST['price'];
$url = $_POST['url'];
$stock = $_POST['stock'];

if(isset($_POST['id'])){
echo "生成結果 :<br>" ;
echo '<font color="blue">';
echo "(" . $id . ",'" . $name . "','" . $maker . "'," . $price . ",'" . $url . "'," . $stock . ");";
echo "</font>";
echo "<br><br>";
}

if(isset($_POST['url'])){
	echo '<img src="' . $_POST['url'] . '">';
}
?>

<script language="JavaScript">
function Formcheck(){
	if(!document.getElementById('id').value.match(/[0-9]{13}/)){
		alert('バーコード(pid)は半角数字13桁で入力してください');
		document.getElementById('id').focus();
        	return false;
	}else if(!document.getElementById('name').value.match(/.+/)){
		alert('商品名(pname)に入力がありません');
		document.getElementById('name').focus();
        	return false;
	}else if(!document.getElementById('maker').value.match(/.+/)){
		alert('メーカー(pmaker)に入力がありません');
		document.getElementById('maker').focus();
       		return false;
	}else if(!document.getElementById('price').value.match(/^[1-9][0-9]*$/)){
		alert('値段(pprice)1以上の半角数字のみで入力してください \n単位や記号、桁区切りは不要です');
		document.getElementById('price').focus();
       		return false;
	}else if(!document.getElementById('url').value.match(/.+/)){
		alert('画像URL(pimage)に入力がありません');
		document.getElementById('url').focus();
       		return false;	
	}else if(!document.getElementById('stock').value.match(/^[1-9][0-9]*$/)){
		alert('在庫(pstock)は1以上の半角英数字のみで入力してください\n単位や記号、桁区切りは不要です');
		document.getElementById('stock').focus();
       		return false;
	}else if(ImageCheck() == false){						
		alert('入力された画像URL(pimage)に画像が存在しません\nもう一度画像URLを取得しなおしてください');
		document.getElementById('url').focus();
       		return false;
	}else{
		return true;
	}
}

function ImageRead(){
	image = new Image();
	image.src = document.getElementById('url').value; 
}

function ImageCheck(){
Sleep(1);
	if(image.height > 0){
		return true;
	}
	return false
}

function Sleep( T ){ 
   var d1 = new Date().getTime(); 
   var d2 = new Date().getTime(); 
   while( d2 < d1+1000*T ){    //T秒待つ 
       d2=new Date().getTime(); 
   } 
   return; 
} 
	
</script>
</body>

</html>