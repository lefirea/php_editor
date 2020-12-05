<?php
  $courseID = $_GET['courseID'];
?>
<html>
  <head>
    <title>PHPエディタ ログイン</title>
  </head
  <body>
    <h3>PHPエディタ　ログインページ</h3>
    <ul>
      <li>「ログイン」を押して使用してください。</li>
      <li>「クラスID」と「ユーザID」を省略した場合はデモクラスに接続します。</li>
      <li>授業で指示されたsAccessの「クラスID」と「ユーザID」を入力してログインしてください。</li>
    </ul>

    <form method="post" action="php_editor.php" onsubmit=" return FormCheck();">
      <p>クラスID : <input type="text" id="courseID" name="courseID" value="<?php echo $courseID; ?>"></p>
      <p>ユーザID : <input type="text" id="id" name="id"></p>
<input type="hidden" id="mode" name="mode" value="login">
      <input type="submit" value="ログイン" name="send">
    </form>
    <script>
      function FormCheck(){
            if(document.getElementById('id').value == '' && document.getElementById('courseID').value == ''){
                  document.getElementById('courseID').value = "demoCourse";
                  document.getElementById('id').value = new Date().getTime();
                  return true;
            }
            if(document.getElementById('id').value.match(/^[a-zA-Z0-9_]+$/)){
	        if(document.getElementById('courseID').value.match(/^[a-zA-Z0-9_]+$/)){
          	      return true;
	        }else{
 	              alert('クラスIDは半角英数字で入力してください。');
		      return false;
	        }
            }else{
                alert('ユーザIDは半角英数字で入力してください。');
                return false;
            }
      }
    </script>
  </body>

</html>
