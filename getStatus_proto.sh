#!/bin/csh -f
cd /home/oecu-edu/www/php/refact/userfile/250881
#while 1
	clear
#	set okfile=/tmp/ok.txt
#	set errfile=/tmp/error.txt
#	set tmpfile=/tmp/error_msg.txt
	set okfile=ok.txt
	set errfile=error.txt
	set tmpfile=error_msg.txt
	rm -f $okfile
	rm -f $errfile
	rm -f $tmpfile
	touch $okfile
	touch $errfile
	foreach dir ( test demo )
    echo $dir
#		foreach f (`ls -t $dir/*.php | head -1`)
		foreach f (`ls -t $dir/*shop.php | head -1`)
			/home/oecu-edu/tmp/php -l $f >& $tmpfile
#			if ($?) then
			if ($status) then
				echo -n `date` >> $errfile
				echo -n "# " >> $errfile
				echo -n $dir >> $errfile
				echo -n ": " >> $errfile
				head -1 $tmpfile >> $errfile
			else
				echo $f >> $okfile
			endif
		end
	end
#	sleep 30
#end