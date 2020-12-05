//「<script src="error_check.js"></script>」
//上記の「」内を<head>タグ以下に挿入することでJSのエラーが確認できます．
window.onerror = function(msg, url, line, col, error) { 
    var report = msg + "\n" + "エラーがあります「" + line + "行目」を確認してください"; 
    alert(report); 
};