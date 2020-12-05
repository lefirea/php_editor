<!DOCTYPE html>
<html lang="ja">
<head>
<script src="https://code.jquery.com/jquery.js"></script>
<title>丁半ゲーム</title>
</head>

<body>
<center><h1>丁半博打</h1></center>
<p>
※ルール<br>
勝てば2倍。</br>
連勝で倍率アップ。</br>
奇数なら「半」、偶数なら「丁」。<br>
持ち金が尽きたら・・・<br>
</p>

<p id="str">持ち金：100文</p>
<form name="te">
<input type="hidden" name="point" id="point" value=100>
<select name="bet">
<option value="10">10文</option>
<option value="50">50文</option>
<option value="100">100文</option>
</select>
<br>
<input  name="te" class="han" type="radio" value="han">半
<input  name="te" class="tyo" type="radio" value="tyo">丁
<button type="submit" class="Account">勝負</button>
</form>

<script>
var point = document.getElementById('point').value;
var bet = document.te.bet.value;
alert(document.te.bet.value);
var answer = Math.floor( ( Math.random() * 11 ) + 0 ) % 2 ;
if(document.te.te.checked){
	var te = 0;
}else{
	var te = 1;
}

if(answer == te){
	document.getElementById('point').value += bet * 2;
}

</script>

</body>
</html>