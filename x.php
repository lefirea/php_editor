<?php
$retval = exec("php -l userfile/".$argv[1]);
echo "errors:".$retval;
?>
