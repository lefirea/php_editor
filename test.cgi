#!/usr/local/bin/bash


#Header
echo "Content-Type: text/html"
echo ""

#Body
#echo "<h1>`php -l $1`</h1>"
#echo "`/usr/bin/php -l $1`"
#echo "`(/usr/bin/php -l $1 >/dev/null)2>&1 | awk 'NR==1'`"
#echo "`/usr/bin/php -l $1 | awk 'NR==2'`"
echo exec("`/usr/bin/php -l $1`")

