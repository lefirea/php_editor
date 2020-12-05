#!/usr/local/bin/bash -xv


#Header
echo "Content-Type: text/html"
echo ""

#Body
#echo "<h1>`php -l $1`</h1>"
#echo "`php -l $1`"
echo "`(./getStatus_proto.sh)`"
